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
            'email' => 'test@example.com',
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
            'email' => 'test@example.com',
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
        $this->assertTrue($user->validate_input($validData));

        $input = [
            'email' => '',
            'password' => 'password123',
            'fname' => '',
            'lname' => 'Doe',
            'phone' => '1234567890',
            'companyName' => 'Test Company',
            'state' => 'Texas',
            'city' => 'Missouri City',
            'street' => '123 Main Street',
            'zipcode' => '90001'
        ];
    
        $errors = $user->test_input($input);
    
        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('fname', $errors);
        $this->assertArrayNotHasKey('password', $errors);
        $this->assertArrayNotHasKey('lname', $errors);
    }

    /**
    * @covers \App\User::editUserProfile
    */
    public function testEditUserProfile(): void{
        $user = new User($this->connection);

        // Test data for updating the user profile
        $userData = [
            'id' => 1, // Change this to an existing user id in your database
            'email' => 'new_email@example.com',
            'password' => 'NewPassword123',
            'fname' => 'John',
            'mname' => 'A',
            'lname' => 'Doe',
            'phone' => '1234567890',
            'companyName' => 'New Company',
            'state' => 'Texas',
            'city' => 'Missouri City',
            'street' => 'New Street',
            'street2' => 'New Street 2',
            'zipcode' => '12345'
        ];

        // Assert that the editUserProfile function returns true on successful update
        $this->assertTrue($user->editUserProfile($userData));

        // Fetch the updated data from the database and compare it with the test data
        $stmt = $this->connection->prepare("SELECT * FROM user_profiles WHERE id=?");
        $stmt->bind_param("i", $userData['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $updatedUserData = $result->fetch_assoc();

        $this->assertEquals($userData['email'], $updatedUserData['email']);
        $this->assertEquals($userData['fname'], $updatedUserData['fname']);
        $this->assertEquals($userData['mname'], $updatedUserData['mname']);
        $this->assertEquals($userData['lname'], $updatedUserData['lname']);
        $this->assertEquals($userData['phone'], $updatedUserData['phone']);
        $this->assertEquals($userData['companyName'], $updatedUserData['companyName']);
        $this->assertEquals($userData['state'], $updatedUserData['state']);
        $this->assertEquals($userData['city'], $updatedUserData['city']);
        $this->assertEquals($userData['street'], $updatedUserData['street']);
        $this->assertEquals($userData['street2'], $updatedUserData['street2']);
        $this->assertEquals($userData['zipcode'], $updatedUserData['zipcode']);
}

    // public function testEditUserProfile(){
    //     $user = new User($this->connection);
    //     // Create a test user profile
    //     $id = 1;
    //     $user_data = [
    //         'email' => 'test@example.com',
    //         'password' => 'password123',
    //         'fname' => 'John',
    //         'lname' => 'Doe',
    //         'phone' => '1234567890',
    //         'companyName' => 'Test Company',
    //         'state' => 'Texas',
    //         'city' => 'Missouri City',
    //         'street' => '123 Main Street',
    //         'zipcode' => '90001'
    //     ];

    //     // Insert the test user profile into the database
    //     $user->createUser($user_data);

    //     $new_user_data = [
    //         'email' => 'test@example.com',
    //         'password' => 'password123',
    //         'fname' => 'John',
    //         'lname' => 'Doee',
    //         'phone' => '1234567890',
    //         'companyName' => 'Test Company',
    //         'state' => 'Texas',
    //         'city' => 'Missouri City',
    //         'street' => '123 Main Street',
    //         'zipcode' => '90001'
    //     ];
    //     // Update the user profile
    //     $result = $user->editUserProfile($id, $new_user_data);

    //     // Check that the user profile was updated successfully
    //     $this->assertTrue($result, 'User profile was not updated successfully');

    //     // Fetch the updated user profile from the database
    //     $stmt = $this->connection->prepare('SELECT * FROM user_profiles WHERE id = ?');
    //     $stmt->bind_param('i', $id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $updated_profile = $result->fetch_assoc();
    //     $stmt->close();

    //     // Check that the user profile data was updated correctly
    //     $this->assertEquals($user_data['email'], $updated_profile['email']);
    //     $this->assertTrue(password_verify($user_data['password'], $updated_profile['password']));
    //     $this->assertEquals($user_data['fname'], $updated_profile['fname']);
    //     $this->assertEquals($user_data['mname'], $updated_profile['mname']);
    //     $this->assertEquals($user_data['lname'], $updated_profile['lname']);
    //     $this->assertEquals($user_data['phone'], $updated_profile['phone']);
    //     $this->assertEquals($user_data['companyName'], $updated_profile['companyName']);
    //     $this->assertEquals($user_data['state'], $updated_profile['state']);
    //     $this->assertEquals($user_data['city'], $updated_profile['city']);
    //     $this->assertEquals($user_data['street'], $updated_profile['street']);
    //     $this->assertEquals($user_data['street2'], $updated_profile['street2']);
    //     $this->assertEquals($user_data['zipcode'], $updated_profile['zipcode']);
    // }
}