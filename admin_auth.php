<?php
session_start();
if(!isset($_SESSION["admin_username"])){
	header("Location: index.php");
	exit();
} else {
	include './connection.php';
	$user = $db->prepare("SELECT * from USER_TABLE WHERE user_name=?");
	$user->execute([$_SESSION['admin_username']]);
	$user = $user->fetch();
}
?>