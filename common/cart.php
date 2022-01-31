<?php
session_start();
include 'functions.php';
$con= open_db();

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
$id = (int)$_POST['product_id'];
$quantity = (int)$_POST['quantity'];

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con, "SELECT * FROM products WHERE ProductID = $id");
if ($result != false) {
    $row = mysqli_fetch_array($result);
} else {
    echo "Something went wrong :(";
}

if ($id && $quantity > 0) {
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        if (array_key_exists($id, $_SESSION['cart'])) {
            $_SESSION['cart'][$id] += $quantity;
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }
    } else {
        $_SESSION['cart'] = array($id => $quantity);
    }
}
}

if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}

if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: placeorder.php');
    exit;
}

$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
if ($products_in_cart) {
    $a = implode(", ", array_keys($products_in_cart));
    $result = mysqli_query($con, 'SELECT * FROM products WHERE ProductID IN ('. $a .')');
    if ($result != false) {
        $i = 0;
        while  (($a = mysqli_fetch_array($result)) != array()){
            $products[$i] = $a;
            $i += 1;
        }
    } else {
        echo "Something went wrong :(";
    }

    foreach ($products as $product) {
        $subtotal += (float)$product['Price'] * (int)$_SESSION['cart'][$product['ProductID']];
    }
}
?>
<?= t_header("Cart");
    t_head();
?>
<body>

<div class="main-basket">
    <h1>CART</h1>
        <?php if (empty($products)): ?>
            <div class="no-products">
            <p>You have no products added in your Shopping Cart</p>
            <button type="button" onclick="location.href='../index.php' ">Continue shopping</button>
            </div>
        <?php else: ?>
    <form action="cart.php" method="post">
            <?php foreach ($products as $product): ?>
                <div class="cart-product">
                    <div class="img-prod">
                        <img src="../img/<?php echo $product['Name']?>.jpg" alt="<?=$product['Description']?>">
                        <a href="cart.php?remove=<?=$product['ProductID']?>" class="remove">X</a>
                    </div>
                    <div class="info">
                        <a href="product.php?product=<?=$product['ProductID']?>"><?=$product['Name']?></a>
                        <div class="quantity">Subtotal for <?=$products_in_cart[$product['ProductID']]?> unit(s) = <?=$product['Price'] * $products_in_cart[$product['ProductID']]?>&euro;</div>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>
        <div class="total">
            <span class="text">Total:  </span>
            <span class="price"><?=$subtotal?>&euro;</span>
        </div>
        </form>
        <form action = "placeorder.php" method = "GET">
            <?php 
                $n = 0;
                foreach($products as $product) {
                    ?><input type="hidden" name="result[]" value="<?php echo $product['Name'] ?>"><?php
                    $n += $products_in_cart[$product['ProductID']];
                }   
            ?>
            <input type = "hidden" name = "number" value = "<?=$n?>">
            <input type="submit" value="Place Order" name="placeorder">
        </form>
        </div>
        <br><br>
        <?php endif; ?>
</div>
</body>
</html>