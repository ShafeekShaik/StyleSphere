<?php
	session_start();
	//remove the id from our cart array
	unset($_SESSION['cart'][$_GET['id']]);
 //rearrange array after unset
	$_SESSION['cart'] = array_values($_SESSION['cart']);
 	header('location: cart.php');
?>
