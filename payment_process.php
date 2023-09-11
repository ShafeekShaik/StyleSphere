<?php
session_start();
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
    </head>

    <?php
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $adr = $_POST['adr'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    $cname = $_POST['cname'];
    $cnumber = $_POST['cnumber'];
//$cexpire = $_POST['cexpire'];
    $cexpire = isset($_POST['cexpire']) ? $_POST['cexpire'] : '';
    $cvv = $_POST['cvv'];

    $success = true;
    $errorMsg = "";

// full name check
    if (empty($_POST["fname"])) {
        $errorMsg .= "Full Name is required.<br>";
        $success = false;
    } else {
        $fname = sanitize_input($_POST["fname"]);
        // Additional check to make sure name is well-formed.
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
            $errorMsg .= "Only alphabets and white space are allowed in the last name<br>";
            $success = false;
        }
    }
//email check
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }
    //address check
    if (empty($_POST["adr"])) {
        $errorMsg .= "Address is required.<br>";
        $success = false;
    } else {
        $adr = sanitize_input($_POST["adr"]);
        // Additional check to make sure address is well-formed.
        if (!preg_match("/^[a-zA-Z0-9\s\.,#-]*$/", $adr)) {
            $errorMsg .= "Only numbers, alphabets, spaces, commas, periods, hash, and dash are allowed for address<br>";
            $success = false;
        }
    }

// city check
    if (empty($_POST["city"])) {
        $errorMsg .= "City is required.<br>";
        $success = false;
    } else {
        $city = sanitize_input($_POST["city"]);
        // additional check to make sure city is well-formed
        if (!preg_match("/^[a-zA-Z\s]*$/", $city)) {
            $errorMsg .= "Only letters and spaces are allowed for city.<br>";
            $success = false;
        }
    }

// state check
    if (empty($_POST["state"])) {
        $errorMsg .= "State is required.<br>";
        $success = false;
    } else {
        $state = sanitize_input($_POST["state"]);
        // additional check to make sure state is well-formed
        if (!preg_match("/^[a-zA-Z\s]*$/", $state)) {
            $errorMsg .= "Only letters and spaces are allowed for state.<br>";
            $success = false;
        }
    }

// zip check
    if (empty($_POST["zip"])) {
        $errorMsg .= "Zip is required.<br>";
        $success = false;
    } else {
        $zip = sanitize_input($_POST["zip"]);
        // additional check to make sure zip code is well-formed
        if (!preg_match("/^[0-9]*$/", $zip)) {
            $errorMsg .= "Only numbers are allowed for zip.<br>";
            $success = false;
        }
    }

// card number fill check
    if (empty($_POST["cnumber"])) {
        $errorMsg .= "Credit card number is required.<br>";
        $success = false;
    }


// Identify the type of card based on the first digit of the card number
    $first_digit = substr($cnumber, 0, 1);
    if ($first_digit == '4') {
        $card_type = 'Visa';
        $valid_card_length = 16;
        $valid_security_code_length = 3;
    } elseif ($first_digit == '5') {
        $card_type = 'Mastercard';
        $valid_card_length = 16;
        $valid_security_code_length = 3;
    } else {
        $card_type = 'Unknown';
        $valid_card_length = 0;
        $valid_security_code_length = 0;
        $errorMsg .= "Unknown or Unaccepted Card type.<br>";
        $success = false;
    }

// Check if the card number is a valid length for the card type
    if (strlen($cnumber) != $valid_card_length) {
        $errorMsg .= "Invalid card number length.<br>";
        $success = false;
    }

// Check if the card number passes the Luhn algorithm
    if (!luhn_algorithm($cnumber)) {
        $errorMsg .= "Invalid card number.<br>";
        $success = false;
    }

// Check if the card name is well-formed
    if (empty($_POST["cname"])) {
        $errorMsg .= "Full Name on Credit Card is required.<br>";
        $success = false;
    } else {
        $cname = sanitize_input($_POST["cname"]);
        // Additional check to make sure name is well-formed.
        if (!preg_match("/^[a-zA-Z ]*$/", $cname)) {
            $errorMsg .= "Only alphabets and white space are allowed in the Card Name.<br>";
            $success = false;
        }
    }

// card expire check
    if (empty($_POST["cexpire"])) {
        $errorMsg .= "Expiry date is required.<br>";
        $success = false;
    } else {
        $cexpire = sanitize_input($_POST["cexpire"]);
        // check if the expiry date is valid
        if (!is_valid_expiry_date($cexpire)) {
            $errorMsg .= "Invalid expiry date.<br>";
            $success = false;
        }
    }

// Check if the security code is the expected length for the card type
    if (empty($_POST["cvv"])) {
        $errorMsg .= "CVV is required.<br>";
        $success = false;
    } else {
        $cvv = sanitize_input($_POST["cvv"]);
        // check if the security code is valid
        if (!valid_security_code_length($cvv)) {
            $errorMsg .= "Invalid security code length or security code should only contain numbers.<br>";
            $success = false;
        }
    }

    /**
     * Implementation of the Luhn algorithm for credit card validation.
     *
     * @param string $number The credit card number to validate.
     * @return bool Whether the credit card number is valid or not.
     */
    function luhn_algorithm($cnumber) {
        $sum = 0;
        $alt = false;
        for ($i = strlen($cnumber) - 1; $i >= 0; $i--) {
            $digit = intval($cnumber[$i]);
            if ($alt) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
            $alt = !$alt;
        }
        return $sum % 10 == 0;
    }

    /**
     * Checks if an expiry date string is a valid date in the future.
     *
     * @param string $date The expiry date string in the format MM/YY.
     * @return bool Whether the date is valid and in the future or not.
     */
    function is_valid_expiry_date($date) {
        $cexpire = DateTime::createFromFormat('m/y', $date);
        if (!$cexpire) {
            return false;
        }
        $current_date = new DateTime();
        return $cexpire > $current_date;
    }

    /**
     * Checks if the security code is the expected length for the card type.
     *
     * @param string $cvv The security code to validate.
     * @return bool Whether the security code is valid or not.
     */
    function valid_security_code_length($cvv) {
        global $valid_security_code_length;
        return preg_match('/^[0-9]+$/', $cvv) && strlen($cvv) == $valid_security_code_length;
    }

// sanitize user input
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <?php
    if ($success) {

        include "config.php";

        $stmt = $conn->prepare("INSERT INTO purchase_history (product_name, quantity, subtotal, size, user_id) VALUES (?, ?, ?, ?, ?)");
        // Bind & execute the query statement:
//        echo $conn->connect_errno;

        if (!empty($_SESSION['cart'])) {
            $stmt->bind_param("siisi", $param_pname, $param_quantity, $param_itemtotal, $param_size, $param_userid);
            foreach ($_SESSION['cart'] as $citem) {
                $param_pname = $citem['pname'];
                $param_quantity = $citem['quantity'];
                $param_itemtotal = $citem['itemtotal'];
                $param_size = $citem['size'];
                $param_userid = $_SESSION['id'];
//                print($citem['pname']);
                $stmt->execute();
//                echo $conn->connect_errno;
                header("location: profile.php");
            }
        }
    } else {
        include "inc/nav.inc.php";
        echo "<h4>Oops!<br>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
?>
        <form action = "paymentform.php" method = "post">
        <div class = "form-group">
        <button class = "btn btn-danger" type = "submit", id = "submit">Return To Payment Page</button>
        </div>
        </form>
  <?php
    }
    ?>    

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

    //<?php
    include "inc/footer.inc.php"
//    ?>