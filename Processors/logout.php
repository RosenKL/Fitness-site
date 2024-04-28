<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the index page
header("Location: http://localhost/site%20for%20project/Fitness-site/Main/index.php");
exit();
?>