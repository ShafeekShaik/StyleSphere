<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    session_start();
    include 'config.php';
    $pid = $_POST['pid'];
    // prepare and execute SQL query to delete data from database
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND pid = ?");
    $stmt->bind_param("ii", $_SESSION['id'], $pid);
    $stmt->execute();
    // If the product is successfully deleted from the wishlist, display a success message
    if ($stmt->affected_rows > 0) {
        $_SESSION['wishlist'] = 'Product deleted from wishlist successfully!';
        header("location: wishlist.php");
    } else {
        $_SESSION['wishlist'] = 'Error deleting product from wishlist!';
        header("location: wishlist.php");
    }
    // Close the statement
    $stmt->close();
} else {
    header("location: wishlist.php");
    exit();
}
