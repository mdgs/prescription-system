<?php
	include("dbconnect.php");
	include("helper.php");

	/* Check if user click save button */
	if (isset($_REQUEST['btnSave']) && empty($_REQUEST['patient_id'])) {
		
		//Do the saving process
		//Get all the information
		$pFName = $_REQUEST[''];
		
		//Create query statement
		$sql = "";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array();
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("patient.php", "Save data success");		
	} 
	
	else if (isset($_REQUEST['btnSave']) && !empty($_REQUEST['patient_id'])) {
	
		//Do the updating process
		//Get all the information
		$pId 	= $_REQUEST['patient_id'];

		
		//Create query statement
		$sql = "";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array( );
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("patient.php", "Update data success");	
	}
	
	//if nothing provided, redirect to empty form
	redirect("patient.form.php");		

?>