<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] = false) {
    $_SESSION['login_err'] = "Please login to view your cart!";
    header("location: index.php");
    exit();
}
unset($_SESSION['carttotal']);
include "inc/nav.inc.php"
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StyleSphere</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section id="cart" class="section-p1">
            <h2 style="text-align: center">#cart</h2>

            <table width="100%">
                <thead>
                    <tr>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Size</td>
                        <td>Subtotal</td>
                        <td>Remove</td>

                    </tr>
                </thead>

                <tbody>
                <form action='update_items.php' method='post' id='remp'>

                    <?php
                    if (!empty($_SESSION['cart'])) {
                        $index = 0;
                        $total = 0;
                        foreach ($_SESSION['cart'] as $citem) {
                            ?>
                            <tr>
                                <td><?php echo $citem['pname']; ?></td>
                                <td><?php echo $citem['pprice']; ?></td>
                                <td><input type="number" min=1 class="form-control" value="<?php echo $citem['quantity']; ?>" name="<?php echo $index; ?>"></td>
                                <td><?php echo $citem['size']; ?></td>
                                <td><?php echo $citem['itemtotal']; ?></td>
                                <td><a href="delete_item.php?id=<?php echo $index ?>" style="color:red;">X</a></td>
                            </tr>

                            <?php
                            $total += $citem['itemtotal'];
                            $index++;
                        }
                        $_SESSION['carttotal'] = $total;
                    } else {
                        $total = 0;
                        echo "<tr>";
                        echo "<td colspan='6'>Your cart is empty!</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
            </table>
            <br><br>
            <button type="submit" class="btn btn-success" name="save">Save Changes</button>
            <a href="clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
        </form>

    </section>

    <section id="cart-add" class="section-p1">
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>$ <?php echo $total; ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$ <?php echo $total; ?></strong></td>
                </tr>
            </table>
            <?php
            if ($total == 0) {
                echo '<button class="normal" disabled>Proceed to checkout</button>';
            } else {
                ?>
                <a href="paymentform.php" class="btn btn-danger" role="button">Proceed To Checkout</a>
                <?php
            }
            ?>
        </div>
    </section>

    <?php include 'inc/footer.inc.php';
    ?>
    <script src="js/script.js"></script>
</body>
</html>