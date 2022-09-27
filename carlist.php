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
<title>CAR Lists</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: small;
}
.style2 {font-family: Arial, Helvetica, sans-serif;
font-size:18px;
font-weight:bold}
table.tbl{ border-style:groove}
td.t1{background-color:#CCFFFF; color:#000000; font-size:small; font-family:Arial, Helvetica, sans-serif;}
th.t2{background-color:#99CCFF; color:#000000; font-size:small; font-family:Arial, Helvetica, sans-serif;}
td.t2{background-color:#99CCFF; color:#000000; font-size:small; font-family:Arial, Helvetica, sans-serif;}
p.p{color:#663300; font-size:medium; font-family:Arial, Helvetica, sans-serif; font-weight:bold;}
-->
</style>
</head>
<?php 
if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$group = $_POST['group'];
include ("conn.php");

?>
<body>
<table width="80" border="0" align="center">
    <tr>
      <td width="74"><form name="form1" method="post" action="admin.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
	  <!--
	   <td width="74"><form name="form1" method="post" action="requestlist.php">
	    <input type="hidden" name="group" value="<?php //echo $group; ?>">
        <input type="submit" name="Submit" value="CAR Request List">
      </form></td>
	  -->
    </tr>
</table>
<div align="center">

  
  <?php
$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;    
$offsetOriginal = $offset; 
$count = 0;

$form = "<center><table><tr><td>";
$form .= "<form method=\"POST\" action=\"carlist.php\">";
$form .= "<table class =\"style1\">";
$form .= "<tr>";
$form .= "<td>CAR Number :</td><td><select name=\"inum\"><option value=\"\"></option>";
$sc = "select IssNumber from tblCAR";
$scResult = mysql_query($sc);
while ($sr = mysql_fetch_array($scResult))
{
$in = $sr['IssNumber'];
$form .= "<option value=\"$in\">$in</option>";
}

$form .= "</select></td>";
$form .= "<td>CAR Status:</td><td>";
$form .= "<select name=\"stat\"><option value=\"\" selected></option><option value=\"open\">open</option><option value=\"closed\">close</option>";
$form .= "</select></td>";
$form .= "<td><input type=\"hidden\" name=\"what\" value=\"search\">";
$form .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
$form .= "</td><td><input type=\"submit\" value=\"Search\"></td>";

$form .= "</form></td>";
print $form;


$form1 = "<td><form method=\"POST\" action=\"carlist.php\">";
$form1 .= "<td>Dept</td><td>";
$form1 .= "<select name=\"sdept\"><option value=\"\"></option>";

$gd = "select DeptID,DeptName from tblDept";
$gdResult = mysql_query($gd);
if($gdResult)
{
	while($r = mysql_fetch_array($gdResult))
	{
		$did = $r['DeptID'];
		$dn = $r['DeptName'];
		$form1 .= "<option value=\"$did\">$dn</option>";
		
	}
}

$form1 .= "<input type=\"hidden\" name=\"sort\" value=\"sort\">";
$form1 .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
$form1 .= "</select></td><td><br/><input type=\"submit\" value=\"Sort\"></form></td></tr></table>";

print $form1;
print "<br/>";

			if(isset($_POST['what']))
			{
			
			if($_POST['what'] == "search")
			{
				$inum = $_POST['inum'];
				$stat = $_POST['stat'];
		
		
	   	 		$select1 = "SELECT * FROM tblCAR";
				if(($_POST['inum'] != "") && ($_POST['stat'] != ""))
				{
					$select1 .=" WHERE IssNumber='$inum' AND CARStatus = '$stat'";
				}
				
				//inum is not empty
				if(($_POST['inum'] != "") && ($_POST['stat'] == ""))
				{
					$select1 .=" WHERE IssNumber='$inum'";
				}
				
				//status is not empty
				if(($_POST['inum'] == "") && ($_POST['stat'] != ""))
				{
					$select1 .=" WHERE CARStatus = '$stat'";
				}
				
             		$select1 .= " order by CARID DESC";
			}
    	}
        
		elseif(isset($_POST['sort']))
		{
			if($_POST['sort'] == "sort")
			{
				$select1 = "select * from tblCAR order by CARID DESC";
			}
		}

		
		else
		{
			$select1 = "select * from tblCAR ORDER BY CARID DESC LIMIT $offset,50";
		}
       $totalRows = 0;		
       $select1Result = mysql_query($select1);
       if($select1Result)
       {
   			$totalRows = mysql_num_rows($select1Result);
			
			if(isset($_POST['what']))
			{
			print "<p>$totalRows CAR files is found</p>";
			}
		}
		
	
	$display = "";
	
	if($select1Result)
	{
	
	    if($totalRows != 0)
		{
			$display = "<table align = \"center\" class =\"tbl\"><tr><th class=\"t2\">CAR Number</th><th class=\"t2\">Issued Date</th><th class=\"t2\">CAR Status</th>";
			$display .= "<th class=\"t2\">Originator</th><th class=\"t2\">Originator Manager</th><th class=\"t2\">In Charge Manager</th><th class=\"t2\">Departement</th></tr>";
		}
	     
		while($row = mysql_fetch_array($select1Result))
		{
		
			$carid = $row['CARID'];
			$issNumber = $row['IssNumber'];
			$issDate = $row['IssDate'];
			$issMonth = $row['IssMonth'];
			$issYear = $row['IssYear'];
			$status = $row['CARStatus'];
			$osid = $row['OSID'];
			$omid = $row['OMID'];
			$amid = $row['AMID'];
			$issuedDate = $issDate."/".$issMonth."/".$issYear;
			$topic = $row['CTopic'];
			$percent = $row['Percent'];
		
			$select2 = "select * from tblMUAccount where MUserID = $osid";
			$select2Result = mysql_query($select2);
			if($select2Result)
			{
				while($row = mysql_fetch_array($select2Result))
				{
		
					$osid2 = $row['MUserID'];
					$osName = $row['Name'];
					
				}
			}
		
			$select3 ="select * from tblMUAccount where MUserID = $omid";
			$select3Result = mysql_query($select3);
			if($select3Result)
			{
				while($row = mysql_fetch_array($select3Result))
				{
		    		$omid2 = $row['MUserID'];
					$omName = $row['Name'];
					
				}
			}
		
			$select4 ="select * from tblMUAccount where MUserID = $amid";
			$select4Result = mysql_query($select4);
			if($select4Result)
			{
				while($row = mysql_fetch_array($select4Result))
				{
		    		$amid2 = $row['MUserID'];
					$amName = $row['Name'];
					$amDept = $row['DeptID'];
					
					//get departemen name
					 $deptName = "";
			    $getDept = "select DeptName from tblDept where DeptID = $amDept";
				$getDeptResult = mysql_query($getDept);
				if($getDeptResult)
				{
					while($row1 = mysql_fetch_array($getDeptResult))
					{
					$deptName = $row1['DeptName'];
					}
				}
				}
					
			}
			
			$afid = "";
			$sf = "select AFID from tblAttach where IssNumber = '$issNumber'";
			$sfr = mysql_query($sf);
			if($sfr)
			{
				while($rf = mysql_fetch_array($sfr))
				{
					$afid = $rf['AFID'];
				}
			}
			
			if(isset($_POST['sort']))
			{
			
				if($_POST['sort'] == "sort")
				{
					$sdept = $_POST['sdept'];
					
					if($sdept == $amDept)
					{
						$count++;
			
						$display .= "<form method=\"post\" action=\"displaycardtl.php\">";
		    			$display .= "<tr align = \"center\">";
		    			$display .= "<td class=\"t1\">$issNumber</td>";
		    			$display .= "<td class=\"t1\">$issuedDate</td>";
		    		    $display .= "<td class=\"t1\">$status</td>";
					    $display .= "<td class=\"t1\">$osName</td>";
						$display .= "<td class=\"t1\">$omName</td>";
						$display .= "<td class=\"t1\">$amName</td>";
						$display .= "<td class=\"t1\">$deptName</td>";
						$display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
						$display .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
						$display .= "<td class=\"t1\"><input type =\"submit\" value=\"Details\"></td>";
						if($afid != "")
						{
							$display .= "<td><img src=\"paper-clip.jpg\"></td>";
						}
						$display .= "</tr>";
						$display .= "</form>";
					   }
			    }
		}	
		else
		{

			
				$display .= "<form method=\"post\" action=\"displaycardtl.php\">";
				$display .= "<tr align = \"center\">";
				$display .= "<td class=\"t1\">$issNumber</td>";
				$display .= "<td class=\"t1\">$issuedDate</td>";
				$display .= "<td class=\"t1\">$status</td>";
				$display .= "<td class=\"t1\">$osName</td>";
				$display .= "<td class=\"t1\">$omName</td>";
				$display .= "<td class=\"t1\">$amName</td>";
				$display .= "<td class=\"t1\">$deptName</td>";
				$display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$display .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
				$display .= "<td class=\"t1\"><input type =\"submit\" value=\"Details\"></td>";
				if($afid != "")
						{
							$display .= "<td><img src=\"paper-clip.jpg\"></td>";
						}
				$display .= "</tr>";
				$display .= "</form>";
				$offset++;
		}
		
		}
		if(isset($_POST['sort']))
		{
			print "<p>$count CAR files is found</p>";
		}
		$display .= "</table>"; 
		
		}
		
		
   		if($display !="")
   		{
    		print "<div style=\"width: 900px; height: 500px;overflow: auto; padding: 5px\">".$display; 
 		}
	
	
	if((!isset($_POST['what']))&&(!isset($_POST['sort']))) // page is not in search mode or sort mode
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
</head>

<body>
<p></p>
 <table width="78" border="0">
     <tr>
       <td><form name="form2" method="post" action="carlist.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
         <input type="submit" name="Submit2" value="Display All">
       </form></td>
     </tr>
   </table>  
   <?php
   }
   ?>

</div> 

</div>
</body>
</html>
<?php
}

function next_page($offset)  
{ 
     $group = $_POST['group'];
	 
	 $carCount = retrieve_car_count();
     if ($offset < $carCount) 
	 { 
	      $displayNext = "<div align=\"center\">";
          $displayNext .= "<table width=\"1\" border=\"0\"><tr>";
          $displayNext .= "<td><form name=\"form1\" method=\"post\" action=\"carlist.php\">";
		  $displayNext .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayNext .= "<input type=\"hidden\" name=\"offset\" value=\"$offset\">";
		  $displayNext .= "<input type=\"submit\" name=\"Submit\" value=\"Next Page\">";
		  $displayNext .= "</form></td></tr></table></div>";
          return $displayNext; 
     } 
	 else 
	 { 
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
          $displayPrevious .= "<td><form name=\"form1\" method=\"post\" action=\"carlist.php\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"offset\" value=\"$offset\">";
		  $displayPrevious .= "<input type=\"submit\" name=\"Submit\" value=\"Previous Page\">";
		  $displayPrevious .= "</form></td></tr></table></div>";
          return $displayPrevious; 
          
     } 
	 else 
	 { 
          return "<< Previous Page";   
     } 
} 

function retrieve_car_count() 
{ 
   $countQuery = "SELECT count(CARID) as carCount FROM tblCAR" ; 
	
     $countResult = mysql_query($countQuery); 

     return mysql_result($countResult,0,"carCount"); 

} 

?>

