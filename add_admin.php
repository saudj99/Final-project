<?php
	include 'config.php';

	$admin_id = strval(mt_rand(10000000, 99999999));
	$username = "Admin Test";
	$permission = "Admin";
	$password = "Admin12";

	$pass_hash = password_hash($password, PASSWORD_BCRYPT, ["COST"=>8]);

	$statement = $con->prepare("INSERT INTO `user`(`user_id`, `username`, `permission`, `password`) VALUES (?, ?, ?, ?)");
	$statement->bind_param("ssss", $admin_id, $username, $permission, $pass_hash);
	if ($statement->execute()) {
		echo "<script>alert('Admin Added successfully')</script>";
	}else{
		echo "<script>alert('Error occurred. Try Again.')</script>";
	}

?>