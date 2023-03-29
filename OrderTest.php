<?php
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private $order;

    protected function setUp(): void
    {
        $this->order = new Order('test.db');
    }

    protected function tearDown(): void
    {
        unset($this->order);
        unlink('test.db');
    }

    public function testAddOrder(): void
    {
        $initialOrderCount = count($this->order->get_all_orders());

        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');

        $allOrders = $this->order->get_all_orders();
        $newOrderCount = count($allOrders);

        $this->assertEquals($initialOrderCount + 1, $newOrderCount);
    }

    public function testGetAllOrders(): void
    {
        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');
        $this->order->add_order('unleaded', 200, 'Jane', 'Smith', 'janesmith@example.com', '+0987654321', 'credit');

        $allOrders = $this->order->get_all_orders();

        $this->assertCount(2, $allOrders);

        $lastOrder = end($allOrders);
        $this->assertEquals('unleaded', $lastOrder['fuel_type']);
        $this->assertEquals(200, $lastOrder['gallons']);
        $this->assertEquals('Jane', $lastOrder['first_name']);
        $this->assertEquals('Smith', $lastOrder['last_name']);
        $this->assertEquals('janesmith@example.com', $lastOrder['email']);
        $this->assertEquals('+0987654321', $lastOrder['phone']);
        $this->assertEquals('credit', $lastOrder['payment_type']);
    }

    public function testGetOrderHistory(): void
    {
        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');
        $this->order->add_order('unleaded', 200, 'Jane', 'Smith', 'janesmith@example.com', '+0987654321', 'credit');

        $johnOrders = $this->order->get_order_history('johndoe@example.com');
        $janeOrders = $this->order->get_order_history('janesmith@example.com');

        $this->assertCount(1, $johnOrders);
        $this->assertCount(1, $janeOrders);

        $this->assertEquals('leaded', $johnOrders[0]['fuel_type']);
        $this->assertEquals(100, $johnOrders[0]['gallons']);
        $this->assertEquals('John', $johnOrders[0]['first_name']);
        $this->assertEquals('Doe', $johnOrders[0]['last_name']);
        $this->assertEquals('johndoe@example.com', $johnOrders[0]['email']);
        $this->assertEquals('+1234567890', $johnOrders[0]['phone']);
        $this->assertEquals('cash', $johnOrders[0]['payment_type']);

        $this->assertEquals('unleaded', $janeOrders[0]['fuel_type']);
        $this->assertEquals(200, $janeOrders[0]['gallons']);
    }
}
?>
