<?php
// Load configuration and required libraries
require_once 'config.php';
require_once 'vendor/autoload.php';


// Initialize errors array

// Handle form submission
if (isset($_POST['signupBtn'])) {
    // Validate user input
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
    $userType = mysqli_real_escape_string($conn, $_POST['userType']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);

    $userExists = "Select * from users where username = '$username'";

    $result =  mysqli_query($conn,$userExists);
    if(mysqli_num_rows($result)>0){
        $error[] = "User already exists!";
    }
    else{

        if($password != $confirmPassword){
            $error[] = "Passwords do not match!";
        }
        else{

        // Generate verification code and save it to database
        $verificationCode = rand(100000, 999999);
        $sql = "INSERT INTO users (FirstName, LastName, UserType, Email, Username, Password, VerificationCode, VerificationStatus, Status, Created_at)
        VALUES ('$firstName', '$lastName', '$userType', '$emailAddress', '$username', '$password', '$verificationCode', '0', '0', NOW())";
        mysqli_query($conn, $sql);

        $userId = mysqli_insert_id($conn);

        // Send verification email using SendGrid
        $email = new \SendGrid\Mail\Mail();
        // Set the verification URL as a substitution value
    // Set the HTML content of the email using your SendGrid template, with the substitution value included
        $email->setFrom("OXamSystem@outlook.com", "Online Exam System");
        $email->setTemplateId("d-833c2d2044ca4ccaa800d4860b01fe1e");
        $email->addDynamicTemplateData("verificationCode", $verificationCode);
        $email->addDynamicTemplateData("userId", $userId);
        $email->addTo($emailAddress, $firstName . " " . $lastName);
        /*$email->addContent(
            "text/plain",
            "To finish creating your account please click the link to verify your email: <a href='http://localhost/Online-Exam-System/verify-email.php?code={$verificationCode}'>Verify Email</a>"
        );*/
        
        $sendgrid = new \SendGrid($SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            // Check response status code and headers for errors
            if ($response->statusCode() >= 400) {
                throw new Exception('Error sending email: ' . $response->body());
            }   
            // Redirect to login page after successful sign up
            header('Location:signup.php');
            exit();
        } catch (Exception $e) {
            $errors[] = 'Error sending email: ' . $e->getMessage();
        }
        }
    }

}
?>
