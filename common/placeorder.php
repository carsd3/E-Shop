<?php
session_start();
include 'functions.php';
?>
<?=t_header('Place Order')?>

<div class="order">
    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true): ?>
        <?php $user = $_SESSION["username"]?>
        <h1>Your Order Has Been Placed</h1>
        <p>Thanks <b><?php echo $user ?></b> for ordering with us, we'll contact you by email with your order details.</p>
        <?php 
            $db = open_db();
            $p = $_GET['result'];
            $n = $_GET['number'];
            $user = (int) $_SESSION["id"];
            $titles = implode(", ", $p);

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $result = mysqli_query($db, "INSERT INTO history(id_user, num_elem, titles) VALUES (". $user .", ". $n .", '". $titles ."')");
            if ($result == false) {
                echo "Something went wrong :(";
            }  
        ?>
        <?php $_SESSION['cart'] = null ?>
        <button type="button" onclick="location.href='../index.php' ">Continue shopping</button>        
    <?php else: ?>
        <h1>Please, login before</h1>
        <button type="button" onclick="location.href='account.php'" class="place-order-login-but">Login</button>
    <?php endif; ?>
</div>
