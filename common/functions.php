<?php 

function open_db() {
    $DATABASE_HOST = "localhost";
    $DATABASE_USER = "root";
    $DATABASE_NAME = "e-shop";
    $con = new mysqli("localhost","root","","e-shop");
    return $con;
}

function t_header($title, $f = false) {
    if ($f) {
        echo <<<EOT
    <!DOCTYPE html>
    <html lang = 'en'>
        <head>
        <link rel='apple-touch-icon' sizes='180x180' href='../img/favicon/apple-touch-icon.png'>
        <link rel='icon' type='image/png' sizes='32x32' href='../img/favicon/favicon-32x32.png'>
        <link rel='icon' type='image/png' sizes='16x16' href='../img/favicon/favicon-16x16.png'>
        <link rel='manifest' href='../img/favicon/site.webmanifest'>
        <link rel='mask-icon' href='../img/favicon/safari-pinned-tab.svg' color='#5bbad5'>
        <meta name='msapplication-TileColor' content='#da532c'>
        <meta name='theme-color' content='#ffffff'>
        <link rel='stylesheet' href='../styles/main.css' />
        <link rel='stylesheet' href='../styles/index.css' />
        <link rel='stylesheet' href='../styles/results.css' />
        <link rel='stylesheet' href='../styles/account.css' />
        <title>$title</title>
        </head>
EOT;
    } else {
        echo <<<EOT
    <!DOCTYPE html>
    <html lang = 'en'>
        <head>
        <link rel='apple-touch-icon' sizes='180x180' href='../img/favicon/apple-touch-icon.png'>
        <link rel='icon' type='image/png' sizes='32x32' href='../img/favicon/favicon-32x32.png'>
        <link rel='icon' type='image/png' sizes='16x16' href='../img/favicon/favicon-16x16.png'>
        <link rel='manifest' href='../img/favicon/site.webmanifest'>
        <link rel='mask-icon' href='../img/favicon/safari-pinned-tab.svg' color='#5bbad5'>
        <meta name='msapplication-TileColor' content='#da532c'>
        <meta name='theme-color' content='#ffffff'>
        <link rel='stylesheet' href='../styles/main.css' />
        <link rel='stylesheet' href='../styles/index.css' />
        <link rel='stylesheet' href='../styles/results.css' />
        <title>$title</title>
        </head>
EOT;
    }
}
function t_head() {
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        echo <<<EOT
    <div id="head">
        <div class='tab'>    
            <a class = "link" href="../index.php">
                <img class = "start" src = "../img/icon.jpg" alt = "test">
            </a>
            <h1 class = "title">Hello World!</h1>
        </div>
        <div class="tab">
            <a id = "tabs" href = "cart.php">
                <h2>Cart</h2>
            </a>
            <a id = "tabs" href = "products.php">
                <h2>Products</h2>
            </a>
            <a id = "tabs" href = "contact_us.php">
                <h2>Contact Us</h2>
            </a>
            <a id = 'tabs' href = "login_info.php"><h2>My Account</h2></a>
            <a id = 'tabs' href = "logout.php"><h2>Logout</h2></a>
            <div class="searchbar">
                <form action="search.php" method="GET">
                    <input type="text" name="query" />
                    <input type="submit" value="Search" />
                </form>
            </div>
        </div>
    </div>
    <hr>
EOT;
    } else {
        echo <<<EOT
        <div id="head">
        <div class='tab'>    
            <a class = "link" href="../index.php">
                <img class = "start" src = "../img/icon.jpg" alt = "test">
            </a>
            <h1 class = "title">Hello World!</h1>
        </div>
        <div class="tab">
            <a id = "tabs" href = "cart.php">
                <h2>Cart</h2>
            </a>
            <a id = "tabs" href = "products.php">
                <h2>Products</h2>
            </a>
            <a id = "tabs" href = "contact_us.php">
                <h2>Contact Us</h2>
            </a>
            <a id = "tabs" href = "account.php">
                <h2>Account</h2>
            </a>
            <div class="searchbar">
                <form action="search.php" method="GET">
                    <input type="text" name="query" />
                    <input type="submit" value="Search" />
                </form>
            </div>
        </div>
    </div>
    <hr>
EOT;
    }
}
?>