# Import necessary modules
import sqlite3
import math 
import re

from geopy import distance
from geopy.geocoders import Nominatim
from geopy.exc import GeocoderTimedOut, GeocoderServiceError

# Define the classes for the application
class FuelQuote:
    def __init__(self, db_name='fuel_quotes.db'):
        self.db_name = db_name
        self.create_table()

    # Create fuel_quotes table in the database
    def create_table(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''CREATE TABLE IF NOT EXISTS fuel_quotes
                              (id INTEGER PRIMARY KEY AUTOINCREMENT,
                              company_name TEXT NOT NULL,
                              state TEXT NOT NULL,
                              city TEXT NOT NULL,
                              address TEXT NOT NULL)''')

    # Add a fuel quote to the database
    def add_quote(self, company_name, state, city, address):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''INSERT INTO fuel_quotes (company_name, state, city, address)
                              VALUES (?, ?, ?, ?)''', (company_name, state, city, address))
            connection.commit()

    # Get all fuel quotes from the database
    def get_all_quotes(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''SELECT * FROM fuel_quotes''')
            return cursor.fetchall()

    def get_last_quote_location(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''SELECT city, state FROM fuel_quotes ORDER BY id DESC LIMIT 1''')
            return cursor.fetchone()

    def get_num_quotes(self):
      with sqlite3.connect(self.db_name) as connection:
          cursor = connection.cursor()
          cursor.execute('''SELECT COUNT(*) FROM fuel_quotes''')
          return cursor.fetchone()[0]
          
    # Validate state input
    def is_valid_state(self, state):
        state_pattern = r'^[A-Za-z]{2}$'
        return re.match(state_pattern, state)

    # Validate city input
    def is_valid_city(self, city):
        city_pattern = r'^[A-Za-z\s\-]+$'
        return re.match(city_pattern, city)

    # Validate address input
    def is_valid_address(self, address):
        address_pattern = r'^[\d\sA-Za-z,.\-]+$'
        return re.match(address_pattern, address)
    
