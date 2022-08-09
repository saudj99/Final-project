<?php
	session_start();
	include 'config.php';

	$output = '';
	$patient_id = $_SESSION['patient_id'];
	$query  = "SELECT * FROM appointment WHERE patient_id = '$patient_id'";
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
				<h4>Department: </h4>
				<p>'.$row["department"].'</p>
			</div>
		
			<div class="title">
				<h4>Reason: </h4>
				<p>'.$row["reason"].'</p>
			</div>
			
			<form action="view_appointment.php" method="post">
				<input type="hidden" name="app_id" value="'.$row["app_id"].'"/>
				<input type="hidden" name="department" value="'.$row["department"].'"/>
				<input type="hidden" name="reason" value="'.$row["reason"].'"/>
				<input type="submit" name="update" class="btn_update" value="Update"/>
			</form>
			<form action="view_appointment.php" method="post">
				<input type="hidden" name="app_id" value="'.$row["app_id"].'"/>
				<input type="submit" name="delete" class="btn_delete" value="Cancel"/>
			</form>
			
		</div>';

        }
    }
    if (isset($_POST['update'])) {
    	$_SESSION['app_id'] = $_POST['app_id'];
    	$_SESSION['department'] = $_POST['department'];
    	$_SESSION['reason'] = $_POST['reason'];
    	
		header("Location: update_appointment.php");
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
			<li><a href="patient.php">Home</a></li>
			<li><a href="appointment.php">Make Appointment</a></li>
			<li><a class="active" href="view_appointment.php">View Appointment</a></li>
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
