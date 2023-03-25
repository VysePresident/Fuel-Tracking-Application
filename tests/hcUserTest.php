<?php
require_once __DIR__ . '/../server/hcUser.php';

class hcUserTest extends PHPUnit\Framework\TestCase
{
    public function testGetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    public function testSetEmail()
    {
        $user = new hcUser('test@example.com', 'John', 'Doe', '123-456-7890', 'password');
        $user->setEmail('new@example.com');
        $this->assertEquals('new@example.com', $user->getEmail());
    }

    // REMINDER TO SELF - Repeat the above pattern of test methods for the remaining methods of the hcUser class
}
?>
