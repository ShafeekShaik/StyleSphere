<?php

include "config.php";
include "access_control.php";

session_start();
$permitted = array(0, 1);
access_control($permitted);

if (isset($_GET['id'])) {

    //The variables will be according to who is logged in 
    if ($_SESSION['role'] == 0) {
        $did = $_GET['id'];
    } else if ($_SESSION['role'] == 1) {
        $did = $_SESSION['id'];
    }
    $sql = "Delete FROM users WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo mysqli_error($conn);
        echo "Statement Preparation Gone Wrong. Please check connection to Database";
        //debugging message which shows if the preparation has an error 
        exit();
    } else {
        //Binds the parameters which are the user input with the SQL statement
        mysqli_stmt_bind_param($stmt, "i", $did);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            if ($_SESSION['role'] == 1) {
                session_unset();
                session_destroy();
                header("location: index.php");
            } else if ($_SESSION['role'] == 0) {
                header("location: console.php");
            }
        } else {
            echo mysqli_error($conn);
        }
    }
} else {
    header("location: console.php");
    exit();
}







    