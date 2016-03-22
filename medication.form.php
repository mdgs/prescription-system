<?php 
	include("header.php"); 
	include("dbconnect.php");
	
	$med = array();
	
 	//check action request, if not set, show empty form
	if (isset($_REQUEST['act']) && isset($_REQUEST['id'])) {
	
		//get parameter from request
		$act = $_REQUEST['act'];
		$id  = $_REQUEST['id'];
		
		//if action request = delete
		if ($act === "del") {
						
			//create statement
			$sql = "";
					
			//prepare statement
			$stmt = $conn->prepare($sql);
			
			$params = array ($id );
			
			//execute statement with parameter value
			try {
			
				$stmt->execute($params);
				
			} catch(Exception $e) {
			
				die( show_exception($e) );
				
			} 
			
			//if delete success, redirect to physician page
			redirect("medication.php", "Delete medication success");
		} 
		
		else if ($act === "edit") {
			
			//create statement to get specific id
			$sql = "";
			
			//prepare statement
			$stmt = $conn->prepare($sql);
			
			$params = array ($id );
			
			//execute statement with parameter value
			try {
			
				$stmt->execute($params);
				$rows = $stmt->fetchAll();
				if (count($rows) > 0) {				
					$med = $rows[0];
				}
				
			} catch(Exception $e) {
			
				die( show_exception($e));
				
			} 
			
			
		}
	}
?>

<h4>Form Medication</h4>

<form action="medication.form.save.php" method="post">
	<table class="table" style="width: 100%">
		<tr>
			<td style="width: 139px">ID</td>
			<td style="width: 11px">:</td>
			<td>
			<input name="medication_id" style="width: 50px" type="text" readonly="readonly" value=""></td>
		</tr>
		<tr>
			<td style="width: 139px">MED NAME</td>
			<td style="width: 11px">:</td>
			<td><input name="medication_name" style="width: 300px" type="text" value=""></td>
		</tr>
		<tr>
			<td style="width: 139px">DOSAGE</td>
			<td style="width: 11px">:</td>
			<td>
			<input name="medication_dosage" style="width: 67px" type="text" value=""></td>
		</tr>

		<tr>
			<td style="width: 139px">&nbsp;</td>
			<td style="width: 11px">&nbsp;</td>
			<td><input name="btnSave" type="submit" value="Save" class="btn btn-primary">
			<a class="btn btn-default" href="medication.php">Cancel</a></td>
		</tr>
	</table>
</form>

<?php include("footer.php"); ?>

