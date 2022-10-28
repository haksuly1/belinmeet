<?php

if (isset($_POST['submit'])) {
    if (
        isset($_POST['username']) &&
        isset($_POST['password']) &&
        isset($_POST['gender']) &&
        isset($_POST['email']) &&
        isset($_POST['phoneCode']) &&
        isset($_POST['phone'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phoneCode = $_POST['phoneCode'];
        $phone = $_POST['phone'];

        $host = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'berlinmeet';

        //Create Connection
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to database.');
        } 
        else {
            $Select = 'SELECT email FROM berlinmeet_register WHERE email = ? LIMIT 1';
            $Insert = 'INSERT INTO berlinmeet_register(username, password, gender, email, phoneCode, phone) values(?, ?, ?, ?, ?, ?)';

            //Prepare Statement
            $stmt = $conn->prepare($Select);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param('ssssii', $username, $password, $gender, $email, $phoneCode, $phone);
                if ($stmt->execute()) {
                    echo 'You have successfully inserted your details, we will contact you shortly';
                } 
                else {
                    echo $stmt->error;
                }
            } 
            else {
              echo 'This email is already registered.';
            }
            $stmt->close();
            $conn->close();
        }
    } 
    else {
        echo 'All fields are required';
        die();
    }
} 
else {
    echo 'submit button is not set';
}

?>
