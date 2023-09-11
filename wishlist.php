<?php
include "access_control.php";

$permitted = array(0, 1);
access_control($permitted);

include "config.php";
$stmt = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$user_id = $_SESSION['id'];
$stmt->execute();
$result = $stmt->get_result();
//$fetch_wishlist = $result->fetch_assoc();
include 'inc/nav.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StyleSphere Singapore - Wishlist</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <section id="page-header" class="about-header">
            <h2>#wishlist</h2>
        </section>
        <div class="container">
            <h4 style="text-align: center">wishlist</h4>
            <?php
            if (!empty($_SESSION['wishlist'])) {
                echo '<div class="alert alert-primary" style="color:green">' . $_SESSION['wishlist'] . '</div>';
            }
            ?>
            <section id="wishlist" class="section-p1">
                <table class='table table-hover' id='customers'>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Add to Cart</th>
                        <th>Remove Item</th>

                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>";
                        echo $row['pname'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['pprice'];
                        echo "</td>";
                        echo "<td>";
                        ?>
                        <form action="product.php" method="post">
                            <input type="hidden" name="pname" value="<?php echo $row["pname"] ?>">
                            <input type="hidden" name="pprice" value="<?php echo $row["pprice"] ?>">
                            <input type="hidden" name="pid" value="<?php echo $row["pid"] ?>">
                            <input type="hidden" name="pimage" value="<?php echo $row["pimage"] ?>">
                            <button type="submit" formaction="product.php"class="normal"
                                    >Add to Cart</button>

                            <?php
                            echo "</td>";
                            echo "<td>";
                            echo "<button type='submit' formaction='deletefromwishlist.php'class='normal'>Remove from list</button>";
                            echo "</form>";
                        }

                        echo "</table>";
                        echo "</div>";
                        ?>
                </table></section></div>
        <section id="newsletter" class="section-p1 section-m1">
            <div class="newstext">
                <h4>Sign Up For Newsletters</h4>
                <p>Get E-mail updates about our latest shop and <span>special offers.</span> </p>
            </div>
            <div class="form">
                <input type="text" placeholder="Your email address">
                <button class="normal">Sign Up</button>
            </div>
        </section>


        <?php
        include 'inc/footer.inc.php';
        unset($_SESSION['wishlist']);

        