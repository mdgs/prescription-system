<?php 
	include("header.php"); 
	include("dbconnect.php");

	/* Get all data physician */
	$sql = "SELECT a.physician_fname, a.physician_lname, b.patient_fname, b.patient_lname, 
				   c.medication_name, c.medication_dosage, c.medication_route, 
				   d.prescription_id, d.physician_id, d.patient_id, d.medication_id, d.prescription_taken_daily
			FROM physician a, patient b, medication c, prescription d
			WHERE a.physician_id=d.physician_id 
				AND b.patient_id=d.patient_id 
				AND c.medication_id=d.medication_id";
			
	/* Execute query */
	$stmt = $conn->query($sql);
	$rows = $stmt->fetchAll();
	
	//Check if there any message passed
	if (isset($_REQUEST['msg'])) {
		$msg = $_REQUEST['msg'];
	}
?>

<h4>List of Prescription</h4>

<?php if (isset($msg)) { ?>
	<div class="alert alert-success"><?= $msg ?></div>
<?php } ?>

<?php if(count($rows) > 0) { ?>

	<table class="table table-striped">
		<tr>
			<th style="width: 50px">ID</th>
			<th style="width: 175px">PATIENT</th>
			<th style="width: 175px">PHYSICIAN</th>			
			<th style="width: 99px">DOSAGE</th>			
			<th style="width: 125px">ROUTE</th>			
			<th style="width: 95px">TAKEN DAILY</th>			
			<th style="width: 100px">Action</th>
		</tr>
		
		<?php foreach($rows as $idx => $row) { ?>
		
		<tr>
			<td><?= $row["prescription_id"]?></td>
			<td style="width: 175px"><?= $row["patient_fname"] . " " . $row["patient_lname"] ?></td>
			<td style="width: 175px"><?= $row["physician_fname"] . " " . $row["physician_lname"] ?></td>
			<td style="width: 99px"><?= $row["medication_dosage"]?></td>
			<td style="width: 125px"><?= $row["medication_route"]?></td>
			<td style="width: 95px"><?= $row["prescription_taken_daily"]?></td>
			<td>
				<a href="prescription.form.php?act=edit&id=<?= $row["prescription_id"]?>">Edit</a>
				<a href="prescription.form.php?act=del&id=<?= $row["prescription_id"]?>">Delete</a></td>
		</tr>
		
		<?php } ?>
		
	</table>

<?php } else { ?>

	<div class="alert alert-info">No Medication Found.</div>
	
<?php } ?>

<a class="btn btn-primary" href="prescription.form.php">Add New</a>

<?php include("footer.php"); ?>

