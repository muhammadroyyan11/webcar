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
<title>Editing Corrective Action Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 18px; }
.style2 {
font-family: Arial, Helvetica, sans-serif; font-size: 18px;
color:#990000; 
}
-->
</style>
</head>

<?php
if ((!$_POST['group'])or(!$_POST['group']))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$group = $_POST['group'];
$id11 = $_POST['id'];
$inum = $_POST['inum'];
$view = $_POST['view'];
?>
<body>
<table border="0" align="left">
    <tr>
      
      <td><form name="form2" method="post" action="cardetail.php">
	  <input type ="hidden" name="group" value="<?php echo $group; ?>">
	  <input type ="hidden" name="inum" value="<?php echo $inum; ?>">
	   <input type ="hidden" name="id" value="<?php echo $id11; ?>">
	   <input type ="hidden" name="view" value="<?php echo $view; ?>">
        <input type="submit" name="Submit2" value="back">
      </form></td>
    </tr>
  </table>
  <br/></br>
<?php

include("conn.php");

if(isset($_POST['what']))
{
        if($_POST['what'] == "add")
		{
			if($_POST['cam'] != "")
			{
				$cam = $_POST['cam'];
			}
			else
			{
				$cam = "";
			}
			$sql = "INSERT INTO tblCARDTL1 ";
    		$sql .= "(IssNumber,CAMID,CAMStat)";
    		$sql .= "VALUES ( ";
    		$sql .= "'$inum',$cam,'no response')"; 
    		$result = mysql_query($sql);
			if($result)
			{
				print "<p class =\"style2\">corrective action manager has been added</style></p>";
			}
			else
			{
				print "<p class =\"style2\">Failed to add update corrective action manager</style></p>";
			}
		}
		if($_POST['what'] == "delete")
		{
		$id = $_POST['camid'];
		$delete = "delete from tblCARDTL1 where CAMID=$id and IssNumber='$inum'";
		$deleteResult = mysql_query($delete);
		if($deleteResult)
		{
			print "<p class=\"style2\">Selected Corrective Action Manager has been deleted</style></p>";
		}
		}
}	

print "<p class=\"style2\">Corrective Action Manager</p></style>";
 
$select5 = "select CAMID from tblCARDTL1 where IssNumber ='$inum'";
$select5Result = mysql_query($select5);
if($select5Result)
		{
			$display = "<table align=\"left\" border=\"1\" class=\"style1\"><tr><th>Name</th><th>Departemen</th></tr>";
			while($row = mysql_fetch_array($select5Result))
			{
				$camid1 = $row['CAMID'];
				
				
				$select19 = "select Name,DeptID from tblMUAccount where MUserID = $camid1";
				$select19Result = mysql_query($select19);
				if($select19Result)
				{
					while($row12 = mysql_fetch_array($select19Result))
					{
						$camName1 = $row12['Name'];
						$camDept1 = $row12['DeptID'];
						
						$getDept = "select DeptName from tblDept where DeptID = $camDept1";
						$getDeptResult = mysql_query($getDept);
						if($getDeptResult)
						{
							while($row4 = mysql_fetch_array($getDeptResult))
							{
								$deptName1 = $row4['DeptName'];
							}
						}
					
					}
				}
				
				//$camStat = $row['CAMStat'];
				
			    $display .= "<form method=\"post\" action=\"editcam.php\">";
				$display .= "<tr align = \"center\">";
				$display .= "<td>$camName1</td>";
				$display .= "<td>$deptName1</td>";
				//$display .= "<td>$camStat</td>";
				$display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$display .= "<input type=\"hidden\" name=\"view\" value=\"$view\">";
				$display .= "<input type=\"hidden\" name=\"id\" value=\"$id11\">";
		        $display .= "<input type=\"hidden\" name=\"inum\" value=\"$inum\">";
				$display .= "<input type=\"hidden\" name=\"camid\" value=\"$camid1\">";
				$display .= "<input type=\"hidden\" name=\"what\" value=\"delete\">";
		        $display .= "<td><input type =\"submit\" value=\"delete\"></td>";
		        $display .= "</tr>";
		        $display .= "</form>";
				
			}
			$display .="</table><p></p>";
			print $display;
		}		
?>


<div align="left">
<p></p>
  <form name="form1" method="post" action="editcam.php">
    <table  class ="style1" border="0">
      <tr>
        
        <td><select name="cam">
		<option value="" selected></option>
			<?php
		  $cam = "select MUserID,Name,DeptID from tblMUAccount where GroupID = 'cam' order by Name ASC";
		  $camResult = mysql_query($cam);
		  while($row = mysql_fetch_array($camResult))
			{
			$camid = $row['MUserID'];
			$camDept = $row['DeptID'];
			
					$getDept1 = "select DeptName from tblDept where DeptID = $camDept";
					$getDeptResult1 = mysql_query($getDept1);
					if($getDeptResult1)
					{
						while($row20 = mysql_fetch_array($getDeptResult1))
						{
								$deptName = $row20['DeptName'];
						}
					}
			
			$camDisplay = $row['Name']." Dept. ".$deptName;
		  ?>
                <option value="<?php echo $camid;?>"><?php echo $camDisplay; ?></option>
          <?php
		  }
		  
		  ?>
        </select></td>
     <input type ="hidden" name="group" value="<?php echo $group; ?>">
	  <input type ="hidden" name="inum" value="<?php echo $inum; ?>">
	   <input type ="hidden" name="id" value="<?php echo $id11; ?>">
        <input type="hidden" name="what" value="add">
		<input type="hidden" name="view" value="view">
        <td><input type="submit" name="Submit" value="Add"> </td>
       </tr>
    </table>
  </form>
  
</div>
</body>
</html>
<?php
}
?>
