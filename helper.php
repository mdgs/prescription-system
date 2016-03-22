<?php

	/* Helper function */
	function show_error( $errors ) {
	    /* Display errors. */
	    echo "Error information: <br/>";
	
	    foreach ( $errors as $error )
	    {
	        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
	        echo "Code: ".$error['code']."<br/>";
	        echo "Message: ".$error['message']."<br/>";
	    }
	}	

	function show_exception( $ex ) {
	    /* Display errors. */
	    echo "Error information: <br/>";
	
        
        echo "Code: ".$ex->getCode()."<br/>";
        echo "Message: ".$ex->getMessage()."<br/>";
        echo "File: ".$ex->getFile()."<br/>";
		echo "Line: ".$ex->getLine()."<br/>";
	}	

	function redirect($url, $msg = null, $statusCode = 303) {	
	   
	   if (isset($msg) && trim($msg) !== "") {
	   		$url = $url . "?msg=" . $msg;
	   } 
	   
	   header('Location: ' . $url, true, $statusCode);
	   die();
	}
	
	function get_value($row, $field) {
		if (isset($row) && isset($field) && isset($row[$field])) return $row[$field];
		return "";
	}
?>
