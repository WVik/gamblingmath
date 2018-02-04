<?php
include_once '../dbconnect.php';
$name = $_POST['name'];
$string = $_POST['string'];
$collegename = $_POST['collegename'];
$mobile = $_POST['mobile'];
$valid="yes";


echo "string";

	$queryforstring = "SELECT valid FROM string WHERE string='$string'";
	$queryfornumber = "SELECT string FROM string WHERE string='$string'";
	$resultforstring = mysql_query($queryforstring);
	$resultfornumber = mysql_query($queryfornumber);
	$countforstring = mysql_num_rows($resultforstring); // if string found then register
	$result=mysql_fetch_row($resultforstring);

	echo $result[0];
	if($result[0]!="yes"){
			$valid="no";
			echo $valid;
		}



	if($countforstring!=0){

		if($valid=='no'){
			?>
			<script>alert('Sorry String already Registered');window.location="./";</script>
			<?php
		}



		else{

		if(mysql_query("INSERT INTO playerdb(string,pname,collegename,pmobile)  VALUES('$string','$name','$collegename','$mobile')"))
		{
			mysql_query("UPDATE string SET valid='no' WHERE string='$string'") or die("I should quit now!");

			?>
			<script>alert('successfully registered ');window.location="./";</script>
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering your gameboard...');window.location="./";</script>
			<?php
		}
		}
	}
	else{
			?>
			<script>alert(' Invalid String Entered.');window.location="./";</script>
			<?php
	}
	?>
