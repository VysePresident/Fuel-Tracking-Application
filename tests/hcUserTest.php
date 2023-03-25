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
     * @covers hcUser::getPassword
     * @covers hcUser::getPhone
     */
    public function testConstructor()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertInstanceOf(hcUser::class, $user);
        $this->assertEquals('test@example.com', $user->getEmail());
        $this->assertEquals('John', $user->getFname());
        $this->assertEquals('Doe', $user->getLname());
        $this->assertEquals('123-456-7890', $user->getPhone());
        $this->assertEquals('password', $user->getPassword());
    }

    /**
     * @covers hcUser::getEmail
     * @covers hcUser::__construct
     */
    public function testGetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    /**
     * @covers hcUser::setEmail
     * @covers hcUser::getEmail
     * @covers hcUser::__construct
     */
    public function testSetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
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
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertEquals('John', $user->getFname());
    }
    
    /**
     * @covers hcUser::setFname
     * @covers hcUser::getFname
     * @covers hcUser::__construct
     */
    public function testSetFname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $user->setFname('Jane');
        $this->assertEquals('Jane', $user->getFname());
    }

    /**
     * @covers hcUser::getLname
     * @covers hcUser::__construct
     */
    public function testGetLname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertEquals('Doe', $user->getLname());
    }

    /**
     * @covers hcUser::setLname
     * @covers hcUser::getLname
     * @covers hcUser::__construct
     */
    public function testSetLname()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $user->setLname('Smith');
        $this->assertEquals('Smith', $user->getLname());
    }

    /**
     * @covers hcUser::getPhone
     * @covers hcUser::__construct
     */
    public function testGetPhone()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertEquals('123-456-7890', $user->getPhone());
    }

    /**
     * @covers hcUser::setPhone
     * @covers hcUser::getPhone
     * @covers hcUser::__construct
     */
    public function testSetPhone()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $user->setPhone('555-555-5555');
        $this->assertEquals('555-555-5555', $user->getPhone());

    }

    /**
     * @covers hcUser::getPassword
     * @covers hcUser::__construct
     */
    public function testGetPassword()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertEquals('password', $user->getPassword());
    }

    /**
     * @covers hcUser::setPassword
     * @covers hcUser::getPassword
     * @covers hcUser::__construct
     */
    public function testSetPassword()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $user->setPassword('newpassword');
        $this->assertEquals('newpassword', $user->getPassword());
    }

    /**
     * @covers hcUser::setEmail
     * @covers hcUser::setFname
     * @covers hcUser::setLname
     * @covers hcUser::setPhone
     * @covers hcUser::setPassword
     * @covers hcUser::__construct
     * @covers hcUser::getEmail
     * @covers hcUser::getFname
     * @covers hcUser::getLname
     * @covers hcUser::getPhone
     * @covers hcUser::getPassword
     */
    public function testAllSetters()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $user->setEmail('new@example.com');
        $user->setFname('Jane');
        $user->setLname('Smith');
        $user->setPhone('555-555-5555');
        $user->setPassword('newpassword');

        $this->assertEquals('new@example.com', $user->getEmail());
        $this->assertEquals('Jane', $user->getFname());
        $this->assertEquals('Smith', $user->getLname());
        $this->assertEquals('555-555-5555', $user->getPhone());
        $this->assertEquals('newpassword', $user->getPassword());
    }
}
?>
