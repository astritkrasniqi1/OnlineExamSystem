<?php
// connect to the database
$pdo = new PDO("mysql:host=127.0.0.1:3308;dbname=onlineexam", "root", "");

// get the subject ID from the frontend
$subjectId = $_POST['subjectId'];

// delete the subject from the database
$stmt = $pdo->prepare("DELETE FROM subject WHERE Id = ?");
$stmt->execute([$subjectId]);
?>