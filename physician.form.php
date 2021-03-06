<?php 
	include("header.php"); 
	include("dbconnect.php");
	
	$physician = array();
	
 	//check action request, if not set, show empty form
	if (isset($_REQUEST['act']) && isset($_REQUEST['id'])) {
	
		//get parameter from request
		$act = $_REQUEST['act'];
		$id  = $_REQUEST['id'];
		
		//if action request = delete
		if ($act === "del") {
						
			//create statement
			$sql = "DELETE FROM physician
					WHERE physician_id = ?";
					
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
			redirect("physician.php", "Delete physician success");
		} 
		
		else if ($act === "edit") {
			
			//create statement to get specific id
			$sql = "SELECT physician_id, physician_fname, physician_lname
					FROM physician 
					WHERE physician_id = ?";
			
			//prepare statement
			$stmt = $conn->prepare($sql);
			
			$params = array ($id );
			
			//execute statement with parameter value
			try {
			
				$stmt->execute($params);
				$rows = $stmt->fetchAll();
				if (count($rows) > 0) {				
					$physician = $rows[0];
				}
				
			} catch(Exception $e) {
			
				die( show_exception($e));
				
			} 
			
			
		}
	}
?>

<h4>Form Physician</h4>

<form action="physician.form.save.php" method="post">
	<table class="table" style="width: 100%">
		<tr>
			<td style="width: 139px">ID</td>
			<td style="width: 11px">:</td>
			<td>
			<input name="physician_id" style="width: 50px" type="text" readonly="readonly" value="<?= get_value($physician, 'physician_id') ?>"></td>
		</tr>
		<tr>
			<td style="width: 139px">FIRST NAME</td>
			<td style="width: 11px">:</td>
			<td><input name="physician_fname" style="width: 300px" type="text" value="<?= get_value($physician, 'physician_fname') ?>"></td>
		</tr>
		<tr>
			<td style="width: 139px">LAST NAME</td>
			<td style="width: 11px">:</td>
			<td>
			<input name="physician_lname" style="width: 300px" type="text" value="<?= get_value($physician, 'physician_lname') ?>"></td>
		</tr>
		<tr>
			<td style="width: 139px">&nbsp;</td>
			<td style="width: 11px">&nbsp;</td>
			<td><input name="btnSave" type="submit" value="Save" class="btn btn-primary">
			<a class="btn btn-default" href="physician.php">Cancel</a></td>
		</tr>
	</table>
</form>

<?php include("footer.php"); ?>

