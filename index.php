<?php
require_once "/common/functions.php";
session_start();
// if (isset($_SESSION["a"])) {
//     echo $_SESSION["a"];
// }
?>
<!DOCTYPE html>
<html lang = 'en'>
    <head>
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
        <link rel="manifest" href="img/favicon/site.webmanifest">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="styles/main.css" />
        <link rel="stylesheet" href="styles/index.css" />
        <title>Hello World!</title>
    </head>
    <body>
        <div id="head">
            <div class='tab'>    
                <a class = "link" href="index.php">
                    <img class = "start" src = "img/icon.jpg" alt = "test">
                </a>
                <h1 class = "title">Hello World!</h1>
            </div>
            <div class="tab">
                <a id = "tabs" href = "common/cart.php">
                    <h2>Cart</h2>
                </a>
                <a id = "tabs" href = "common/products.php">
                    <h2>Products</h2>
                </a>
                <a id = "tabs" href = "common/contact_us.php">
                    <h2>Contact Us</h2>
                </a>
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true):?>
                    <a id = 'tabs' href = "common/login_info.php"><h2>My Account</h2></a>
                    <a id = 'tabs' href = "common/logout.php"><h2>Logout</h2></a>
                <?php else: ?>
                    <a id = "tabs" href = "common/account.php">
                        <h2>Account</h2>
                    </a>
                <?php endif;?>
                <div class="searchbar">
                    <form action="./common/search.php" method="GET">
	                    <input type="text" name="query" />
	                    <input type="submit" value="Search" />
                    </form>
                </div>
            </div>
        </div>

        <hr>

        <img src = "img/book.jpeg" alt = "book">

    </body>
</html>