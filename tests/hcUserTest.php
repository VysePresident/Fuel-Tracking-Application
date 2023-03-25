<?php
require_once __DIR__ . '/../src/hcUser.php';
//require_once '../src/hcUser.php';

class hcUserTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers hcUser::getEmail
     * @covers \App\User::__construct
     */
    public function testGetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    /**
     * @covers hcUser::setEmail
     * @covers \App\User::__construct
     */
    public function testSetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $user->setEmail('new@example.com');
        $this->assertEquals('new@example.com', $user->getEmail());
    }

    // REMINDER TO SELF - Repeat the above pattern of test methods for the remaining methods of the hcUser class
}
?>
