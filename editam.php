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
<title>Editing In Charge Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK  href="tbldesign.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 18px; }
-->
</style>
</head>
<?php
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['inum'])or($_POST['inum'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$group = $_POST['group'];
$inum = $_POST['inum'];
$id = $_POST['id'];
$view = $_POST['view'];
include ("conn.php");

if(isset($_POST['what']))
{

	if($_POST['what'] == "update")
	{
		$amngr = $_POST['amngr'];
		
		$update = "update tblCAR set AMID=$amngr,RejectReason='' where IssNumber='$inum'";
		$updateResult = mysql_query($update);
		if($updateResult)
		{
			print "<p align=\"center\" class=\"p\">In Charge Manager for CAR with Issue Number $inum has been changed</p></center>";
		}
		else
		{
			print mysql_error();
			
		
		}
	}
}

?>
<body>
<p align="center"><span class="style3">Editing In Charge Manager </span></p>
<table width="513" border="0" align="center">
  <tr>
    <td width="507"><form name="form1" method="post" action="editam.php">
      <table width="507" border="0">
         <tr>
          <td width="141"><span class="style1">In Charge Manager : </span></td>
          <td width="356"><span class="style1">
            <select name="amngr">
			<?php
			$getam = "select AMID from tblCAR where IssNumber = '$inum'";
			$getamResult = mysql_query($getam);
			if($getamResult)
			{
			 	while($row1 = mysql_fetch_array($getamResult))
				{
					$amid1 = $row1['AMID'];
				
				$getName = "select Name,DeptID from tblMUAccount where MUserID = $amid1";
				$getNameResult = mysql_query($getName);
				if($getNameResult)
				{
			 		
					while($row2 = mysql_fetch_array($getNameResult))
					{
						$amName1 = $row2['Name'];
						$amDept1 = $row2['DeptID'];
					
							$getDept1 = "select DeptName from tblDept where DeptID = $amDept1";
							$getDeptResult1 = mysql_query($getDept1);
							if($getDeptResult1)
							{
								while($row3 = mysql_fetch_array($getDeptResult1))
								{
									$deptName1 = $row3['DeptName'];
								}
							
							$amDisplay1 = $amName1." Dept. ".$deptName1; 
							?>
							<option value="<?php echo $amid1;?>"><?php echo $amDisplay1; ?></option>
							<?php
							}
				 }
				 }
				}
				
			}
			
			?>
			
			<option value=""></option>
			<?php
		  $am = "select MUserID,Name,DeptID from tblMUAccount where GroupID = 'am' order by Name ASC";
		  $amResult = mysql_query($am);
		  while($row = mysql_fetch_array($amResult))
			{
			$amid = $row['MUserID'];
			$amName = $row['Name'];
			$amDept = $row['DeptID'];
			
					$getDept = "select DeptName from tblDept where DeptID = $amDept";
					$getDeptResult = mysql_query($getDept);
					if($getDeptResult)
					{
						while($row4 = mysql_fetch_array($getDeptResult))
						{
							$deptName = $row4['DeptName'];
						}
							
					$amDisplay = $amName." Dept. ".$deptName; 
					?>
				 <option value="<?php echo $amid;?>"><?php echo $amDisplay; ?></option>
					<?php
					}
			
		  }
		  ?>
            </select>
          </span> </td>
        </tr>
        
        <tr>
          <td><input type="hidden" name="what" value="update">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
		  <input type="hidden" name="inum" value="<?php echo $inum;?>"><input type="hidden" name="view" value="<?php echo $view; ?>"></td>
          <td><input name="Submit" type="submit" value="Submit"></form><form name="form1" method="post" action="cardetail.php">
	    <input type="hidden" name="group" value="<?php echo $group;?>"><input type="hidden" name="what" value="update">
		  <input type="hidden" name="view" value="<?php echo $view; ?>">
		  <input type="hidden" name="inum" value="<?php echo $inum;?>"><input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="Submit" value="Back">
      </form></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</body>
</html>
<?php
}
?>
