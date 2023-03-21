<?php

use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{
    private $user;

    protected function setUp(): void{
        $mysqli = $this->createMock(\mysqli::class);
        $this->user = new User($mysqli);
    }

    public function testCleanInput(){
        $dirtyInput = "    <script>alert('test');</script> \t";
        $expectedOutput = "&lt;script&gt;alert(&#039;test&#039;);&lt;/script&gt;";

        $cleanedInput = $this->user->clean_input($dirtyInput);
        $this->assertEquals($expectedOutput, $cleanedInput);
    }

    public function testValidateInput()
    {
        $validData = [
            'custEmail' => 'test@example.com',
            'password' => 'password123',
            'fname' => 'John',
            'lname' => 'Doe',
            'phone' => '1234567890',
            'companyName' => 'Test Company',
            'state' => 'Texas',
            'city' => 'Missouri City',
            'street' => '123 Main Street',
            'zipcode' => '90001'
        ];

        $invalidData = $validData;
        $invalidData['custEmail'] = 'invalid_email';

        $this->assertTrue($this->user->validate_input($validData));
        $this->assertFalse($this->user->validate_input($invalidData));
    }

    public function testCreateUser() {
        $validData = [
            'custEmail' => 'test@example.com',
            'password' => 'password123',
            'fname' => 'John',
            'lname' => 'Doe',
            'phone' => '1234567890',
            'companyName' => 'Test Company',
            'state' => 'Texas',
            'city' => 'Missouri City',
            'street' => '123 Main Street',
            'zipcode' => '90001'
        ];

        $invalidData = $validData;
        $invalidData['custEmail'] = 'invalid_email';

        $this->assertTrue($this->user->createUser($validData));
        $this->assertFalse($this->user->createUser($invalidData));
    }
}
