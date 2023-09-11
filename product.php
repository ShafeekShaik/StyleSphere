<?php
session_start();

include "access_control.php";
$permitted = array(0,1);
access_control($permitted);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
} else {
    header("location: index.php");
    exit();
}
?>

<?php
//session_start();
include "inc/nav.inc.php";
include 'config.php';
$pid = $_POST["pid"];
$stmtdelete = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND pid = ?");
$stmtdelete->bind_param("ii", $_SESSION['id'], $pid);
$stmtdelete->execute();
$stmtdelete -> close();
?>


<!DOCTYPE html>
<html lang="en">
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src=<?php echo $_POST["pimage"]; ?> width="100%" id="MainImg" alt="">
        </div>

        <div class="single-pro-details">
            <h6>Home / T-Shirt</h6>
            <h4><?php echo $_POST["pname"]; ?></h4>
            <span><?php echo $_POST["pdesc"] ?></span>
            <h2>$<?php echo $_POST["pprice"]; ?></h2>
            <form action="addtocart.php" method="post" id="addp">
                <label>Size</label>
                <select required name="size" form="addp">
                    <option value=""disabled selected>Select Size</option>
                    <option>XL</option>
                    <option>XXL</option>
                    <option>Small</option>
                    <option>Large</option>
                </select>
                <label>Quantity</label>
                <input type="number" required min="1" name="quantity" >
                <input type="hidden" name="pid" value="<?php echo $_POST["pid"]; ?>">
                <input type="hidden" name="pname" value="<?php echo $_POST["pname"]; ?>">
                <input type="hidden" name="pprice" value="<?php echo $_POST["pprice"]; ?>">
                <input type="hidden" name="pimage" value="<?php echo $_POST["pimage"]; ?>">
                <button type="submit" formaction="addtocart.php" class="normal">Add to Cart</button>
                <button type="submit" value="submit-wishlist" formaction="addtowishlist.php" class=" normal">Add to Wishlist</button>

            </form>

        </div>
    </section>

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
//session_start();
    include "inc/footer.inc.php"
    ?>
    <script src="js/script.js"></script>
</body>

</html>