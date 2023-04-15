<?php
    @include 'config.php';

    if(isset($_POST['signupBtn'])){
        $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
        $emailAddress = mysqli_real_escape_string($conn,$_POST['emailAddress']);
        $userType = mysqli_real_escape_string($conn,$_POST['userType']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = md5($_POST['password']);
        $confirmPassword = md5($_POST['confirmPassword']);

        $userExists = mysqli_query($conn,"Select * from users where Username = '$username'");
        if(mysqli_num_rows($userExists)> 0){
            $erorr[]= "User already exists";
        }
        else{
            if($password != $confirmPassword){
                $error[] = 'Passwords do not match';
            }
            else{
                $sql = "INSERT into users (FirstName, LastName, UserType, Email, Username, Password, Status, Created_at)
                values ('$firstName', '$lastName', '$userType', '$emailAddress', '$username', '$password', '0', Now())";
                mysqli_query($conn, $sql);
                header("Location:login.php");
            }
        }
    }







?>