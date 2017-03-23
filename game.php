<?php

session_start();
if(isset($_SESSION['user'])=="")
{
  header("Location: ./login/");
}

include 'dbconnect.php';   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="isola board game">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Zombie Mathematics</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
    <!-- include the core styles -->
    <link rel="stylesheet" href="dist/alertify.css" />
    <!-- include a theme, can be included into the core instead of 2 separate files -->
    <!--<link rel="stylesheet" href="dist/alertify.default.css" />-->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <style type="text/css">
      body {
      padding-top: 54px;
      padding-bottom: 20px;
      }
      .box{  margin-right:4px;
             margin-bottom:4px;

      }
      #game{
        display: flex;
        flex-direction:row;
        justify-content:center;
        width: 100% !important;
      }

     .dead{
      	background-color: red;
      }
      .movable{
        background-color: lightgreen;
      }
	    
      
      .score{
        display: flex;
        padding:10px;
        background-color: lightgreen;
        position: absolute;
        border-radius: 3px;
        justify-content:center;
        align-items:center;
        
      }

      .score1{
       
        width:100px;
        height:100px;
      }

      .score2{
        
        width:100px;
        height:100px;
      }

      .scorecontainer{
        position: absolute;
        display:flex;
        justify-content:center;
        width: 170px;
        height:170px;
        font-size: 30px
      }

      .scorecontainer1{
        left:50px;
      }

      .scorecontainer2{
        right: 50px;
      }
   
     .container{
      width: 100%;
     }
     #questions{
      display:none;
     }

     .playerPos{
       color:black;
     }

    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
  <div id="questions">
    <div class="ques">
      
      <?php 
for ($x = 1; $x <= 49; $x++) {

    $prompt=mysql_query("SELECT question from questions WHERE qno=".$x) or die("error in query");
    $row = mysql_fetch_row($prompt);
    echo '<p id="prompt'.$x.'">'.$row[0].'</p>';
    $q=mysql_query("SELECT answer from questions WHERE qno=".$x) or die("error in query");
    $row = mysql_fetch_row($q);
    echo '<p id="q'.$x.'">'.sha1($row[0]).'</p>';
} 
?> 


    
    </div>
  </div>

  <div id="gamedetails">
  <?php 
  $string=$_SESSION['user'];
  
  $gamedetails=mysql_query("SELECT pl1pos,pl2pos,redbox,rno,turn from gameboard WHERE string='$string'") or die("error in query");
  $rowgamedetails=mysql_fetch_row($gamedetails);

   ?>
  <p id="p1pos" hidden><?php echo $rowgamedetails[0]; ?></p>
  <p id="p2pos" hidden><?php echo $rowgamedetails[1]; ?></p>
  <p id="redBox" hidden><?php echo $rowgamedetails[2]; ?></p>
  <p id="rNum" hidden><?php echo $rowgamedetails[3]; ?></p>
  <p id="turn" hidden><?php echo $rowgamedetails[4]; ?></p>
  </div>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Zombie Mathematics</a>
          
        </div>
        
        <div id="navbar" class="navbar-collapse collapse">
          
          <form class="navbar-form navbar-right">
            
            <a href="./login/logout_action.php?logout=true" class="btn btn-danger"><strong>Logout</strong></a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    
      <div class="container" >  
      <div class="alert alert-info">
		  <h4 style="text-align: center;"><strong>Move ! Move ! </strong> <em>Player 1 </em> its time to move your Zombie.</h4>
	  </div>
	 
      <div id="game" style="width:100%;">
       
      <table>
        <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
        <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>
         <tr class="gamerow">
          <td class="box btn btn-primary box1 11" id="11"></td>
          <td class="btn btn-primary box box1 12" id="12"></td>
          <td class="btn btn-primary box box1 13" id="13"></td>
          <td class="btn btn-primary box box1 15" id="15"></td>
          <td class="btn btn-primary box box1 16" id="16"></td>
        </tr>


      </table>
  
      </div> 
       <!-- Game Panel Div Ends -->
     
      
      
      <footer>
        <p>&copy; 2017 Mathematics Association .</p>
      </footer>
   	</div> <!-- Game Panel CONTAINER Div Ends -->
   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    
    <script src="../../dist/js/bootstrap.min.js">
     player1 = document.getElementById('14');
     player2 = document.getElementById('74');

    </script>
      <script src="dist/alertify.min.js"></script>
  

      <script type="text/javascript" src="js/sha1.js"></script>
      <script type="text/javascript" src="js/clickable_fn.js?v=123"></script>
      <script type="text/javascript" src="js/setalign.js?v=234"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>
