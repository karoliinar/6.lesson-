<?php
 
 
	// require another php file
	// ../../../ => 3 folders back
	require_once("../../config.php");

	$everything_was_okay = true;

 
 //getting the message from address
 // if there is ?name=.. then $_GET["name"]
 //$my_message = $_GET["message"];
 //$to = $_GET["to"];
 //$from = $_GET["from"];
 
	//check if there is variable in the URL
	if(isset($_GET["color"])){
		
		//only if there is message in the URL
		//echo "there is message"

		//if its empty
		if($_GET["color"]==="empty"){
		$everything_was_okay = false;
				//it is empty
			echo "You selected: <br>";
			echo "Please enter the dolphins color! <br>";
		}else{
			//its not empty
			echo "You selected: <br>";
			echo "Color: ".$_GET["color"]."<br>";
			$varv = $_GET["color"];
		}
	}else{
		echo "Nothing is added <br>";
		$everything_was_okay = false;
	}
	//Dorsal fin field validation 
	if(isset($_GET["color"])){
		if(empty($_GET["dorsal_fin"])){
		$everything_was_okay = false;
			echo "Please enter the dorsal fin shape! <br>";
		}else{
			echo "Dorsal fin: ".$_GET["dorsal_fin"]."<br>";
		}
	}else{
		$everything_was_okay = false;
	}
	
	//Tail field 
	if(isset($_GET["tail"])){
		if($_GET["tail"]==="empty"){
		$everything_was_okay = false;
				//it is empty
			echo "Please enter the dolphins tail shape! <br>";
		}else{
			//its not empty
			echo "Tail shape: ".$_GET["tail"]."<br>";
		}
	}else{
		$everything_was_okay = false;
	}
	
	
	//lenght feild  
	if(isset($_GET["lenght"])){
		if(empty($_GET["lenght"])){
		$everything_was_okay = false;
		echo "Please enter the dolphins lenght! <br>";
		}else{
			echo "Lenght: ".$_GET["lenght"]."<br>";
	
			}
	}else{
		$everything_was_okay = false;
	}
		
		
	//SAVE TO DB
	// ? was everything okay
	if($everything_was_okay == true){
		
	echo "Saving to database ... ";
	
		
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		// 1 servername
		// 2 username
		// 3 password
		// 4 database
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_karoliinar");
		
		$stmt = $mysql->prepare("INSERT INTO homework (color, uim, saba, pikkus ) VALUES (?,?,?,?)");
			
		//echo error
		echo $mysql->error;
		
		// we are replacing question marks with values
		// s - string, date or smth that is based on characters and numbers
		// i - integer, number
		// d - decimal, float
		
		//for each question mark its type with one letter
		$stmt->bind_param("sssi", $_GET["color"], $_GET["dorsal_fin"], $_GET["tail"], $_GET["lenght"]);
		
		//save
		if($stmt->execute()){
			echo "saved sucessfully";
		}else{
			echo $stmt->error;
		}
		
		
	}
	

?>

<h2> Identifying dolphins from pool 7 </h2>
<a href="mytable.php">Table</a>

	

<form method="get">
	<label for="color">Color: </label><br>
	<select name="color">
		<option value="grey">Grey
		<option value="dark grey">Dark grey
		<option value="empty"
						selected>Select color
	</select><br>

<form method="get">
	<label for="dorsal_fin">Dorsal fin: </label><br>
	<input type="radio" name="dorsal_fin" value="Straight">Straight<br>
	<input type="radio" name="dorsal_fin" value="Flabby">Flabby<br>
	
<form method="get">
	<label for="tail">Tail shape: </label><br>
	<select name="tail">
		<option value="broken">Broken
		<option value="not broken">Not broken
		<option value="empty"
						selected>Select tail shape
	</select><br>
	
<form method="get">
	<lable for="lenght">Lenght in meters:</label><br>
	<input type="number" placeholder="insert dolphins lenght" name="lenght"><br>
	<input type="submit" value="Save to DB">
