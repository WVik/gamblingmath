<?php
  session_start();
  include './dbconnect.php';
  if(!isset($_SESSION['user']))
  {
    header("Location: ./login/");
  }
?>

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

    <title>Gambling Mathematics</title>

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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
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

    $str =  $_SESSION;
    //echo $str['user'];
    $string = $str['user'];
    //echo $string;
   for ($x = 1; $x <= 50; $x++) {
    $queryforrandomno = mysql_query("SELECT * from gameboard where string = '$string'");
    $rno = mysql_fetch_row($queryforrandomno);
    $qno = ((int)$rno[1]+(int)$x)%50+1;
    $prompt=mysql_query("SELECT * from questions WHERE qno='$qno'") or die("error in query");
    $row = mysql_fetch_row($prompt);
    echo '<p id="prompt'.$qno.'">'.$row[0].'</p>';

    //$q=mysql_query("SELECT * from questions WHERE qno=".$x) or die("error in query");
    //$row = mysql_fetch_row($q);
    echo '<p id="q'.$qno.'">'.$row[1].'</p>';
    echo '<p id="a'.$qno.'">'.SHA1($row[2]).'</p>';
    }
    echo "string";
  ?>

  </div>

</div>




<div id="gamedetails">
  <?php

  $str = $_SESSION['user'];

  $gamedetails=mysql_query("SELECT numq,correct,incorrect,score,rno from gameboard WHERE string='$str'") or die("error in gamedetails");
  $rowgamedetails=mysql_fetch_row($gamedetails);

   ?>

  <p id="numq" hidden><?php echo $rowgamedetails[0]; ?></p>
  <p id="correct" hidden><?php echo $rowgamedetails[1]; ?></p>
  <p id="incorrect" hidden><?php echo $rowgamedetails[2]; ?></p>
  <p id="score" hidden><?php echo $rowgamedetails[3]; ?></p>

  <p id="rno" hidden><?php echo $rowgamedetails[4]; ?></p>

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
          <a class="navbar-brand" href="#">Gambling Mathematics</a>

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
      <h4 style="text-align: center;"><strong>Keep an eye on your score. </strong> <em> </em> You have 10 questions!</h4>
    </div>

    <div id="game" style="width:100%;">

    <!-- Question Display -->
    <div class="questioncontainer">
        <div class="question hiddn">

             <div class="questionContent">QUESTION AREA</div>

             <form id="answerInput">
Your Answer: <input type="text" name="fname"><br>
              </form>

  <button onClick="submitForm()" class="btn btn-success btn-deep-purlple" style="margin-left:1%;margin-top:2%;">Submit</button>


        </div>
    </div>

    <!-- Question Display End -->



    <table>
      <tr class="gamerow">
        <td class="box btn btn-primary box1 1" id="1"></td>
        <td class="btn btn-primary box box1 2" id="2"></td>
        <td class="btn btn-primary box box1 3" id="3"></td>
        <td class="btn btn-primary box box1 4" id="4"></td>
        <td class="btn btn-primary box box1 5" id="5"></td>
      </tr>
      <tr class="gamerow">
        <td class="box btn btn-primary box1 6" id="6"></td>
        <td class="btn btn-primary box box1 7" id="7"></td>
        <td class="btn btn-primary box box1 8" id="8"></td>
        <td class="btn btn-primary box box1 9" id="9"></td>
        <td class="btn btn-primary box box1 10" id="10"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 11" id="11"></td>
        <td class="btn btn-primary box box1 12" id="12"></td>
        <td class="btn btn-primary box box1 13" id="13"></td>
        <td class="btn btn-primary box box1 14" id="14"></td>
        <td class="btn btn-primary box box1 15" id="15"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 16" id="16"></td>
        <td class="btn btn-primary box box1 17" id="17"></td>
        <td class="btn btn-primary box box1 18" id="18"></td>
        <td class="btn btn-primary box box1 19" id="19"></td>
        <td class="btn btn-primary box box1 20" id="20"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 21" id="21"></td>
        <td class="btn btn-primary box box1 22" id="22"></td>
        <td class="btn btn-primary box box1 23" id="23"></td>
        <td class="btn btn-primary box box1 24" id="24"></td>
        <td class="btn btn-primary box box1 25" id="25"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 26" id="26"></td>
        <td class="btn btn-primary box box1 27" id="27"></td>
        <td class="btn btn-primary box box1 28" id="28"></td>
        <td class="btn btn-primary box box1 29" id="29"></td>
        <td class="btn btn-primary box box1 30" id="30"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 31" id="31"></td>
        <td class="btn btn-primary box box1 32" id="32"></td>
        <td class="btn btn-primary box box1 33" id="33"></td>
        <td class="btn btn-primary box box1 34" id="34"></td>
        <td class="btn btn-primary box box1 35" id="35"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 36" id="36"></td>
        <td class="btn btn-primary box box1 37" id="37"></td>
        <td class="btn btn-primary box box1 38" id="38"></td>
        <td class="btn btn-primary box box1 39" id="39"></td>
        <td class="btn btn-primary box box1 40" id="40"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 41" id="41"></td>
        <td class="btn btn-primary box box1 42" id="42"></td>
        <td class="btn btn-primary box box1 43" id="43"></td>
        <td class="btn btn-primary box box1 44" id="44"></td>
        <td class="btn btn-primary box box1 45" id="45"></td>
      </tr>
       <tr class="gamerow">
        <td class="box btn btn-primary box1 46" id="46"></td>
        <td class="btn btn-primary box box1 47" id="47"></td>
        <td class="btn btn-primary box box1 48" id="48"></td>
        <td class="btn btn-primary box box1 49" id="49"></td>
        <td class="btn btn-primary box box1 50" id="50"></td>
      </tr>


    </table>


    </div>
       <!-- Game Panel Div Ends -->



      <footer>
        <p>&copy; 2017 Mathematics Association .</p>
      </footer>
    </div> <!-- Game Panel CONTAINER Div Ends -->





    </div>
  </div>


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
