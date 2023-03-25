<?php
require_once __DIR__ . '/../server/loginManager.php';
//require_once '../src/hcUser.php';

class loginManagerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers loginManager::__construct
     * @covers loginManager::getEmail
     * @covers loginManager::getPassword
     */
    public function testConstructor()
    {
        $loginManager = new LoginManager('bob@gmail.com', 'Glory2Bob');
        $this->assertInstanceOf(LoginManager::class, $loginManager);
        $this->assertEquals('bob@gmail.com', $loginManager->getEmail());
        $this->assertEquals('Glory2Bob', $loginManager->getPassword());
    }
}