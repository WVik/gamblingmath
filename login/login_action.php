<?php
?>

			<?php
session_start();

if(isset($_SESSION['user']))
{
	header("Location: ../index.php");
}
include_once '../dbconnect.php';

?>
  <?php

	$string = $_POST['string'];

	// email exist or not
	$querypdb = "SELECT pmobile FROM playerdb WHERE string='$string'";
	$resultpdb = mysql_query($querypdb);
	$row = mysql_fetch_row($resultpdb);
	$countpdb = mysql_num_rows($resultpdb); // if email not found then register

	$querygdb = "SELECT * FROM gameboard WHERE string='$string'";
	$resultgdb = mysql_query($querygdb);
	$numquery = mysql_fetch_row($resultgdb);
	$countgdb = mysql_num_rows($resultgdb);

	$querypname = "SELECT * FROM playerdb WHERE string='$string'";
	$resultpname = mysql_query($querypname);
	$name = mysql_fetch_row($resultpname);
	$pfirstname  = explode(" ",$name[2]);



	if($countpdb != 0){
	 if($countgdb == 0){
	 	$correct="";
		$incorrect="";
	 	/*$pl1pos="14";
	 	$pl2pos="74";*/
	 	$rno=substr($string, -2);

	 	/*$pl1=$row['0'];
	 	$pl2=$row['1'];*/

	 mysql_query("INSERT INTO gameboard(string,rno,numq,correct,incorrect,score)  VALUES('$string','$rno','0','$correct','$incorrect','0')") or die("error");
 }
		$_SESSION['user']=$string;
		$_SESSION['name']=$pfirstname[0];
		$_SESSION['numq']=$numquery[2];

		//echo $_SESSION['name'];
		//echo "Vikeam";
		//echo $_SESSION['name'];
		header("Location: ../index.php");
	}
	else{
			?>
			<script>alert('Sorry your string has no gameboard. Please ask for a new one if time left.');window.location="./";</script>
			<?php
	}



?>
