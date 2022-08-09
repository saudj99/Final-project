<?php
	session_start();
	include 'config.php';

	if (isset($_POST['submit'])) {
		$department = $_POST['department'];
		$reason = $_POST['reason'];
	
		$patient_id = $_SESSION['patient_id'];
		$stmt = $con->prepare("INSERT INTO `appointment`(`patient_id`, `department`, `reason`) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $patient_id, $department, $reason);

		if ($stmt->execute()) {
			echo "<script>alert('Appointment made successfully')</script>";
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| Make Appointment</title>
	<script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
      crossorigin="anonymous"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
     <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
     <script>
     $( function() {
       $( "#datepicker" ).datepicker();
        } );
  </script>
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
		border: 1px solid black;
		width: 30%;
		margin-left: 30%;
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
		margin-bottom: 20px;
	}
	.medical_records{
		display: block;
	}
	.title h4{
		width: 120px;
		font-weight: bold;
	}
	.title p{
		color: blue;
		font-weight: bold;
	}
	hr{
		margin-bottom: 10px;
	}
	form{
		display: block;
	}
	textarea{
		width: 200px;
		height: 50px;
		padding: 10px;
	}
	#submit{
		background: blue;
		color: white;
		padding: 10px;
		margin-left: 40%;
	}
	
</style>
<body>
	<div id="header">
		<h1>Electronic Medical Record | Makes Appointments</h1>
		<ul>
			<li><a href="patient.php">Home</a></li>
			<li><a class="active" href="appointment.php">Make Appointment</a></li>
			<li><a href="view_appointment.php">View Appointment</a></li>
			<li><a href="index.php">Logout</a></li>
			
		</ul>
	</div>
	<div id="contact_container">
		<center><h1>Make Appointment</h1></center>
		<form method='post' action="appointment.php">
			<div class="div_form">
				<div class="title">
					<h4>Select Department: </h4>
					<select name="department">
						<option value="Cardiology">Cardiology</option>
						<option value="Surgery">Surgery</option>
						<option value="Hematology">Hematology</option>
						<option value="Radiology">Radiology</option>
						<option value="Neurology">Neurology</option>
						<option value="Pharmacy">Pharmacy</option>
					</select>
				</div>
				
				
			</div>
			<div>
				
				<div class="title">
					<h4>Reason: </h4>
					<textarea name="reason" id="reason" placeholder="Enter the reason for making the appointent"></textarea>
				</div>
				
				<div class="title">
					<h4>Appointment Date: <input type="text" id="datepicker"> </h4>
					
				</div>



			</div>
			<input type="submit" id="submit" name="submit"  value="Save">

		</form>
		
	</div>

</body>
</html>
