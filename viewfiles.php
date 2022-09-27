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
<title>CAR Files</title>
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
if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else //user authorized
	{
	
	$group = $_POST['group'];
	
	include ("conn.php");
	
	$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;    
    $offsetOriginal = $offset; 
	
	if($_SERVER['REQUEST_METHOD'] == "POST") 
		{
		
		
		if(isset($_POST['what']))
			{
			$sinum = $_POST['sinum'];
            $sstatus = $_POST['sstatus'];
            $sdept = $_POST['sdept'];
  
	   	 	$select1 = "SELECT * FROM file";
			
			    if(($sinum != "")&& ($sstatus != "")&& ($sdept != ""))
				{
					$select1 .=" WHERE INumber = '$sinum' AND FStatus = '$sstatus' AND DeptID = $sdept";
				}
				
				//sinum is not empty
				if(($sinum != "")&& ($sstatus == "")&& ($sdept == ""))
				{
					$select1 .=" WHERE INumber = '$sinum'";
				}
				
				//sstatus is not empty
				if(($sinum == "")&& ($sstatus != "")&& ($sdept == ""))
				{
					$select1 .=" WHERE FStatus = '$sstatus'";
				}
				 
				 //sdept is not empty
				if(($sinum == "")&& ($sstatus == "")&& ($sdept != ""))
				{
					$select1 .=" WHERE DeptID = $sdept";
				}

				
				//sinum and sstatus are not empty
				if(($sinum != "")&& ($sstatus != "")&& ($sdept == ""))
				{
					$select1 .=" WHERE INumber = '$sinum' AND FStatus = '$sstatus'";
				}
		
				//sinum and sdept are not empty
				if(($sinum != "")&& ($sstatus == "")&& ($sdept != ""))
				{
					$select1 .=" WHERE INumber = '$sinum' AND DeptID = $sdept";
				}
				
				//sstatus and sdept are not empty
				if(($sinum == "")&& ($sstatus != "")&& ($sdept != ""))
				{
					$select1 .=" WHERE FStatus = '$sstatus' AND DeptID = $sdept";
				}
				
				$select1 .= " ORDER BY FileID ASC ";
			
			
    	}

    else
	{
	$select1 = "SELECT * FROM file ORDER BY FileID ASC LIMIT $offset,50";
    }
	$selectResult = mysql_query($select1);
	$totalRows = mysql_num_rows($selectResult);
	$displayItem = "";
		

		
		if ($selectResult)
		{
			
			if($totalRows != 0)
			{
			$displayItem = " <table align = \"center\" border = \"3\" class =\"style1\"><tr><th>Issued Date</th>";
			$displayItem .= "<th>CAR Number</th><th>CAR Status</th><th>Departement</th><th></th><th></th></tr>";
			}
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
				
				if($inum == "n/a")
				{
				$inum = "";
				}
				
				if(($idate != 0)or($imonth != 0)or($iyear != 0))
				{
				$issuedDate = $idate."/".$imonth."/".$iyear;
				}
				else
				{
				$issuedDate = "";
				}
				
				if($deptid != 0)
				{
				$getDept = "select DeptName from tblDept where DeptID = $deptid";
				$getDeptResult = mysql_query($getDept);
				if($getDeptResult)
				{
					while($row1 = mysql_fetch_array($getDeptResult))
					{
					$deptName = $row1['DeptName'];
					}
				}
				}
				else
				{
				$deptName ="";
				}
				if($status != "n/a")
				{
				//if($percent != 0)
				//{
				//$displayStatus = $status." ".$percent."%";
				//}
				//else
				//{
				$displayStatus = $status;
				//}
				}
				else
				{
				$displayStatus = "";
				}
				
				$displayItem .= "<form method=\"post\" action=\"editfiles.php\">";
				$displayItem .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
				$displayItem .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$displayItem .= "<tr align = \"center\">";
				//$displayItem .= "<td>$topic</td>";
				$displayItem .= "<td>$issuedDate</td>";
				$displayItem .= "<td>$inum</td>";
			    $displayItem .= "<td>$displayStatus</td>";
				$displayItem .= "<td>$deptName</td>";
				$displayItem .= "<td><a href =\"http://192.168.1.36/webcar/archived/$filename\">Download</a></td>";
				$displayItem .= "<td><input type=\"submit\" value=\"edit/delete\"></td>";
				$displayItem .= "</tr>";
				$displayItem .= "</form>";
				$offset++;
			}
		$displayItem .= "</table><p></p>"; 
        
		}
}
?>

<body>
<div align="center">
  
  
  <table width="80" border="0" align="center">
    <tr>
      <td width="74"><form name="form1" method="post" action="admin.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
    </tr>
