<?php

session_start();

//Updating Cart items
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    # Basically the POSTed items are in the order of the items in the cart so just need to loop and break when it reaches the button.
    foreach ($_POST as $key => $value) {
        if ($key === "save") {
            continue;
        }
        $_SESSION['cart'][$key]['quantity'] = $value;
        $itemtotal = $_SESSION['cart'][$key]["quantity"] * $_SESSION['cart'][$key]["pprice"];
        $_SESSION['cart'][$key]['itemtotal'] = $itemtotal;
    }
}
header('location: cart.php');
exit();
