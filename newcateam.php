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
<title>New Corrective Action Team</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
font-family: Arial, Helvetica, sans-serif;
font-size: 24px;
color:#990000;
}

.style3 {
font-family: Arial, Helvetica, sans-serif;
font-size: 24px;
}
-->
</style>
</head>

<?php
if ((!$_POST['name'])or($_POST['name'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$name = $_POST['name'];
if($_SERVER['REQUEST_METHOD'] == "POST") //add button is clicked
{
    if((isset($_POST['what'])) && ($_POST['what'] == "add"))

	{
	$fname = "";
	$lname = "";
	$departemen = "";
	$section = "";
	
	if($_POST['fname'] != "")
	{
	$fname = $_POST['fname'];
	}
	if($_POST['lname'] != "")
	{
	$lname = $_POST['lname'];
	}
	if($_POST['departemen'] != "")
	{
	$departemen = $_POST['departemen'];
	}
	if($_POST['section'] != "")
	{
	$section = $_POST['section'];
	}
	
	    include("conn.php");
		
		//check whether the data has already exist in the database
		
		$sql = "INSERT INTO tblCAT ";
    	$sql .= "(CATFirstName,CATLastName,CATDept,CATSec)";
    	$sql .= "VALUES ( ";
    	$sql .= "'$fname','$lname','$departemen','$section')"; 
    	$result = mysql_query($sql, $connection);
		
		if($result)
		{
			print "<center><p class=\"style2\">".$fname." ".$lname." "."has been added to Corrective Action Team list</p></style></center>";
		}
		
		}
		
	
}

//display form to add corrective action team
?>

<body>
<table width="80" border="0" align="center">
    <tr>
      <td width="74"><form name="form1" method="post" action="admin.php">
	    <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
    </tr>
</table>
<p align="center" class="style3"><strong> New Corrective Action Team </strong></p>
<table width="280" border="0" align="center">
  <tr>
    <td width="440" class="style1"><form name="form1" method="post" action="newcateam.php">
      <table width="306" border="0" align="center">
        <tr>
          <td width="114">First Name : </td>
          <td width="150"><input name="fname" type="text" id="fname" size="25" maxlength="25"></td>
        </tr>
        <tr>
          <td>Last Name : </td>
          <td><input name="lname" type="text" id="lname" size="25" maxlength="25"></td>
        </tr>
        <tr>
          <td>Departement : </td>
          <td><input name="departemen" type="text" id="departemen" size="25" maxlength="25"></td>
        </tr>
        <tr>
          <td>Section : </td>
          <td><input name="section" type="text" id="section" size="25" maxlength="25"></td>
        </tr>
        <tr>
          <td><br></td>
          <td><br><input type="hidden" name="what" value="add"><input type="hidden" name="name" value="<?php echo $name;?>">
            <input type="submit" name="Submit" value="Add"> <input name="Reset" type="reset" id="Reset" value="Reset"></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>


<p align="center">&nbsp;</p>
</body>
</html>
<?php
}
?>


