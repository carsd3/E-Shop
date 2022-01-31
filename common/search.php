<?php 
require_once "functions.php"; 
session_start();
?>
    <?= t_header("Results")?>
    <body>
        <?= t_head()?> 
        <?php
          $con= open_db();
          $name = $_GET['query'];
        ?> 
        <h1 style="font-weight:bold">
          Results for "<?php echo $name; ?>"
        </h1>
        <?php
          if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          $result = mysqli_query($con, "SELECT * FROM products WHERE LOCATE('$name', Category) > 0 OR LOCATE('$name', Name) > 0 OR LOCATE('$name', Author) > 0");
          if ($result != false) {
            ?>
            <div id = "results">
            <?php
            while ($row = mysqli_fetch_array($result)) {
              ?>
              <div id = "result">
                <form id="result" action="product.php" method="GET">
                  <input type = "image" src = "../img/<?php echo $row['Name']?>.jpg" alt = "a">
                  <input type = "hidden" name = "product" value = "<?php echo $row['ProductID'] ?>">
                  <br>
                  <p><?php echo $row['Name']?></p>
                </form>  
              </div>
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