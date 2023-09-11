<?php
include "access_control.php";
$permitted = array(0);
access_control($permitted);

if (isset($_GET['product_id']) && $_SESSION['role'] == 0) {
    include "config.php";
    $sql = "SELECT product_id, product_name, product_price, product_desc, product_img,product_category FROM products WHERE product_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $prod_id);
        // Set parameters
        $prod_id = $_GET['product_id'];
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Store result
            mysqli_stmt_store_result($stmt);
            // Check if username exists, if yes then verify password
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $product_id, $product_name, $product_price, $product_desc, $product_img, $product_category);
                if (mysqli_stmt_fetch($stmt)) {

                    $product_id = $product_id;
                    $product_name = $product_name;
                    $product_price = $product_price;
                    $product_desc = $product_desc;
                    $product_img = $product_img;
                    $product_category = $product_category;
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                } else {
                    $_SESSION['console_err'] = "Something went wrong, please contact admin.";
                }
            }
        } else {
            // Product doesn't exist, display a generic error message
            $_SESSION['console_err'] = "Product does not exist.";
        }
    } else {
        $_SESSION['console_err'] = "Something went wrong, please contact admin.";
    }
    $_SESSION['console_err'] = "Something went wrong, please contact admin.";
//    Close statement
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['console_err'] = "Something went wrong, please contact admin.";
    header("location: console.php");
}

include "inc/nav.inc.php";
?>


<body>
    <div class="container">


        <section id="prodetails" class="section-p1">
            <div class="single-pro-image">
                <img src=<?php echo $product_img; ?> width="100%" id="MainImg" alt="">
            </div>

            <div class="">

                <?php
                if (!empty($_SESSION['prod_u_error'])) {
                    echo '<div class="alert alert-primary" style="color:red">' . $_SESSION['prod_u_error'] . '</div>';
                }
                ?>

                <h3 >Update Product</h3>
                <form action='product_process.php' method='post' enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $product_id; ?>"  name="prodid" required>
                    <input type="hidden" value="<?php echo $product_img; ?>"  name="prodimage2" required>
                    <label for="product name"><b>Name</b></label>
                    <input required type="text" placeholder="Enter Product Name" value="<?php echo $product_name; ?>"  name="prodname" required>
                    <label for="product price"><b>Price</b></label>
                    <input required type="text" value="<?php echo $product_price; ?>"  placeholder="Enter Product Price" name="prodprice" required>
                    <label for="product description"><b>Description</b></label>
                    <input required type="text" value="<?php echo $product_desc; ?>"  placeholder="Enter Product Description" name="proddesc" required>
                    <label for="product image"><b>Image (Only upload if image needs to be changed)</b></label>
                    <input type="file" name="prodimage">
                    <label required for="category">Choose a category:</label>
                    <select name="prodcategory" class="form-select">
                        <option value=""disabled selected>Select Category</option>
                        <option value="apparels">Apparels</option>
                        <option value="bottoms">Bottoms</option>
                        <option value="accessories">Accessories</option>
                        <option value="bags">Bags</option>
                        <option value="sale">Sale</option>
                        <option value="dress">Dress</option>

                    </select>
                    <br>
                    <button class="update" name="submit" value="update_prod"type="submit">Update</button><br>               
                </form>
            </div>
        </section>
    </div>


    <section id="newsletter" class="section-m1 section-p1">
        <div class="newstext">
            <h4>Sign Up For Newsletters </h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" name="" placeholder="Your email address" id="">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php
    unset($_SESSION['prod_u_error']);
    include "inc/footer.inc.php";

    