<?php
	include("dbconnect.php");
	include("helper.php");

	/* Check if user click save button */
	if (isset($_REQUEST['btnSave']) && empty($_REQUEST['medication_id'])) {
		
		//Do the saving process
		//Get all the information
		$mName 		= $_REQUEST['medication_name'];

		
		//Create query statement
		$sql = "";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array(  );
		
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
		redirect("medication.php", "Update data success");	
	}
	
	//if nothing provided, redirect to empty form
	redirect("medication.form.php");		

?>