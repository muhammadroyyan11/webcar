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
<style type="text/css">
.toggle {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.toggle input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<title>Master Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK  href="tbldesign.css" rel="stylesheet" type="text/css">
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
				
			
			if($_POST['what'] == "Delisted")
			{	
				
				$userID = $_POST['userid'];
				
				$sql = "UPDATE tblMUAccount SET ";
				$sql .= "StatusActive = 0 ";
				$sql .= " WHERE MUserID = '$userID'";
    			$result = mysql_query($sql, $connection);
		
   	 			if ($result)
				{ 
					//update all other account with same username and password
					$select1 = "SELECT * FROM tblMUAccount ORDER BY Name ASC LIMIT $offset,50";
					print "<p align =\"center\" class =\"Header1\">Account has been delisted</p>";
					
				}
    			else 
				{
					print mysql_error();
				}
   			} // close update
			elseif($_POST['what'] == "Activated")
			{
				
				$userID = $_POST['userid'];
				
				$sql = "UPDATE tblMUAccount SET ";
				$sql .= "StatusActive = 1 ";
				$sql .= " WHERE MUserID = '$userID'";
    			$result = mysql_query($sql, $connection);
		
   	 			if ($result)
				{ 
					//update all other account with same username and password
					$select1 = "SELECT * FROM tblMUAccount ORDER BY Name ASC LIMIT $offset,50";
					print "<p align =\"center\" class =\"Header1\">Account has been Activated</p>";
					
				}
    			else 
				{
					print mysql_error();
				}
   			} // close update			
			else {
						
		    $suname = $_POST['suname'];
            $sname = $_POST['sname'];
            $sgrp = $_POST['sgrp'];
            $sdept = $_POST['sdept'];
  
	   	 	$select1 = "SELECT * FROM tblMUAccount";
			
			    if(($suname != "") && ($sname != "")&& ($sgrp != "")&& ($sdept != ""))
				{
					$select1 .=" WHERE MUsername = '$suname' AND Name LIKE '%$sname%' AND GroupID = '$sgrp' AND DeptID = $sdept";
				}
				
				//username is not empty
				if(($suname != "") && ($sname == "")&& ($sgrp == "")&& ($sdept == ""))
				{
					$select1 .=" WHERE MUsername = '$suname'";
				}
				
				//name is not empty
				if(($suname == "") && ($sname != "")&& ($sgrp == "")&& ($sdept == ""))
				{
					$select1 .=" WHERE Name LIKE '%$sname%'";
				}
				
				//group is not empty
				if(($suname == "") && ($sname == "")&& ($sgrp != "")&& ($sdept == ""))
				{
					$select1 .=" WHERE GroupID = '$sgrp'";
				}
				 
				 //departement is not empty
				if(($suname == "") && ($sname == "")&& ($sgrp == "")&& ($sdept != ""))
				{
					$select1 .=" WHERE DeptID = $sdept";
				}
				
				//username and name are not empty
				if(($suname != "") && ($sname != "")&& ($sgrp == "")&& ($sdept == ""))
				{
					$select1 .=" WHERE MUsername = '$suname' AND Name LIKE '%$sname%'";
				}
				
				//username and group are not empty
				if(($suname != "") && ($sname == "")&& ($sgrp != "")&& ($sdept == ""))
				{
					$select1 .=" WHERE MUsername = '$suname' AND GroupID = '$sgrp'";
				}
				
				//username and departement are not empty
				if(($suname != "") && ($sname == "")&& ($sgrp == "")&& ($sdept != ""))
				{
					$select1 .=" WHERE MUsername = '$suname' AND DeptID = $sdept";
				}
				
				//name and group are not empty
				if(($suname == "") && ($sname != "")&& ($sgrp != "")&& ($sdept == ""))
				{
					$select1 .=" WHERE Name LIKE '%$sname%' AND GroupID = '$sgrp'";
				}
		
				//name and departement are not empty
				if(($suname == "") && ($sname != "")&& ($sgrp == "")&& ($sdept != ""))
				{
					$select1 .=" WHERE Name LIKE '%$sname%' AND DeptID = $sdept";
				}
				
				//group and departement are not empty
				if(($suname == "") && ($sname == "")&& ($sgrp != "")&& ($sdept != ""))
				{
					$select1 .=" WHERE GroupID = '$sgrp' AND DeptID = $sdept";
				}
				
				//username is  empty
				if(($suname == "") && ($sname != "")&& ($sgrp != "")&& ($sdept != ""))
				{
					$select1 .=" WHERE Name LIKE '%$sname%' AND GroupID = '$sgrp' AND DeptID = $sdept";
				}
				
				//name is empty
				if(($suname != "") && ($sname == "")&& ($sgrp != "")&& ($sdept != ""))
				{
					$select1 .=" WHERE MUsername = '$suname' AND GroupID = '$sgrp' AND DeptID = $sdept";
				}
				
				//group is empty
				if(($suname != "") && ($sname != "")&& ($sgrp == "")&& ($sdept != ""))
				{
					$select1 .=" WHERE MUsername = '$suname' AND Name LIKE '%$sname%' AND DeptID = $sdept";
				}
				
				//departement is empty
				if(($suname != "") && ($sname != "")&& ($sgrp != "")&& ($sdept == ""))
				{
					$select1 .=" WHERE MUsername = '$suname' AND Name LIKE '%$sname%' AND GroupID = '$sgrp'";
				}
				
				$select1 .= " ORDER BY Name ASC ";

			}
						
    	}

    else
	{
	$select1 = "SELECT * FROM tblMUAccount ORDER BY Name ASC LIMIT $offset,50";
	}
	$selectResult = mysql_query($select1);
	$totalRows = mysql_num_rows($selectResult);
	$displayItem = "";
		
        if ($selectResult)
		{
			$baris = 0;
			if($totalRows != 0)
			{
			$displayItem = " <table align = \"center\" border = \"0\" class =\"tbl\"><tr><th class =\"t2\">Username</th><th class =\"t2\">Password</th>";
			$displayItem .= "<th class =\"t2\">Name</th><th class =\"t2\">Departement</th><th class =\"t2\">Section</th><th class =\"t2\">Email</th><th class =\"t2\">Group</th><th class =\"t2\">Edit</th><th class =\"t2\">Status</th></tr>";
			}
			while($row = mysql_fetch_array($selectResult))
			{
                $userID = $row['MUserID'];
				$userName = $row['MUsername'];
				$pass = $row['MPassword'];
				$name = $row['Name'];
				$deptID = $row['DeptID'];
				$sec = $row['Section'];
				$grp = $row['GroupID'];
				$eml = $row['Email'];
				$status = $row['StatusActive'];
				
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
		
				if($grp == "os")
			    {
					$displayGroup = "Originator";
				}
				elseif($grp == "om")
				{
					$displayGroup = "Originator Manager";
				}
				elseif($grp == "am")
				{
					$displayGroup = "In Charge Manager";
				}
				/*
				elseif($grp == "cam")
				{
					$displayGroup = "Corrective Action Manager";
				}
				*/
				elseif($grp == "cat")
				{
					$displayGroup = "Corrective Action Team";
				}
				else
				{
					$displayGroup = "";
				}
				
				if($status == 0 ){
					$statusUser = "Activated";
					$check = "unchecked";
				}else if($status == 1 ){
					$statusUser = "Delisted";	
					$check = "checked";
				}
				if(($userName != "admin") &&($grp != "admin"))
				{			
				$displayItem .= "<form id=\"myForm\" method=\"post\" action=\"editmaster.php\">";
				$displayItem .= "<input type=\"hidden\" name=\"userid\" value=\"$userID\">";
				$displayItem .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$displayItem .= "<tr align = \"center\">";
				$displayItem .= "<td class =\"t1\">$userName</td>";
				$displayItem .= "<td class =\"t1\">$pass</td>";
				$displayItem .= "<td class =\"t1\">$name</td>";
			    $displayItem .= "<td class =\"t1\">$deptName</td>";
				$displayItem .= "<td class =\"t1\">$sec</td>";
				$displayItem .= "<td class =\"t1\">$eml</td>";
				$displayItem .= "<td class =\"t1\">$displayGroup</td>";
				$displayItem .= "<td class =\"t1\"><input type=\"submit\" value=\"edit\"></td>";
				$displayItem .= "</form>";
				$displayItem .= "<form id=\"$baris\" method=\"post\" action=\"viewmaster.php\">";
				$displayItem .= "<input type=\"hidden\" name=\"userid\" value=\"$userID\">";
				$displayItem .= "<input type=\"hidden\" name=\"status\" value=\"$status\">";
				$displayItem .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$displayItem .= "<td class =\"t1\"><label class=\"toggle\"><input type=\"checkbox\" name=\"what\" value=\"$statusUser\" onclick=\"myFunction($userID,'$statusUser','$group')\" $check> <div class=\"slider round\"></div></label></td>";
				$displayItem .= "</tr>";
				$displayItem .= "</form>";
				}
				$offset++;
				$baris++;
			}
		$displayItem .= "</table><p></p>"; 
        
		}
	
}
?>

