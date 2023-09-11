<?php

function make_admin($user_id) {
    include "config.php";
    $sql = "UPDATE users SET role=? WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        $role_param = 0;
        $userid_param = $user_id;
        mysqli_stmt_bind_param($stmt, "ii", $role_param, $userid_param);
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            # Excecute your query
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            echo $errorMsg;
            $_SESSION['console_err'] = "Change Successful!";
            header("location: console.php");
            exit();
        } else {
            $_SESSION['console_err'] = "Something went wrong!";
            header("location: console.php");
            exit();
        }
    } else {
        $_SESSION['console_err'] = "Something went wrong!";
        header("location: console.php");
        exit();
    }
}

function remove_admin($user_id) {
    include "config.php";
    $sql = "UPDATE users SET role=? WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        $role_param = 1;
        $userid_param = $user_id;
        mysqli_stmt_bind_param($stmt, "ii", $role_param, $userid_param);
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            # Excecute your query
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            echo $errorMsg;
            $_SESSION['console_err'] = "Change Successful!";
            header("location: console.php");
            exit();
        } else {
            $_SESSION['console_err'] = "Something went wrong!";
            header("location: console.php");
            exit();
        }
    } else {
        $_SESSION['console_err'] = "Something went wrong!";
        header("location: console.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['purpose'] == 'remove') {
    remove_admin($_POST['id']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['purpose'] == 'make') {
    make_admin($_POST['id']);
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("location: index.php");
} 