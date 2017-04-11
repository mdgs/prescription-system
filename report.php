
<?php 
	include("header.php"); 
	include("dbconnect.php");

	/* Get all data physician */
	$sql = "SELECT a.physician_id, a.physician_fname, a.physician_lname, COUNT(d.prescription_id) AS total 
			FROM physician a, prescription d
			WHERE a.physician_id=d.physician_id
			GROUP BY a.physician_id, a.physician_fname, a.physician_lname";
			
	/* Execute query */
	$stmt = $conn->query($sql);
	$rows = $stmt->fetchAll();
	
	//Check if there any message passed
	if (isset($_REQUEST['msg'])) {
		$msg = $_REQUEST['msg'];
	}
?>

<h4>Sample Report</h4>

<?php if(count($rows) > 0) { ?>

	<table class="table table-striped">
		<tr>
			<th style="width: 50px">ID</th>
			<th style="width: 175px">PHYSICIAN NAME</th>
			<th style="width: 175px">TOTAL PRESCRIPTION</th>			
		</tr>
		
		<?php foreach($rows as $idx => $row) { ?>
		
		<tr>
			<td><?= $row["physician_id"]?></td>
			<td style="width: 175px"><?= $row["physician_fname"] . " " . $row["physician_lname"] ?></td>
			<td style="width: 99px"><?= $row["total"]?></td>
		</tr>
		
		<?php } ?>
		
	</table>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<h4>Sample Chart</h4>
<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
	Highcharts.chart('container', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Total Prescription per Physician'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
	            rotation: -45,
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Total Prescription'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    tooltip: {
	        pointFormat: 'Total Prescription: <b>{point.y}</b>'
	    },
	    series: [{
	        name: 'Total Prescription',
	        data: [
	        	<?php 
	        		$data = [];
	        		$format = "['%s', %d]";
	        		foreach($rows as $idx => $row) {
	        			$data[] = sprintf($format, $row["physician_fname"] . " " . $row["physician_lname"], $row["total"]);
	        		}
	        		echo implode(",", $data);
	        	?>
	        ],
	        dataLabels: {
	            enabled: true,
	            rotation: -90,
	            color: '#FFFFFF',
	            align: 'right',
	            format: '{point.y}', // one decimal
	            y: 10, // 10 pixels down from the top
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    }]
	});
</script>
<?php } else { ?>

	<div class="alert alert-info">No Medication Found.</div>
	
<?php } ?>


<?php include("footer.php"); ?>

