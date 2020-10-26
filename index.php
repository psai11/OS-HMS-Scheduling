<!DOCTYPE html>


<?php  
require 'config.php';
require 'patient_class.php';
$patient_array=array();
$str="";
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
				Add new patient details here!
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
		<div class='show_patient'>
			<?php  
				echo $str;
			?>
		</div>
		<br>
		<br>
		
	</div>


</body>
</html>