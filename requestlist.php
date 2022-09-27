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
<title>CAR Request List</title>
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
td.t1{background-color:#669900; color:#FFFFFF; font-size:small; font-family:Arial, Helvetica, sans-serif;}
th.t2{background-color:#CCCC00; color:#FFFFFF; font-size:small; font-family:Arial, Helvetica, sans-serif;}
td.t2{background-color:#CCCC00; color:#FFFFFF; font-size:small; font-family:Arial, Helvetica, sans-serif;}
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

		if(isset($_POST['what']))
		{
			
			if($_POST['what'] == "delete")
   			{
            	$rid1 = $_POST['rid'];
				$delete = "DELETE FROM tblRequest WHERE RequestID = $rid1";
		    	$delqry = mysql_query($delete);
		    	if ($delqry) 
				{
				
						print "<p class = \"style2\" align=\"center\">Selected CAR Request has been deleted</p>";
				}

		}//close if($_POST['what'] == "delete")
		} //close if(isset($_POST['what']))
		

?>
<body>
<table width="80" border="0" align="center">
    <tr>
      <td width="74"><form name="form1" method="post" action="admin.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
    </tr>
</table>
<div align="center">

  
  <?php
$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;    
$offsetOriginal = $offset; 
$count = 0;

			$select1 = "select * from tblRequest ORDER BY RequestID DESC LIMIT $offset,30";
		
       $totalRows = 0;		
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
			$display = "<table align = \"center\" class =\"tbl\"><tr><th class=\"t2\">Request Date</th><th class=\"t2\">To</th><th class=\"t2\">CC</th>";
			$display .= "<th class=\"t2\">BCC</th><th class=\"t2\">From</th><th class=\"t2\">Findings</th><th></th></tr>";
		}
	     
		while($row = mysql_fetch_array($select1Result))
		{
		
			$rid = $row['RequestID'];
			$rto = $row['RTo'];
			$rfrom = $row['RFrom'];
			$rbcc = $row['RBCC'];
			$rcc = $row['RCC'];
			$fdg = $row['RFindings'];
			$rd = $row['RDate'];
			$rm = $row['RMonth'];
			$ry = $row['RYear'];
			$requestDate = $rd."/".$rm."/".$ry;
			
		    $mcc = "";
			$gmcc = "select DeptMngr from tblDept where DeptID = $rcc";
			$gmccr = mysql_query($gmcc);
			if($gmccr)
			{
				while($rmcc = mysql_fetch_array($gmccr))
				{
					$mcc = $rmcc['DeptMngr'];
				}
			}
			
			$mbcc = "";
			$gmbcc = "select DeptMngr from tblDept where DeptID = $rbcc";
			$gmbccr = mysql_query($gmbcc);
			if($gmbccr)
			{
				while($rmbcc = mysql_fetch_array($gmbccr))
				{
					$mbcc = $rmbcc['DeptMngr'];
				}
			}
			
			
			
		        $display .= "<form method=\"post\" action=\"requestlist.php\">";
				$display .= "<tr align = \"center\">";
				$display .= "<td class=\"t1\">$requestDate</td>";
				$display .= "<td class=\"t1\">$rto</td>";
				$display .= "<td class=\"t1\">$mcc</td>";
				$display .= "<td class=\"t1\">$mbcc</td>";
				$display .= "<td class=\"t1\">$rfrom</td>";
				$display .= "<td class=\"t1\">$fdg</td>";
				$display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$display .= "<input type=\"hidden\" name=\"rid\" value=\"$rid\">";
				$display .= "<input type=\"hidden\" name=\"what\" value=\"delete\">";
				$display .= "<td class=\"t1\"><input type =\"submit\" value=\"delete\"></td>";
				$display .= "</tr>";
				$display .= "</form>";
				$offset++;
		
		
		}
		
		$display .= "</table>"; 
		
		}
		
		
   		if($display !="")
   		{
    		print "<div style=\"width: 900px; height: 500px;overflow: auto; padding: 5px\">".$display; 
 		}
	
	
	
		print "<p></p>"; 
		print "<center class =\"style1\">";
		print previous_page($offset, $totalRows);  
        print "<br />"; 
        print next_page($offset); 
		print "</center>";
	

?>
</head>

<body>

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
          $displayNext .= "<td><form name=\"form1\" method=\"post\" action=\"requestlist.php\">";
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
          $offset = $offset - $totalRows -30; 
		  $displayPrevious = "<div align=\"center\">";
          $displayPrevious .= "<table width=\"1\" border=\"0\"><tr>";
          $displayPrevious .= "<td><form name=\"form1\" method=\"post\" action=\"requestlist.php\">";
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
   $countQuery = "SELECT count(RequestID) as requestCount FROM tblRequest" ; 
	
     $countResult = mysql_query($countQuery); 

     return mysql_result($countResult,0,"requestCount"); 

} 

?>


