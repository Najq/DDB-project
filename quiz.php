<?php
session_start();
error_reporting(1);
include("database.php");
extract($_POST);
extract($_GET);
extract($_SESSION);
/*$rs=mysql_query("select * from mst_question where test_id=$tid",$cn) or die(mysql_error());
if($_SESSION[qn]>mysql_num_rows($rs))
{
unset($_SESSION[qn]);
exit;
}*/
$db=new mysqli('localhost','root','','user') ;

if($db->connect_errno)
{
	echo "$db->connect_error";
	die("Sorry some problem occured");
}
$userid=$_SESSION['userID'];

$sqlscore="SELECT * from user_info where username='$userid' ";
$resultscore=mysqli_query($db,$sqlscore);
$rowscore=mysqli_fetch_assoc($resultscore);
$score=$rowscore['score'];	

if(isset($subid) && isset($testid))
{
$_SESSION[sid]=$subid;
$_SESSION[tid]=$testid;
header("location:quiz.php");
}
if(!isset($_SESSION[sid]) || !isset($_SESSION[tid]))
{
	header("location: index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Online Quiz</title>
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
	
<script type="text/javascript">
var MAX_COUNTER = 500;
var counter = null;
var counter_interval = null;

function setCookie(name,value,days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        expires = "; expires="+date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1,c.length);
        }
        if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length,c.length);
        }
    }
    return null;
}

function deleteCookie(name) {
    setCookie(name,"",-1);
}

function resetCounter() {
    counter = MAX_COUNTER;
}

function stopCounter() {
    window.clearInterval(counter_interval);
    deleteCookie('counter');
}

function updateCounter() {
    var msg = '';
    if (counter > 0) {
        counter -= 1;
        msg = counter;
        setCookie('counter', counter, 1);
    }
    else {
        window.location="/Online_exam_New/index.php";
        stopCounter();
    }
    var el = document.getElementById('counter');
    if (el) {
        el.innerHTML = msg+' seconds left';
    }
}

function startCounter() {
    stopCounter();
    counter_interval = window.setInterval(updateCounter, 1000);
}

function init() {
    counter = getCookie('counter');
    if (!counter) {
        resetCounter();
    }
    startCounter();
}


init();


</script>
</head>

<body onload="f1()">

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


$query="select * from mst_question";
if($_SESSION[sid]==10)
{
	$rs=mysql_query("select * from mst_question ",$cn) or die(mysql_error());
	
}
else
{
	
$rs=mysql_query("select * from mst_question where test_id=$tid",$cn) or die(mysql_error());
}
if(!isset($_SESSION[qn]))
{
	$_SESSION[qn]=0;
	$counter=0;
	mysql_query("delete from mst_useranswer where sess_id='" . session_id() ."'") or die(mysql_error());
	$_SESSION[trueans]=0;
	
}
else
{	
		if($submit=='Next Question' && isset($ans))
		{
				mysql_data_seek($rs,$_SESSION[qn]);
				$row= mysql_fetch_row($rs);	
				mysql_query("insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysql_error());
				if($ans==$row[7])
				{
							$_SESSION[trueans]=$_SESSION[trueans]+1;
							$score=$score+5;
							$sqlupdate="UPDATE user_info SET score=$score where username='$userid'";
							$insert=mysqli_query($db,$sqlupdate) or die("Could not perform the query");
				}
				if($_SESSION[sid]==10)
				{
					$rand=rand(0,27);
				}
				else
				$rand=rand(0,9);
				$_SESSION[qn]=$rand;
				$counter++;
		}
		else if($submit=='Get Result' && isset($ans))
		{
				mysql_data_seek($rs,$_SESSION[qn]);
				$row= mysql_fetch_row($rs);	
				mysql_query("insert into mst_useranswer(sess_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans) values ('".session_id()."', $tid,'$row[2]','$row[3]','$row[4]','$row[5]', '$row[6]','$row[7]','$ans')") or die(mysql_error());
				if($ans==$row[7])
				{
							$_SESSION[trueans]=$_SESSION[trueans]+1;
				}
				echo "<h1 style=font-weight:bold;text-align:center;text-decoration:underline;> Result</h1>";
				$_SESSION[qn]=$_SESSION[qn]+1;
				echo "<Table class=\"bordered\" style=text-align:center; font-weight:bold;> <thead><tr class=tot><th>Total Question<th> $_SESSION[qn]";
				echo "<tr class=tans><th>True Answer<th>".$_SESSION[trueans];
				$w=$_SESSION[qn]-$_SESSION[trueans];
				echo "<tr class=fans><th>Wrong Answer<th> ". $w;
				echo "</table>";
				mysql_query("insert into mst_result(login,test_id,test_date,score) values('$login',$tid,'".date("d/m/Y")."',$_SESSION[trueans])") or die(mysql_error());
				echo "<h1 align=center><a href=review.php> Review Question</a> </h1>";
				unset($_SESSION[qn]);
				unset($_SESSION[sid]);
				unset($_SESSION[tid]);
				unset($_SESSION[trueans]);
				exit;
		}
}
//$rs=mysql_query("select * from mst_question where test_id=$tid",$cn) or die(mysql_error());


if($_SESSION[qn]>mysql_num_rows($rs)-1)
{
unset($_SESSION[qn]);
echo "<h1 class=head1>Some Error  Occured</h1>";
session_destroy();
echo "Please <a href=index.php> Start Again</a>";

exit;
}


mysql_data_seek($rs,$_SESSION[qn]);
$row= mysql_fetch_row($rs);
echo "  <div id=counter align=right style=text-align:right;font-weight:bold;font-size:120%> </div>";
echo "<form name=myfm method=post action=quiz.php id=form>";
echo "<table width=100%> <tr> <td width=100>&nbsp;<td> <table border=0>";
$n=$_SESSION[qn]+1;
echo "<tr><td><span style=text-align:center;font-weight:bold;font-size:120%>Question:<br> $row[2]</style>";

   
echo "<tr style=font-weight:bold;><td class=style8><input type=radio name=ans value=1>$row[3]";
echo "<tr style=font-weight:bold;><td class=style8> <input type=radio name=ans value=2>$row[4]";
echo "<tr style=font-weight:bold;><td class=style8><input type=radio name=ans value=3>$row[5]";
echo "<tr style=font-weight:bold;><td class=style8><input type=radio name=ans value=4>$row[6]";



  

if($_SESSION[qn]<mysql_num_rows($rs)-1 )
echo "<tr><td><input type=submit name=submit value='Next Question' class=button-secondary pure-button></form>";
else
echo "<tr ><td><input type=submit name=submit value='Get Result' class=button-secondary pure-button></form>";
echo "</table></table>";
?>
</body>
</html>