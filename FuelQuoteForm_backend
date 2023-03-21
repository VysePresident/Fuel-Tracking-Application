#Fuel Quote Class
import sqlite3
import re

# FuelQuote class
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
        address_pattern = r'^[\d\s\w,.\-]+$'
        return re.match(address_pattern, address)

if __name__ == '__main__':
    fuel_quote = FuelQuote()

    # Example usage:
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
        
        
#Order class
import sqlite3
import re

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

    

if __name__ == '__main__':
    order = Order()

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
   
    while True:
      payment_type = input("Enter payment type (cash, credit, debit): ")
      if order.is_valid_payment_type(payment_type):
        break
      print("Invalid payment type. Please enter a valid one based off of the given options")
    order.add_order(fuel_type, gallons, first_name, last_name, email, phone_number, payment_type)

    print("All orders in the database:")
    for o in order.get_all_orders():
        print(o)
    
#Trucking class 
!pip install geopy

import requests
from geopy import distance
from geopy.geocoders import Nominatim

class Trucking:
    def __init__(self, user_agent):
        self.user_agent = user_agent
        self.geolocator = Nominatim(user_agent=self.user_agent)
        self.starting_location = "University of Houston, Houston, TX"

    def get_distance(self, destination_address):
        starting_point = self.geolocator.geocode(self.starting_location)
        destination_point = self.geolocator.geocode(destination_address)

        if starting_point and destination_point:
            return distance.distance((starting_point.latitude, starting_point.longitude),
                                      (destination_point.latitude, destination_point.longitude)).miles
        else:
            return None

    def is_valid_address(self, address):
        geocode_result = self.geolocator.geocode(address)
        return geocode_result is not None

if __name__ == "__main__":
    # Replace "YourAppName" with your actual application name
    user_agent = "YourAppName/1.0"
    trucking = Trucking(user_agent)

    while True:
        destination_address = input("Enter the destination address: ")

        if trucking.is_valid_address(destination_address):
            break
        else:
            print("Invalid address. Please enter a valid address.")

    distance_in_miles = trucking.get_distance(destination_address)

    if distance_in_miles:
        print(f"The distance from the University of Houston to the destination is {distance_in_miles:.2f} miles.")
    else:
        print("Failed to calculate the distance. Please check the input address.")
