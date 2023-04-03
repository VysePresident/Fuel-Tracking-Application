<?php

use App\User;
use App\EditUserProfiletoTest;
use PHPUnit\Framework\TestCase;

/**
 * @codeCoverageIgnore
 */
class EditUserProfileTest extends TestCase
{
    private $connection;

    protected function setUp(): void
    {
        $servername = "gasco-server.mysql.database.azure.com";
        $username = "tanya";
        $password = "team53server";
        $dbname = "gasco";
        $port = 3306;

        $this->connection = mysqli_connect($servername, $username, $password, $dbname, $port);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    protected function tearDown(): void
    {
        $this->connection->close();
    }

    /**
     * @covers \App\User::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(User::class, new User($this->connection));
    }

    /**
     * @covers \App\User::clean_input
     * @covers \App\User::__construct
     */
    public function testCleanInput()
    {
        $user = new User($this->connection);
        $dirtyInput = "    <script>alert('test');</script> \t";
        $expectedOutput = "&lt;script&gt;alert(&#039;test&#039;);&lt;/script&gt;";

        $cleanedInput = $user->clean_input($dirtyInput);
        $this->assertEquals($expectedOutput, $cleanedInput);
        $this->assertNotEquals($dirtyInput, $cleanedInput);
        $this->assertEquals($expectedOutput, $cleanedInput);
    }

    /**
    * @covers \App\User::clean_input
    * @covers \App\User::validate_input
    * @covers \App\EditUserProfiletoTest
    * @covers \App\EditUserProfiletoTest::run
    * @covers \App\User::__construct
    */
    public function testEditUserProfile(){
        // Test data for updating the user profile
        $userData = [
            'email' => 'abc@gmail.com',
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
    
        // Prepare mock data for $_POST
        $_POST = $userData;
    
        // Instantiate EditUserProfiletoTest class and run the test
        $editUserProfile = new EditUserProfiletoTest($this->connection);
        $editUserProfile->run();
        // Fetch the updated data from the database and compare it with the test data
        $stmt = $this->connection->prepare("SELECT * FROM ClientInformation WHERE email=?");
        $stmt->bind_param("s", $userData['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        $updatedUserData = $result->fetch_assoc();
    
        $this->assertEquals($userData['email'], $updatedUserData['email']);
        $this->assertEquals($userData['fname'], $updatedUserData['fname']);
        $this->assertEquals($userData['mname'], $updatedUserData['mname']);
        $this->assertEquals($userData['lname'], $updatedUserData['lname']);
        $this->assertEquals($userData['phone'], $updatedUserData['phone']);
        $this->assertEquals($userData['companyName'], $updatedUserData['companyName']);
        $this->assertEquals($userData['state'], $updatedUserData['companyState']);
        $this->assertEquals($userData['city'], $updatedUserData['companyCity']);
        $this->assertEquals($userData['street'], $updatedUserData['companyStreet']);
        $this->assertEquals($userData['street2'], $updatedUserData['companyStreet2']);
        $this->assertEquals($userData['zipcode'], $updatedUserData['zipcode']);
    }
}    

?>