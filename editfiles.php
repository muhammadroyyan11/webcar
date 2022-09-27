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
<title>Edit CAR Files Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style7 {
	font-size: x-small;
	color: #990000;
}
-->
</style>

</head>
<?php 
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['id'])or($_POST['id'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else //user authorized
	{
	
	include ("conn.php");
	
	$id = $_POST['id'];
	$group = $_POST['group'];
	
	if($_SERVER['REQUEST_METHOD'] == "POST") //update button is clicked
	{
		if(isset($_POST['what']))
		{
			if($_POST['what'] == "update")
			{
			$topic1 = "n/a";
			$idate1 = "0";
			$imonth1 = "0";
			$iyear1 = "0";
			$inum1 = "n/a";
			$status1 = "n/a";
			$dept1 = "0";
			$percent1 = "0";
			
			//if($_POST['topic'] != "")
			//{
			//$topic1 = trim($_POST['topic']);
			//}
			if($_POST['idate'] != "")
			{
			$idate1 = $_POST['idate'];
			}
			if($_POST['imonth'] != "")
			{
			$imonth1 = $_POST['imonth'];
			}
			if($_POST['iyear'] != "")
			{
			$iyear1 = $_POST['iyear'];
			}
			if($_POST['inum'] != "")
			{
			$inum1 = trim($_POST['inum']);
			}
			if($_POST['status'] != "")
			{
			$status1 = $_POST['status'];
			}
			if($_POST['dept'] != "")
			{
			$dept1 = $_POST['dept'];
			}
			
			//if($_POST['percent'] != "")
			//{
			//$percent1 = $_POST['percent'];
    		//}
			

				$sql = "UPDATE file SET ";
				$sql .= "IDate = $idate1,IMonth = $imonth1,Iyear = $iyear1,INumber = '$inum1',FStatus = '$status1',DeptID = $dept1,Percent = $percent1";
				$sql .= " WHERE FileID=$id";
    			$result = mysql_query($sql, $connection);
		
   	 			if ($result)
				{ 
					print "<p class =\"style2\"><center>Car Files Information has been updated</center></p>";
				}
    			else 
				{
					print mysql_error();
				}
   			} // close update
	
		if($_POST['what'] == "delete")
   		{
               $filename1 = stripslashes($_POST['filename']);
				$filedir = "192.168.1.36\archived\\$filename1"; //path to directory of actual files
				$deletefiles = unlink ($filedir); //delete files
				if($deletefiles)
	    		{
						$delete = "DELETE FROM file WHERE FileID = '$_POST[id]'";
		                $delqry = mysql_query($delete);
						print "<p class = \"style2\"><center>Selected CAR Files has been deleted</center></p>";
				}
			
		   
			    
			?>
			<table width="113" border="0" align="center">
              <tr>
                <td><form name="form1" method="post" action="viewfiles.php">
                  <input type="hidden" name="group" value="<?php echo $group; ?>">
                  <input type="submit" name="Submit3" value="Back">
                </form></td>
              </tr>
            </table>
<?php
			
			
	}//close delete
} //close what
	
	$select= "SELECT * FROM file WHERE FileID = $id "; 
	$selectResult = mysql_query($select);
		if ($selectResult)
		{
		while($row = mysql_fetch_array($selectResult))
			{
				$id = $row['FileID'];
				$topic = $row['Topic'];
				$filename = $row['FileName'];
				$idate = $row['IDate'];
				$imonth = $row['IMonth'];
				$iyear = $row['IYear'];
				$inum = $row['INumber'];
				$status = $row['FStatus'];
				$deptid = $row['DeptID'];
				$percent = $row['Percent'];
				
				if($topic == "n/a")
				{
				$topic = "";
				}
				if($inum == "n/a")
				{
				$inum = "";
				}
				if($percent == 0)
				{
				$percent = "";
				}
				
			
	?>

<body>
<p></p>
<table width="80" border="0" align="center">
    <tr>
      <td width="74"><form name="form1" method="post" action="viewfiles.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="Back">
      </form></td>
    </tr>
</table>
<p align="center" class="style1"><strong> Edit CAR Files Information </strong></p>
<table width="488" border="0" align="center">
  <tr>
    <td width="482" class="style1"><form action="editfiles.php" method="post" name="form1">
      <table width="498" border="0" align="center">
        <tr>
          <td class="style1">Issued Date: </td>
          <td>        <select name="idate">
	        <?php
	  if($idate != 0)
	  {
	  ?>
	        <option value="<?php echo $idate; ?>" selected><?php echo $idate; ?></option>
	        <?php
	  }
	  ?>
	      
	  
		    <option value="">dd</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
        </select>
        / 
        
        <select name="imonth">
		    <?php
		if($imonth != 0)
	 
	  {
	  ?>
	        <option value="<?php echo $imonth; ?>" selected><?php echo $imonth; ?></option>
	        <?php
	  }
	  ?>
              <option value="">mm</option>
              <option value="1">January</option>
              <option value="2">February</option>
              <option value="3">March</option>
              <option value="4">April</option>
              <option value="5">May</option>
              <option value="6">June</option>
              <option value="7">July</option>
              <option value="8">August</option>
              <option value="9">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
        </select>
        /
		<select name="iyear">
		    <?php
		if($iyear!= 0)
		
		{
		?>
		    <option value="<?php echo $iyear; ?>" selected><?php echo $iyear; ?></option>
		    <?php
		}
		
		?>
            <option value="">yyyy</option>
	           <option value="1990">1990</option>
	           <option value="1991">1991</option>
	           <option value="1992">1992</option>
	           <option value="1993">1993</option>
	           <option value="1994">1994</option>
	           <option value="1995">1995</option>
	           <option value="1996">1996</option>
	           <option value="1997">1997</option>
	           <option value="1998">1998</option>
	           <option value="1999">1999</option>
		       <option value="2000">2000</option>
		       <option value="2001">2001</option>
               <option value="2002">2002</option>
	           <option value="2003">2003</option>
	           <option value="2004">2004</option>
	           <option value="2005">2005</option>
               <option value="2006">2006</option>
               <option value="2007">2007</option>
	           <option value="2008">2008</option>
	           <option value="2009">2009</option>
	           <option value="2010">2010</option>
	          
      </select>            </td>
        </tr>
		<tr>
          <td width="196" class="style1">CAR Number : </td>
          <td width="292" class="style1">
            <input name="inum" type="text" id="inum" size="25" maxlength="25" value ="<?php echo $inum; ?>">
          </td>
        </tr>
        <tr>
          <td class="style1">Status : </td>
          <td>      <select name="status">
		    <?php
		if($status != "n/a")
	 
	  {
	  ?>
	        <option value="<?php echo $status; ?>" selected><?php echo $status; ?></option>
	        <?php
	  }
	  ?>
              <option value=""></option>
              <option value="open">open</option>
              <option value="closed">close</option>
      </select>
	 
     </td>
        </tr>
		<tr>
          <td width="196" class="style1">Departement  : </td>
          <td width="292">		    <select name="dept">
		      
		    <?php
		 
		  if($deptid != 0)
	      {
	      
		  $getDept = "select DeptID,DeptName from tblDept Where DeptID = $deptid";
		  $getDeptResult = mysql_query($getDept);
		  while($row1 = mysql_fetch_array($getDeptResult))
			{
			$deptid1 = $row1['DeptID'];
			$deptname1 = $row1['DeptName'];
			}
			
            ?>
                <option value="<?php echo $deptid1;?>"><?php echo $deptname1; ?></option>
                <?php
		  }
		  ?>
		   <option value=""></option>
		   <?php
		  $getDept1 = "select DeptID,DeptName from tblDept";
		  $getDeptResult1 = mysql_query($getDept1);
		  while($row2 = mysql_fetch_array($getDeptResult1))
			{
			$deptid2 = $row2['DeptID'];
			$deptname2 = $row2['DeptName'];
			
		  ?>
                <option value="<?php echo $deptid2;?>"><?php echo $deptname2; ?></option>
                <?php
		  }
		  ?>
		          </select>            </td>
        </tr>
        <tr>
          <td class="style1"><br>
          </td>
          <td class="style1"><br>
              <input type="hidden" name="what" value="update">
		      <input type="hidden" name="group" value="<?php echo $group; ?>">
		      <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit" name="Submit" value="update"> 
              <input name="Reset" type="reset" id="Reset" value="reset">
          </td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<table width="501" border="0" align="center">
  <tr>
    <td width="199">&nbsp;</td>
    <td width="292" ><form name="form2" method="post" action="editfiles.php">
	 <input type="hidden" name="filename" value="<?php echo $filename; ?>">
	<input type="hidden" name="what" value="delete">
	<input type="hidden" name="group" value="<?php echo $group; ?>">
		  <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" name="Submit2" value="delete">
    </form></td>
  </tr>
</table>




<?php
}
}
}
}


?>
</body>
</html>
