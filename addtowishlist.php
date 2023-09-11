<?php

// Start the session
session_start();

// Check if the user is logged in
include "access_control.php";

$permitted = array(0, 1);
access_control($permitted);

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "config.php";
    // get form data
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST["pimage"];

// Check if the product ID already exists in the wishlist for this user
    $user_id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ? AND pid = ?");
    $stmt->bind_param("ii", $user_id, $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the product ID already exists, display an error message
    if ($result->num_rows > 0) {
        header("location: wishlist.php");
    } else {
        // Get the product details from the database
        // prepare and execute SQL query to insert data into database
        $stmt = $conn->prepare("INSERT INTO wishlist (pid, pname, pprice,pimage, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isisi", $pid, $pname, $pprice, $pimage, $useridparam);
        $useridparam = $_SESSION['id'];
        $stmt->execute();

        // If the product is successfully added to the wishlist, display a success message
        if ($stmt->affected_rows > 0) {
            $_SESSION['wishlist'] = 'Product successfully added to wishlist!';
            header("location: wishlist.php");
        } else {
            $_SESSION['wishlist'] = 'Error adding product to wishlist!';


            header("location: wishlist.php");
        }
    }

    // Close the database connection and statement
    $stmt->close();
    $conn->close();
}
?> 