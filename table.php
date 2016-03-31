<?php
	
	//table
	//getting out confing
	
	require_once("../../config.php");
	
	//create connection to database
	
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_dmikab");
	
	//SQL sentence
	
	$stmt = $mysql->prepare("SELECT id, recipient, message, created FROM messages_sample");
	
	//if error in sentense
	
	echo $mysql->error;
	
	$stmt->bind_result($id, $recipient, $message, $created);
	
	$stmt->execute();

	$table_html = "";

$table_html .="<table>";
$table_html .="<tr>";
$table_html .="<th>Recipient</th>";
$table_html .="<th>Message</th>";
$table_html .="<th>Created</th>";
$table_html .="</tr>";


	
	//Get result
	//we have multiple rows
	while($stmt->fetch()){


		$table_html .="<tr>";
		$table_html .= "<td>".$id."</td>"; //add column
		$table_html .= "<td>".$recipient."</td>";
		$table_html .= "<td>".$message."</td>";
		$table_html .= "<td>".$created."</td>";
		$table_html .="</tr>"; //end row
		
		//DO something for EACH ROW
		
		//echo $id."  ".$message."<br>";
		
		}
		$table_html .="</table>";
		echo $table_html;
	
	
	?>
	<a href ="app.php">table</a>