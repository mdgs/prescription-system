<?php 
	include("header.php"); 
	include("dbconnect.php");
	
	$prescription = array();
	
 	//check action request, if not set, show empty form
	if (isset($_REQUEST['act']) && isset($_REQUEST['id'])) {
	
		//get parameter from request
		$act = $_REQUEST['act'];
		$id  = $_REQUEST['id'];
		
		//if action request = delete
		if ($act === "del") {
						
			//create statement
			$sql = "DELETE FROM prescription 
					WHERE prescription_id = ?";
					
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
			redirect("prescription.php", "Delete prescription success");
		} 
		
		else if ($act === "edit") {
			
			//create statement to get specific id
			$sql = "SELECT a.physician_fname, a.physician_lname, b.patient_fname, b.patient_lname, 
						   c.medication_name, c.medication_dosage, c.medication_route, 
						   d.prescription_id, d.physician_id, d.patient_id, d.medication_id, d.prescription_taken_daily
					FROM physician a, patient b, medication c, prescription d
					WHERE a.physician_id=d.physician_id 
						AND b.patient_id=d.patient_id 
						AND c.medication_id=d.medication_id
						AND prescription_id = ?";
			
			//prepare statement
			$stmt = $conn->prepare($sql);
			
			$params = array ($id );
			
			//execute statement with parameter value
			try {
			
				$stmt->execute($params);
				$rows = $stmt->fetchAll();
				if (count($rows) > 0) {				
					$prescription = $rows[0];
				}
				
			} catch(Exception $e) {
			
				die( show_exception($e));
				
			} 
		}
	}
	
	/* Prepare lookup value */
	/* Patient */ 
	$sql = "SELECT patient_id, patient_fname, patient_lname
			FROM patient";
			
	//Execute query
	$stmt = $conn->query($sql);
	$paLookup = $stmt->fetchAll();
	
	/* Physician */
	$sql = "SELECT physician_id, physician_fname, physician_lname
			FROM physician";
			
	//Execute query	
	$stmt = $conn->query($sql);
	$phLookup = $stmt->fetchAll();
	
	/* Medication */
	$sql = "SELECT medication_id, medication_name, medication_dosage, medication_route
			FROM medication";
			
	/* Execute query */
	$stmt = $conn->query($sql);
	$medLookup = $stmt->fetchAll();

?>

<h4>Form Medication</h4>

<form action="prescription.form.save.php" method="post">
	<table class="table" style="width: 100%">
		<tr>
			<td style="width: 178px">ID</td>
			<td style="width: 11px">:</td>
			<td>
			<input name="prescription_id" style="width: 50px" type="text" readonly="readonly" value="<?= get_value($prescription, 'prescription_id') ?>"></td>
		</tr>
		<tr>
			<td style="width: 178px">PATIENT</td>
			<td style="width: 11px">:</td>
			<td>
				<!--<input name="patient_id" style="width: 236px" type="text" value="<?= get_value($prescription, 'patient_id') ?>">-->
				<select name="patient_id">
					<option value="">-- Select Patient --</option>
					<?php foreach($paLookup as $idx => $row) { 
						$curr = get_value($prescription, 'patient_id');
						$selected = !empty($curr) && $curr == $row['patient_id'] ? "selected" : ""; 
					?>
						<option <?= $selected ?> value="<?= $row['patient_id'] ?>"><?= $row["patient_fname"] . " " . $row["patient_lname"] ?></option>
					<?php } ?>
				</select>
			
			</td>
		</tr>
		<tr>
			<td style="width: 178px; height: 26px;">PHYSICIAN</td>
			<td style="width: 11px; height: 26px;">:</td>
			<td style="height: 26px">
				<!--<input name="physician_id" style="width: 236px" type="text" value="<?= get_value($prescription, 'physician_id') ?>">-->
				<select name="physician_id">
					<option value="">-- Select Physician --</option>
					<?php foreach($phLookup as $idx => $row) { 
						$curr = get_value($prescription, 'physician_id');
						$selected = !empty($curr) && $curr == $row['physician_id'] ? "selected" : ""; 
					?>
						<option <?= $selected ?> value="<?= $row['physician_id'] ?>"><?= $row["physician_fname"] . " " . $row["physician_lname"] ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td style="width: 178px">MEDICATION</td>
			<td style="width: 11px">&nbsp;</td>
			<td>
				<!--<input name="medication_id" style="width: 235px" type="text" value="<?= get_value($prescription, 'medication_id') ?>">-->
				<select name="medication_id">
					<option value="">-- Select Medication --</option>
					<?php foreach($medLookup as $idx => $row) { 
						$curr = get_value($prescription, 'medication_id');
						$selected = !empty($curr) && $curr == $row['medication_id'] ? "selected" : ""; 
					?>
						<option <?= $selected ?> value="<?= $row['medication_id'] ?>"><?= $row["medication_name"] . " (" . $row["medication_dosage"] . " " . $row["medication_route"] . ")" ?></option>
					<?php } ?>
				</select>
			
			</td>
		</tr>
		<tr>
			<td style="width: 178px">NUM TAKEN DAILY</td>
			<td style="width: 11px">:</td>
			<td>
			<input name="prescription_taken_daily" type="text" value="<?= get_value($prescription, 'prescription_taken_daily') ?>" style="width: 80px"></td>
		</tr>
		<tr>
			<td style="width: 178px">&nbsp;</td>
			<td style="width: 11px">&nbsp;</td>
			<td><input name="btnSave" type="submit" value="Save" class="btn btn-primary">
			<a class="btn btn-default" href="prescription.php">Cancel</a></td>
		</tr>
	</table>
</form>

<?php include("footer.php"); ?>

