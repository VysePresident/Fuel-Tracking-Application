<?php
require_once __DIR__ . '/../src/loginManager.php';
//require_once '../src/hcUser.php';

class loginManagerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers loginManager::__construct
     * @covers loginManager::getEmail
     * @covers loginManager::getPassword
     * @covers Dbh::connect
     */
    public function testConstructor()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $this->assertInstanceOf(LoginManager::class, $loginManager);
        $this->assertEquals('bob@gmail.com', $loginManager->getEmail());
        $this->assertEquals('Glory2Bob', $loginManager->getPassword());
    }

    /**
     * @covers loginManager::getEmail
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */

    public function testGetEmail()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $this->assertEquals($loginManager->getEmail(), "bob@gmail.com");
    }

    /**
     * @covers loginManager::getEmail
     * @covers loginManager::setEmail
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */
    public function testSetEmail()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $loginManager->setEmail("masterBob@gmail.com");
        $this->assertEquals($loginManager->getEmail(), "masterBob@gmail.com");
    }

    /**
     * @covers loginManager::getPassword
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */

    public function testGetPassword()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $this->assertEquals($loginManager->getPassword(), "Glory2Bob");
    }

    /**
     * @covers loginManager::getPassword
     * @covers loginManager::setPassword
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */
    public function testSetPassword()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $loginManager->setPassword("MOREGLORY2BOB!!!");
        $this->assertEquals($loginManager->getPassword(), "MOREGLORY2BOB!!!");
    }

    /**
     * @covers loginManager::getConn
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */

    /*public function testGetConn()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $this->assertEquals($loginManager->getconn(), $loginManager->connect());
    }*/

    /**
     * @covers loginManager::getPassword
     * @covers loginManager::setPassword
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */
    /*public function testSetConn()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $loginManager->setPassword("MOREGLORY2BOB!!!");
        $this->assertEquals($loginManager->getPassword(), "MOREGLORY2BOB!!!");
    }*/

    /**
     * @covers loginManager::getClientByEmail
     * @covers loginManager::__construct
     * @covers loginManager::doesPasswordMatch
     * @covers Dbh::connect
     * @covers client::__construct
     * @covers client::setCompanyStreet2
     * @covers hcUser::__construct
     * @covers hcUser::setMname
     */

    public function testGetClientByEmail()
    {
        // Good info
        $loginManager = new LoginManager('bob10@gmail.com', '123456789');
        $this->assertNotNull($loginManager->getClientByEmail('bob10@gmail.com'));
        // Bad email
        $this->assertNull($loginManager->getClientByEmail('FAKEBOB@gmail.com'));
        // Bad Password
        $loginManager2 = new LoginManager('bob10@gmail.com', 'FAKE_BOB_ID');
        $this->assertNull($loginManager2->getClientByEmail('bob10@gmail.com'));
        // Bad connection
        //$loginManager2 = new LoginManager('bob1@gmail.com', 'FAKE_BOB_ID');
        //$this->assertNull($loginManager2->getClientByEmail('bob1@gmail.com'));
    }

    /**
     * @covers loginManager::doesPasswordMatch
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */

    public function testdoesPasswordMatch() 
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $hashed_pwd = password_hash('Glory2Bob', PASSWORD_DEFAULT);
        $this->assertTrue($loginManager->doesPasswordMatch('Glory2Bob', $hashed_pwd));
        $this->assertFalse($loginManager->doesPasswordMatch("pwd", "notPwd"));
    }

    /**
     * @covers loginManager::doesPasswordMatch
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */

    /*public function testLoginUser()
    {
        $loginManager = new LoginManager('bob1@gmail.com', 'pwd');
        $client = new Client('bob@gmail.com', 'Bob', 'Doom', '281-123-4567', 
                                '12345', 'BobTech', 'Texas', 'Houston', '12345 Bob Rd');
        $this->assertTrue($loginManager->loginUser($client));
    }*/

    /**
     * @covers loginManager::isLoginValid
     * @covers loginManager::getClientByEmail
     * @covers loginManager::__construct
     * @covers Dbh::connect
     */

    public function testIsLoginValid() {
        $loginManager = new LoginManager('bob1@gmadfasdfadfail.com', 'pwd');
        $this->assertFalse($loginManager->isLoginValid());
        //$this->assertEquals($loginManager->isLoginValid(), );
    }

    
} 