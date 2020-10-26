<?php  

$newpatient = new Patient();
$patname = "";
$patillness = "";
$patinttime = "";

if (isset($_POST["add_button"])){

	$patname = strip_tags($_POST['patient_name']);
	$patillness = strip_tags($_POST['patient_illness']);
	$patintime = strip_tags($_POST['patient_intime']);
	$patintime = $patintime.":00";
	
	$query = mysqli_query($con,"INSERT INTO CURRENT_PATIENT VALUES('','$patname','$patillness','$patintime')");
}

if (isset($_POST['finish_button'])){

	$data_query = mysqli_query($con,"SELECT * FROM CURRENT_PATIENT");

	if (mysqli_num_rows($data_query) > 0) {
		while ($row=mysqli_fetch_array($data_query)) {
			$id = $row['PAT_ID'];
			$name = $row['PAT_NAME'];
			$illness=$row['PAT_ILLNESS'];
			$intime=$row['PAT_INTIME'];

			$str .= "<div class='show_each_patient'>
						<div class='patient_idname'>
							<h4>$id : $name</h4>
						</div>

						<div class='patient_details'>
							<h5>Patient Illness: $illness</h5>
							<h5>Patient Intime: $intime</h5>
						</div>
					</div>
					<hr>";
		}
	}


}

?>