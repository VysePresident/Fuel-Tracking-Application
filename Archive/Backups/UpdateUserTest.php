<?php

use App\User;
use PHPUnit\Framework\TestCase;

class UpdateUserTest extends TestCase{
    protected $connection;
    protected $user;

    protected function setUp(): void{
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "GasCo12345678";
        $dbname = "gasco";
        $port = 3307;
    
        // Create connection
        $this->connection = new mysqli($servername, $username, $password, $dbname, $port);
    
        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    
        // Set up the User instance
        $this->user = new User($this->connection);
    
        // Create a test user in the database
        $this->testUserId = $this->createTestUser();
    }
    
    protected function tearDown(): void
    {
        // Clean up the test user from the database
        $this->deleteTestUser($this->testUserId);
    }

    public function testUpdateUser()
    {
        // Call the updateUser method with the test user ID and new values
        $newValues = [
            'custEmail' => 'test@example.com',
            'password' => 'password123',
            'fname' => 'UpdatedFirstName',
            'lname' => 'UpdatedLastName',
            'phone' => '1234567890',
            'companyName' => 'Test Company',
            'state' => 'Texas',
            'city' => 'Missouri City',
            'street' => '123 Main Street',
            'zipcode' => '90001'
        ];

      $invalidData = $newValues;
      $invalidData['custEmail'] = 'invalid_email';

      $this->assertTrue($this->user->createUser($newValues));
      $this->assertFalse($this->user->createUser($invalidData));
        $this->user->updateUser($this->testUserId, $newValues);

        // Retrieve the updated user from the database
        $updatedUser = $this->getUserById($this->testUserId);

        // Check if the values have been updated correctly
        $this->assertEquals($newValues['fname'], $updatedUser['fname']);
        $this->assertEquals($newValues['lname'], $updatedUser['lname']);
       
    }

}