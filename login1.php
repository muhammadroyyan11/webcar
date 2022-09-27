<?php
/* 
*****************************
* Programmer : Milda Ifan   *
* Date Created : April 2006 *
*****************************
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 
{font-family: Arial, Helvetica, sans-serif;
 font-weight: bold;
 color:#CC0000;
 
 
}
-->
</style>
</head>

<?php 

if((!$_POST['what']) or ($_POST['what']!= "login") or ($_POST['what'] ==""))
{
//redirect to login page
include ("redirectlogin.php");
}
else
{
if($_SERVER['REQUEST_METHOD'] == "POST" and $_POST['what'] == "login")
{
   //connect to database 
	include ("conn.php");
	$sql= "SELECT * FROM tblMUAccount WHERE MUsername ='$_POST[username]' AND MPassword = '$_POST[password]' AND GroupID = '$_POST[group]' ";
	$result = mysql_query($sql, $connection);

$name= "";
$group = "";
while($row = mysql_fetch_array($result))
{
	$name = $row['MUsername'];
	$group = $row['GroupID'];
	$id = $row['MUserID'];
}

if(($name =="")&&($group == ""))
{
	print "<h3 class=\"style2\"><center>Your login information is incorrect</center></h1>";
    print "<br><h3 class=\"style2\"><center> Please try again</h1></center>";
	print "<br><h3 class=\"style2\"><center><a href=\"login.php\">Back to login page</a></center>";
}

else
{ 

if($group == "os")
{
$displayName = "Originator";
}
elseif($group == "om")
{
$displayName = "Originator Manager";
}
elseif($group == "am")
{
$displayName = "In Charge Manager";
}
/*
elseif($group == "cam")
{
$displayName = "Corrective Action Manager";
}
*/
elseif($group == "cat")
{
$displayName = "Corrective Action Team";
}
else
{
$displayName = "Administrator";
}
?>	
	




<body>
<p><center class="style1">Welcome <?php echo $name; ?>. You have logged in as <?php echo $displayName; ?></center>
</p>
<p></p>
<table width="62" border="0" align="center">
  <tr>
    <td width="56"><form name="form1" method="post" action="<?php echo $group; ?>.php">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name="group" value="<?php echo $group;?>">
      <input type="submit" name="Submit" value="Continue">
    </form></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
</body>
</html>
<?php 

}
}	
}
?>
