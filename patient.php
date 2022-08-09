<?php
	session_start();
	include 'config.php';

	$output = '';
	// $_SESSION['patient_id'] = "44126834";
	$patient_id = $_SESSION['patient_id'];

	$query  = "SELECT * FROM patient_records WHERE patient_id = '$patient_id'";
	$statement = $db->prepare($query);
	if ($statement->execute()) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
        	$output .= '<div class="medical_records">
        	<hr>
			<div class="title">
				<h4>Patient ID: </h4>
				<p>'.$row["patient_id"].'</p>
			</div>
			<div class="title">
				<h4>Age: </h4>
				<p>'.$row["age"].'</p>
			</div>
			<div class="title">
				<h4>Medical History: </h4>
				<p>'.$row["medical_history"].'</p>
			</div>
			<div class="title">
				<h4>Pre-existing condition: </h4>
				<p>'.$row["pre_existing_condition"].'</p>
			</div>
			<div class="title">
				<h4>Current Illness: </h4>
				<p>'.$row["current_illness"].'</p>
			</div>
			<div class="title">
				<h4>Health Summary: </h4>
				<p>'.$row["health_summary"].'</p>
			</div>
			<div class="title">
				<h4>Medical Fee: </h4>
				<p>'.$row["medical_fee"].'</p>
			</div>
			<div class="title">
				<h4>Doctor: </h4>
				<p>'.$row["doctor"].'</p>
			</div>
			
			
		</div>';

        }
    }
 

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| Admin</title>
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

	
</style>
<body>
	<div id="header">
		<h1>Electronic Medical Record | Patient</h1>
		<ul>
			<li><a class="active" href="patient.php">Home</a></li>
			<li><a href="appointment.php">Make Appointment</a></li>
			<li><a href="view_appointment.php">View Appointment</a></li>
			<li><a href="index.php">Logout</a></li>
			
		</ul>
	</div>
	<div id="contact_container">
		<center><h1>All Medical Records</h1></center>
		<?php echo $output ?>

		
		
	</div>

</body>
</html>
