<?php 
@include 'config.php';
session_start();
function send2FACode($email) {
    $url = "http://127.0.0.1/2faapi/public/index.php?action=sendCode";
    $data = ['email' => $email];
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result, true);
}

function verify2FACode($email, $code) {
    $url = "http://127.0.0.1/2faapi/public/index.php?action=verifyCode";
    $data = ['email' => $email, 'code' => $code];
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => 'Invalid request'];

    if (isset($_POST['loginBtn'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            if ($row['UserType'] == '0') {
                $_SESSION['professorUsername'] = $row['FirstName'] . ' ' . $row['LastName'];
                $_SESSION['professorID'] = $row['Id'];

                $sendResult = send2FACode($row['Email']);
                if ($sendResult['success']) {
                    $_SESSION['pending2FA'] = true;
                    $_SESSION['userType'] = 'professor';
                    $_SESSION['userId'] = $row['Id'];
                    $response = ['success' => true, 'pending2FA' => true];
                } else {
                    $response = ['success' => false, 'message' => $sendResult['message']];
                }
            } elseif ($row['UserType'] == '1') {
                $_SESSION['studentUsername'] = $row['FirstName'] . ' ' . $row['LastName'];
                $_SESSION['studentID'] = $row['Id'];

                $sendResult = send2FACode($row['Email']);
                if ($sendResult['success']) {
                    $_SESSION['pending2FA'] = true;
                    $_SESSION['userType'] = 'student';
                    $_SESSION['userId'] = $row['Id'];
                    $response = ['success' => true, 'pending2FA' => true];
                } else {
                    $response = ['success' => false, 'message' => $sendResult['message']];
                }
            }
        } else {
            $response = ['success' => false, 'message' => 'Invalid username or password'];
        }
    }

    if (isset($_POST['verify2FA'])) {
        $code = (int)$_POST['2facode'];
        if ($_SESSION['pending2FA']) {
            $userId = $_SESSION['userId'];
            $sql = "SELECT * FROM users WHERE Id = '$userId'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $email = $row['Email'];
                $verifyResult = verify2FACode($email, $code);
                if ($verifyResult['success']) {
                    if ($_SESSION['userType'] == 'professor') {
                        $update = "UPDATE users SET Status='1' WHERE Id={$_SESSION['professorID']} AND UserType='0'";
                        mysqli_query($conn, $update);
                        setcookie('remember_professor', $_SESSION['professorID'], time() + 86400, "/");
                        $response = ['success' => true, 'redirectUrl' => 'professor/FrontEnd/Dashboard.php'];
                    } elseif ($_SESSION['userType'] == 'student') {
                        $update = "UPDATE users SET Status='1' WHERE Id={$_SESSION['studentID']} AND UserType='1'";
                        mysqli_query($conn, $update);
                        setcookie('remember_student', $_SESSION['studentID'], time() + 86400, "/");
                        $response = ['success' => true, 'redirectUrl' => 'student/FrontEnd/Dashboard.php'];
                    }
                    unset($_SESSION['pending2FA']);
                } else {
                    $response = ['success' => false, 'message' => $verifyResult['message']];
                }
            }
        }
    }

    echo json_encode($response);
    exit;
}
