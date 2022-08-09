<?php
	session_start();
	include 'config.php';

	$output = '';

	$query  = "SELECT * FROM doctor";
	$statement = $db->prepare($query);
	if ($statement->execute()) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
        	$output .= '<div class="medical_records">
        	<hr>
			<div class="title">
				<h4>Doctor ID: </h4>
				<p>'.$row["doctor_id"].'</p>
			</div>
			<div class="title">
				<h4>First Name: </h4>
				<p>'.$row["firstname"].'</p>
			</div>
			<div class="title">
				<h4>Middle Name: </h4>
				<p>'.$row["middlename"].'</p>
			</div>
			<div class="title">
				<h4>Last Name: </h4>
				<p>'.$row["lastname"].'</p>
			</div>
			<div class="title">
				<h4>Gender: </h4>
				<p>'.$row["gender"].'</p>
			</div>
			<div class="title">
				<h4>Date of Birth: </h4>
				<p>'.$row["dob"].'</p>
			</div>
			<div class="title">
				<h4>Address: </h4>
				<p>'.$row["address"].'</p>
			</div>
			<div class="title">
				<h4>Department: </h4>
				<p>'.$row["department"].'</p>
			</div>

			<div class="title">
				<h4>Date of Joining: </h4>
				<p>'.$row["date_of_joining"].'</p>
			</div>

			<div class="title">
				<h4>Email: </h4>
				<p>'.$row["email"].'</p>
			</div>
			<div class="title">
				<h4>Phone: </h4>
				<p>'.$row["phone"].'</p>
			</div>


			<form action="view_doctors.php" method="post">
				<input type="hidden" name="doctor_id" value="'.$row["doctor_id"].'"/>
				<input type="hidden" name="firstname" value="'.$row["firstname"].'"/>
				<input type="hidden" name="middlename" value="'.$row["middlename"].'"/>
				<input type="hidden" name="lastname" value="'.$row["lastname"].'"/>
				<input type="hidden" name="gender" value="'.$row["gender"].'"/>
				<input type="hidden" name="dob" value="'.$row["dob"].'"/>
				<input type="hidden" name="address" value="'.$row["address"].'"/>
				<input type="hidden" name="department" value="'.$row["department"].'"/>
				<input type="hidden" name="date_of_joining" value="'.$row["date_of_joining"].'"/>
				<input type="hidden" name="email" value="'.$row["email"].'"/>
				<input type="hidden" name="phone" value="'.$row["phone"].'"/>
				<input type="submit" name="update" class="btn_update" value="Edit"/>
			</form>
			<form action="view_doctors.php" method="post">
				<input type="hidden" name="doctor_id" value="'.$row["doctor_id"].'"/>
				<input type="submit" name="delete" class="btn_delete" value="Delete"/>
			</form>
			
		</div>';

        }
    }
    if (isset($_POST['update'])) {
    	$_SESSION['doctor_id'] = $_POST['doctor_id'];
    	$_SESSION['firstname'] = $_POST['firstname'];
    	$_SESSION['middlename'] = $_POST['middlename'];
    	$_SESSION['lastname'] = $_POST['lastname'];
    	$_SESSION['gender'] = $_POST['gender'];
    	$_SESSION['dob'] = $_POST['dob'];
    	$_SESSION['address'] = $_POST['address'];
    	$_SESSION['department'] = $_POST['department'];
    	$_SESSION['date_of_joining'] = $_POST['date_of_joining'];
    	$_SESSION['email'] = $_POST['email'];
    	$_SESSION['phone'] = $_POST['phone'];
    	$_SESSION['doctor_id'] = $_POST['doctor_id'];
    	
		header("Location: update_doctor.php");
    }
    if (isset($_POST['delete'])) {
    	$doctor_id = $_POST['doctor_id'];
    	$query  = "
        DELETE FROM doctor WHERE doctor_id = ".$doctor_id."
        ";

        $delete_stmt = $con->prepare($query);

        if ($delete_stmt->execute()) {
            echo "<script>alert('Doctor deleted successfully')</script>";
            echo "<meta http-equiv='refresh' content='0'>";
            
            
        }
    	
    }

	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronic Medical Record| View Doctors</title>
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
		<h1>Electronic Medical Record | View Doctors</h1>
		<ul>
			<li><a href="admin.php">Home</a></li>
			<li><a href="add_doctor.php">Add Doctor</a></li>
			<li><a class="active" href="view_doctors.php">View Doctors</a></li>
			<li><a href="add_patient.php">Add Patient</a></li>
			
		</ul>
	</div>
	<div id="contact_container">
		<center><h1>All Doctors</h1></center>
		<div class="div_doctor">
			<?php echo $output ?>
		</div>
		
		
		
		
	</div>

</body>
</html>
