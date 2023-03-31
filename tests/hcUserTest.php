<?php
require_once __DIR__ . '/../src/hcUser.php';
//require_once '../src/hcUser.php';

class hcUserTest extends PHPUnit\Framework\TestCase
{

    /**
     * @covers hcUser::__construct
     * @covers hcUser::getEmail
     * @covers hcUser::getFname
     * @covers hcUser::getLname
     * @covers hcUser::getPhone
     */
    public function testConstructor()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $this->assertInstanceOf(hcUser::class, $user);
        $this->assertEquals('test@example.com', $user->getEmail());
        $this->assertEquals('John', $user->getFname());
        $this->assertEquals('Doe', $user->getLname());
        $this->assertEquals('123-456-7890', $user->getPhone());
    }

    /**
     * @covers hcUser::getEmail
     * @covers hcUser::__construct
     */
    public function testGetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    /**
     * @covers hcUser::setEmail
     * @covers hcUser::getEmail
     * @covers hcUser::__construct
     */
    public function testSetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $user->setEmail('new@example.com');
        $this->assertEquals('new@example.com', $user->getEmail());
    }

    // REMINDER TO SELF - Repeat the above pattern of test methods for the remaining methods of the hcUser class

    /**
     * @covers hcUser::getFname
     * @covers hcUser::__construct
     */
    public function testGetFname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $this->assertEquals('John', $user->getFname());
    }
    
    /**
     * @covers hcUser::setFname
     * @covers hcUser::getFname
     * @covers hcUser::__construct
     */
    public function testSetFname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $user->setFname('Jane');
        $this->assertEquals('Jane', $user->getFname());
    }

    /**
     * @covers hcUser::getMname
     * @covers hcUser::setMname
     * @covers hcUser::__construct
     */
    public function testGetMname()
    {
        $user = new hcUser('test@example.com', 'Dob', 'Doe', '123-456-7890', "12345");
        $user->setMname('Bob');
        $this->assertEquals('Bob', $user->getMname());
    }
    
    /**
     * @covers hcUser::setMname
     * @covers hcUser::getMname
     * @covers hcUser::__construct
     */
    public function testSetMname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $user->setMname('Jane');
        $this->assertEquals('Jane', $user->getMname());
    }




    /**
     * @covers hcUser::getLname
     * @covers hcUser::__construct
     */
    public function testGetLname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $this->assertEquals('Doe', $user->getLname());
    }

    /**
     * @covers hcUser::setLname
     * @covers hcUser::getLname
     * @covers hcUser::__construct
     */
    public function testSetLname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $user->setLname('Smith');
        $this->assertEquals('Smith', $user->getLname());
    }

    /**
     * @covers hcUser::getPhone
     * @covers hcUser::__construct
     */
    public function testGetPhone()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $this->assertEquals('123-456-7890', $user->getPhone());
    }

    /**
     * @covers hcUser::setPhone
     * @covers hcUser::getPhone
     * @covers hcUser::__construct
     */
    public function testSetPhone()
    {
        $user = new hcUser('test@example.com', 'Bob', 'Doe', '123-456-7890', "12345");
        $user->setPhone('555-555-5555');
        $this->assertEquals('555-555-5555', $user->getPhone());
    }

    /**
     * @covers hcUser::getZipcode
     * @covers hcUser::__construct
     */

    public function testGetZipcode()
    {
        $user = new hcUser('test@example.com', 'Bob', 'Doe', '123-456-7890', "12345");
        $this->assertEquals("12345", $user->getZipcode());
    }

    /**
     * @covers hcUser::getZipcode
     * @covers hcUser::setZipcode
     * @covers hcUser::__construct
     */

    public function testSetZipcode()
    {
        $user = new hcUser('test@example.com', 'Bob', 'Doe', '123-456-7890', "12345");
        $user->setZipcode("23456");
        $this->assertEquals("23456", $user->getZipcode());
    }

    /**
     * @covers hcUser::setEmail
     * @covers hcUser::setFname
     * @covers hcUser::setLname
     * @covers hcUser::setPhone
     * @covers hcUser::__construct
     * @covers hcUser::getEmail
     * @covers hcUser::getFname
     * @covers hcUser::getLname
     * @covers hcUser::getPhone
     */
    public function testAllSetters()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', "12345");
        $user->setEmail('new@example.com');
        $user->setFname('Jane');
        $user->setLname('Smith');
        $user->setPhone('555-555-5555');

        $this->assertEquals('new@example.com', $user->getEmail());
        $this->assertEquals('Jane', $user->getFname());
        $this->assertEquals('Smith', $user->getLname());
        $this->assertEquals('555-555-5555', $user->getPhone());
    }
}
?>
