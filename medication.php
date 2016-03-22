<?php 
	include("header.php"); 
	include("dbconnect.php");

	/* Get all data physician */
	$sql = "SELECT medication_id, medication_name, medication_dosage, medication_route
			FROM medication";
			
	/* Execute query */
	$stmt = $conn->query($sql);
	$rows = $stmt->fetchAll();
	
	//Check if there any message passed
	if (isset($_REQUEST['msg'])) {
		$msg = $_REQUEST['msg'];
	}
?>

<h4>List of Medication</h4>

<?php if (isset($msg)) { ?>
	<div class="alert alert-success"><?= $msg ?></div>
<?php } ?>

<?php if(count($rows) > 0) { ?>

	<table class="table table-striped">
		<tr>
			<th style="width: 50px">ID</th>
			<th style="width: 270px">MED NAME</th>
			<th style="width: 129px">DOSAGE</th>			
			<th style="width: 203px">ROUTE</th>			
			<th style="width: 100px">Action</th>
		</tr>
		
		<?php foreach($rows as $idx => $row) { ?>
		
		<tr>
			<td><?= $row["medication_id"]?></td>
			<td style="width: 270px"><?= $row["medication_name"]?></td>
			<td style="width: 129px"><?= $row["medication_dosage"]?></td>
			<td style="width: 203px"><?= $row["medication_route"]?></td>
			<td>
				<a href="medication.form.php?act=edit&id=<?= $row["medication_id"]?>">Edit</a>
				<a href="medication.form.php?act=del&id=<?= $row["medication_id"]?>">Delete</a></td>
		</tr>
		
		<?php } ?>
		
	</table>

<?php } else { ?>

	<div class="alert alert-info">No Medication Found.</div>
	
<?php } ?>

<a class="btn btn-primary" href="medication.form.php">Add New</a>

<?php include("footer.php"); ?>