class Order:
    def __init__(self, db_name='orders.db'):
        self.db_name = db_name
        self.create_table()

    def create_table(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''CREATE TABLE IF NOT EXISTS orders
                              (id INTEGER PRIMARY KEY AUTOINCREMENT,
                              fuel_type TEXT NOT NULL,
                              gallons REAL NOT NULL,
                              first_name TEXT NOT NULL,
                              last_name TEXT NOT NULL,
                              email TEXT NOT NULL,
                              phone TEXT NOT NULL,
                              payment_type TEXT NOT NULL)''')

    def add_order(self, fuel_type, gallons, first_name, last_name, email, phone, payment_type):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''INSERT INTO orders (fuel_type, gallons, first_name, last_name, email, phone, payment_type)
                              VALUES (?, ?, ?, ?, ?, ?, ?)''', (fuel_type, gallons, first_name, last_name, email, phone, payment_type))
            connection.commit()

    def get_all_orders(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''SELECT * FROM orders''')
            return cursor.fetchall()

    def get_order_history(self, email):
      with sqlite3.connect(self.db_name) as connection:
          cursor = connection.cursor()
          cursor.execute('''SELECT * FROM orders WHERE email = ?''', (email,))
          return cursor.fetchall()

    def is_valid_fuel_type(self, fuel_type):
        return fuel_type.lower() in ['leaded', 'unleaded', 'diesel']

    def is_valid_gallons(self, gallons):
        try:
            float_gallons = float(gallons)
            return float_gallons > 0
        except ValueError:
            return False

    def is_valid_name(self, name):
        name_pattern = r'^[A-Za-z\s\-]+$'
        return re.match(name_pattern, name)

    def is_valid_email(self, email):
        email_pattern = r'^[\w\.-]+@[\w\.-]+\.\w+$'
        return re.match(email_pattern, email)

    def is_valid_phone(self, phone):
        phone_pattern = r'^\+?\d{10}$'
        return re.match(phone_pattern, phone)

    def is_valid_payment_type(self, payment_type):
        return payment_type.lower() in ['cash', 'credit', 'debit']
    
class Trucking:
    def __init__(self, user_agent, starting_location):
        self.user_agent = user_agent
        self.geolocator = Nominatim(user_agent=self.user_agent)
        self.starting_location = starting_location
    # This method calculates the distance in miles between the starting location and destination address.
    def get_distance(self, destination_address):
        try:
            starting_location = self.geolocator.geocode(self.starting_location, addressdetails=True, timeout=10)
            destination_location = self.geolocator.geocode(destination_address, addressdetails=True, timeout=10)
        except (GeocoderTimedOut, GeocoderServiceError):
            return None

        if starting_location and destination_location:
            starting_point = (starting_location.raw['lat'], starting_location.raw['lon'])
            destination_point = (destination_location.raw['lat'], destination_location.raw['lon'])
            return distance.distance(starting_point, destination_point).miles
        else:
            return None
    # This method calculates the final cost of transporting fuel based on the order and fuel quote information.
    def calculate_final_cost(self, order, fuel_quote):
        # Constants
        MAX_CAPACITY = 3000
        #The gas price changes based on the selected fuel by the user
        PRICES_PER_GALLON = {
                    "Leaded": 3.047,
                    "Unleaded": 3.760,
                    "Diesel": 3.793
                    }  
                    
        MPG = 6.5
        # Get the last order, fuel type, and quote from the order and fuel_quote instances
        gallons = order.get_all_orders()[-1][2]
        last_order = order.get_all_orders()[-1]
        fuel_type, gallons = last_order[1], last_order[2]
        city, state = fuel_quote.get_last_quote_location()
        destination_address = f"{city}, {state}"

        if gallons <= 0:
            return None

        distance_in_miles = self.get_distance(destination_address)

        if distance_in_miles is None:
            return None

        distance_cost = distance_in_miles / MPG


        #Get the price per gallon for the selected fuel type
        price_per_gallon = PRICES_PER_GALLON.get(fuel_type)

        # Calculate the number of trucks needed
        num_trucks = math.ceil(gallons / MAX_CAPACITY)
        remaining_gallons = gallons
        
        # Calculate the final cost based on the number of trucks
        final_cost = 0
        for _ in range(num_trucks):
            if remaining_gallons > MAX_CAPACITY:
                gallons_on_truck = MAX_CAPACITY
            else:
                gallons_on_truck = remaining_gallons

            cost_for_truck = gallons_on_truck * price_per_gallon + distance_cost
            final_cost += cost_for_truck
            remaining_gallons -= MAX_CAPACITY

        return final_cost
    
class TruckingCost:
    def __init__(self, db_name="trucking_costs.db"):
        self.db_name = db_name
        self.create_table()
    # This method creates the trucking_costs table if it doesn't exist.
    def create_table(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''CREATE TABLE IF NOT EXISTS trucking_costs
                              (id INTEGER PRIMARY KEY AUTOINCREMENT,
                              order_id INTEGER NOT NULL,
                              fuel_quote_id INTEGER NOT NULL,
                              final_cost REAL NOT NULL)''')

    def add_cost(self, order_id, fuel_quote_id, final_cost):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''INSERT INTO trucking_costs (order_id, fuel_quote_id, final_cost)
                              VALUES (?, ?, ?)''', (order_id, fuel_quote_id, final_cost))
            connection.commit()

    def get_all_costs(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''SELECT * FROM trucking_costs''')
            return cursor.fetchall()

class FinalReport:
    def __init__(self, db_name='final_reports.db'):
        self.db_name = db_name
        self.create_table()

    def create_table(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''CREATE TABLE IF NOT EXISTS final_reports
                              (id INTEGER PRIMARY KEY AUTOINCREMENT,
                              company_name TEXT NOT NULL,
                              state TEXT NOT NULL,
                              city TEXT NOT NULL,
                              address TEXT NOT NULL,
                              fuel_type TEXT NOT NULL,
                              gallons INTEGER NOT NULL,
                              first_name TEXT NOT NULL,
                              last_name TEXT NOT NULL,
                              email TEXT NOT NULL,
                              phone_number TEXT NOT NULL,
                              payment_method TEXT NOT NULL,
                              distance REAL NOT NULL,
                              final_cost REAL NOT NULL)''')

    def add_report(self, order, fuel_quote, trucking, final_cost):
        # Extract the required information from the instances of the other classes
        last_order = order.get_all_orders()[-1]
        fuel_type, gallons, first_name, last_name, email, phone_number, payment_method = last_order[1:]

        last_quote = fuel_quote.get_all_quotes()[-1]
        company_name, state, city, address = last_quote[1:]

        distance = trucking.get_distance(f"{city}, {state}")

        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''INSERT INTO final_reports (company_name, state, city, address, fuel_type, gallons, first_name, last_name, email, phone_number, payment_method, distance, final_cost)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)''', (company_name, state, city, address, fuel_type, gallons, first_name, last_name, email, phone_number, payment_method, distance, final_cost))
            connection.commit()

    def get_all_reports(self):
        with sqlite3.connect(self.db_name) as connection:
            cursor = connection.cursor()
            cursor.execute('''SELECT * FROM final_reports''')
            return cursor.fetchall()

    # Replace "YourAppName" with your actual application name
    user_agent = "YourAppName/1.0"
    DEFAULT_STARTING_LOCATION = "University of Houston, Houston, TX"
  
    # Set the starting location to the default starting location (University of Houston, Houston, TX)
    starting_location = DEFAULT_STARTING_LOCATION

    # Create instances of Order, FuelQuote, Trucking, and TruckingCost
    order = Order()
    fuel_quote = FuelQuote()
    trucking = Trucking(user_agent, starting_location)
    trucking_cost = TruckingCost()

   

