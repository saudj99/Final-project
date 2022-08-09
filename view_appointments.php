<?php
	session_start();
	include 'config.php';

	$output = '';
	$query  = "SELECT * FROM appointment";
	$statement = $db->prepare($query);
	if ($statement->execute()) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
        	$output .= '<div class="medical_records">
        	<hr>
			<div class="title">
				<h4>Appointment ID: </h4>
				<p>'.$row["app_id"].'</p>
			</div>
			<div class="title">
				<h4>Patient ID: </h4>
				<p>'.$row["patient_id"].'</p>
			</div>
			<div class="title">
				<h4>Department: </h4>
				<p>'.$row["department"].'</p>
			</div>
		
			<div class="title">
				<h4>Reason: </h4>
				<p>'.$row["reason"].'</p>
			</div>
		
			<form action="view_appointments.php" method="post">
				<input type="hidden" name="app_id" value="'.$row["app_id"].'"/>
				<input type="submit" name="delete" class="btn_delete" value="Cancel"/>
			</form>
			
		</div>';

        }
    }
   
    if (isset($_POST['delete'])) {
    	$app_id = $_POST['app_id'];
    	$query  = "
        DELETE FROM appointment WHERE app_id = ".$app_id."
        ";

        $delete_stmt = $con->prepare($query);

        if ($delete_stmt->execute()) {
            echo "<script>alert('Appointment cancelled successfully')</script>";
            echo "<meta http-equiv='refresh' content='0'>";
            
            
        }
    	
    }

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| View Appointments</title>
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
		padding-left: 40px;
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
		margin-left: 20px;
		border: 1px solid black;
		padding: 20px;
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
		margin-top: 10px;
		border-radius: 20%;
	}

	.div_doctor{
		display: flex;
		flex-flow: wrap;
	}

	
</style>
<body>
	<div id="header">
		<h1>Electronic Medical Record | View Appointments</h1>
		<ul>
			<li><a href="doctor.php">Home</a></li>
			<li><a href="add_record.php">Add Patient Record</a></li>
			<li><a class="active" href="view_appointments.php">View Appointments</a></li>
			<li><a href="index.php">Logout</a></li>
		</ul>
	</div>
	<div id="contact_container">
		<center><h1>All Appointments</h1></center>
		<div class="div_doctor">
			<?php echo $output ?>
		</div>
		
		
		
		
	</div>

</body>
</html>
