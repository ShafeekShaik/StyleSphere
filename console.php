<?php
include "access_control.php";
$permitted = array(0);
access_control($permitted);
include "inc/nav.inc.php";

include "config.php";
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM products";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT * FROM purchase_history";
$result3 = mysqli_query($conn, $sql3);
?>
<div class='container'>
    <?php
    if (!empty($_SESSION['console_err'])) {
        echo '<div class="alert alert-primary" style="color:red">' . $_SESSION['console_err'] . '</div>';
    }
    ?>
    <a id="new-prod" onclick="document.getElementById('newprod').style.display = 'block'" class="btn btn-info" role="button">Create new Product</a>

    <button type='button' class='collapsible'>Users</button>
    <div class='content'>
        <table class='table table-hover' id='customers'>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Privileges</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>";
                echo $row['id'];
                echo "</td>";
                echo "<td>";
                echo $row['username'];
                echo "</td>";
                echo "<td>";
                if ($row["role"] == 0) {
                    echo "Admin";
                } else {
                    echo "User";
                }
                echo "</td>";
                echo "<td>";
                echo $row['email'];
                echo "</td>";
                echo "<td>";
                echo $row['number'];
                echo "</td>";
                echo "<td>";
                echo "<a href=profile.php?id=" . $row['id'] . ">Update</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href=delete_user.php?id=" . $row['id'] . ">Delete</a>";
                echo "</td>";
                if ($row['role'] == 0) {
                    ?>
                    <td>
                        <form action="admin_process.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                            <input type="hidden" name="purpose" value="remove">
                            <?php
                            // This is so that you don't accidentally remove yourself as an admin and get locked out
                            if ($_SESSION['id'] == $row["id"]) {
                                echo "<button disabled type = 'submit' value = 'remove' class='btn btn-primary'>Remove Admin</button>";
                            } else {
                                echo "<button type = 'submit' value = 'remove' class='btn btn-primary'>Remove Admin</button>";
                            }
                            ?>
                        </form>

                    </td>
                    <?php
                } else {
                    echo "<td>";
                    ?>

                    <form action="admin_process.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                        <input type="hidden" name="purpose" value="make">
                        <?php
                        if ($_SESSION['id'] == $row["id"]) {
                            echo "<button disabled type = 'submit' value = 'make' class='btn btn-primary'>Make Admin</button>";
                        } else {
                            echo "<button type = 'submit' value = 'make' class='btn btn-primary'>Make Admin</button>";
                        }
                        ?>
                    </form>

                    <?php
                    echo "</td>";
                }
            }
            echo "</table>";
            echo "</div>";
            ?>
        </table>
        <button type='button' class='collapsible'>Products</button>
        <div class='content'>
            <table class='table table-hover' id='customers'>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row2['product_id'];
                    echo "</td>";
                    echo "<td>";
                    echo $row2['product_name'];
                    echo "</td>";
                    echo "<td>";
                    echo $row2['product_price'];
                    echo "</td>";
                    echo "<td>";
                    echo $row2['product_desc'];
                    echo "</td>";
                    echo "<td>";
                    echo $row2['product_category'];
                    echo "</td>";
                    echo "<td>";
                    echo "<a href=update_prod.php?product_id=" . $row2['product_id'] . ">Update</a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href=product_process.php?del_product_id=" . $row2['product_id'] . ">Delete</a>";
                    echo "</td>";
                }
                echo "</table>";
                echo "</div>";
                ?>
                <button type='button' class='collapsible'>Purchase History</button>
                <div class='content'>
                    <table class='table table-hover' id='customers'>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Time</th>
                            <th>Size</th>
                            <th>User ID</th>
                        </tr>
                        <?php
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            echo "<tr>";
                            echo "<td>";
                            echo $row3['purchase_id'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['product_name'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['quantity'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['subtotal'];
                            echo "</td>";
                            echo "<td>";
                            echo date("d/m/Y", strtotime($row3['time']));
                            echo "</td>";
                            echo "<td>";
                            echo $row3['size'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['user_id'];
                            echo "</td>";
                        }
                        echo "</table>";
                        echo "</div>";
                        ?>
                </div>
        </div>
        <?php
        ?>

        <div id="newprod" class="modal">
            <form class="modal-content animate" action="create_prod.php" method="post" enctype="multipart/form-data">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('newprod').style.display = 'none'" class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <h3>Create a new product!</h3><br>
                    <?php
                    if (!empty($_SESSION['prod_err'])) {
                        echo '<div class="alert alert-primary" style="color:red">' . $_SESSION['prod_err'] . '</div>';
                    }
                    ?>
                    <label for="product name"><b>Name</b></label>
                    <input type="text" placeholder="Enter Product Name" name="prodname" required>
                    <label for="product price"><b>Price</b></label>
                    <input type="number" placeholder="Enter Product Price" name="prodprice" required>
                    <label for="product description"><b>Description</b></label>
                    <input type="text" placeholder="Enter Product Description" name="proddesc" required>
                    <label for="product image"><b>Image</b></label>
                    <input type="file" name="prodimage" required>
                    <label for="category">Choose a category:</label>
                    <select name="prodcategory" class="form-select">
                        <option value="apparels">Apparels</option>
                        <option value="bottoms">Bottoms</option>
                        <option value="accessories">Accessories</option>
                        <option value="bags">Bags</option>
                        <option value="sale">Sale</option>
                        <option value="dress">Dress</option>
                    </select>
                    <br>
                    <button class="login" value="upload"type="submit">Create</button><br>
                </div></form>
        </div>
    </div>
    <script>
        //As this js is only applicable to this page, it was decided to keep it in here 
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
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
    include "inc/footer.inc.php";

    mysqli_close($conn);

    mysqli_free_result($result);
    mysqli_free_result($result2);
    mysqli_free_result($result3);

    unset($_SESSION['console_err']);
    unset($_SESSION['prod_u_err']);
    unset($_SESSION['prod_err']);

    