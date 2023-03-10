<?php
session_start();
/*
// Check if user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
*/
// Check if user is logged in
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Webpage - Network Security</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="container">
      <h1>Network Security</h1>
      <p>Congratulations! You have successfully logged in.</p>
      <a href="logout.php" class="button">Logout</a>
    </div>
  </body>
</html>

