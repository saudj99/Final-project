<?php
	session_start();
	include 'config.php';

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = $con->prepare("select user_id, permission, password from user where username = ? limit 1");
        $sql->bind_param("s", $username);
        $sql->execute();

        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
          	$getUserId = $row["user_id"];
          	$getPermission = $row["permission"];
          	$getpassword = $row["password"];

          	if (password_verify($password, $getpassword)) {
          		if ($getPermission == "Admin") {
          			header("Location: admin.php");
          		} else if ($getPermission == "Patient") {
          			$_SESSION['patient_id'] = $getUserId;
          			header("Location: patient.php");
          		}else if ($getPermission == "Doctor") {
          			header("Location: doctor.php");
          		}
          		
          	}
          	else{
          		echo "<script>alert('Incorrect Password!!');</script>";
          	}
		}
		else{
      		echo "<script>alert('Incorrect Username!!');</script>";
      	}
	}

?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
      
</head>
<style>
	*{
		margin: 0;
		padding: 0;
	}
	body{
		background: #EBEDF3;
	}
	
	#container{
		width: 36%;
		height: 400px;
		background: white;
		margin-left: 30%;
		margin-top: 20px;
		
	}
	h3{
		margin-top: 20px;
	}
	.login_img img{
		height: 150px;
		width: 100%;
	}
	.div_username, .div_password {
        position: relative;
        margin-left: 30px;
        margin-top: 30px;
    }
    label{
    	font-size: 16px;
    	color: gray;
    	
    }
    .div_username input, .div_password input{
    	padding-left: 20px;
    	width: 60%;
    	padding-bottom: 5px;
    	border-top: none;
    	border-left: none;
    	border-right: none;
    	border-color: lightblue;
    }
      
    .div_username i, .div_password i{
        position: absolute;
        left: 15%;
  		top: 2px;
        color: gray;
    }
    #div_remember{
    	margin-left: 20%;
    	margin-top: 10px;
    }
    #forget{
    	margin-left: 25%;
    }
    #login{
    	background: #219ebc;
    	padding: 5px;
    	padding-left: 20px;
    	padding-right: 20px;
    	border: none;
    	border-radius: 10px;
    	margin-left: 20%;
    	margin-top: 20px;
    	color: white;
    }
    #user_img{
    	position: absolute;
    	top: 56.7%;
    	left: 59.5%;
    	width: 150px;
    }
	
	
</style>
<body>
	<center><h3>Login page for Hospital Software/Website</h3></center>
	<div id="container">
		<div class="login_img">
			<img src="images/login_img.PNG">
			
		</div>
		<div>
			<form action="index.php" method="post">
				<div class="div_username">
					<label>Username</label>
					<input type="text" name="username" placeholder="Enter Username"><i class="fa fa-user-circle" aria-hidden="true"></i>
				</div>
				<div class="div_password">
					<label>Password</label>
					<input type="password" name="password" placeholder="Enter Password"><i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<div>
					<div id="div_remember">
						<input type="checkbox" id="remeber" name="remember" value="Remeber">
						<label for="remeber"> Remember me</label>
						<label id="forget">Forget Password?</label>
						<img src="images/user.PNG" id="user_img">
					</div>
				</div>
				<input type="submit" id="login" name="login" value="Login">
			</form>

		</div>
	
	</div>

</body>
</html>
