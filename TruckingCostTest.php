<?php
use PHPUnit\Framework\TestCase;

class TruckingCostTest extends TestCase
{
    // Define the name of the test database and create an instance of the TruckingCost class.
    protected $db_name = 'test_trucking_costs.db';
    protected $trucking_cost;

    // Set up the test by creating an instance of the TruckingCost class and initializing the database.
    protected function setUp(): void
    {
        $this->trucking_cost = new TruckingCost($this->db_name);
    }

    // Clean up after the test by deleting the test database file.
    protected function tearDown(): void
    {
        unlink($this->db_name);
    }

    // Test the add_cost and get_all_costs methods by adding some costs to the database and retrieving them.
    public function testAddAndGetAllCosts()
    {
        $this->trucking_cost->add_cost(1, 1, 100.50);
        $this->trucking_cost->add_cost(2, 2, 200.75);
        $this->trucking_cost->add_cost(3, 3, 300.25);

        $expected_costs = [
            [
                'id' => 1,
                'order_id' => 1,
                'fuel_quote_id' => 1,
                'final_cost' => 100.50,
            ],
            [
                'id' => 2,
                'order_id' => 2,
                'fuel_quote_id' => 2,
                'final_cost' => 200.75,
            ],
            [
                'id' => 3,
                'order_id' => 3,
                'fuel_quote_id' => 3,
                'final_cost' => 300.25,
            ],
        ];

        $this->assertEquals($expected_costs, $this->trucking_cost->get_all_costs());
    }

    /**
     * Test the create_table method by calling it and verifying that the table exists in the database.
     *
     * @covers TruckingCost::create_table
     */
    public function testCreateTable()
    {
        $this->trucking_cost->create_table();

        $connection = new SQLite3($this->db_name);
        $result_set = $connection->query('SELECT name FROM sqlite_master WHERE type = "table" AND name = "trucking_costs"');
        $this->assertTrue($result_set->fetchArray() !== false);
    }

    /**
     * Test the add_cost and get_all_costs methods by adding a single cost to the database and retrieving it.
     *
     * @covers TruckingCost::add_cost
     * @covers TruckingCost::get_all_costs
     */
    public function testAddAndGetCost()
    {
        $this->trucking_cost->add_cost(1, 1, 100.50);

        $expected_cost = [
            'id' => 1,
            'order_id' => 1,
            'fuel_quote_id' => 1,
            'final_cost' => 100.50,
        ];

        $this->assertEquals([$expected_cost], $this->trucking_cost->get_all_costs());
    }
}
?>
