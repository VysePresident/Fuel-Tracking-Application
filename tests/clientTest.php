<?php
require_once __DIR__ . '/../src/client.php';
//require_once '../src/hcUser.php';

class clientTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers client::__construct
     * @covers client::getCompanyCity
     * @covers client::getCompanyName
     * @covers client::getCompanyState
     * @covers client::getCompanyStreet
     * @covers hcUser::getEmail
     * @covers hcUser::getFname
     * @covers hcUser::getLname
     * @covers hcUser::getPassword
     * @covers hcUser::getPhone
     * @covers hcUser::__construct
     */
    public function testConstructor()
    {
        $client = new Client('bob@gmail.com', 'Bob', 'Doom', '281-123-4567', 
                                'Glory2Bob', 'BobTech', 'Texas', 'Houston', '12345 Bob Rd');
        $this->assertEquals($client->getEmail(), 'bob@gmail.com');
        $this->assertEquals($client->getFname(), 'Bob');
        $this->assertEquals($client->getLname(), 'Doom');
        $this->assertEquals($client->getPhone(), '281-123-4567');
        $this->assertEquals($client->getPassword(), 'Glory2Bob');
        $this->assertEquals($client->getCompanyName(), 'BobTech');
        $this->assertEquals($client->getCompanyState(), 'Texas');
        $this->assertEquals($client->getCompanyCity(), 'Houston');
        $this->assertEquals($client->getCompanyStreet(), '12345 Bob Rd');
    }

    // Testing

    /**
     * @covers client::getCompanyName
     * @covers client::setCompanyName
     * @covers client::__construct
     * @covers hcUser::__construct
     */
    public function testCompanyName()
    {
        $client = new Client('bob@gmail.com', 'Bob', 'Doom', '281-123-4567', 
                                'Glory2Bob', 'BobTech', 'Texas', 'Houston', '12345 Bob Rd');
        $client->setCompanyName('NewTech');
        $this->assertEquals($client->getCompanyName(), 'NewTech');
    }

    /**
     * @covers client::getCompanyState
     * @covers client::setCompanyState
     * @covers client::__construct
     * @covers hcUser::__construct
     */
    public function testCompanyState()
    {
        $client = new Client('bob@gmail.com', 'Bob', 'Doom', '281-123-4567', 
                                'Glory2Bob', 'BobTech', 'Texas', 'Houston', '12345 Bob Rd');
        $client->setCompanyState('California');
        $this->assertEquals($client->getCompanyState(), 'California');
    }

    /**
     * @covers client::getCompanyCity
     * @covers client::setCompanyCity
     * @covers client::__construct
     * @covers hcUser::__construct
     */
    public function testCompanyCity()
    {
        $client = new Client('bob@gmail.com', 'Bob', 'Doom', '281-123-4567', 
                                'Glory2Bob', 'BobTech', 'Texas', 'Houston', '12345 Bob Rd');
        $client->setCompanyCity('Austin');
        $this->assertEquals($client->getCompanyCity(), 'Austin');
    }

    /**
     * @covers client::getCompanyStreet
     * @covers client::setCompanyStreet
     * @covers client::__construct
     * @covers hcUser::__construct
     */
    public function testCompanyStreet()
    {
        $client = new Client('bob@gmail.com', 'Bob', 'Doom', '281-123-4567', 
                                'Glory2Bob', 'BobTech', 'Texas', 'Houston', '12345 Bob Rd');
        $client->setCompanyStreet('9876 New St');
        $this->assertEquals($client->getCompanyStreet(), '9876 New St');
    }




}
?>
