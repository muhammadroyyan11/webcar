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
<title>Audited Manager</title>
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
	
	
		if(isset($_POST['what']))
		{
			$uname = $_POST['uname'];
			$nm = $_POST['nm'];
			$dpt = $_POST['sdept'];
		
	   	 	$select = "SELECT * FROM tblMUAccount";
			if(($_POST['uname'] != "") && ($_POST['nm'] != "")&& ($_POST['sdept'] != ""))
			{
				$select .=" WHERE MUsername='$uname' AND Name LIKE '%$nm%' AND DeptID = $dpt AND GroupID = 'am'";
			}
		
			//username is not empty
			if(($_POST['uname'] != "") && ($_POST['nm'] == "")&& ($_POST['sdept'] == ""))
			{
				$select .=" WHERE MUsername='$uname' AND GroupID = 'am'";
			}
		
			//name is not empty
			if(($_POST['uname'] == "") && ($_POST['nm'] != "")&& ($_POST['sdept'] == ""))
			{
				$select .=" WHERE Name LIKE '%$nm%' AND GroupID = 'am'";
			}
		
			//departemen is not empty
			if(($_POST['uname'] == "") && ($_POST['nm'] == "")&& ($_POST['sdept'] != ""))
			{
				$select .=" WHERE DeptID = $dpt AND GroupID = 'am'";
			}
		
			//username and name are not empty
			if(($_POST['uname'] != "") && ($_POST['nm'] != "")&& ($_POST['sdept'] == ""))
			{
				$select .=" WHERE MUsername='$uname' AND Name LIKE '%$nm%' AND GroupID = 'am'";
			}
			
			//username and departement are not empty
			if(($_POST['uname'] != "") && ($_POST['nm'] == "")&& ($_POST['sdept'] != ""))
			{
				$select .=" WHERE MUsername='$uname' AND DeptID = $dpt AND GroupID = 'am'";
			}
		
			//name and departemen are not empty
			if(($_POST['uname'] == "") && ($_POST['nm'] != "")&& ($_POST['sdept'] != ""))
			{
				$select .=" WHERE Name LIKE '%$nm%' AND DeptID = $dpt AND GroupID = 'am'";
			}
			
			if(($_POST['uname'] == "") && ($_POST['nm'] == "")&& ($_POST['sdept'] == ""))
			{
				$select .=" WHERE GroupID = 'am'";
			}
			
			$select .= " ORDER BY Name ASC";
    	} //close if(isset($_POST['what']))

    else
	{
	
		$select = "SELECT * FROM tblMUAccount WHERE GroupID = 'am' ORDER BY Name ASC LIMIT $offset,50";
	}
 
	
	$selectResult = mysql_query($select);
	$totalRows = mysql_num_rows($selectResult);
	$displayItem = "";
		
		
		
		if ($selectResult)
		{
			
			if($totalRows != 0)
			{
			$displayItem = " <table align = \"center\" border = \"0\" class =\"tbl\"><tr><th class =\"t2\">Username</th><th class =\"t2\">Name</th><th class =\"t2\">Departement</th><th class =\"t2\">Section</th></tr>";
			}
			while($row = mysql_fetch_array($selectResult))
			{
				$userName = $row['MUsername'];
				$name = $row['Name'];
				$deptID = $row['DeptID'];
				$sect = $row['Section'];
				
				$deptName = "";
			    $getDept = "select DeptName from tblDept where DeptID = $deptID";
				$getDeptResult = mysql_query($getDept);
				if($getDeptResult)
				{
					while($row1 = mysql_fetch_array($getDeptResult))
					{
					$deptName = $row1['DeptName'];
					}
				}
			
				$displayItem .= "<tr align = \"center\">";
				$displayItem .= "<td class =\"t1\">$userName</td>";
				$displayItem .= "<td class =\"t1\">$name</td>";
				$displayItem .= "<td class =\"t1\">$deptName</td>";
				$displayItem .= "<td class =\"t1\">$sect</td>";
				$displayItem .= "</tr>";
				
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
 
  <p></p>
  <?php
  $form = "<center>";
	$form .= "<form method=\"POST\" action=\"amngr.php\">";
	$form .= "<table class =\"style1\">";
	$form .= "<tr>";
	$form .= "<td>Username :</td><td><select name=\"uname\"><option value =\"\"></option>";
	$gu = "select MUsername from tblMUAccount where GroupID ='am'";
	$guResult = mysql_query($gu);
	while($ru = mysql_fetch_array($guResult))
	{
	$du = $ru['MUsername'];
	$form .= "<option value =\"$du\">$du</option>";
	}
	$form .= "</select></td>";
	$form .= "<td>Name :</td><td><select name=\"nm\"><option value =\"\"></option>";
	$gn = "select Name from tblMUAccount where GroupID ='am'";
	$gnResult = mysql_query($gn);
	while($rn = mysql_fetch_array($gnResult))
	{
	$dn = $rn['Name'];
	$form .= "<option value =\"$dn\">$dn</option>";
	}
	$form .= "</select></td>";
	$form .= "<td>Departement :</td><td><select name=\"sdept\"><option value=\"\" selected></option>";
		  
    
    $getDept = "select DeptID from tblMUAccount where GroupID = 'am'";
    $getDeptResult = mysql_query($getDept);
    while($row = mysql_fetch_array($getDeptResult))
		{
			$deptid = $row['DeptID'];
			$gdn = "select DeptName from tblDept where DeptID = $deptid";
			$gdnr = mysql_query($gdn);
			while($rd = mysql_fetch_array($gdnr))
			{
				$dn = $rd['DeptName'];
			}
    		$form .= "<option value=\"$deptid\">$dn</option>";
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
		print "<p class = \"style2\"><center>Originator Manager has not been added yet</center></p>";
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
       <td><form name="form2" method="post" action="amngr.php">
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


function next_page($offset)  
{ 
     $group = $_POST['group'];
	 $staffCount = retrieve_staff_count();
     if ($offset < $staffCount) { 
	      $displayNext = "<div align=\"center\">";
          $displayNext .= "<table width=\"1\" border=\"0\"><tr>";
          $displayNext .= "<td><form name=\"form1\" method=\"post\" action=\"amngr.php\">";
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
          $displayPrevious .= "<td><form name=\"form1\" method=\"post\" action=\"amngr.php\">";
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

function retrieve_staff_count() 
{ 

    $countQuery = "SELECT count(MUserID) as staffCount FROM tblMUAccount WHERE GroupID = 'am'";
	
     $countResult = mysql_query($countQuery); 

     return mysql_result($countResult,0,"staffCount"); 

} 

?>