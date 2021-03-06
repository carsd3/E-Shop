<?php
require_once "functions.php"; 
session_start();
?>
    <?= t_header("Products")?>
    <body>
        <?= t_head()?>
        <h1 style="font-weight:bold">
            Products
        </h1>
        <?php
          $con = open_db();
          if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          $result = mysqli_query($con, "SELECT * FROM products");
          if ($result != false) {
            ?>
            <div id = "results">
            <?php
            while ($row = mysqli_fetch_array($result)) {
              ?>
                <form id="result" action="product.php" method="GET">
                  <input type = "image" src = "../img/<?php echo $row['Name']?>.jpg" alt = "a">
                  <input type = "hidden" name = "product" value = "<?php echo $row['ProductID'] ?>">
                  <br>
                  <p><?php echo $row['Name']?></p>
                </form>
            <?php
            }
            ?>
            </div>
            <?php
          } else {
            echo "No results were found";
          }
          mysqli_close($con);
        ?>
    </body>
</html>
