<?php 
require_once "functions.php";
session_start();
?>
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
        <link rel='stylesheet' href='../styles/main.css' />
        <link rel='stylesheet' href='../styles/index.css' />
        <link rel='stylesheet' href='../styles/results.css' />
        <link rel='stylesheet' href='../styles/page2.css' />
        <?php
          $con= open_db();
          $name = $_GET['product'];
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
        <?= t_head()?>
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
                    <h3>Category:    </h3><p id = 'con'> <?php echo $row['Category']; ?> </p>
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
        <form action="cart.php" method="POST">
            <input type="number" name="quantity" value="1" min="1" max="<?echo $row['Number of Items']?>">
            <input type="hidden" name="product_id" value="<?php echo (int)$row['ProductID']?>">
            <br>
            <input type="submit" value="Add to Cart">
            <button type="button" onclick="location.href='../index.php' ">Continue shopping</button>
        </form>
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