<?php
	session_start();
	include 'config.php';

	if (isset($_POST['submit'])) {
		$patient_id = $_POST['patient_id'];
		$age = $_POST['age'];
		$medical_history = $_POST['medical_history'];
		$pre_condition = $_POST['pre_condition'];
		$current_illness = $_POST['current_illness'];
		$health_summary = $_POST['health_summary'];
		$fee = $_POST['fee'];
		$doctor = $_POST['doctor'];

		$stmt = $con->prepare("INSERT INTO `patient_records`(`patient_id`, `age`, `medical_history`, `pre_existing_condition`, `current_illness`, `health_summary`, `medical_fee`, `doctor`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssss", $patient_id, $age, $medical_history, $pre_condition, $current_illness, $health_summary, $fee, $doctor);

		if ($stmt->execute()) {
			echo "<script>alert('Record Added successfully')</script>";
		}
	}
	

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| Add Record</title>
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
	}
	.div_form{
		margin-left: 20px;
		margin-right: 20px;
	}
	#submit{
		position: absolute;
		top: 75%;
		left: 30%;
		background: blue;
		color: white;

	}
	#container_header{
		margin-left: 25%;color: blue;
	}
	textarea{
		width: 190px;
		height: 70px;
		padding: 10px;
		margin-top: 10px;
	}
	

	
</style>
<body>
	<div id="header">
		<h1>Electronic Medical Record | Add Record</h1>
		<ul>
			<li><a href="doctor.php">Home</a></li>
			<li><a class="active" href="add_record.php">Add Patient Record</a></li>
			<li><a href="view_appointments.php">View Appointment</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="contact_container">
		<h1 id="container_header">Add Record</h1>
		<form method='post' action="add_record.php">
			<div class="div_form">
				<div class="title">
					<h4>Patient ID: </h4>
					<input type="text" name="patient_id" placeholder="Enter Patient ID" required>
				</div>
				
				<div class="title">
					<h4>Age: </h4>
					<input type="text" name="age" placeholder="Enter Patient's Age" required>
				</div>
				
				<div class="title">
					<h4>Medical History: </h4>
					<textarea name="medical_history" placeholder="Enter Medical History" required></textarea>
				</div>
				<div class="title">
					<h4>Pre-existing Condition: </h4>
					<textarea name="pre_condition" placeholder="Enter pre-existing condition" required></textarea>
				</div>
			</div>
			<div>
				<div class="title">
					<h4>Current Illness: </h4>
					<textarea name="current_illness" placeholder="Enter current illness" required></textarea>
				</div>
				<div class="title">
					<h4>Health Summary: </h4>
					<textarea name="health_summary" placeholder="Enter Health Summary" required></textarea>
				</div>
				<div class="title">
					<h4>Medical Fee: </h4>
					<input type="text" name="fee"  placeholder="Enter Medical Fee" required>
				</div>
				<div class="title">
					<h4>Doctor's Name: </h4>
					<input type="text" name="doctor" placeholder="Enter Doctor's Name" required>
				</div>
				
				
			</div>
			<input type="submit" id="submit" name="submit"  value="Save">

		</form>
		
		
	</div>

</body>
</html>
