<?php
	include("dbconnect.php");
	include("helper.php");

	/* Check if user click save button */
	if (isset($_REQUEST['btnSave']) && empty($_REQUEST['physician_id'])) {
		
		//Do the saving process
		//Get all the information
		$pFName = $_REQUEST['physician_fname'];
		$pLName = $_REQUEST['physician_lname'];
		
		//Create query statement
		$sql = "INSERT INTO physician (physician_fname, physician_lname)
				VALUES(?, ?)";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array( $pFName , $pLName );
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("physician.php", "Save data success");		
	} 
	
	else if (isset($_REQUEST['btnSave']) && !empty($_REQUEST['physician_id'])) {
	
		//Do the updating process
		//Get all the information
		$pId 	= $_REQUEST['physician_id'];
		$pFName = $_REQUEST['physician_fname'];
		$pLName = $_REQUEST['physician_lname'];
		
		//Create query statement
		$sql = "UPDATE physician 
				SET physician_fname = ?, 
					physician_lname = ?
				WHERE physician_id = ?
				";
				
		//prepare statement
		$stmt = $conn->prepare($sql);
		
		//prepare parameter
		$params = array( $pFName , $pLName, $pId );
		
		//execute statement with parameter value
		try {
		
			$stmt->execute($params);
			
		} catch(Exception $e) {
		
			die( show_exception($e));
			
		} 
		
		//if saving process went OK, redirect to physician list
		redirect("physician.php", "Update data success");	
	}
	
	//if nothing provided, redirect to empty form
	redirect("physician.form.php");		

?>