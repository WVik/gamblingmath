<?php
session_start();
if(isset($_SESSION['user'])!="")
{
  header("Location: ../index.php");
}
else{
?>
<html>

<head>
    <title>GamblingLogin</title>
    <link href="./style.css" rel="stylesheet">

    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<link href="./style.css" rel="stylesheet">

<body>
<div class = "container text-center">

    <div class="wrapper text-center">

        <form action="login_action.php" method="post" name="Login_Form" class="form-signin">
             <div class="logo"></div>
            <h3 class="form-signin-heading">Sign in to GamblingMaths</h3>
              <hr class="colorgraph"><br>

              <input type="text" class="form-control" name="string" placeholder="Please enter the string given to you" required="" autofocus="" />


             <br/>
              <button class="btn btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>
              <a href="../registration" class="btn btn-primary btn-block">Registration</a>
        </form>
    </div>
</div>
</body>

</html>
<?php
}
?>
