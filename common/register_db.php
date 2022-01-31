<?php
session_start();
require_once "functions.php";
$db = open_db();

$a = true;

$username = $_GET['username'];
$pwd = password_hash($_GET['pwd'], PASSWORD_DEFAULT);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($db, "INSERT INTO users(name, password, role) VALUES ('". $username ."', '". $pwd ."', 1)");
if ($result != false) {
    $a = true;
    $row = mysqli_fetch_array($result);
} else {
    $a = false;
    echo "Something went wrong :(";
}
echo $row;
session_start();
                            
$_SESSION["loggedin"] = true;
$_SESSION["id"] = $id;
$_SESSION["username"] = $username;   
// $_SESSION["a"] = mysqli_error($db); 
header("location: ../index.php");
?>