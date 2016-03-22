<?php
	include("dbconnect.php");
	include("helper.php");

	/* Check if user click save button */
	if (isset($_REQUEST['btnSave']) && empty($_REQUEST['medication_id'])) {
		
		//Do the saving process
		//Get all the information
		$mName 		= $_REQUEST['medication_name'];
		$mDosage 	= $_REQUEST['medication_dosage'];
		$mRoute 	= $_REQUEST['medication_route'];
		
		//Create query statement
		$sql = "INSERT INTO medication (medication_name, medication_dosage, medication_route)
				VALUES(?, ?, ?)";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array( $mName , $mDosage , $mRoute );
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("medication.php", "Save data success");		
	} 
	
	else if (isset($_REQUEST['btnSave']) && !empty($_REQUEST['medication_id'])) {
	
		//Do the updating process
		//Get all the information
		$mId 		= $_REQUEST['medication_id'];
		$mName 		= $_REQUEST['medication_name'];
		$mDosage 	= $_REQUEST['medication_dosage'];
		$mRoute 	= $_REQUEST['medication_route'];
		
		//Create query statement
		$sql = "UPDATE medication
				SET medication_name = ?, 
					medication_dosage = ?,
					medication_route = ?
				WHERE medication_id = ?
				";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array( $mName , $mDosage , $mRoute , $mId );
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("medication.php", "Update data success");	
	}
	
	//if nothing provided, redirect to empty form
	redirect("medication.form.php");		

?>