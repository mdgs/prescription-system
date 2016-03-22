<?php
	include("dbconnect.php");
	include("helper.php");

	/* Check if user click save button */
	if (isset($_REQUEST['btnSave']) && empty($_REQUEST['prescription_id'])) {
		
		//Do the saving process
		//Get all the information
		$paId 	= $_REQUEST['patient_id'];
		$phId 	= $_REQUEST['physician_id'];
		$medId 	= $_REQUEST['medication_id'];
		$taken 	= $_REQUEST['prescription_taken_daily'];
		
		//Create query statement
		$sql = "INSERT INTO prescription (patient_id, physician_id, medication_id, prescription_taken_daily)
				VALUES(?, ?, ?, ?)";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array( $paId , $phId , $medId , $taken );
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("prescription.php", "Save data success");		
	} 
	
	else if (isset($_REQUEST['btnSave']) && !empty($_REQUEST['prescription_id'])) {
	
		//Do the updating process
		//Get all the information
		$prescriptionId = $_REQUEST['prescription_id'];
		$paId 			= $_REQUEST['patient_id'];
		$phId 			= $_REQUEST['physician_id'];
		$medId 			= $_REQUEST['medication_id'];
		$taken 			= $_REQUEST['prescription_taken_daily'];
		
		//Create query statement
		$sql = "UPDATE prescription
				SET patient_id = ?, 
					physician_id = ?,
					medication_id = ?,
					prescription_taken_daily = ?
				WHERE prescription_id = ?
				";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array( $paId , $phId , $medId , taken , $prescriptionId);
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("prescription.php", "Update data success");	
	}
	
	//if nothing provided, redirect to empty form
	redirect("prescription.form.php");		

?>