</table>
<p></p>
 <table width="1" border="0">
     <tr>
       <td><form name="form1" method="post" action="upload.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
         <input type="submit" name="Submit" value="Upload Files">
       </form></td>
     </tr>
   </table>
  <p></p>
  
  <?php
   $form = "<center>";
	$form .= "<form method=\"POST\" action=\"viewfiles.php\">";
	$form .= "<table class =\"style1\">";
	$form .= "<tr>";
	//$form .= "<td>Topic :</td><td><input type=\"text\" name=\"stopic\" size=\"50\"></td>";
	$form .= "<td>CAR Number :</td><td><input type=\"text\" name=\"sinum\" size=\"25\" maxlength=\"25\"></td>";
	$form .= "<td>CAR Status :</td><td><select name=\"sstatus\" id=\"sstatus\"><option value=\"\"></option><option value=\"open\">open</option>";
    $form .= "<option value=\"closed\">close</option>";
    //$form .= "<option value=\"rejected\">rejected</option><option value=\"partially closed\">partially closed</option>";
	$form .= "</select></td><td>Departement :</td><td><select name=\"sdept\"><option value=\"\" selected></option>";
		  
    include("conn.php");
    $getDept = "select DeptID,DeptName from tblDept ORDER BY DeptName ASC";
    $getDeptResult = mysql_query($getDept);
    while($row = mysql_fetch_array($getDeptResult))
		{
			$deptid = $row['DeptID'];
    		$form .= "<option value=\"$deptid\">$row[DeptName]</option>";
		 }
    $form .= "</select></td>";
	$form .= "<td><input type=\"hidden\" name=\"what\" value=\"search\"><input type=\"hidden\" name=\"group\" value=\"$group\"></td><td><input type=\"submit\" value=\"Search\"></td>";
	$form .= "</tr>";
	$form .= "</table>";
	$form .= "</form>";
	print $form;
   print "<p></p>";
   
   if($totalRows == 0)
		{
		print "<p class = \"style2\"><center>CAR files is not found</center></p>";
		} 
		
   if($displayItem !="")
   {
    print "<center><div style=\"width: 900px; height: 500px;overflow: auto; padding: 5px; azimuth:center\">".$displayItem; 
 }
		
		if(!isset($_POST['what'])) // page is not in search mode
		{
		print "<p></p>"; 
		print "<center class =\"style1\">";
		print previous_page($offset, $totalRows);  
        print "<br />"; 
        print next_page($offset); 
		print "</center>";
		}
		else 
		{
		
		
   ?>
   <table width="78" border="0">
     <tr>
       <td><form name="form2" method="post" action="viewfiles.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
         <input type="submit" name="Submit2" value="Display All">
       </form></td>
     </tr>
   </table>  
 </center></div>


<?php
}
?>
</div>
</body>
</html>
<?php

}

function next_page($offset)  
{ 
     $group = $_POST['group'];
	 $fileCount = retrieve_file_count();
     if ($offset < $fileCount) { 
	      $displayNext = "<div align=\"center\">";
          $displayNext .= "<table width=\"1\" border=\"0\"><tr>";
          $displayNext .= "<td><form name=\"form1\" method=\"post\" action=\"viewfiles.php\">";
		  $displayNext .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayNext .= "<input type=\"hidden\" name=\"offset\" value=\"$offset\">";
		  $displayNext .= "<input type=\"submit\" name=\"Submit\" value=\"Next Page\">";
		  $displayNext .= "</form></td></tr></table></div>";
          return $displayNext; 
     } else { 
          return "Next Page >>";   
     } 
} 

function previous_page($offset, $totalRows)  
{ 

     $group = $_POST['group'];
	 if ($offset - $totalRows > 0)  
     { 
          $offset = $offset - $totalRows -50; 
		  $displayPrevious = "<div align=\"center\">";
          $displayPrevious .= "<table width=\"1\" border=\"0\"><tr>";
          $displayPrevious .= "<td><form name=\"form1\" method=\"post\" action=\"viewfiles.php\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"offset\" value=\"$offset\">";
		  $displayPrevious .= "<input type=\"submit\" name=\"Submit\" value=\"Previous Page\">";
		  $displayPrevious .= "</form></td></tr></table></div>";
          return $displayPrevious; 
          
     } else 
	 { 
          return "<< Previous Page";   
     } 
} 

function retrieve_file_count() 
{ 

   $countQuery = "SELECT count(FileID) as fileCount FROM file"; 
	
     $countResult = mysql_query($countQuery); 

     return mysql_result($countResult,0,"fileCount"); 

} 

?>

