<?php
	session_start();
	include 'config.php';

	if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$firstName = $_POST['firstName'];
		$middleName = $_POST['middleName'];
		$lastName = $_POST['lastName'];
		$gender = $_POST['gender'];
		$dob = $_POST['dob'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];

		$pass_hash = password_hash($password, PASSWORD_BCRYPT, ["COST"=>8]);
		$patient_id = strval(mt_rand(10000000, 99999999));

		$permission = "Patient";

		$statement = $con->prepare("INSERT INTO `user`(`user_id`, `username`, `permission`, `password`) VALUES (?, ?, ?, ?)");
		$statement->bind_param("ssss", $patient_id, $username, $permission, $pass_hash);
		if ($statement->execute()) {
			$stmt = $con->prepare("INSERT INTO `patient_info`(`patient_id`, `firstname`, `middlename`, `lastname`, `dob`, `gender`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssss", $patient_id, $firstName, $middleName, $lastName, $dob, $gender, $phone);

			if ($stmt->execute()) {
				echo "<script>alert('Patient Added successfully')</script>";
			}else{
				echo "<script>alert('Error occurred. Try Again.')</script>";
			}
		}else{
			echo "<script>alert('Error occurred. Try Again.')</script>";
		}

		
	}
	

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| Add Patient</title>
	<script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
      crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<style>
	*{
		margin: 0;
		padding: 0;
	}
	#header{
		color: white;
		background: blue;
		text-align: center;
		height: 60px;
		padding: 20px;
	}
	#contact_container{
		margin-top: 20px;
		padding: 20px;
	}
	ul{
		display: inline-flex;
		margin-top: 10px;
	}
	ul li{
		list-style: none;
		margin-left: 10px;
	}
	ul li a{
		text-decoration: none;
		background: white;
		padding: 5px;
		border-radius: 20%;
	}
	.active, ul li a:hover{
		background: red;
		color: white;
	}
	.title{
		display: flex;
	}
	.medical_records{
		display: block;
	}
	.title h4{
		width: 180px;
		font-weight: bold;
	}
	.title p{
		color: blue;
		font-weight: bold;
	}
	hr{
		margin-bottom: 10px;
	}
	.btn_delete{
		background: red;
		color: white;
		padding: 5px;
		border-radius: 20%;
	}
	input, select{
		padding: 10px;
		margin-top: 10px;
	}
	form{
		display: flex;
		margin-top: 10px;
	}
	.div_form{
		margin-left: 20px;
		margin-right: 20px;

	}
	#submit{
		position: absolute;
		top: 60%;
		left: 30%;
		background: blue;
		color: white;

	}
	#container_header{
		margin-left: 25%;color: blue;
	}
	

	
</style>
<body>
	<div id="header">
		<h1>Electronic Medical Record | Add Patient</h1>
		<ul>
			<li><a href="admin.php">Home</a></li>
			<li><a href="add_doctor.php">Add Doctor</a></li>
			<li><a href="view_doctors.php">View Doctors</a></li>
			<li><a class="active" href="add_patient.php">Add Patient</a></li>
			<li><a href="view_patients.php">View Patients</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="contact_container">
		<u><h1 id="container_header">Add Patient</h1></u>
		<form method='post' action="add_patient.php">
			<div class="div_form">
				<div class="title">
					<h4>Username: </h4>
					<input type="text" name="username" placeholder="Enter Username" required>
				</div>
				
				<div class="title">
					<h4>Middle Name: </h4>
					<input type="text" name="middleName" placeholder="Enter Middle Name" required>
				</div>
				
				
				<div class="title">
					<h4>Date of Birth: </h4>
					<input type="date" name="dob" required>
				</div>
				<div class="title">
					<h4>Phone: </h4>
					<input type="text" name="phone"  placeholder="Enter Phone" required>
				</div>
				
				
				
			</div>
			<div>
				<div class="title">
					<h4>First Name: </h4>
					<input type="text" name="firstName" placeholder="Enter First Name" required>
				</div>
				<div class="title">
					<h4>Last Name: </h4>
					<input type="text" name="lastName" placeholder="Enter Last Name" required>
				</div>
				<div class="title">
					<h4>Gender: </h4>
					<select name="gender">
						<option value="male">Male</option>
						<option value="female">Female</option>
						<option value="others">Others</option>
					</select>
				</div>
				
				<div class="title">
					<h4>Password: </h4>
					<input type="password" name="password"  placeholder="Enter Password" required>
				</div>
				
				
			</div>
			<input type="submit" id="submit" name="submit"  value="Save">

		</form>
		
		
	</div>

</body>
</html>
