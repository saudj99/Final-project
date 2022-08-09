<?php
	//session_start();
	//include 'config.php';

	$output = '';

	$query  = "SELECT * FROM patient";
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
			<form action="admin.php" method="post">
				<input type="hidden" name="record_id" value="'.$row["id"].'"/>
				<input type="submit" name="delete" class="btn_delete" value="Delete"/>
			</form>
			
		</div>';

        }
    }
    if (isset($_POST['delete'])) {
    	$record_id = $_POST['record_id'];
    	$query  = "
        DELETE FROM patient WHERE id = ".$record_id."
        ";

        $delete_stmt = $con->prepare($query);

        if ($delete_stmt->execute()) {
            echo "<script>alert('Record deleted successfully')</script>";
            echo "<meta http-equiv='refresh' content='0'>";
            
            
        }
    	echo $record_id;
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
		<h1>Electronic Medical Record | Admin</h1>
		<ul>
			<li><a class="active" href="admin.php">Home</a></li>
			<li><a href="add_doctor.php">Add Doctor</a></li>
			<li><a href="view_doctors.php">View Doctors</a></li>
			<li><a href="add_patient.php">Add Patient</a></li>
			<li><a href="view_patients.php">View Patients</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="contact_container">
		<center><h1>All Medical Records</h1></center>
		<?php echo $output ?>

		
		
	</div>

</body>
</html>
