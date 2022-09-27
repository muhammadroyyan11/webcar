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
<title>CAR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
</style>
</head>
<?php
$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;    
$offsetOriginal = $offset; 

/*
$form = "<form method=\"POST\" action=\"guest.php\">";
$form .= "<table class =\"style1\" align=\"center\">";
$form .= "<tr>";
$form .= "<td>Number</td><td><select name=\"inum1\"><option value=\"\"></option>";
$sin = "select IssNumber from tblCAR";
$sinResult = mysql_query($sin);
if($sinResult)
{
	while($ri = mysql_fetch_array($sinResult))
	{
		$in = $ri['IssNumber'];
		$form .= "<option value=\"$in\">$in</option>";
	}
}
$form .= "</select></td>";
$form .= "</tr>";
$form .= "<tr>";
$form .= "<td>Status</td><td>";
$form .= "<select name=\"stat\"><option value=\"\" selected></option><option value=\"open\">open</option><option value=\"closed\">close</option>";
$form .= "</select></td>";
$form .= "</tr>";
$form .= "<tr>";
$form .= "</tr>";
$form .= "<input type=\"hidden\" name=\"what\" value=\"search\">";
$form .= "<input type=\"hidden\" name=\"group\" value=\"$group\"><input type=\"hidden\" name=\"id\" value=\"$id\">";
$form .= "<tr><td></td><td><input type=\"submit\" value=\"Search\"></td></tr>";
$form .= "</table>";
$form .= "</form>";
print $form;

$form1 = "<form method=\"POST\" action=\"guest.php\" align=\"center\">";
$form1 .= "<table class=\"style1\" align =\"center\"><tr><td>Dept</td><td>";
$form1 .= "<select name=\"sdept\"><option value=\"\"></option>";
		
		$gam = "select distinct AMID from tblCAR";
		$gamResult = mysql_query($gam);
		if($gamResult)
		{
			while($ra = mysql_fetch_array($gamResult))
			{
				$ai = $ra['AMID'];
				$sda = "select DeptID from tblMUAccount where MUserID=$ai";
				$sdar = mysql_query($sda);
				while($ra1 = mysql_fetch_array($sdar))
				{
					$sdar1 = $ra1['DeptID'];
					$gd = "select DeptID,DeptName from tblDept where DeptID = $sdar1";
					$gdResult = mysql_query($gd);
					if($gdResult)
					{
					while($r = mysql_fetch_array($gdResult))
					{
						$did = $r['DeptID'];
						$dn = $r['DeptName'];
						if($sdar1 == $did)
						{
							$form1 .= "<option value=\"$did\">$dn</option>";
						}
					}
					}

				}
			}//close while($ra = mysql_fetch_array($gamResult))
		} //close if($gamResult)
		

$form1 .= "<input type=\"hidden\" name=\"sort\" value=\"sort\">";
$form1 .= "<input type=\"hidden\" name=\"group\" value=\"$group\"><input type=\"hidden\" name=\"id\" value=\"$id\">";
$form1 .= "</select></td><td><br/><input type=\"submit\" value=\"Sort\"></form></td></tr></table>";

print $form1;
*/
			if(isset($_POST['what']))
			{
			
			if($_POST['what'] == "search")
			{
				$inum1 = $_POST['inum1'];
				$stat = $_POST['stat'];
				$category = $_POST['category'];
				$catid   = $_POST['catid'];								
				
				$inum1    .= "%";
				$stat     .= "%";
				$category .= "%";
				$catid    .= "%";
				
				
	   	 		$select1 = "SELECT A.* FROM tblCAR as A INNER JOIN tblcardtl2 as B ON A.IssNumber=B.IssNumber ";
				$select1 .= " WHERE A.IssNumber like '$inum1' And A.CARStatus like '$stat' and B.Category like '$category' And B.CatID like '$catid' ";		   
				$select1 .= " ORDER BY A.CARID DESC ";
				
			/*
	   	 		$select1 = "SELECT * FROM tblCAR";
				if(($_POST['inum1'] != "") && ($_POST['stat'] != ""))
				{
					$select1 .=" WHERE IssNumber='$inum1' AND CARStatus = '$stat'";
				}
				
				//inum is not empty
				if(($_POST['inum1'] != "") && ($_POST['stat'] == ""))
				{
					$select1 .=" WHERE IssNumber='$inum1'";
				}
				
				//status is not empty
				if(($_POST['inum1'] == "") && ($_POST['stat'] != ""))
				{
					$select1 .=" WHERE CARStatus = '$stat'";
				}
				
				
             		$select1 .= " ORDER BY CARID DESC";
			*/
			}
    	}
        elseif(isset($_POST['sort']))
		{
			if($_POST['sort'] == "sort")
			{
				$select1 = "select * from tblCAR ORDER BY CARID DESC";
			}
		}
		else
		{
			$select1 = "select * from tblCAR ORDER BY CARID DESC LIMIT $offset,30";
		}
		
