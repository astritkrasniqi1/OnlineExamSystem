<?php
// Retrieve the form data
$currentPassword = $_POST['current_password'];
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

// Validate the form data
// You can add your own validation logic here

// Connect to the database
$conn = new mysqli('localhost', 'username', 'password', 'database_name');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user's current password from the database
// Assuming the table name is "users" and the username is stored in a variable $username
$stmt = $conn->prepare("SELECT Password FROM users WHERE Username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($hashedPassword);
$stmt->fetch();
$stmt->close();

// Verify the current password
if (password_verify($currentPassword, $hashedPassword)) {
    // Hash the new password
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $stmt = $conn->prepare("UPDATE users SET Password = ? WHERE Username = ?");
    $stmt->bind_param("ss", $hashedNewPassword, $username);
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Redirect the user back to the profile page or display a success message
    header("Location: profile.php");
    exit();
} else {
    // Invalid current password
    // Handle the error or display an error message to the user
    echo "Invalid current password.";
    exit();
}
?>






