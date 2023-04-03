<?php
    /**
     * @covers \App\User::validate_input
     * @covers \App\User::editUserProfile
     * @covers \App\User::__construct
     */
    public function testEditUserProfile()
    {
        $user = new User($this->connection);
        $validData = [
            'email' => 'testtesttest@example.com',
            'password' => 'test1234',
            'fname' => 'John',
            'lname' => 'Doe',
            'phone' => '1234567890',
            'companyName' => 'Test Company',
            'state' => 'New York',
            'city' => 'New York',
            'street' => '123 Main St',
            'zipcode' => '12345'
        ];

        // Insert test data into database
        $stmt = $this->connection->prepare("INSERT INTO ClientInformation (email, fname, lname, phone, companyName, companyState, companyCity, companyStreet, companyStreet2, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $validData['email'], $validData['fname'], $validData['lname'], $validData['phone'], $validData['companyName'], $validData['state'], $validData['city'], $validData['street'], $validData['street2'], $validData['zipcode']);
        $stmt->execute();

        // Call editUserProfile method with updated data
        $validData['fname'] = 'Jane';
        $validData['lname'] = 'Doe';
        $validData['phone'] = '9876543210';
        $validData['city'] = 'San Francisco';

        $this->assertTrue($user->editUserProfile($validData));
        $this->assertIsBool($user->editUserProfile($validData));

        // Retrieve updated data from database and assert that it matches
        $stmt = $this->connection->prepare("SELECT fname, lname, phone, companyCity FROM ClientInformation WHERE email = ?");
        $stmt->bind_param("s", $validData['email']);
        $stmt->execute();
        $stmt->bind_result($fname, $lname, $phone, $city);
        $stmt->fetch();
        $stmt->close();
    
        $this->assertEquals($validData['fname'], $fname);
        $this->assertEquals($validData['lname'], $lname);
        $this->assertEquals($validData['phone'], $phone);
        $this->assertEquals($validData['city'], $city);
    
        // Delete test data from database
        $stmt = $this->connection->prepare("DELETE FROM ClientInformation WHERE email = ?");
        $stmt->bind_param("s", $validData['email']);
        $stmt->execute();
    }
