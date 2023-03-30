<?php 
    @include 'config.php';

    session_start();

    if(isset($_POST['loginBtn'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        $sql = "Select * from users where Username='$username' and Password='$password'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)> 0){
            $row = mysqli_fetch_array($result);
            if($row['UserType'] == '0'){
                $_SESSION['professorUsername'] = $row['FirstName'] .' ' .$row['LastName'];
                $update = "UPDATE users SET Status='1' WHERE Id={$row['Id']}";
                mysqli_query($conn, $update);
                header("Location:professor/Dashboard.php");
            }
            elseif($row['UserType'] == '1'){
                $_SESSION['studentUsername'] = $row['FirstName'] .' ' .$row['LastName'];
                header('Location: studentDashboard.php');
            }
        }
        else{
            $error[] = "Incorrect username or password";
        }

    }



?>
