<?php

use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{
    private $connection;

    protected function setUp(): void
    {
        $servername = "localhost";
        $username = "root";
        $password = "GasCo12345678";
        $dbname = "gasco"; // Use a test version of your database
        $port = 3307;

        $this->connection = new mysqli($servername, $username, $password, $dbname, $port);
    }
    protected function tearDown(): void
    {
        $this->connection->close();
    }
    /**
     * @covers \App\User::clean_input
     */
    public function testCleanInput(){
        $user = new User($this->connection);
        $dirtyInput = "    <script>alert('test');</script> \t";
        $expectedOutput = "&lt;script&gt;alert(&#039;test&#039;);&lt;/script&gt;";

        $cleanedInput = $user->clean_input($dirtyInput);
        $this->assertEquals($expectedOutput, $cleanedInput);
    }
    /**
    * @covers \App\User::createUser
    */
    public function testCreateUser()
    {
        $user = new User($this->connection);

        $validData = [
            'custEmail' => 'test@example.com',
            'password' => 'test1234',
            'fname' => 'John',
            'lname' => 'Doe',
            'phone' => '1234567890',
            'companyName' => 'Test Company',
            'state' => 'NY',
            'city' => 'New York',
            'street' => '123 Main St',
            'zipcode' => '12345'
        ];

        $this->assertTrue($user->createUser($validData));
    }

    /**
    * @covers \App\User::validate_input
    */
    public function testValidateInput(){
        $user = new User($this->connection);
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

        $this->assertTrue($user->validate_input($validData));
        $this->assertFalse($user->validate_input($invalidData));
    }
}