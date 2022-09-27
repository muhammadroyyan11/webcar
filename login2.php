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

if((!$_POST['group']) or ($_POST['group']!= "guest") or ($_POST['group'] ==""))
{
//redirect to login page
include ("redirectlogin.php");
}
else
{
if($_SERVER['REQUEST_METHOD'] == "POST" and $_POST['group'] == "guest")
{
   //connect to database 
	include ("conn.php");
	$pass = $_POST['guestpassword'];
	$sql= "SELECT * FROM tblGuest WHERE GuestPass ='$pass'";
	$result = mysql_query($sql, $connection);

$p ="";
$group = "guest";
while($row = mysql_fetch_array($result))
{
	$i = $row['GuestID'];
	$p = $row['GuestPass'];
}

if($p == "")
{
	print "<h3 class=\"style2\"><center>Your password is incorrect</center></h1>";
    print "<br><h3 class=\"style2\"><center> Please try again</h1></center>";
	print "<br><h3 class=\"style2\"><center><a href=\"login.php\">Back to login page</a></center>";
}

else
{ 

?>	
	




<body>
<p><center class="style2">You have logged in as guest</center>
</p>
<p></p>
<table width="62" border="0" align="center">
  <tr>
    <td width="56"><form name="form1" method="post" action="<?php echo $group; ?>.php">
	<input type="hidden" name="id" value="<?php echo $i;?>">
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

