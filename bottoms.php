<?php
session_start();
include "inc/nav.inc.php"
?>
<!DOCTYPE html>
<html lang="en">
    <section id="page-header">
        <h2>#BOTTOMS</h2>
        <p></p>
    </section>
    <section id="product1" class="section-p1">
        <div class="pro-container">
            <?php
            include 'display_prod.php';
            prod_display('bottoms');
            ?>
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