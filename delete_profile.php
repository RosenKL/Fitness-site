<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('location: login.php');
  exit;
}

$dsn = 'mysql:host=localhost;dbname=fitness_site';
$username = 'root';
$password = '1234';

try {
  $conn = new PDO($dsn, $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Retrieve user data using the logged-in username
  $query = "SELECT * FROM users WHERE email = :email";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':email', $_SESSION['email']);
  $stmt->execute();
  $userData = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if user data is found
  if ($userData) {
    $password = $_GET['password']; // Password entered by the user

    // Verify the password
    if (password_verify($password, $userData['password'])) {
      // Delete the profile from the database
      $query = "DELETE FROM users WHERE email = :email";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':email', $_SESSION['email']);
      $stmt->execute();

      // Redirect to the login page or any other desired location
      header('location: login.php');
      exit;
    } else {
     // Incorrect password
     echo "<script>alert('Грешна парола, опитайте пак.');</script>";
    }
  } else {
    echo "<script>alert('Не бяха намерени данни за потребителя!');</script>";
  }
} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
  // Handle the database connection error appropriately
}
?>

