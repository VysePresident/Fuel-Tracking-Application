<?php
    class dummyFile{
        public $db_name;
        function __construct($db_name='fuel_quotes.db') {
        $this->db_name = $db_name;
        $this->create_table();
        }

        function create_table() {
            $connection = new SQLite3($this->db_name);
            $connection->exec('CREATE TABLE IF NOT EXISTS fuel_quotes
                (id INTEGER PRIMARY KEY AUTOINCREMENT,
                company_name TEXT NOT NULL,
                state TEXT NOT NULL,
                city TEXT NOT NULL,
                address TEXT NOT NULL)');
        }
        function add_quote($company_name, $state, $city, $address) {
            $connection = new SQLite3($this->db_name);
            $stmt = $connection->prepare('INSERT INTO fuel_quotes (company_name, state, city, address)
                VALUES (:company_name, :state, :city, :address)');
            $stmt->bindValue(':company_name', $company_name, SQLITE3_TEXT);
            $stmt->bindValue(':state', $state, SQLITE3_TEXT);
            $stmt->bindValue(':city', $city, SQLITE3_TEXT);
            $stmt->bindValue(':address', $address, SQLITE3_TEXT);
            $stmt->execute();
        }    

        function get_all_quotes() {
            $connection = new SQLite3($this->db_name);
            $result = $connection->query('SELECT * FROM fuel_quotes');
            $quotes = array();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                array_push($quotes, $row);
            }
            return $quotes;
        }
        function get_last_quote_location() {
            $connection = new SQLite3($this->db_name);
            $stmt = $connection->prepare('SELECT city, state FROM fuel_quotes ORDER BY id DESC LIMIT 1');
            $result = $stmt->execute();
            return $result->fetchArray(SQLITE3_ASSOC);
        }
        function get_num_quotes() {
            $connection = new SQLite3($this->db_name);
            $result = $connection->query('SELECT COUNT(*) FROM fuel_quotes');
            return $result->fetchArray(SQLITE3_NUM)[0];
        }

         // Validate state input
    function is_valid_state($state) {
        $state_pattern = '/^[A-Za-z]{2}$/';
        return preg_match($state_pattern, $state);
    }
    function is_valid_city($city) {
        $city_pattern = '/^[A-Za-z\s\-]+$/';
        return preg_match($city_pattern, $city);
    }
        // Validate address input
        function is_valid_address($address) {
            $address_pattern = '/^[\d\sA-Za-z,.\-]+$/';
            return preg_match($address_pattern, $address);
        }
    }
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $company_name = $_POST['company_name'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $fuel_type = $_POST['fuelType'];
        $gallons_requested = $_POST['gallonsRequested'];
        $delivery_date = $_POST['deliveryDate'];
        $payment_type = $_POST['paymentType'];
    
        // Validate inputs
        $errors = array();
        if (empty($company_name)) {
            $errors[] = 'Company name is required';
        }
        if (empty($state) || !preg_match('/^[A-Za-z]{2}$/', $state)) {
            $errors[] = 'State is required and must be a valid two-letter abbreviation';
        }
        if (empty($city) || !preg_match('/^[A-Za-z\s\-]+$/', $city)) {
            $errors[] = 'City is required and must contain only letters, spaces, and hyphens';
        }
        if (empty($address) || !preg_match('/^[\d\sA-Za-z,.\-]+$/', $address)) {
            $errors[] = 'Address is required and must contain only letters, numbers, spaces, and punctuation marks';
        }
        if (empty($fuel_type)) {
            $errors[] = 'Fuel type is required';
        }
        if (empty($gallons_requested) || !is_numeric($gallons_requested)) {
            $errors[] = 'Gallons requested is required and must be a number';
        }
        if (empty($delivery_date)) {
            $errors[] = 'Delivery date is required';
        }
        if (empty($payment_type)) {
            $errors[] = 'Payment type is required';
        }
    
        // If there are errors, display them to the user
        if (!empty($errors)) {
            echo '<div class="error"><ul>';
            foreach ($errors as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul></div>';
        } else {
            // Otherwise, save the data to the database and redirect to the order summary page
            require_once 'FuelQuotePractice.php';
            $quote = new FuelQuotePractice();
            $quote->add_quote($company_name, $state, $city, $address);
            // Redirect to order summary page with query parameters for the fuel quote details
            $query_params = http_build_query(array(
                'company_name' => $company_name,
                'state' => $state,
                'city' => $city,
                'address' => $address,
                'fuel_type' => $fuel_type,
                'gallons_requested' => $gallons_requested,
                'delivery_date' => $delivery_date,
                'payment_type' => $payment_type
            ));
            header('Location: orderSummary.php?' . $query_params);
            exit();
        }
    }
    
    ?>
    