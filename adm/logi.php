<?php
session_start();
include 'adm/db_connection.php';
// Get the posted data
$post_username = $_POST['username'];
$post_password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM Admin WHERE Username=? AND Password=?");
$stmt->bind_param("ss", $post_username, $post_password);

$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
  // Successful login
  $_SESSION['username'] = $post_username;
  header('Location: homepage.php'); // replace 'homepage.php' with your actual homepage
} else {
  // Failed login
  echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>
