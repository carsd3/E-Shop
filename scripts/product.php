<!DOCTYPE html>
<html lang = 'en'>
    <head>
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
        <link rel="manifest" href="../img/favicon/site.webmanifest">
        <link rel="mask-icon" href="../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="../styles/main.css" />
        <link rel="stylesheet" href="../styles/page2.css" />
        <?php
          $con= new mysqli("localhost","root","","e-shop");
          $name = $_GET['product'];
          // Check connection
          if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          $result = mysqli_query($con, "SELECT * FROM products WHERE ProductID = $name");
          if ($result != false) {
            $row = mysqli_fetch_array($result);
          } else {
            echo "Something went wrong :(";
          }
        ?>
        <title><?php echo $row['Name']?></title>
    </head>
    <body>
        <div id="head">
            <a class = "link" href="../index.php">
                <img class = "start2" src = "../img/icon.jpg" alt = "test">
            </a>
            <h1 class = "title">Hello World!</h1>
            <div class="tab">
                <a id = "tabs" href = "../common/discounts.php">
                    <h2>Discounts</h2>
                </a>
                <a id = "tabs" href = "../common/products.php">
                    <h2>Products</h2>
                </a>
                <a id = "tabs" href = "../common/contact_us.php">
                    <h2>Contact Us</h2>
                </a>
                <a id = "tabs" href = "../common/about.php">
                    <h2>About</h2>
                </a>
                <a id = "tabs" href = "../common/account.php">
                    <h2>Account</h2>
                </a>
            </div>
            <div class="searchbar">
                <form action="search.php" method="GET">
	                <input type="text" name="query" />
	                <input type="submit" value="Search" />
                </form>
            </div>  
        </div>
        <hr>
        <div id = 'box'>
            <img src = "../img/<?php echo $row['Name']?>.jpg" alt = "a">
            <div id = 'inner_box'>
                <div id = 'row'>
                    <h3>Title:   </h3><p id = 'con'> <?php echo $row['Name']; ?> </p>
                </div>
                <div id = 'row'>
                    <h3>Author:   </h3><p id = 'con'> <?php echo $row['Author']; ?> </p>
                </div>
                <div id = 'row'>
                    <h3>Category:   </h3><p id = 'con'> <?php echo $row['Category']; ?> </p>
                </div>
                <div id = 'row'>
                    <h3>Price:   </h3><p id = 'con'> <?php echo $row['Price'] . "€"; ?> </p>
                </div>
                <div id = 'row'>
                    <h3>Number of Items:   </h3><p id = 'con'> <?php echo $row['Number of Items']; ?> </p>
                </div>
            </div>    

        </div>
        <br>
        <div id ='des'>
            <h3>
                Description:
            </h3><br>
            <?php echo $row['Description']; ?>
        </div>
        <br><br>
        <div id = 'next'>
            <?php
                if (($row['ProductID']-1) != 0){
                    ?>
                    <form action="product.php" method="GET">
                        <input type = "submit" value = "< Previous">
                        <input type = "hidden" name = "product" value = "<?php echo ($row['ProductID'] - 1)?>">
                    </form>
                    <?php
                }
                $a =mysqli_query($con, "SELECT MAX(ProductID) FROM products");
                $a = $a -> fetch_array();
                $max = intval($a[0]);
                if ($max >= ($row['ProductID']+1)){
                    ?>
                    <form action="product.php" method="GET">
                        <input type = "submit" value = "Next >">
                        <input type = "hidden" name = "product" value = "<?php echo ($row['ProductID'] + 1)?>">
                    </form>
                    <?php
                }
            ?>
        </div>
    </body>
    <?php
          mysqli_close($con);
    ?>
</html>