<?php	
	
	$serverName = "(local)\sqlexpress";
	$dbName = "";
		
	try {
		$conn = new PDO( "sqlsrv:server=$serverName ; Database=$dbName", "", "");
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(Exception $e)
	{ 
		die( print_r( $e->getMessage() ) ); 
	}	
?>