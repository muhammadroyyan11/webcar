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
<title>Departement</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">
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
			$name = $_POST['name'];
			$mngr = $_POST['mngr'];

		
	   	 	$select = "SELECT * FROM tblDept";
			if(($_POST['name'] != "") && ($_POST['mngr'] != ""))
			{
				$select .=" WHERE DeptName='$name' AND DeptMngr = '$mngr' ";
			}
		
			//dept name is not empty
			if(($_POST['name'] != "") && ($_POST['mngr'] == ""))
			{
				$select .=" WHERE DeptName='$name'";
			}
		
			//last name is not empty
			if(($_POST['mngr'] != "") && ($_POST['name'] == ""))
			{
				$select .=" WHERE DeptMngr = '$mngr'";
			}
		
			$select .= " ORDER BY DeptName ASC LIMIT $offset,30";
    	}

    else
	{
	$select = "SELECT * FROM tblDept ORDER BY DeptName ASC LIMIT $offset,30";
    }
	$selectResult = mysql_query($select);
	$totalRows = mysql_num_rows($selectResult);
	$displayItem = "";
		
		
		
		if ($selectResult)
		{
			
			if($totalRows != 0)
			{
			$displayItem = " <table align = \"center\" class =\"tbl\"><tr><th class =\"t2\">Dept. ID</th><th class =\"t2\">Dept. Name</th><th class =\"t2\">Dept. Manager</th><th class =\"t2\"></th></tr>";
			}
			while($row = mysql_fetch_array($selectResult))
			{
				
				$did = $row['DID'];
				$id = $row['DeptID'];
				$dname = $row['DeptName'];
				$dmngr = $row['DeptMngr'];
				$displayItem .= "<form method=\"post\" action=\"editdept1.php\">";
				$displayItem .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
				$displayItem .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$displayItem .= "<tr align = \"center\">";
				$displayItem .= "<td class =\"t1\">$did</td>";
				$displayItem .= "<td class =\"t1\">$dname</td>";
				$displayItem .= "<td class =\"t1\">$dmngr</td>";
				$displayItem .= "<td class =\"t1\"><input type=\"submit\" value=\"edit\"></td>";
				$displayItem .= "</tr>";
				$displayItem .= "</form>";
				$offset++;
			}
		$displayItem .= "</table><p></p>"; 
        
		} //close if($selectResult)
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

 <table width="1" border="0">
     <tr>
       <td><form name="form1" method="post" action="adddept.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
         <input type="submit" name="Submit" value="Add Departement">
       </form></td>
     </tr>
   </table>
  <p></p>
  <?php
   $form = "<center>";
	$form .= "<form method=\"POST\" action=\"editdept.php\">";
	$form .= "<table class =\"style1\">";
	$form .= "<tr>";
	$form .= "<td>Departemen Name :</td><td><select name=\"name\"><option value=\"\"></option>";
	$gd = "select DeptName from tblDept";
	$gdResult = mysql_query($gd);
	while($rd = mysql_fetch_array($gdResult))
	{
	$dn = $rd['DeptName'];
	$form .= "<option value =\"$dn\">$dn</option>";
	}
	$form .= "</select></td>";
	$form .= "<td>Departemen Manager :</td><td><select name=\"mngr\"><option value=\"\"></option>";
	$gd1 = "select DeptMngr from tblDept";
	$gdResult1 = mysql_query($gd1);
	while($rd1 = mysql_fetch_array($gdResult1))
	{
	$dn1 = $rd1['DeptMngr'];
	$form .= "<option value =\"$dn1\">$dn1</option>";
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
		print "<p class = \"style2\"><center>No department has been added yet</center></p>";
		} 
		
   if($displayItem !="")
   {
    print $displayItem; 
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
       <td><form name="form2" method="post" action="editdept.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
         <input type="submit" name="Submit2" value="Display All">
       </form></td>
     </tr>
   </table>  
 </div>
</body>
</html>

<?php
}
}

function next_page($offset)  
{ 
     $group = $_POST['group'];
	 $deptCount = retrieve_dept_count();
     if ($offset < $deptCount) { 
	      $displayNext = "<div align=\"center\">";
          $displayNext .= "<table width=\"1\" border=\"0\"><tr>";
          $displayNext .= "<td><form name=\"form1\" method=\"post\" action=\"editdept.php\">";
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
          $offset = $offset - $totalRows -30; 
		  $displayPrevious = "<div align=\"center\">";
          $displayPrevious .= "<table width=\"1\" border=\"0\"><tr>";
          $displayPrevious .= "<td><form name=\"form1\" method=\"post\" action=\"editdept.php\">";
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

function retrieve_dept_count() 
{ 

   $countQuery = "SELECT count(DeptID) as deptCount FROM tblDept"; 
	
     $countResult = mysql_query($countQuery); 

     return mysql_result($countResult,0,"deptCount"); 

} 

?>
