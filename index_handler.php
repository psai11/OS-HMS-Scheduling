<?php  

$newpatient = new Patient();
$patname = "";
$patillness = "";
$patinttime = "";
$conditiontype = "";

//burst time of diseases
$genral_burst_time = array (
	array("cough",5),
	array("cough and cold",10),
	array("stomach problem",15),
	array("headache",18),	
	array("skin problem",20),
	array("urinary problem",21),
	array("migrane",22),
	array("heart problem",28)
);

$genral_condition_multiplier = array (
	array("normal", 0.9),
	array("referral", 0.7),
	array("urgent", 0),
	array("emergency", -0.9)
);

if (isset($_POST["add_button"])){

	$patname = strip_tags($_POST['patient_name']);
	$patillness = strip_tags($_POST['patient_illness']);
	$patintime = strip_tags($_POST['patient_intime']);
	$conditiontype = strip_tags($_POST['condition_type']);
	$patintime = $patintime.":00";
	$error_message = "";

	$conditiontype = strtolower($conditiontype);

	if ($conditiontype == "normal" || $conditiontype == "referral" || $conditiontype == "urgent" || $conditiontype == "emergency") {

		$query = mysqli_query($con,"INSERT INTO CURRENT_PATIENT VALUES('','$patname','$patillness','$patintime','$conditiontype')");
		$error_message = "Person Added";
	}
	
	else {
		$error_message = "Enter valid condition type";

	}
}

if (isset($_POST['finish_button'])){

	$data_query = mysqli_query($con,"SELECT * FROM CURRENT_PATIENT");
	$average_burst_time=0;
	$multiplier=array();
	$patient_burst_time=array();
	$effective_time=array();
	$all_id=array();

	if (mysqli_num_rows($data_query) > 0) {
		while ($row=mysqli_fetch_array($data_query)) {
			$id = $row['PAT_ID'];
			$name = $row['PAT_NAME'];
			$illness = $row['PAT_ILLNESS'];
			$illness = strtolower($illness);
			$intime = $row['PAT_INTIME'];
			$conditiontype = $row['CONDITION_TYPE'];
			$conditiontype = strtolower($conditiontype);

			foreach ($genral_burst_time as $key => $value) {
				if ($value[0] == $illness) {
					$average_burst_time+= $value[1];
					$patient_burst_time[$id]= $value[1];
				}
			}

			foreach ($genral_condition_multiplier as $key => $value) {
				if ($value[0] == $conditiontype) {
					$multiplier[$id]= $value[1];
				}

			}

			$all_id[$id]=$id;

			$str .= "<div class='show_each_patient'>
						<div class='patient_idname'>
							<h4>P$id: $name</h4>
						</div>

						<div class='patient_details'>
							<h5>Patient Illness: $illness</h5>
							<h5>Patient Intime: $intime</h5>
							<h5>Condition Type: $conditiontype</h5>
						</div>
					</div>
					<hr>";

			
		}
	}
	/**
	print_r($patient_burst_time);
	echo "<br>";
	print_r($multiplier);
	echo "<br>";
	print_r($all_id);**/

	$average_burst_time /= mysqli_num_rows($data_query);

	foreach ($patient_burst_time as $key => $value) {
		$efftime = $value + $multiplier[$key] * $average_burst_time;
		$effective_time[$all_id[$key]]=$efftime;
	}
	/**
	asort($effective_time);
	print_r($effective_time);
	echo "<br>";
	**/
	/**
	echo $average_burst_time;
	echo "<br>";
	$endTime = strtotime("+" . $effective_time[2] . " minutes", strtotime($intime));
	echo date('h:i:s', $endTime);
	**/

	$id_in_order=array();
	$data_query = mysqli_query($con, "SELECT * FROM CURRENT_PATIENT ORDER BY PAT_INTIME");
	while($row=mysqli_fetch_array($data_query)) {
		array_push($id_in_order, $row['PAT_ID']);
	}

	$final_array = array();
	$wait_queue = array();

	/**print_r($id_in_order);
	echo "<br>";**/

	print_r($id_in_order);
	echo "<br>";
	print_r($effective_time);
	echo "<br>";

	while (!empty($id_in_order)) {

		if (empty($wait_queue)) {
			array_push($final_array, array_pop($id_in_order));
		}
		else {
			foreach ($effective_time as $key => $value) {
				$flag=0;
				foreach ($wait_queue as $value1) {
					if ($key == $value1) {
						array_push($final_array, $value1);
						array_splice($wait_queue, array_search($value1, $wait_queue), 1);
						$flag=1;
						break;
					}
				if($flag)
					break;
				}
			}
		}
	}

	/**print_r($final_array);
	echo "<br>";
	echo "<br>";**/
	

	$current_time = strtotime("00:00:00");
	/**print_r($patient_burst_time);
	echo "<br>";	**/

	while($id=array_pop($final_array)) {
		/**echo $id;
		echo "<br>";
		echo $id;
		echo "   ";**/
		$data_query = mysqli_query($con, "SELECT * FROM CURRENT_PATIENT WHERE PAT_ID='$id'");
		$row = mysqli_fetch_array($data_query);

		$id = $row['PAT_ID'];
		$name = $row['PAT_NAME'];
		$illness = $row['PAT_ILLNESS'];
		$illness = strtolower($illness);
		$intime = strtotime($row['PAT_INTIME']);

		if($current_time < $intime)
			$current_time = $intime;

		$count=1;

		$finish_time = strtotime("+" . $patient_burst_time[$id] . " minutes", $current_time);
		/**echo $patient_burst_time[$id];
		echo "<br>";**/


		$str1 .= "<div class='show_each_patient'>
						<div class='patient_idname'>
							<h4>Patient $count checked at time <b>" . date('h:i:s' , $current_time) . " </b> till <b>" . date('h:i:s' , $finish_time) . "</b>:<h4>
							
						</div>

						<div class='patient_details'>
							<h5>Patient Id: P$id</h5>
							<h5>Patient Name: $name</h5>
							<h5>Patient Illness: $illness</h5>
							<h5>Patient Treating Time: $patient_burst_time[$id]</h5>
						</div>
					</div>
					<hr>";
		$count++;
		$current_time = $finish_time;


	}



}

?>