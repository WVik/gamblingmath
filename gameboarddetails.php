<?php
session_start();
if(isset($_SESSION['user'])=="")
{
	header("Location: ./");
}
$string=$_SESSION['user'];
echo $string;
include_once './dbconnect.php';
if(isset($_POST['attempted'])){

$attempted = $_POST['attempted'];
//echo $redbox;
mysql_query("UPDATE gameboard SET correct='$attempted' WHERE string='$string'") or die("error in query");
}

if(isset($_POST['cq'])){

$cq = $_POST['cq'];
//echo $redbox;
mysql_query("UPDATE gameboard SET currQ='$cq' WHERE string='$string'") or die("error in query");
}
if(isset($_POST['nq'])){

$nq = $_POST['nq'];
//echo $redbox;
mysql_query("UPDATE gameboard SET numQ='$nq' WHERE string='$string'") or die("error in query");
}
if(isset($_POST['score'])){

$score = $_POST['score'];
//echo $redbox;
mysql_query("UPDATE gameboard SET score='$score' WHERE string='$string'") or die("error in query");
}
