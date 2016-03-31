<?php
//require another php file //
//../../.. 3 folders back
require_once("../../config.php");


$everything_was_okay = true;


//**************
//to field validation
//******************
if(isset($_GET["to"])){
	if(empty($_GET["to"])){
		$everything_was_okay = false;//it is empty
		
		echo "Please enter the recipient!";
		
		}else{
			//its not empty
		echo "to: ".$_GET["to"]."<br>";
		$everything_was_okay = true;
	}
}


if(isset($_GET["from"])){
	
	
	
	if(empty($_GET["from"])){
		//it is empty
		$everything_was_okay = false;
		echo "Please enter the recipient!";
		
		}else{
			//its not empty
		echo "from: ".$_GET["from"]."<br>";
		$everything_was_okay = true;
	}
	
}

//check if there is variable in the URL
if(isset($_GET["message"])){
	
	//only if there is message in the URL
	//echo "there is a message";
	
	if(empty($_GET["message"])){
		//it is empty
		$everything_was_okay = false;
		echo "Please enter the message!";
		
		}else{
			//its not empty
		echo "Message: ".$_GET["message"]."<br>";
		$everything_was_okay = true;
	}
	
	
}


	



//Getting the message from address

//$my_message = $_GET["message"];
//$to = $_GET["to"];
//$from = $_GET["from"];

//echo "My message is ".$my_message." and is to ".$to." and is from ".$from;

/*********************************
*************Save to DB**********
************************************/


// ? was everything okay
if($everything_was_okay == true) {
	
	echo "Saving to database ...";
	
	
	//connection with username and password
	//access username from config
	//echo $db_username;
	
	// 1 servername
	// 2 username
	// 3 password
	// 4 database
	
	
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_dmikab");
	
	$stmt = $mysql->prepare("INSERT INTO messages_sample (recipient, message) VALUES (?, ?)" );
	
	echo $stmt->error;
	
	//we are replacing question marks with values
	//s - string, data or smth that is based on characters and
	//i - intiger, number
	// d - decimal, float
	$stmt->bind_param("ss",$_GET["to"], $_GET["message"] );
	
	//save
	
	if($stmt->execute()){
		
	echo	"saved succesefully";
	}else{
		
		echo $stmt->error;
		
		
		}	
	
	
	}

?>
<br>
<a href ="table.php">table</a>


<h2> First application </h2>

<form method="get">
<label for="message">Message:*<label><br>
<input type="text" name="message"><br><br>

<label for="from">from<label><br>
<input type="text" name="from"><br><br>


<label for="to">To<label><br>
<input type="text" name="to"><br><br>
<!--This is the save button -->
<input type="submit" value="Save to DB"



<form>