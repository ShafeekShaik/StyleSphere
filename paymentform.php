<?php
session_start();
include "inc/nav.inc.php"
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            input[type=text] {
                width: 100%;
                margin-bottom: 20px;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }
        </style>
    </head>

    <body>
        <br>
        <div class="row_p">
            <div class="col-75">
                <div class="container_p">
                    <form action="payment_process.php" method = "POST">

                        <div class="row_p">
                            <div class="col-50">
                                <h3>Billing Address</h3>
                                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                <input type="text" id="fname" name="fname" placeholder="John M. Doe" required>
                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input type="text" id="email" name="email" placeholder="john@example.com" required>
                                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                <input type="text" id="adr" name="adr" placeholder="542 W. 15th Street" required>
                                <label for="city"><i class="fa fa-institution"></i> City</label>
                                <input type="text" id="city" name="city" placeholder="New York" required>

                                <div class="row_p">
                                    <div class="col-50">
                                        <label for="state">State</label>
                                        <input type="text" id="state" name="state" placeholder="NY">
                                    </div>
                                    <div class="col-50">
                                        <label for="zip">Zip</label>
                                        <input type="text" id="zip" name="zip" placeholder="10001">
                                    </div>
                                </div>
                            </div>

                            <div class="col-50">
                                <h3>Payment</h3>
                                <label for="fname">Accepted Cards</label>
                                <div class="icon-container_p">
                                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                                    <!--<i class="fa fa-cc-amex" style="color:blue;"></i>-->
                                    <i class="fa fa-cc-mastercard" style="color:orange;"></i>
                                    <!--<i class="fa fa-cc-discover" style="color:orange;"></i>-->
                                </div>
                                <label for="cname">Name on Card</label>
                                <input type="text" id="cname" name="cname" placeholder="John More Doe" required>
                                <label for="cnum">Card number</label>
                                <input type="text" id="cnum" name="cnumber" placeholder="1111-2222-3333-4444" required>
                                <!--                                <label for="expmonth">Exp Month</label>
                                                                <input type="text" id="expmonth" name="expmonth" placeholder="September" required>-->
                                <div class="row_p">
                                    <div class="col-50">
                                        <label for="cexpire">Card Expire</label>
                                        <input type="text" id="cexpire" name="cexpire" placeholder="MM/YY" required>
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="352">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <label>
                            <input type="checkbox" name="sameadr"> Shipping address same as billing
                        </label>
                        <input type="submit" value="Continue to checkout" class="btn_p">
                    </form>
                </div>
            </div>
        </div>

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
        include "inc/footer.inc.php"
        ?>

        <script src="js/script.js"></script>
    </body>

    <head>
        <style>

        </style>
    </head>

    <script>
    </script>

</html>
<?php
if (!empty($_SESSION['login_err'])) {
    echo "<script type='text/javascript'>";
    echo "document.getElementById('login-btn_p').click();";
    echo "</script>";
} elseif (!empty($_SESSION['reg_error'])) {
    echo "<script type='text/javascript'>";
    echo "document.getElementById('register-btn_p').click();";
    echo "</script>";
}




unset($_SESSION['login_err']);
unset($_SESSION['username_err']);
unset($_SESSION['password_err']);
unset($_SESSION['reg_error']);
?>