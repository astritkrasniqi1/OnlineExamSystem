<?php 
    @include 'config.php';

    session_start();

// Check for remember_user cookie
    if(isset($_COOKIE['remember_user'])) {
    // Get user details from database using cookie value
        $userId = mysqli_real_escape_string($conn, $_COOKIE['remember_user']);
        $sql = "SELECT * FROM users WHERE Id = '$userId' and verificationStatus='1'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            if($row['UserType'] == '0'){
                $_SESSION['professorUsername'] = $row['FirstName'] .' ' .$row['LastName'];
                $_SESSION['professorID'] = $row['Id'];
                $update = "UPDATE users SET Status='1' WHERE Id={$_SESSION['professorID']} and UserType='0' and verificationStatus='1'";
                mysqli_query($conn, $update);
                header("Location:professor/Dashboard.php");
            }
            elseif($row['UserType'] == '1'){
                $_SESSION['studentUsername'] = $row['FirstName'] .' ' .$row['LastName'];
                $_SESSION['studentID'] = $row['Id'];
                $update = "UPDATE users SET Status='1' WHERE Id={$_SESSION['studentID']} and UserType='1' and verificationStatus='1'";
                mysqli_query($conn, $update);
                header('Location: student/Dashboard.php');
            }
        }
    }


    if(isset($_POST['loginBtn'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        $sql = "Select * from users where Username='$username' and Password='$password' and verificationStatus='1'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)> 0){
            $row = mysqli_fetch_array($result);
            if($row['UserType'] == '0'){
                $_SESSION['professorUsername'] = $row['FirstName'] .' ' .$row['LastName'];
                $_SESSION['professorID'] = $row['Id'];
                $update = "UPDATE users SET Status='1' WHERE Id={$_SESSION['professorID']} and UserType='0' and verificationStatus='1'";
                mysqli_query($conn, $update);
                // Set cookie to remember user
                setcookie('remember_user', $row['Id'], time() + 86400, "/");
                header("Location:professor/Dashboard.php");
            }
            elseif($row['UserType'] == '1'){
                $_SESSION['studentUsername'] = $row['FirstName'] .' ' .$row['LastName'];
                $_SESSION['studentID'] = $row['Id'];
                $update = "UPDATE users SET Status='1' WHERE Id={$_SESSION['studentID']} and UserType='1' and verificationStatus='1'";
                mysqli_query($conn, $update);
                // Set cookie to remember user
                setcookie('remember_user', $row['Id'], time() + 86400, "/");
                header('Location: student/Dashboard.php');
            }
        }
        

    }
?>
