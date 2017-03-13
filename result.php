<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz  - Result </title>
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
            <li><a href="about.php">QUESTIONS</a></li>
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
extract($_SESSION);
$rs=mysql_query("select t.test_name,t.total_que,r.test_date,r.score from mst_test t, mst_result r where
t.test_id=r.test_id and r.login='$login'",$cn) or die(mysql_error());

echo "<h1 class=head1 style=text-align:center;font-weight:bold;text-decoration:underline;> Result </h1>";
if(mysql_num_rows($rs)<1)
{
	echo "<br><br><h1 class=head1 style=text-align:center;font-weight:bold;text-decoration:underline;> You have not given any quiz</h1>";
	exit;
}
echo "<table class=\"bordered\" style=text-align:center; font-weight:bold; ><thead><tr><th width=300>Test Name <th> Total<br> Question <th> Score</tr>";
while($row=mysql_fetch_row($rs))
{
echo "<tr style=font-weight:bold;>
		<td>$row[0] <td> $row[1] <td> $row[3]
		</tr>";
}
echo "</table>";
?>
</body>
</html>
