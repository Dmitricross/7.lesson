<?php
//require another php file //
//../../.. 3 folders back
require_once("../../config.php");

//the variable does not exist in the URL
if(!isset($_GET["edit"])) {

//redirect user
	echo "redirect";
	header("location: table.php");
	exit();// dont execute further

}else{

echo "User want to edit row:".$_GET["edit"];

$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_dmikab");

//maybe user wants to update data after clicking the button

if(isset($_GET["to"]) && isset($_GET["message"])){

	echo "User modified data, tried to safe";

	$stmt = $mysql->prepare("UPDATE messages_sample SET recipient=?, message=?, email=? WHERE id=?");

	echo $mysql->error;

	$stmt->bind_param("sssi", $_GET["to"], $_GET["message"], $_GET["from"], $_GET["edit"]);
		
		if($stmt->execute()){

			echo "saved successefully";

            //option one = redirect
            //header("Location: table")

            $recipient = $_GET["to"];
            $message = $_GET["message"];
            $id = $_GET["edit"];



		}else{

			echo $stmt->error;

}

  			
  		}else{
 			//user did not click any buttons yet,
 			//give user latest data from db


  		






$stmt=$mysql->prepare("SELECT id, recipient, message FROM messages_sample WHERE id=?");

echo $mysql->error;

//replace the ? mark
$stmt->bind_param("i", $_GET["edit"]);


//bind result data
$stmt->bind_result($id, $recipient, $message);

$stmt->execute();

//we have only 1 raw of data
if($stmt->fetch()){

	echo $id." ".$recipient." ".$message;

}else{


echo $stmt->error;

          }


    }

}

?>

<br>
<a href ="table.php">table</a>


<h2> First application </h2>


<form method="get">
<input  hidden name="edit" value="<?=$id;?>"><br><br>
<label for="message">Message:*<label><br>
<input type="text" name="message" value="<?=$message;?>"<br><br>

<label for="from">from<label><br>
<input type="text" name="from"value="<?=$id;?>"<br><br>


<label for="to">To<label><br>
<input type="text" name="to"value="<?=$recipient;?>"><br><br>
<!--This is the save button -->
<input type="submit" value="Save to DB"



<form>