<?php 
	include("header.php"); 
	include("dbconnect.php");

	/* Get all data physician */
	$sql = "SELECT physician_id, physician_fname, physician_lname
			FROM physician";
			
	/* Execute query */
	$stmt = $conn->query($sql);
	$rows = $stmt->fetchAll();
	
	//Check if there any message passed
	if (isset($_REQUEST['msg'])) {
		$msg = $_REQUEST['msg'];
	}
?>

<h4>List of Physician</h4>

<?php if (isset($msg)) { ?>
	<div class="alert alert-success"><?= $msg ?></div>
<?php } ?>

<?php if(count($rows) > 0) { ?>

	<table class="table table-striped">
		<tr>
			<th style="width: 50px">ID</th>
			<th style="width: 340px">FIRST NAME</th>
			<th style="width: 340px">LAST NAME</th>
			<th style="width: 100px">Action</th>
		</tr>
		
		<?php foreach($rows as $idx => $row) { ?>
		
		<tr>
			<td><?= $row["physician_id"]?></td>
			<td><?= $row["physician_fname"]?></td>
			<td><?= $row["physician_lname"]?></td>
			<td>
				<a href="physician.form.php?act=edit&id=<?= $row["physician_id"]?>">Edit</a>
				<a href="physician.form.php?act=del&id=<?= $row["physician_id"]?>">Delete</a></td>
		</tr>
		
		<?php } ?>
		
	</table>

<?php } else { ?>

	<div class="alert alert-info">No Physician Found.</div>
	
<?php } ?>

<a class="btn btn-primary" href="physician.form.php">Add New</a>

<?php include("footer.php"); ?>

