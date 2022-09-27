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
<title>Change Administrator Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style3 {font-size: 18px}
.style2 {
font-family: Arial, Helvetica, sans-serif;
color:#990000;
}
-->
</style>
</head>
<?php
if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{

if(isset($_POST['who']))
{
	$group = $_POST['group'];
	
	include ("conn.php");
	
        $adoldpass = $_POST['adoldpass'];
		$adnewpass1 = $_POST['adnewpass1'];
		$adnewpass2 = $_POST['adnewpass2'];
	//check old password
		$sql = "select MPassword from tblMUAccount where MUsername = 'admin'";
		$result = mysql_query($sql, $connection);
    	$pass="";
    	while($row = mysql_fetch_array($result))
    	{
			$pass = $row['MPassword'];
    	}
	
		//compare old password
		if($adoldpass == $pass) 
		{
			if ($adnewpass1 != $adnewpass2) //compare password 1 and 2
			{
				print "<h2><p class=\"style2\">Your new password and password confirmation are not the same</p></style></h2>";
			}
			else //update password
			{
				$update = "update tblMUAccount SET MPassword = '$adnewpass1' where MUsername = 'admin'";
				$updateResult = mysql_query($update, $connection);
				if($updateResult)
				{
					print "<h2><p class=\"style2\">Password for Administrator has been changed</p></style></h2>";
				}
			}
		}
		else //old password is incorrect
		{
			print "<h2><p class=\"style2\">Your old password is incorrect</p></style></h2>";
			print mysql_error();
		}
	
	}//close if(isset($_POST['who']))
	
	if(isset($_POST['guest']))
{
	$group = $_POST['group'];
	
	include ("conn.php");
	
        $goldpass = $_POST['goldpass'];
		$gnewpass1 = $_POST['gnewpass1'];
		$gnewpass2 = $_POST['gnewpass2'];
	//check old password
		$sql1 = "select GuestPass,GuestID from tblGuest where GuestPass = '$goldpass'";
		$result1 = mysql_query($sql1, $connection);
    	$pass1 ="";
    	while($row1 = mysql_fetch_array($result1))
    	{
			$pass1 = $row1['GuestPass'];
			$gid = $row1['GuestID'];
    	}
	
		//compare old password
		if($pass1 != "") 
		{
			if ($gnewpass1 != $gnewpass2) //compare password 1 and 2
			{
				print "<h2><p class=\"style2\">Your new password and password confirmation are not the same</p></style></h2>";
			}
			else //update password
			{
				$update1 = "update tblGuest SET GuestPass = '$gnewpass1' where GuestID = '$gid'";
				$updateResult1 = mysql_query($update1, $connection);
				if($updateResult1)
				{
					print "<h2><p class=\"style2\">Password for Guest has been changed</p></style></h2>";
				}
			}
		}
		else //old password is incorrect
		{
			print "<h2><p class=\"style2\">Your old password is incorrect</p></style></h2>";
			print mysql_error();
		}
	
	}//close if(isset($_POST['guest'])) 
	


?>



<body class="style1">
<table width="80" border="0">
    <tr>
      <td width="74"><form name="form1" method="post" action="admin.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
    </tr>
</table>
<p class="style3">Administrator</p>
<table width="309" border="1" bordercolor="#333333">
  <tr>
    <td width="303"><form name="form1" method="post" action="adminsettings.php">
        <table width="297" border="0">
          <tr>
            <td width="206">Old Password : </td>
            <td width="81"><input name="adoldpass" type="password" id="adoldpass" size="10" maxlength="10"></td>
          </tr>
          <tr>
            <td>New Password : </td>
            <td><input name="adnewpass1" type="password" id="adnewpass1" size="10" maxlength="10"></td>
          </tr>
          <tr>
            <td>Confirm New Password : </td>
            <td><input name="adnewpass2" type="password" id="adnewpass2" size="10" maxlength="10"></td>
          </tr>
          <tr>
            <td><input type="hidden" name="group" value="<?php echo $group; ?>"><input type="hidden" name="who" value="admin"></td>
            <td><br><input type="submit" name="Submit6" value="Change"></td>
          </tr>
        </table>
    </form></td>
  </tr>
</table>

<p class="style3">Guest</p>
<table width="309" border="1" bordercolor="#333333">
  <tr>
    <td width="303"><form name="form1" method="post" action="adminsettings.php">
        <table width="297" border="0">
          <tr>
            <td width="206">Old Password : </td>
            <td width="81"><input name="goldpass" type="password" id="goldpass" size="10" maxlength="10"></td>
          </tr>
          <tr>
            <td>New Password : </td>
            <td><input name="gnewpass1" type="password" id="gnewpass1" size="10" maxlength="10"></td>
          </tr>
          <tr>
            <td>Confirm New Password : </td>
            <td><input name="gnewpass2" type="password" id="gnewpass2" size="10" maxlength="10"></td>
          </tr>
          <tr>
            <td><input type="hidden" name="group" value="<?php echo $group; ?>"><input type="hidden" name="guest" value="guest"></td>
            <td><br><input type="submit" name="Submit6" value="Change"></td>
          </tr>
        </table>
    </form></td>
  </tr>
</table>

</body>
</html>
<?php
}
?>