<!DOCTYPE html>


<?php  
require 'config.php';
require 'patient_class.php';
$patient_array=array();
$str="";
$str1="";
$str2="";
$error_message="";
$str_wait_time="";
$str_fcfs_wait_time="";
require 'index_handler.php';
?>


<html>
<head>
	<title>Welcome User!!</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" type="text/css" href="index_css.css">
</head>
<body>

	<div class="wrapper">
		<h1>Hospital Scheduling Management System</h1>
		<span></span>
		<div class="add_patient">
			<div class="add_patient_header">
				<h3>Add new patient details here!</h3>
			</div>
			<form action="index.php" method="POST">
				<label for="patient_name">Patient Name:</label>
				<input type="text" name="patient_name" placeholder="eg. Sai Chaitanya"required>
				<br>
				<label for="patient_illness">Patient Illness:</label>
				<input type="text" name="patient_illness" placeholder="eg. Cough and Cold"required>
				<br>
				<label for="patient_intime">Patient Intime:</label>
				<input type="time" name="patient_intime" placeholder="Patient Intime"required>
				<br>
				<label for="condition_type">Condition Type:</label>
				<input type="text" name="condition_type" placeholder="Normal/Referral/Urgent/Emergency"required>
				<p><?php echo $error_message; ?></p>
				<input type="submit" name="add_button" value="Add Patient">
				<br>
			</form>
			<form action="index.php" method="POST">
				<input type="submit" name="finish_button" value="Finish Adding">
				<br>
			</form>
			
		</div>
		<br>
		<br>

		<div class="scheduling">
			<div class='show_sheduled_patient first'>
				<br>
				<br>
				<h3>Using genral FCFS:</h3>
				<hr>
				<?php  
					echo $str2;
				?>
				<h3>Statistics:</h3>
				<?php  
					echo $str_fcfs_wait_time;
				?>
			</div>

			<div class='show_sheduled_patient second'>
				<br>
				<br>
				<h3>The Scheduling is as follows:</h3>
				<hr>
				<?php  
					echo $str1;
				?>
				<h3>Statistics:</h3>
				<?php  
					echo $str_wait_time;
				?>
			</div>
		</div>
		<br>
		<br>
		
	</div>

	<div class='show_patient'>
		<h3>Current Patient Queue</h3>
		<hr>
		<?php  
			echo $str;
		?>
	</div>

	<br>
	<br>


</body>
</html>
