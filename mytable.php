<?php
	//table.php
	
	//getting our config
	require_once("../../config.php");
 
 	//creat connetction
 	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_karoliinar");
 	
 	/*
 		IF there is a ?delete=row_id in the url
 	*/
 	
 	if(isset($_GET["delete"])){
 	
 		echo "Deleting row with id:".$_GET["delete"];
 		
 		$stmt = $mysql->prepare("UPDATE homework SET deleted=NOW() Where id=?");
 		
 		echo $mysql->error;
 		
 		//reaplace the?
 		$stmt->bind_param("i", $_GET["delete"]);
 		
 		if($stmt->execute()){
 			echo "deleted successfully";
 		}else{
 			echo $stmt->error; 
 		}
 		
 		//close the statment, so others can use connection 
 		$stmt->close();
 		
 	}
 	
 	//SQL sentence
 	$stmt = $mysql->prepare("SELECT id, color, uim, saba, pikkus, created FROM homework WHERE deleted IS NULL ORDER BY created DESC LIMIT 10 ");
 	
 	//WHERE deleted IS NULL show only those that are not deleted 	
 	//if error is sentence
 	echo $mysql->error;
 	
 	//veriables for data for each row we will get
 	$stmt->bind_result($id, $color, $uim, $saba, $pikkus, $created);
 	
 	//query
 	$stmt->execute();
 	
 	$table_html = "";
 	
 	//ass smth to string .=
 	$table_html .= "<table>";
 		$table_html .= "<tr>";
 			$table_html .= "<th>ID</th>";
 			$table_html .= "<th>Color</th>";
 			$table_html .= "<th>Uim</th>";
 			$table_html .= "<th>Saba</th>";
 			$table_html .= "<th>Pikkus</th>";
 			$table_html .= "<th>Created</th>";
 			$table_html .= "<th>Delete ?</th>";
 	 	$table_html .= "</tr>";
 	
 	//GET RESULT
 	//we have multiple rowa
 	while($stmt->fetch()){
 	
		//DO SOMETHING FOR EACH ROW
		//echo $id." ".$message."<br>";
		$table_html .= "<tr>"; //start a new row
 			$table_html .= "<td>".$id."</td>"; //add columns
 			$table_html .= "<td>".$color."</td>";
 			$table_html .= "<td>".$uim."</td>";
 			$table_html .= "<td>".$saba."</td>";
 			$table_html .= "<td>".$pikkus."</td>";
 			$table_html .= "<td>".$created."</td>";
 			$table_html .= "<td><a href='?delete=".$id."'>X<a/></td>";
 	 	$table_html .= "</tr>"; //End row
			
	}
	$table_html .= "</table>";
	echo $table_html;
		
?>
<a href="app.php">app</a>