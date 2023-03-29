<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once 'FinalReport.php';

final class FinalReportTest extends TestCase
{
    private $finalReport;
    private $db_name = 'test_final_reports.db';

    protected function setUp(): void
    {
        $this->finalReport = new FinalReport($this->db_name);
    }

    protected function tearDown(): void
    {
        // Clean up the test database
        unlink($this->db_name);
    }

    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            FinalReport::class,
            $this->finalReport
        );
    }

    public function testAddReport(): void
    {
        // Create dummy instances of Order, FuelQuote, and Trucking classes
        // Replace them with actual instances if needed
        $order = new stdClass();
        $fuel_quote = new stdClass();
        $trucking = new stdClass();

        // Mock get_all_orders method
        $order->get_all_orders = function() {
            return [
                [
                    1,
                    'Diesel',
                    100,
                    'John',
                    'Doe',
                    'john@example.com',
                    '123-456-7890',
                    'Credit Card'
                ]
            ];
        };
    
        // Mock get_all_quotes method
        $fuel_quote->get_all_quotes = function() {
            return [
                [
                    1,
                    'Best Fuel Supplier',
                    'CA',
                    'Los Angeles',
                    '1234 Main St'
                ]
            ];
        };
    
        // Mock get_distance method
        $trucking->get_distance = function($location) {
            return 50.0;
        };
    
        // Test adding a report
        $final_cost = 2500.0;
        $this->finalReport->add_report($order, $fuel_quote, $trucking, $final_cost);
    
        // Check if the report was added correctly
        $reports = $this->finalReport->get_all_reports();
        $this->assertCount(1, $reports);
    
        $expectedReport = [
            'id' => 1,
            'company_name' => 'Best Fuel Supplier',
            'state' => 'CA',
            'city' => 'Los Angeles',
            'address' => '1234 Main St',
            'fuel_type' => 'Diesel',
            'gallons' => 100,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone_number' => '123-456-7890',
            'payment_method' => 'Credit Card',
            'distance' => 50.0,
            'final_cost' => 2500.0
        ];
    
        $this->assertEquals($expectedReport, $reports[0]);
    }
    
    public function testGetAllReports(): void
    {
        // Add dummy reports to the test database
        $this->addDummyReports();
    
        // Test getting all reports
        $reports = $this->finalReport->get_all_reports();
    
        // Check if the correct number of reports is returned
        $this->assertCount(2, $reports);
    }
    
    private function addDummyReports(): void
    {
        $connection = new SQLite3($this->db_name);
    
        $dummyReports = [
            [
                'Best Fuel Supplier',
                'CA',
                'Los Angeles',
                '1234 Main St',
                'Diesel',
                100,
                'John',
                'Doe',
                'john@example.com',
                '123-456-7890',
                'Credit Card',
                50.0,
                2500.0
            ],
            [
                'Another Fuel Supplier',
                'TX',
                'Houston',
                '5678 Second St',
                'Gasoline',
                150,
                'Jane',
                'Smith',
                'jane@example.com',
                '987-654-3210',
                'Debit Card',
                100.0,
                3500.0
            ]
        ];
        
    foreach ($dummyReports as $report) {
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

        for ($i = 1; $i <= count($report); $i++) {
            $type = ($i === 6 || $i === 12 || $i === 13) ? SQLITE3_FLOAT : SQLITE3_TEXT;
            $stmt->bindValue($i, $report[$i - 1], $type);
        }

        $stmt->execute();
    } 

    $stmt->close();
    $connection->close();
    }
}
?>
    
