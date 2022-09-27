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
<title>Corrective Action Team</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
font-family: Arial, Helvetica, sans-serif;
font-size:14px;
color:#990000;
}
-->
</style>
</head>
<?php 
if ((!$_POST['name'])or($_POST['name'] == "")or(!$_POST['id'])or($_POST['id'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else //user authorized
	{
	
	include ("conn.php");
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	
	if($_SERVER['REQUEST_METHOD'] == "POST") //update button is clicked
	{
		if(isset($_POST['what']))
		{
		if($_POST['what'] == "update")
		{
		if($_POST['fname'] != "")
		{
		$fname = $_POST['fname'];
		}
		else
		{
		$fname = "";
		}
		if($_POST['lname'] != "")
		{
		$lname = $_POST['lname'];
		}
		else
		{
		$lname = "";
		}
		if($_POST['departemen'] != "")
		{
		$departemen = $_POST['departemen'];
		}
		else
		{
		$departemen = "";
		}
		if($_POST['section'] != "")
		{
		$section = $_POST['section'];
		}
		else
		{
		$section = "";
		}
		
		
		$sql = "UPDATE tblCAT SET ";
		$sql .= "CATFirstName = '$fname', CATLastName = '$lname', CATDept = '$departemen',";
		$sql .= "CATSec = '$section' ";
		$sql .= " WHERE CATID='$id'";
    	$result = mysql_query($sql, $connection);
		
   	 	if ($result)
		{ 
		print "<p class =\"style2\"><center>Corrective Action Team Information has been updated</center></p>";
		}
    	else 
		{
			print mysql_error();
			
		}
  
	}//close if update
	
	if($_POST['what'] == "delete")
   {
            $delete = "DELETE FROM tblCAT WHERE CATID = '$_POST[id]'";
		    $delqry = mysql_query($delete);
		    if ($delqry) 
			{
			print "<p class = \"style2\"><center>Selected Corrective Action Team has been deleted</center></p>";
			?>
			<table width="113" border="0" align="center">
              <tr>
                <td><form name="form1" method="post" action="corractteam.php">
                  <input type="hidden" name="name" value="<?php echo $name; ?>">
                  <input type="submit" name="Submit3" value="Back">
                </form></td>
              </tr>
            </table>
<?php
			
			}

}
}
	}
	$select= "SELECT * FROM tblCAT WHERE CATID = $id "; 
	$selectResult = mysql_query($select);
		if ($selectResult)
		{
		while($row = mysql_fetch_array($selectResult))
			{
	?>

<body>
<p></p>
<table width="80" border="0" align="center">
    <tr>
      <td width="74"><form name="form1" method="post" action="corractteam.php">
	    <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="submit" name="Submit" value="Back">
      </form></td>
    </tr>
</table>
<p align="center" class="style3 style1"><strong> Edit Corrective Action Team</strong></p>
<table width="280" border="0" align="center">
  <tr>
    <td width="440" class="style1"><form name="form1" method="post" action="editcateam.php">
      <table width="306" border="0" align="center">
        <tr>
          <td width="114">First Name : </td>
          <td width="150"><input name="fname" type="text" id="fname" size="25" maxlength="25" value ="<?php echo $row['CATFirstName']; ?>"></td>
        </tr>
        <tr>
          <td>Last Name : </td>
          <td><input name="lname" type="text" id="lname" size="25" maxlength="25" value ="<?php echo $row['CATLastName']; ?>"></td>
        </tr>
        <tr>
          <td>Departement : </td>
          <td><input name="departemen" type="text" id="departemen" size="25" maxlength="25" value ="<?php echo $row['CATDept']; ?>"></td>
        </tr>
        <tr>
          <td>Section : </td>
          <td><input name="section" type="text" id="section" size="25" maxlength="25" value ="<?php echo $row['CATSec']; ?>"></td>
        </tr>
        <tr>
          <td><br></td>
          <td><br><input type="hidden" name="what" value="update">
		    <input type="hidden" name="name" value="<?php echo $name; ?>">
		  <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="Submit" value="update"> 
            <input name="Reset" type="reset" id="Reset" value="reset"></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<table border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td ><form name="form2" method="post" action="editcateam.php">
	  <input type="hidden" name="name" value="<?php echo $name; ?>">
		  <input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="hidden" name="what" value="delete">
      <input type="submit" name="Submit2" value="delete">
    </form></td>
  </tr>
</table>


<p>&nbsp;</p>

<?php
}
}
}


?>
</body>
</html>


