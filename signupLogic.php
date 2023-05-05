<?php
@include 'config.php';

require 'vendor/autoload.php';


if (isset($_POST['signupBtn'])) {
    // Validate user input
    if (empty($_POST['firstName'])) {
        $errors[] = 'First name is required';
    } else {
        $firstName = $_POST['firstName'];
    }

    if (empty($_POST['lastName'])) {
        $errors[] = 'Last name is required';
    } else {
        $lastName = $_POST['lastName'];
    }

    if (empty($_POST['emailAddress'])) {
        $errors[] = 'Email address is required';
    } elseif (!filter_var($_POST['emailAddress'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address';
    } else {
        $emailAddress = $_POST['emailAddress'];
    }

    if (empty($_POST['userType'])) {
        $errors[] = 'User type is required';
    } else {
        $userType = $_POST['userType'];
    }

    if (empty($_POST['username'])) {
        $errors[] = 'Username is required';
    } else {
        $username = $_POST['username'];
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Password is required';
    } elseif ($_POST['password'] != $_POST['confirmPassword']) {
        $errors[] = 'Passwords do not match';
    } else {
        $password = md5($_POST['password']);
    }

    // If no errors, proceed with sign up
    if (empty($errors)) {
        // generate verification code and save it to database
        $verificationCode = rand(100000, 999999);
        $sql = "INSERT into users (FirstName, LastName, UserType, Email, Username, Password, verificationCode, verificationStatus, Status, Created_at)
        values ('$firstName', '$lastName', '$userType', '$emailAddress', '$username', '$password', '$verificationCode', '0', '0', Now())";
        mysqli_query($conn, $sql);

        // send verification email using SendGrid
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("blert.osmani@student.uni-pr.edu", "Online Exam System");
        $email->setSubject("Verify your account");
        $email->addTo($emailAddress, $firstName . " " . $lastName);
        $email->addContent(
            "text/plain",
            "Your verification code is: " . $verificationCode
        );
        $sendgrid = new \SendGrid( getenv('SENDGRID_API_KEY') );
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        header("Location:login.php");
        exit();
    }
}
?>
