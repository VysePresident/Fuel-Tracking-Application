<?php
    class FinalReport{
        public $db_name;
        public function __construct($db_name='final_reports.db') {
        $this->db_name = $db_name;
        $this->create_table();
    }
    
    private function create_table() {
        $connection = new SQLite3($this->db_name);
        $connection->exec('CREATE TABLE IF NOT EXISTS final_reports (
                              id INTEGER PRIMARY KEY AUTOINCREMENT,
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
                              final_cost REAL NOT NULL)');
        $connection->close();
    }
    
    public function add_report($order, $fuel_quote, $trucking, $final_cost) {
        // Extract the required information from the instances of the other classes
        $last_order = $order->get_all_orders()[-1];
        list($fuel_type, $gallons, $first_name, $last_name, $email, $phone_number, $payment_method) = array_slice($last_order, 1);
    
        $last_quote = $fuel_quote->get_all_quotes()[-1];
        list($company_name, $state, $city, $address) = array_slice($last_quote, 1);
    
        $distance = $trucking->get_distance($city . ', ' . $state);
    
        $connection = new SQLite3($this->db_name);
        $stmt = $connection->prepare("INSERT INTO final_reports (
            company_name,
            state,
            city,
            address,
            fuel_type,
            gallons,
            first_name,
            last_name,
            email,
            phone_number,
            payment_method,
            distance,
            final_cost
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $company_name, SQLITE3_TEXT);
        $stmt->bindValue(2, $state, SQLITE3_TEXT);
        $stmt->bindValue(3, $city, SQLITE3_TEXT);
        $stmt->bindValue(4, $address, SQLITE3_TEXT);
        $stmt->bindValue(5, $fuel_type, SQLITE3_TEXT);
        $stmt->bindValue(6, $gallons, SQLITE3_INTEGER);
        $stmt->bindValue(7, $first_name, SQLITE3_TEXT);
        $stmt->bindValue(8, $last_name, SQLITE3_TEXT);
        $stmt->bindValue(9, $email, SQLITE3_TEXT);
        $stmt->bindValue(10, $phone_number, SQLITE3_TEXT);
        $stmt->bindValue(11, $payment_method, SQLITE3_TEXT);
        $stmt->bindValue(12, $distance, SQLITE3_FLOAT);
        $stmt->bindValue(13, $final_cost, SQLITE3_FLOAT);
        $stmt->execute();
        $stmt->close();
        $connection->close();
    }
    
    public function get_all_reports() {
        $connection = new SQLite3($this->db_name);
        $result = $connection->query('SELECT * FROM final_reports');
        $reports = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $reports[] = $row;
        }
        $result->finalize();
        $connection->close();
        return $reports;
        }
    }
?>