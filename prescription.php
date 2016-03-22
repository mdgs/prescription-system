<?php 
	include("header.php"); 
	include("dbconnect.php");

	/* Get all data physician */
	$sql = "";
			
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
		
			<th style="width: 100px">Action</th>
		</tr>
		
		<?php foreach($rows as $idx => $row) { ?>
		
		<tr>
			<td><?= $row["prescription_id"]?></td>

			<td>

		</tr>
		
		<?php } ?>
		
	</table>

<?php } else { ?>

	<div class="alert alert-info">No Medication Found.</div>
	
<?php } ?>

<a class="btn btn-primary" href="prescription.form.php">Add New</a>

<?php include("footer.php"); ?>