if __name__ == "__main__":
    # Replace "YourAppName" with your actual application name
    user_agent = "YourAppName/1.0"
    DEFAULT_STARTING_LOCATION = "University of Houston, Houston, TX"
    
    # Set the starting location to the default starting location (University of Houston, Houston, TX)
    starting_location = DEFAULT_STARTING_LOCATION
    
    # Create instances of Order, FuelQuote, Trucking, and FinalReport classes
    fuel_quote = FuelQuote()
    order = Order()
    trucking = Trucking(user_agent, starting_location)
    final_report = FinalReport()
  
    company_name = input("Enter company name: ")

    # Validate state input
    while True:
        state = input("Enter state: ")
        if fuel_quote.is_valid_state(state):
            break
        print("Invalid state. Please enter a valid 2-letter state abbreviation.")

    # Validate city input
    while True:
        city = input("Enter city: ")
        if fuel_quote.is_valid_city(city):
            break
        print("Invalid city. Please enter a valid city name.")

    # Validate address input
    while True:
        address = input("Enter address: ")
        if fuel_quote.is_valid_address(address):
            break
        print("Invalid address. Please enter a valid address.")

    fuel_quote.add_quote(company_name, state, city, address)

    print("All fuel quotes in the database:")
    for quote in fuel_quote.get_all_quotes():
        print(quote)

    # Validate fuel type input
    while True:
        fuel_type = input("Enter fuel type (Leaded, Unleaded, Diesel): ")
        if order.is_valid_fuel_type(fuel_type):
            break
        print("Invalid fuel type. Please enter a valid fuel type.")

    # Validate gallons input
    while True:
        gallons = input("Enter gallons of fuel: ")
        if order.is_valid_gallons(gallons):
            gallons = float(gallons)
            break
        print("Invalid gallons. Please enter a positive number.")

    # Validate first name input
    while True:
        first_name = input("Enter first name: ")
        if order.is_valid_name(first_name):
            break
        print("Invalid first name. Please enter a valid first name.")

    # Validate last name input
    while True:
        last_name = input("Enter last name: ")
        if order.is_valid_name(last_name):
            break
        print("Invalid Last name. Please enter a valid last name.")
          
    # Validate email input
    while True:
        email = input("Enter Email: ")
        if order.is_valid_email(email):
            break
        print("Invalid Email address. Please enter a valid email.")
    
    # Validate phone number input
    while True:
        phone_number = input("Phone Number: ")
        if order.is_valid_phone(phone_number):
            break
        print("Invalid Phone number. Please enter a valid phone number.")
    
    # Valid payment type
    while True:
        payment_type = input("Enter payment type (cash, credit, debit): ")
        if order.is_valid_payment_type(payment_type):
            break
        print("Invalid payment type. Please enter a valid one based off of the given options")
    
    # Add an order to the database (assuming the user has provided valid input)
    order.add_order(fuel_type, gallons, first_name, last_name, email, phone_number, payment_type)
    
    # Add a fuel quote to the database (assuming the user has provided valid input)
    #fuel_quote.add_quote(order.get_all_orders())

    # Get the city and state from the last added fuel quote
    city, state = fuel_quote.get_last_quote_location()

    # Set the destination address based on the city and state from the FuelQuote class
    destination_address = f"{city}, {state}"

    distance_in_miles = trucking.get_distance(destination_address)
    if distance_in_miles:
        print(f"The distance from {trucking.starting_location} to {destination_address} is {distance_in_miles:.2f} miles.")
    else:
        print("Failed to calculate the distance. Please check the input addresses.")

    final_cost = trucking.calculate_final_cost(order, fuel_quote)

    if final_cost:
        print(f"The final cost for transporting the fuel is ${final_cost:.2f}.")
        # Store the final report in the database
        final_report.add_report(order, fuel_quote, trucking, final_cost)
    if final_cost is not None:
        # Store the final report in the database
        final_report = FinalReport()
        final_report.add_report(order, fuel_quote, trucking, final_cost)

    print("All orders in the database:")
    for report in final_report.get_all_reports():
        print(report)