<body>
<div align="center">
  
  
  <table width="80" border="0" align="center" class ="Header1">
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
       <td><form name="form1" method="post" action="addmaster.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
         <input type="submit" name="Submit" value="Add Account">
       </form></td>
     </tr>
   </table>
  <p></p>
  
  <?php
    $form = "<center>";
	$form .= "<form method=\"POST\" action=\"viewmaster.php\">";
	$form .= "<table class =\"style1\">";
	$form .= "<tr>";
	$form .= "<td>Username :</td><td><select name=\"suname\"><option value =\"\"></option>";
	$gu = "select distinct MUsername from tblMUAccount order by MUsername ASC";
	$guResult = mysql_query($gu);
	while($ru = mysql_fetch_array($guResult))
	{
	$du = $ru['MUsername'];
	if($du != "admin")
	{
	$form .= "<option value =\"$du\">$du</option>";
	}
	}
	$form .= "</select></td>";
	$form .= "<td>Name :</td><td><select name=\"sname\"><option value =\"\"></option>";
	$gn = "select distinct Name from tblMUAccount order by Name ASC";
	$gnResult = mysql_query($gn);
	while($rn = mysql_fetch_array($gnResult))
	{
	$dn = $rn['Name'];
	$form .= "<option value =\"$dn\">$dn</option>";
	}
	$form .= "</select></td>";
	$form .= "<td>Group :</td><td><select name=\"sgrp\" id=\"sgrp\"><option value=\"\"></option><option value=\"os\">Originator</option>";
    $form .= "<option value=\"om\">Originator Manager</option><option value=\"am\">In Charge Manager</option>";
    //$form .= "<option value=\"cam\">Corrective Action Manager</option>";
	$form .= "<option value=\"cat\">Corrective Action Team</option></select></td>";
	$form .= "<td>Departement :</td><td><select name=\"sdept\"><option value=\"\" selected></option>";
		  
   $dg1 = ""; 
   
   $getDept1 = "select distinct DeptID from tblMUAccount";
    $getDeptResult1 = mysql_query($getDept1);
    while($row1 = mysql_fetch_array($getDeptResult1))
		{
			$deptid1 = $row1['DeptID'];
			if($deptid1 != "")
			{
			$gdn1 = "select DeptName from tblDept where DeptID = $deptid1 order by DeptName ASC";
			$gdnr1 = mysql_query($gdn1);
			while($rd1 = mysql_fetch_array($gdnr1))
			{
				$dg1 = $rd1['DeptName'];
			}
    		$form .= "<option value=\"$deptid1\">$dg1</option>";
			}
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
		print "<p class = \"style2\"><center>User is not found</center></p>";
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
       <td><form name="form2" method="post" action="viewmaster.php">
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
	 $userCount = retrieve_user_count();
     if ($offset < $userCount) { 
	      $displayNext = "<div align=\"center\">";
          $displayNext .= "<table width=\"1\" border=\"0\"><tr>";
          $displayNext .= "<td><form name=\"form1\" method=\"post\" action=\"viewmaster.php\">";
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
          $displayPrevious .= "<td><form name=\"form1\" method=\"post\" action=\"viewmaster.php\">";
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

function retrieve_user_count() 
{ 

   $countQuery = "SELECT count(MUserID) as userCount FROM tblMUAccount"; 
	
     $countResult = mysql_query($countQuery); 

     return mysql_result($countResult,0,"userCount"); 

} 

?>

<script>
function myFunction(userID, statusUser, group) {
	console.log(userID)
	console.log(statusUser)
	console.log(group)
	
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "viewmaster.php");

    
	var fieldStatus = document.createElement("input");
	fieldStatus.setAttribute("type", "hidden");
	fieldStatus.setAttribute("name", "what");
	fieldStatus.setAttribute("value", statusUser);
	
	var fieldID = document.createElement("input");
	fieldID.setAttribute("type", "hidden");
	fieldID.setAttribute("name", "userid");
	fieldID.setAttribute("value", userID);
	
	var fieldGroup = document.createElement("input");
	fieldGroup.setAttribute("type", "hidden");
	fieldGroup.setAttribute("name", "group");
	fieldGroup.setAttribute("value", group);
	

	form.appendChild(fieldStatus);
	form.appendChild(fieldID);
	form.appendChild(fieldGroup);
	
    document.body.appendChild(form);
    form.submit();
}
</script>


