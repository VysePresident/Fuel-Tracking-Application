<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once 'Order.php';

class OrderTest extends TestCase
{
    protected $order;

    protected function setUp(): void
    {
        $this->order = new Order();
    }

    public function testAddOrder()
    {
        $initialOrderCount = count($this->order->get_all_orders());

        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');

        $allOrders = $this->order->get_all_orders();
        $newOrderCount = count($allOrders);

        $this->assertEquals($initialOrderCount + 1, $newOrderCount);
    }

    public function testGetLastOrderId()
    {
        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');
        $lastOrderId = $this->order->get_last_order_id();
        $allOrders = $this->order->get_all_orders();

        $this->assertEquals($lastOrderId, end($allOrders)['id']);
    }

    public function testGetAllOrders()
    {
        $initialOrderCount = count($this->order->get_all_orders());

        $this->order->add_order('leaded', 100, 'John', 'Doe', 'johndoe@example.com', '+1234567890', 'cash');
        $this->order->add_order('unleaded', 200, 'Jane', 'Smith', 'janesmith@example.com', '+0987654321', 'credit');

        $allOrders = $this->order->get_all_orders();
        $newOrderCount = count($allOrders);

        $this->assertEquals($initialOrderCount + 2, $newOrderCount);

        $lastOrder = end($allOrders);
        $this->assertEquals('unleaded', $lastOrder['fuel_type']);
        $this->assertEquals(200, $lastOrder['gallons']);
        $this->assertEquals('Jane', $lastOrder['first_name']);
        $this->assertEquals('Smith', $lastOrder['last_name']);
        $this->assertEquals('janesmith@example.com', $lastOrder['email']);
        $this->assertEquals('+0987654321', $lastOrder['phone_number']);
        $this->assertEquals('credit', $lastOrder['payment_type']);
    }

    // Other test methods for the Order class...
}
