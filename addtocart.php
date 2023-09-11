<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] = false) {
    $_SESSION['login_err'] = "Please login to start adding items to cart!";
    header("location: index.php");
    exit();
}
$added = 0;
if (isset($_SESSION["cart"])) {
    
} else {
    $cart = array();
    $_SESSION['cart'] = $cart;
}
$cart = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$_SESSION['cart']) { //empty cart
        $itemtotal = $_POST["quantity"] * $_POST["pprice"];
        $item = array("pname" => $_POST["pname"], "pprice" => $_POST["pprice"], "quantity" => $_POST["quantity"], "size" => $_POST["size"], "itemtotal" => $itemtotal);
        array_push($_SESSION['cart'], $item);
        header("location: cart.php");
        exit();
    } else { //non empty cart
        foreach ($_SESSION['cart'] as &$citem) {

            if ($citem['pname'] == $_POST['pname'] && $citem['size'] == $_POST['size'] && $citem['pprice'] == $_POST['pprice']) {
                $previousquantity = $citem['quantity'];
                $citem['pname'] = $_POST['pname'];
                $citem['size'] = $_POST['size'];
                $citem['quantity'] = $previousquantity + $_POST["quantity"];
                $itemtotal = $citem["quantity"] * $citem["pprice"];
                $citem['itemtotal'] = $itemtotal;
                $added = 1;
            }


            // print $citem["quantity"];
        }
        if ($added == 0) {
            $itemtotal = $_POST["quantity"] * $_POST["pprice"];
            $item = array("pname" => $_POST["pname"], "pprice" => $_POST["pprice"], "quantity" => $_POST["quantity"], "size" => $_POST["size"], "itemtotal" => $itemtotal);
            array_push($_SESSION['cart'], $item);
        }
// unset($_SESSION['cart']);
        header("location: cart.php");
// exit();
    }
}
header("location: cart.php");

// print_r($_SESSION['cart']);
?>
<pre>
    <?php
    print_r($_SESSION['cart']);
    ?>
</pre>
<pre>
    <?php
    print_r($_SESSION['cart'][1]);
    ?>
</pre>

