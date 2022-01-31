
<?php
session_start();
 
$_SESSION = array(); 
// destroy the session to log out
session_destroy();
$_SESSION['loggedin'] = false;
 
// redirect to the index page
header("location: ../index.php");
exit;
?>