<?php
session_start();
include "inc/nav.inc.php"
?>
<?php include 'send_email.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <section id="page-header" class="about-header">
        <h2>#let's_talk</h2>
        <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>
    <section id="form-details">
        <form action="send_email.php" method="post">
            <span>Contact us with any queries or feedback us!</span>
            <h2>We love to hear from you </h2>
            <?php
            if (!empty($_SESSION['feedback'])) {
                echo '<div class="alert alert-primary" style="color:green">' . $_SESSION['feedback'] . '</div>';
            }
            ?>
            <input type="text" name="name" id="name" placeholder="Your Name" required align="center">
            <input type="email" name="email" id="email" placeholder="E-mail"  required align="center">
            <input type="text" name="phoneNum" id="phoneNum" placeholder="Phone Number" required align="center">
            <input type="text" name="orderNum" id="orderNum" placeholder="Order Number" required align="center">
            <textarea name="message" cols="40" rows="10" placeholder="Your Message"  required align="center"></textarea>
            <button type="submit" name="submit" class="send-btn" value="Send">Send</button>
        </form>
        <div class="people">
            <div>
                <img src="images/sitlogo.png" alt="Avatar" >
                <p><span>Brought to you by Team 2</span> INF1005 <br> Team StyleSphere <br> We love INF1005!</p>
            </div>
            <div>
            </div>
        </div>
    </section>

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
    unset($_SESSION['feedback']);
    include "inc/footer.inc.php"
    ?>

    <script src="js/script.js"></script>	
</script>

</body>

</html>