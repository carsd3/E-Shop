<?php

$link = mysqli_connect('localhost', 'root', '', 'e-shop');

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>