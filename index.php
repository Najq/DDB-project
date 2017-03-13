<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome</title>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/online_quiz/assets/ico/favicon.png">

    <title>SPOT</title>

    <!-- Bootstrap core CSS -->
    <link href="/online_quiz/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/online_quiz/assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/online_quiz/assets/css/main.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  


<body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/online_quiz/index.html">SP<i class="fa fa-circle"></i>T</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="/online_quiz/index.html">HOME</a></li>
            <li><a href="/online_quiz/about.php">QUESTIONS</a></li>
            <li><a href="/Online_exam_New/index.php">Login</a></li>
            <li><a href="/online_quiz/leaderboard.php">Leaderboard</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
	</div>

<?php

include("header.php");
include("database.php");
extract($_POST);
session_start();


if(isset($submit))
{
	$rs=mysql_query("select * from mst_user where login='$loginid' and pass='$pass'");
	$_SESSION['userID']=$loginid;
	if(mysql_num_rows($rs)<1)
	{
		$found="N";
	}
	else
	{
		$_SESSION[login]=$loginid;
	}
}

if (isset($_SESSION[login]))
{
echo "<h1 style='font-weight:bold;text-decoration:underline;' align=center>Welcome to Online Quiz</h1>";
		echo '<table width="28%"  border="0" align="center">
  <tr>
    <td width="7%" height="65" valign="bottom"><img src="image/HLPBUTT2.JPG" width="100" height="100" align="middle"></td>
    <td width="93%" valign="bottom" bordercolor="#0000FF"> <a href="sublist.php" style=font-weight:bold;font-size:200%;>Subject for Quiz <br></a></td>
  </tr>
  <tr>
    <td height="58" valign="bottom"><img src="image/DEGREE.JPG" width="100" height="100" align="absmiddle"></td>
    <td valign="bottom"> <a href="result.php" class="style4" style=font-weight:bold;font-size:200%;>Result </a></td>
  </tr>
</table>';
   
		exit;
		

}


?>
<table width="100%" border="0">
  <tr>
    <td width="70%" height="25">&nbsp;</td>
    <td width="1%" rowspan="2" bgcolor="#CC3300"><span class="style6"></span></td>
    <td width="29%" bgcolor="#CC3333"><div align="center" style="font-weight:bold; color:#ffffff;">User Login </div></td>
  </tr>
  <tr>
    <td height="296" valign="top"><div align="center">
        <h1 style="text-align:center; font-weight:bold;">Welcome</h1>
      <span class="style5"><img src="image/paathshala.jpg" width="129" height="100"><span class="style7"><img src="image/HLPBUTT2.JPG" width="50" height="50"><img src="image/BOOKPG.JPG" width="43" height="43"></span>        </span>
        <param name="movie" value="english theams two brothers.dat">
        <param name="quality" value="high">
        <param name="movie" value="Drag to a file to choose it.">
        <param name="quality" value="high">
        <param name="BGCOLOR" value="#FFFFFF">
<p align="left" class="style5">&nbsp;</p>
      <blockquote>
          <p align="left" style="font-weight:bold;"><span class="style7"> This Site will provide the quiz for various subject of interest. 
            You need to login for the take the online quiz.</span></p>
      </blockquote>
    </div></td>
    <td valign="top"><form name="form1" method="post" action="">
      <table width="200" border="0">
        <tr>
          <td><span style="font-weight:bold;">Login ID </span></td>
          <td><input name="loginid" type="text" id="loginid2"></td>
        </tr>
        <tr>
          <td><span style="font-weight:bold;">Password</span></td>
          <td><input name="pass" type="password" id="pass2"></td>
        </tr>
        <tr>
          <td colspan="2"><span class="errors">
            <?php
		  if(isset($found))
		  {
		  	echo "Invalid Username or Password";
		  }
		  ?>
          </span></td>
          </tr>
        <tr>
          <td colspan=2 align=center class="errors">
		  <input name="submit" type="submit" id="submit" value="Login" class="button-secondary pure-button"> </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#CC3300"><div align="center"><span style="font-weight:bold; color:#ffffff;" >New User ? <a href="signup.php" style="font-weight:bold; color:#ffffff;">Signup Free</a></span></div></td>
          </tr>
      </table>
      <div align="center">
        
        </div>
    </form></td>
  </tr>
</table>

</body>
</html>
