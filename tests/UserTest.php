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
        $dbname = "gasco"; 
        $port = 3307;

        $this->connection = new mysqli($servername, $username, $password, $dbname, $port);
    }
    protected function tearDown(): void
    {
        $this->connection->close();
    }

    /**
     * @covers \App\User::__construct
     */
    public function testConstructor(){
        $this->assertInstanceOf(User::class, new User($this->connection));
    }

    /**
     * @covers \App\User::clean_input
     * @covers \App\User::__construct
     */
    public function testCleanInput(){
        $user = new User($this->connection);
        $dirtyInput = "    <script>alert('test');</script> \t";
        $expectedOutput = "&lt;script&gt;alert(&#039;test&#039;);&lt;/script&gt;";

        $cleanedInput = $user->clean_input($dirtyInput);
        $this->assertEquals($expectedOutput, $cleanedInput);
        $this->assertNotEquals($dirtyInput, $cleanedInput);
        $this->assertEquals($expectedOutput, $cleanedInput);
    }

    /**
    * @covers \App\User::validate_input
    * @covers \App\User::createUser
    * @covers \App\User::__construct
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
        $this->assertIsBool($user->createUser($validData));
    }

    /**
    * @covers \App\User::validate_input
    * @covers \App\User::__construct
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
        $this->assertTrue($user->validate_input($validData));
        $this->assertIsBool($user->validate_input($validData));

        $input = [
            'custEmail' => '',
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
    
        $errors = $user->validate_input($input);
    
        $this->assertContains("Missing or empty field: custEmail", $errors);
        $this->assertContains("Missing or empty field: fname", $errors);
        $this->assertNotContains("Missing or empty field: password", $errors);
        $this->assertNotContains("Missing or empty field: lname", $errors);
        $this->assertIsArray($errors);

        // Test case to cover the 'continue' statement for 'mname' and 'street2'
        $inputWithMnameStreet2 = $validData;
        $inputWithMnameStreet2['mname'] = 'Middle';
        $inputWithMnameStreet2['street2'] = 'Apt 4B';
        $this->assertTrue($user->validate_input($inputWithMnameStreet2));

        // Test case for invalid email format
        $invalidEmailInput = $validData;
        $invalidEmailInput['custEmail'] = 'invalid_email';
        $errors = $user->validate_input($invalidEmailInput);
        $this->assertContains("Invalid email format", $errors);

        // Test case for password too short
        $shortPasswordInput = $validData;
        $shortPasswordInput['password'] = 'short';
        $errors = $user->validate_input($shortPasswordInput);
        $this->assertContains("Password too short, must be at least 8 characters", $errors);

        // Test case for invalid phone number format
        $invalidPhoneInput = $validData;
        $invalidPhoneInput['phone'] = '1234567';
        $errors = $user->validate_input($invalidPhoneInput);
        $this->assertContains("Invalid phone number format", $errors);

        // Test case for invalid zipcode format
        $invalidZipcodeInput = $validData;
        $invalidZipcodeInput['zipcode'] = '1234';
        $errors = $user->validate_input($invalidZipcodeInput);
        $this->assertContains("Invalid zipcode format", $errors);

        // Test case for long string values
        $longStringInput = $validData;
        $longStringInput['fname'] = str_repeat('a', 51);
        $longStringInput['lname'] = str_repeat('b', 51);
        $longStringInput['companyName'] = str_repeat('c', 101);
        $longStringInput['city'] = str_repeat('d', 101);
        $longStringInput['street'] = str_repeat('e', 101);

        $errors = $user->validate_input($longStringInput);
        $this->assertContains("Field fname too long, maximum length is 50 characters", $errors);
        $this->assertContains("Field lname too long, maximum length is 50 characters", $errors);
        $this->assertContains("Field companyName too long, maximum length is 100 characters", $errors);
        $this->assertContains("Field city too long, maximum length is 100 characters", $errors);
        $this->assertContains("Field street too long, maximum length is 100 characters", $errors);
    }

//     /**
//     * @covers \App\User::validate_input
//     * @covers \App\User::editUserProfile
//     * @covers \App\User::__construct
//     */
//     public function testEditUserProfile(): void{
//         $user = new User($this->connection);

//         // Test data for updating the user profile
//         $userData = [
//             'id' => 1,
//             'custEmail' => 'new_email@example.com',
//             'password' => 'NewPassword123',
//             'fname' => 'John',
//             'mname' => 'A',
//             'lname' => 'Doe',
//             'phone' => '1234567890',
//             'companyName' => 'New Company',
//             'state' => 'Texas',
//             'city' => 'Missouri City',
//             'street' => 'New Street',
//             'street2' => 'New Street 2',
//             'zipcode' => '12345'
//         ];

//         // Assert that the editUserProfile function returns true on successful update
//         $this->assertTrue($user->editUserProfile($userData));

//         // Fetch the updated data from the database and compare it with the test data
//         $stmt = $this->connection->prepare("SELECT * FROM user_profiles WHERE id=?");
//         $stmt->bind_param("i", $userData['id']);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $updatedUserData = $result->fetch_assoc();

//         $this->assertEquals($userData['custEmail'], $updatedUserData['custEmail']);
//         $this->assertEquals($userData['fname'], $updatedUserData['fname']);
//         $this->assertEquals($userData['mname'], $updatedUserData['mname']);
//         $this->assertEquals($userData['lname'], $updatedUserData['lname']);
//         $this->assertEquals($userData['phone'], $updatedUserData['phone']);
//         $this->assertEquals($userData['companyName'], $updatedUserData['companyName']);
//         $this->assertEquals($userData['state'], $updatedUserData['state']);
//         $this->assertEquals($userData['city'], $updatedUserData['city']);
//         $this->assertEquals($userData['street'], $updatedUserData['street']);
//         $this->assertEquals($userData['street2'], $updatedUserData['street2']);
//         $this->assertEquals($userData['zipcode'], $updatedUserData['zipcode']);
// }
}