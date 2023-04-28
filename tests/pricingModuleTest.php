<?php

namespace tests;

require_once __DIR__ . '/../src/client.php';

use PHPUnit\Framework\TestCase;
use Client;
use PDO;
use PDOStatement;
use stdClass;

/**
 * @covers PricingModule
 */
class PricingModuleTest extends TestCase
{
    /**
     * @covers PricingModule::calculatePrice
     */
    public function testCalculatePrice(){
        // Set up test data
        $data = array('gallonsRequested' => 500);
        $_SESSION['client'] = new Client('Test Company', 'Texas', 'test@test.com');
        $conn = $this->getMockBuilder(PDO::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        // Set up mock database statement
        $stmt = $this->getMockBuilder(PDOStatement::class)
                     ->disableOriginalConstructor()
                     ->getMock();
        $stmt->expects($this->once())
             ->method('bind_param')
             ->with($this->equalTo('s'), $this->equalTo('test@test.com'));
        $stmt->expects($this->once())
             ->method('execute');
        $result = $this->getMockBuilder(stdClass::class)
                       ->setMethods(array('fetch_row'))
                       ->getMock();
        $result->expects($this->once())
               ->method('fetch_row')
               ->willReturn(array(1));
        $stmt->expects($this->once())
             ->method('get_result')
             ->willReturn($result);
        $conn->expects($this->once())
             ->method('prepare')
             ->with($this->equalTo('SELECT COUNT(*) FROM fuelquote WHERE email = ?'))
             ->willReturn($stmt);

        // Call pricingModule.php
        ob_start();
        include __DIR__ . '/../server/pricingModule.php';
        $output = ob_get_clean();

        // Check the response
        $response = json_decode($output, true);
        $this->assertArrayHasKey('suggestedPrice', $response);
        $this->assertArrayHasKey('totalAmount', $response);
        $this->assertIsNumeric($response['suggestedPrice']);
        $this->assertIsNumeric($response['totalAmount']);
        $this->assertGreaterThan(0, $response['suggestedPrice']);
        $this->assertGreaterThan(0, $response['totalAmount']);
    }
    
    /**
     * @covers Client::__construct
     * @covers Client::getName
     * @covers Client::getState
     * @covers Client::getEmail
     */
    public function testClient()
    {
        $client = new Client('Test Company', 'Texas', 'test@test.com');
        $this->assertEquals('Test Company', $client->getName());
        $this->assertEquals('Texas', $client->getState());
        $this->assertEquals('test@test.com', $client->getEmail());
    }
}