$select1Result = mysql_query($select1);
if($select1Result)
{
$totalRows = mysql_num_rows($select1Result);
}
$display = "";
	
	if($select1Result)
	{
	
	    if($totalRows != 0)
		{
			$display = "<div style=\"width: 275px; height: 500px;overflow: auto; padding: 5px\"><table align = \"center\" border = \"0\" class=\"tbl\"><tr><th class =\"t2\">CAR Number</th><th class =\"t2\"></th><th class =\"t2\"></th></tr>";
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
			//$topic = $row['CTopic'];
			//$percent = $row['Percent'];
		
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
			
			$display .= "<form method=\"post\" action=\"guest.php\">";
		    $display .= "<tr align = \"left\">";
		    $display .= "<td class=\"t1\">$issNumber</td>";
			$display .= "<input type=\"hidden\" name=\"sdept\" value=\"$sdept\">";
			$display .= "<input type=\"hidden\" name=\"sort\" value=\"sort\">";
		    $display .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		    $display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		    $display .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
		    $display .= "<input type=\"hidden\" name=\"action\" value=\"vd\">";
		    $display .= "<td class=\"t1\"><input type =\"submit\" value=\"Details\"></td>";
			if($afid != "")
						{
							$display .= "<td class=\"t1\"><img src=\"paper-clip.jpg\"></td>";
						}
						else
						{
						$display .= "<td class=\"t1\"></td>";
						}
		    $display .= "</tr>";
		   $display .= "</form><p></p>";
			}
			}
		}	
		else
		{
		$display .= "<form method=\"post\" action=\"guest.php\">";
		$display .= "<tr align = \"center\">";
		
		$display .= "<td class=\"t1\">$issNumber</td>";
		$display .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		$display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		$display .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
		$display .= "<input type=\"hidden\" name=\"action\" value=\"vd\">";
		if(isset($_POST['what']))
			{
				if($_POST['what'] == "search")
				{
					$display .= "<input type=\"hidden\" name=\"what\" value=\"search\">";
					$display .= "<input type=\"hidden\" name=\"stat\" value=\"$stat\">";
		            $display .= "<input type=\"hidden\" name=\"inum1\" value=\"$inum1\">";
					$display .= "<input type=\"hidden\" name=\"category\" value=\"$category\">";
					$display .= "<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
				}
			}
			
		$display .= "<td class=\"t1\"><input type =\"submit\" value=\"Details\"></td>";
		if($afid != "")
						{
							$display .= "<td class=\"t1\"><img src=\"paper-clip.jpg\"></td>";
						}
						else
						{
						$display .= "<td class=\"t1\"></td>";
						}
		$display .= "</tr>";
		$display .= "</form><p></p>";
		
		$offset++;
		}
		}
		$display .= "</table><p></p>"; 
		if($totalRows == 0)
		{
		print "<p align =\"center\" class = \"style2\"> CAR is not found</center></p>";
		} 
		
   		if($display !="")
   		{
    		print $display; 
 		}
	}
	
	if((!isset($_POST['what']))&&(!isset($_POST['sort']))) // page is not in search mode or sort mode
	{
		
		
		print "<p class=\"style1\" align=\"center\">";
		 
		print previous_page($offset, $totalRows); 
		
		print "</p><p class=\"style1\" align=\"center\">";
     
        print next_page($offset);
		
		print "</p>"; 
		
		
	}
	else
	{

?>

<p></p>
 <table border="0" align ="center">
     <tr>
       <td><form name="form2" method="post" action="guest.php">
	   <input type="hidden" name="group" value="<?php echo $group; ?>">
	   <input type="hidden" name="id" value="<?php echo $id; ?>">
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


function next_page($offset)  
{ 
     $group = $_POST['group'];
	 $id = $_POST['id'];
	 $carCount = retrieve_car_count();
     if ($offset < $carCount) 
	 { 
	      $displayNext = "<p></p>";
          $displayNext .= "<form name=\"form1\" method=\"post\" action=\"guest.php\">";
		  $displayNext .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayNext .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		  $displayNext .= "<input type=\"hidden\" name=\"offset\" value=\"$offset\">";
		  $displayNext .= "<input type=\"submit\" name=\"Submit\" value=\"Next Page\">";
		  $displayNext .= "</form>";
          return $displayNext; 
     } 
	 else 
	 { 
          return "Next Page";   
     } 
} 

function previous_page($offset, $totalRows)  
{ 

     $group = $_POST['group'];
	 $id = $_POST['id'];
	 if ($offset - $totalRows > 0)  
     { 
          $offset = $offset - $totalRows -30; 
          
          $displayPrevious = "<form name=\"form1\" method=\"post\" action=\"guest.php\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"offset\" value=\"$offset\">";
		  $displayPrevious .= "<input type=\"submit\" name=\"Submit\" value=\"Previous Page\">";
		  $displayPrevious .= "</form>";
          return $displayPrevious; 
          
     } 
	 else 
	 { 
          return "Previous Page";   
     } 
} 

function retrieve_car_count() 
{ 
   $id = $_POST['id'];
   $countQuery = "SELECT count(CARID) as carCount FROM tblCAR"; 
	
     $countResult = mysql_query($countQuery); 

     return mysql_result($countResult,0,"carCount"); 

} 

?>

</body>
</html>
