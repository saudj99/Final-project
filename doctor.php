<?php
	session_start();
	include 'config.php';

	$output = '';

	$query  = "SELECT * FROM patient_records";
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
			<form action="doctor.php" method="post">
				<input type="hidden" name="record_id" value="'.$row["id"].'"/>
				<input type="hidden" name="patient_id" value="'.$row["patient_id"].'"/>
				<input type="hidden" name="age" value="'.$row["age"].'"/>
				<input type="hidden" name="medical_history" value="'.$row["medical_history"].'"/>
				<input type="hidden" name="pre_existing_condition" value="'.$row["pre_existing_condition"].'"/>
				<input type="hidden" name="current_illness" value="'.$row["current_illness"].'"/>
				<input type="hidden" name="health_summary" value="'.$row["health_summary"].'"/>
				<input type="hidden" name="medical_fee" value="'.$row["medical_fee"].'"/>
				<input type="hidden" name="doctor" value="'.$row["doctor"].'"/>
				<input type="submit" name="update" class="btn_update" value="Update"/>
			</form>
			<form action="doctor.php" method="post">
				<input type="hidden" name="record_id" value="'.$row["id"].'"/>
				<input type="submit" name="delete" class="btn_delete" value="Delete"/>
			</form>
			
		</div>';

        }
    }
    if (isset($_POST['update'])) {
    	$_SESSION['id'] = $_POST['record_id'];
    	$_SESSION['patient_id'] = $_POST['patient_id'];
    	$_SESSION['age'] = $_POST['age'];
    	$_SESSION['medical_history'] = $_POST['medical_history'];
    	$_SESSION['pre_existing_condition'] = $_POST['pre_existing_condition'];
    	$_SESSION['current_illness'] = $_POST['current_illness'];
    	$_SESSION['health_summary'] = $_POST['health_summary'];
    	$_SESSION['medical_fee'] = $_POST['medical_fee'];
    	$_SESSION['doctor'] = $_POST['doctor'];
    	
		header("Location: update_record.php");
    }
    if (isset($_POST['delete'])) {
    	$record_id = $_POST['record_id'];
    	$query  = "
        DELETE FROM patient_records WHERE id = ".$record_id."
        ";

        $delete_stmt = $con->prepare($query);

        if ($delete_stmt->execute()) {
            echo "<script>alert('Record deleted successfully')</script>";
            echo "<meta http-equiv='refresh' content='0'>";
            
            
        }
    	
    }

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| Doctor</title>
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
	.btn_update{
		background: green;
		color: white;
		padding: 5px;
		margin-top: 10px;
		border-radius: 20%;
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
		<h1>Electronic Medical Record | Doctor</h1>
		<ul>
			<li><a class="active" href="doctor.php">Home</a></li>
			<li><a href="add_record.php">Add Patient Record</a></li>
			<li><a href="view_appointments.php">View Appointment</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="contact_container">
		<center><h1>All Patients Records</h1></center>
		<?php echo $output ?>

		
		
	</div>

</body>
</html>
