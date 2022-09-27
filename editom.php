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
<title>Editing Originator Manager</title>
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
$id = $_POST['id'];
$inum = $_POST['inum'];
$view = $_POST['view'];
include ("conn.php");

if(isset($_POST['what']))
{

	if($_POST['what'] == "update")
	{
		$omngr = $_POST['omngr'];
		
		
		$update = "update tblCAR set OMID=$omngr where IssNumber='$inum'";
		$updateResult = mysql_query($update);
		if($updateResult)
		{
			print "<p class=\"p\" align=\"center\">Originator Manager for CAR with Issue Number $inum has been changed</p>";
		}
		else
		{
			print mysql_error();
			
		
		}
	}
}

?>
<body>
<p align="center"><span class="style3">Editing Originator Manager </span></p>
<table width="393" border="0" align="center">
  <tr>
    <td width="181"><form name="form1" method="post" action="editom.php">
      <table width="387" border="0">
         <tr>
          <td width="181"><span class="style1">Originator Manager : </span></td>
          <td width="202"><span class="style1">
            <select name="omngr">
			<?php
			$getom = "select OMID from tblCAR where IssNumber = '$inum'";
			$getomResult = mysql_query($getom);
			if($getomResult)
			{
			 	while($row1 = mysql_fetch_array($getomResult))
				{
					$omid1 = $row1['OMID'];
				
				$getName = "select Name,DeptID from tblMUAccount where MUserID = $omid1";
				$getNameResult = mysql_query($getName);
				if($getNameResult)
				{
			 		
					while($row2 = mysql_fetch_array($getNameResult))
					{
						$omName1 = $row2['Name'];
						$omDept1 = $row2['DeptID'];
					
							$getDept1 = "select DeptName from tblDept where DeptID = $omDept1";
							$getDeptResult1 = mysql_query($getDept1);
							if($getDeptResult1)
							{
								while($row3 = mysql_fetch_array($getDeptResult1))
								{
									$deptName1 = $row3['DeptName'];
								}
							
							$omDisplay1 = $omName1." Dept. ".$deptName1; 
							?>
							<option value="<?php echo $omid1;?>"><?php echo $omDisplay1; ?></option>
							<?php
							}
				 }
				 }
				}
				
			}
			
			?>
			
			<option value=""></option>
			<?php
		  $om = "select MUserID,Name,DeptID from tblMUAccount where GroupID = 'om' order by Name ASC";
		  $omResult = mysql_query($om);
		  while($row = mysql_fetch_array($omResult))
			{
			$omid = $row['MUserID'];
			$omName = $row['Name'];
			$omDept = $row['DeptID'];
			
					$getDept = "select DeptName from tblDept where DeptID = $omDept";
					$getDeptResult = mysql_query($getDept);
					if($getDeptResult)
					{
						while($row4 = mysql_fetch_array($getDeptResult))
						{
							$deptName = $row4['DeptName'];
						}
							
					$omDisplay = $omName." Dept. ".$deptName; 
					?>
				 <option value="<?php echo $omid;?>"><?php echo $omDisplay; ?></option>
					<?php
					}
			
		  }
		  ?>
            </select>
          </span> </td>
        </tr>
        
        <tr>
          <td><br/><br/><input type="hidden" name="group" value="<?php echo $group;?>"><input type="hidden" name="what" value="update">
		  <input type="hidden" name="view" value="<?php echo $view; ?>">
		  <input type="hidden" name="inum" value="<?php echo $inum;?>"><input type="hidden" name="id" value="<?php echo $id;?>"><span class="style1"></span></td>
          <td><input name="Submit" type="submit" value="Submit"></form><form name="form1" method="post" action="cardetail.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
		 <input type="hidden" name="id" value="<?php echo $id; ?>">
		 <input type="hidden" name="inum" value="<?php echo $inum; ?>">
		 <input type="hidden" name="view" value="<?php echo $view; ?>">
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