<?php

/* 
*****************************
* Programmer : Milda Ifan   *
* Date Created : April 2006 *
*****************************
*/

 
if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{

if($_POST['month'] == 1)
{
$m = "January";
}
elseif($_POST['month'] == 2)
{
$m = "February";
}
elseif($_POST['month'] == 3)
{
$m = "March";
}
elseif($_POST['month'] == 4)
{
$m = "April";
}
elseif($_POST['month'] == 5)
{
$m = "May";
}
elseif($_POST['month'] == 6)
{
$m = "June";
}
elseif($_POST['month'] == 7)
{
$m = "July";
}
elseif($_POST['month'] == 8)
{
$m = "August";
}
elseif($_POST['month'] == 9)
{
$m = "September";
}
elseif($_POST['month'] == 10)
{
$m = "October";
}
elseif($_POST['month'] == 11)
{
$m = "November";
}
elseif($_POST['month'] == 12)
{
$m = "December";
}
else
{
$m = "";
}

if($_POST['month1'] == 1)
{
$m1 = "January";
}
elseif($_POST['month1'] == 2)
{
$m1 = "February";
}
elseif($_POST['month1'] == 3)
{
$m1 = "March";
}
elseif($_POST['month1'] == 4)
{
$m1 = "April";
}
elseif($_POST['month1'] == 5)
{
$m1 = "May";
}
elseif($_POST['month1'] == 6)
{
$m1 = "June";
}
elseif($_POST['month1'] == 7)
{
$m1 = "July";
}
elseif($_POST['month1'] == 8)
{
$m1 = "August";
}
elseif($_POST['month1'] == 9)
{
$m1 = "September";
}
elseif($_POST['month1'] == 10)
{
$m1 = "October";
}
elseif($_POST['month1'] == 11)
{
$m1 = "November";
}
elseif($_POST['month1'] == 12)
{
$m1 = "December";
}
else
{
$m1 = "";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CAR Periodical Report </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: small;
}
.style2 {font-family: Arial, Helvetica, sans-serif;
font-size:24px;
font-weight:bold}
-->
</style>
</head>
<?php
$group = $_POST['group'];
$id = $_POST['id'];

$date_array =getdate(); 
foreach($date_array as $key => $val)
{
 	$key = $val;
}

if($_POST['month'] != "")
{
$mth = $_POST['month'];
}
else
{
$mth = "";
}
if($_POST['month1'] != "")
{
$mth1 = $_POST['month1'];
}
else
{
$mth1 = "";
}

if($_POST['year'] != "")
{
$yr = $_POST['year'];
}
else
{
$yr = $date_array['year'];
}



include ("conn.php");

?>
<body>

<div align="center">

  
  <p class="style2">CAR Periodical Report <?php echo $m; ?> 
  <?php
  if($m1 != "")
  {
  print " to ".$m1;
  }
  ?>
   <?php echo $yr;?></p>
  <?php
$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;    
$offsetOriginal = $offset; 
$count = 0;



print "<br/>";



			if(isset($_POST['what']))
			{
			
			if($_POST['what'] == "search")
			{
								$idate = $_POST['idate'];
				if(isset($_POST['imonth']))
				{
					$imonth = $_POST['imonth'];
					if($imonth != "") //search by $imonth
					{
						$sm = $imonth;
					}
				}
				
				else //search by $mth
				{
				$sm = $mth;
				}
				
				if($_POST['stat'] != "")
				{
				$stat = $_POST['stat'];
				}
				
				
		
		
	   	 		$select1 = "SELECT * FROM tblCAR";
				if(($_POST['stat'] != "")&&($_POST['idate'] != "")&&($_POST['imonth'] != ""))
				{
					$select1 .=" WHERE CARStatus = '$stat' AND IssDate = $idate AND IssMonth = $sm AND IssYear = $yr ";
				}
				
				//stat is not empty
				if(($_POST['stat'] != "")&&($_POST['idate'] == "")&&($_POST['imonth'] == ""))
				{
					$select1 .=" WHERE CARStatus = '$stat' AND IssYear = $yr ";
				}
				
				//idate is not empty
				if(($_POST['stat'] == "")&&($_POST['idate'] != "")&&($_POST['imonth'] == ""))
				{
					$select1 .=" WHERE IssDate = $idate AND IssYear = $yr ";
				}
				
				//imonth is not empty
				
				if(($_POST['stat'] == "")&&($_POST['idate'] == "")&&($_POST['imonth'] != ""))
				{
					$select1 .=" WHERE IssMonth = $sm AND IssYear = $yr ";
				}
				
				//stat and idate are not empty
				if(($_POST['stat'] != "")&&($_POST['idate'] != "")&&($_POST['imonth'] == ""))
				{
					$select1 .=" WHERE CARStatus = '$stat' AND IssDate = $idate AND IssYear = $yr ";
				}
				
				//stat and imonth are not empty
				if(($_POST['stat'] != "")&&($_POST['idate'] == "")&&($_POST['imonth'] != ""))
				{
					$select1 .=" WHERE CARStatus = '$stat' AND IssMonth = $sm AND IssYear = $yr ";
				}
				
				//idate and imonth are not empty
				if(($_POST['stat'] == "")&&($_POST['idate'] != "")&&($_POST['imonth'] != ""))
				{
					$select1 .=" WHERE IssDate = $idate AND IssMonth = $sm AND IssYear = $yr ";
				}
				
             		
						$select1 .= " ORDER BY AMID DESC ";
					
					
			}
    	}//close if(isset($_POST['what']))
        
		elseif(isset($_POST['sort']))
		{
			if($_POST['sort'] == "sort")
			{
				if($mth == "")
				{
					$select1 = "select * from tblCAR where IssYear = $yr order by AMID DESC ";
				}
			    else
				{
					if($mth1 != "")
					{
						$select1 = "select * from tblCAR where IssMonth between $mth and $mth1 and IssYear = $yr order by AMID DESC";
					}
					else
					{
					$select1 = "select * from tblCAR where IssMonth = $mth and IssYear = $yr order by AMID DESC";
					}
				}
			}
		}
        elseif(isset($_POST['sortso']))
		{
			if($_POST['sortso'] == "sortso")
			{
				if($mth == "")
				{
					$select1 = "select * from tblCAR where IssYear = $yr order by AMID DESC ";
				}
			    else
				{
					if($mth1 != "")
					{
						$select1 = "select * from tblCAR where IssMonth between $mth and $mth1 and IssYear = $yr order by AMID DESC";
					}
					else
					{
						$select1 = "select * from tblCAR where IssMonth = $mth and IssYear = $yr order by AMID DESC";
					}
					
				}
			}
		}
		
		else
		{
			if($mth == "")
			{
				$select1 = "select * from tblCAR where IssYear = $yr order by AMID DESC LIMIT $offset,25";
			}
			else
			{
				if($mth1 != "")
				{
				$select1 = "select * from tblCAR where IssMonth between $mth and $mth1 and IssYear = $yr order by AMID DESC LIMIT $offset,25";
				}
				else
				{
				$select1 = "select * from tblCAR where IssMonth = $mth and IssYear = $yr order by AMID DESC LIMIT $offset,25";
				}
				
			}
			
		}
		
       $totalRows = 0;		
       $select1Result = mysql_query($select1);
       if($select1Result)
       {
   			$totalRows = mysql_num_rows($select1Result);
			
		}
		
	
	$display2 = "";
	
	if($select1Result)
	{
	$gtotal = 0;
	    if($totalRows != 0)
		{
			$display2 = "<table align = \"center\" border = \"3\" class =\"style1\"><tr><th>In Charge Dept.</th><th>CAR Number</th><th>Originator</th><th>PIC</th><th>Status</th>";//<th>Code</th>";
			//$display2 .= "<th>ISO Ref</th><th>Category</th><th>PIC1</th><th>PIC2</th>";
			//$display2 .= "<th>PIC3</th><th>PIC4</th><th>PIC5</th><th>PIC6</th>";
			$display2 .= "</tr>";
			
		}
	     
		while($row = mysql_fetch_array($select1Result))
		{
		
			
			$issNumber = $row['IssNumber'];
			$issDate = $row['IssDate'];
			$issMonth = $row['IssMonth'];
			$issYear = $row['IssYear'];
			$status = $row['CARStatus'];
			$osid = $row['OSID'];
			$omid = $row['OMID'];
			$amid = $row['AMID'];
		
			$dnpic = "";
		$rp = "";
		$pn = "";
		
		$sp ="select distinct PICID from tblPIC where IssNumber = '$issNumber'";
		$spr = mysql_query($sp);
	    if($spr)
			{
			
			while($rpic = mysql_fetch_array($spr))
			{
		     	
				$rp = $rpic['PICID'];
				
				$sp1 = "select * from tblMUAccount where MUserID = $rp";
				$spr1 = mysql_query($sp1);
				
				if($spr1)
				{
						
						while($rpic1 = mysql_fetch_array($spr1))
						{
							$pn = $rpic1['Name'];
						}
					}//close if($spr1)
				}
			}//close if($spr)
		
			$getosn = "select Name from tblMUAccount where MUserID = $osid";
			$getosnr = mysql_query($getosn);
			if($getosnr)
			{
				while($rosn = mysql_fetch_array($getosnr))
				{
					$osname = $rosn['Name'];
				}
			}
			
		    $select2 ="select * from tblMUAccount where MUserID = $amid";
			$select2Result = mysql_query($select2);
			if($select2Result)
			{
				while($row1 = mysql_fetch_array($select2Result))
				{
		    		$amid2 = $row1['MUserID'];
					$amDept = $row1['DeptID'];
					
					//get departemen name
					 $deptName = "";
			    $getDept = "select DeptName from tblDept where DeptID = $amDept";
				$getDeptResult = mysql_query($getDept);
				if($getDeptResult)
				{
					while($row2 = mysql_fetch_array($getDeptResult))
					{
					$deptName = $row2['DeptName'];
					}
				}
				}
					
			}//close if($select2Result)
			
			$select22 ="select * from tblMUAccount where MUserID = $omid";
			$select22Result = mysql_query($select22);
			if($select22Result)
			{
				while($row122 = mysql_fetch_array($select22Result))
				{
		    		$omid2 = $row122['MUserID'];
					$omDept = $row122['DeptID'];
					
					//get departemen name
					 $deptName22 = "";
			    $getDept22 = "select DeptName from tblDept where DeptID = $omDept";
				$getDeptResult22 = mysql_query($getDept22);
				if($getDeptResult22)
				{
					while($row222 = mysql_fetch_array($getDeptResult22))
					{
					$deptName22 = $row222['DeptName'];
					}
				}
				}
					
			}//close if($select22Result)
			
			 
			if(isset($_POST['sort'])) //process form 1
			{
			
				if($_POST['sort'] == "sort")
				{
					$sdept = $_POST['sdept'];
					if($sdept == $amDept)
					{
						$count++;
						$c = 0;
			           
			$count1 = "select count(CARDTLID2) as codeCount from tblCARDTL2 where IssNumber = '$issNumber'";
			$c3 = mysql_query($count1); 
			$c4 = mysql_result($c3,0,"codeCount");
			$c4 = $c4 + 1;
			
			$display2 .= "<tr align = \"center\"><td valign=\"top\" rowspan=\"2\">$deptName</td><td valign=\"top\" rowspan=\"$c4\">$issNumber</td><td valign=\"top\" rowspan=\"$c4\">$osname</td><td valign=\"top\" rowspan=\"$c4\">$pn</td><td valign=\"top\" rowspan=\"$c4\">$status</td>";
			 
			$select3 = "select * from tblCARDTL2 where IssNumber='$issNumber'"; 
			$select3Result = mysql_query($select3);
			if($select3Result)
			{
				while($row3 = mysql_fetch_array($select3Result))
				{
					$c++;
					$cardtlid2 = $row3['CARDTLID2'];
					/*
					$code = $row3['Code'];
					if($code == "n/a")
					{
						$code = "";
					}
					*/
					$findings = $row3['Findings'];
					if($findings == "n/a")
					{
						$findings = "";
					}
					$analysis = $row3['Analysis'];
					if($analysis == "n/a")
					{
						$analysis = "";
					}
					/*
					$corrAct = $row3['CorrAct'];
					if($corrAct == "n/a")
					{
						$corrAct = "";
					}
					*/
					$dDate = $row3['DDate'];
					$dMonth = $row3['DMonth'];
					$dYear = $row3['DYear'];
					if(($dDate != 0)&&($dMonth != 0)&&($dYear != 0))
					{
						$dueDate = $dDate."/".$dMonth."/".$dYear;
					}
					else
					{
						$dueDate = "";
					}
				
					/*
					$carStatus = $row3['CARStatus'];
					
					$dInspect = $row3['DInspect'];
					$mInspect = $row3['MInspect'];
					$yInspect = $row3['YInspect'];
					if(($dInspect != 0)&&($mInspect != 0)&&($yInspect != 0))
					{
						$dateInspect = $dInspect."/".$mInspect."/".$yInspect;
					}
					else
					{
						$dateInspect = "";
					}
				*/
					$remark = $row3['Remark'];
					if($remark == "n/a")
					{
						$remark = "";
					}
					/*
					$cDate = $row3['ClosedDate'];
					$cMonth = $row3['ClosedMonth'];
					$cYear = $row3['ClosedYear'];
					if(($cDate != 0)&&($cMonth != 0)&&($cYear != 0))
					{
						$closedDate =$cDate."/".$cMonth."/".$cYear;
					}
					else
					{
						$closedDate = "";
					}
				*/
					$iso = $row3['ISORef'];
					if($iso == "n/a")
					{
					$iso = "";
					}
					$category = $row3['Category'];
					if($category == "n/a")
					{
					$category = "";
					}
					/*
					$pic1 = $row3['PICID1'];
					$pic2 = $row3['PICID2'];
					$pic3 = $row3['PICID3'];
					$pic4 = $row3['PICID4'];
					$pic5 = $row3['PICID5'];
					$pic6 = $row3['PICID6'];
					$pic7 = $row3['PICID7'];
					$pic8 = $row3['PICID8'];
					$pic9 = $row3['PICID9'];
					$pic10 = $row3['PICID10'];
					$pupdate = $row3['PUpdate'];
                	$dupdate = $row3['DUpdate']; 
                	$mupdate = $row3['MUpdate']; 
                	$yupdate = $row3['YUpdate']; 
				*/
				
				$display2 .= "<form method=\"post\" action=\"printreportdtl.php\">";
				/*$display2 .= "<td>$iso</td><td>$category</td>";
				
				$full1 = "";
				$full2 = "";
				$full3 = "";
				$full4 = "";
				$full5 = "";
				$full6 = "";
				$full7 = "";
				$full8 = "";
				$full9 = "";
				$full10 = "";
				$s1 = "";
				$s2 = "";
				$s3 = "";
				$s4 = "";
				$s5 = "";
				$s6 = "";
				$s7 = "";
				$s8 = "";
				$s9 = "";
				$s10 = "";
				
				if($pic1 != 0)//get pic name and section
				{
				$select9 ="select Name,Section from tblMUAccount where MUserID = $pic1";
				
				
				$select9Result = mysql_query($select9);
					while($row4 = mysql_fetch_array($select9Result))
					{
						$full1 = $row4['Name'];
						$s1 = $row4['Section'];
					}
				}
				
				if($pic2 != 0)//get pic name and section
				{
				$select10 ="select Name,Section from tblMUAccount where MUserID = $pic2";
				$select10Result = mysql_query($select10);
					while($row5 = mysql_fetch_array($select10Result))
					{
						$full2 = $row5['Name'];
						$s2 = $row5['Section'];
					}
				}
				
				if($pic3 != 0)//get pic name and section
				{
				$select11 ="select Name,Section from tblMUAccount where MUserID = $pic3";
				$select11Result = mysql_query($select11);
					while($row6 = mysql_fetch_array($select11Result))
					{
						$full3 = $row6['Name'];
						$s3 = $row6['Section'];
					}
				}
				
				if($pic4 != 0)//get pic name and section
				{
				$select12 ="select Name,Section from tblMUAccount where MUserID = $pic4";
				$select12Result = mysql_query($select12);
					while($row7 = mysql_fetch_array($select12Result))
					{
						$full4 = $row7['Name'];
						$s4 = $row7['Section'];
					}
				}
				
				if($pic5 != 0)//get pic name and section
				{
				$select13 ="select Name,Section from tblMUAccount where MUserID = $pic5";
				$select13Result = mysql_query($select13);
					while($row8 = mysql_fetch_array($select13Result))
					{
						$full5 = $row8['Name'];
						$s5 = $row8['Section'];
					}
				}
				
				if($pic6 != 0)//get pic name and section
				{
				$select14 ="select Name,Section from tblMUAccount where MUserID = $pic6";
				$select14Result = mysql_query($select14);
					while($row9 = mysql_fetch_array($select14Result))
					{
						$full6 = $row9['Name'];
						$s6 = $row9['Section'];
					}
				}
				
				if($pic7 != 0)//get pic name and section
				{
				$select15 ="select Name,Section from tblMUAccount where MUserID = $pic7";
				$select15Result = mysql_query($select15);
					while($row10 = mysql_fetch_array($select15Result))
					{
						$full7 = $row10['Name'];
						$s7 = $row10['Section'];
					}
				}
				
				if($pic8 != 0)//get pic name and section
				{
				$select16 ="select Name,Section from tblMUAccount where MUserID = $pic8";
				$select16Result = mysql_query($select16);
					while($row11 = mysql_fetch_array($select16Result))
					{
						$full8 = $row11['Name'];
						$s8 = $row11['Section'];
					}
				}
				
				if($pic9 != 0)//get pic name and section
				{
				$select17 ="select Name,Section from tblMUAccount where MUserID = $pic9";
				$select17Result = mysql_query($select17);
					while($row12 = mysql_fetch_array($select17Result))
					{
						$full9 = $row12['Name'];
						$s9 = $row12['Section'];
					}
				}
				
				if($pic10 != 0)//get pic name and section
				{
				$select18 ="select Name,Section from tblMUAccount where MUserID = $pic10";
				$select18Result = mysql_query($select18);
					while($row13 = mysql_fetch_array($select18Result))
					{
						$full10 = $row13['Name'];
						$s10 = $row13['Section'];
					}
				}
				
				if($full1 != "")
				{
				$display2 .= "<td>$full1<br/>$s1</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full2 != "")
				{
				$display2 .= "<td>$full2<br/>$s2</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full3 != "")
				{
				$display2 .= "<td>$full3<br/>$s3</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full4 != "")
				{
				$display2 .= "<td>$full4<br/>$s4</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full5 != "")
				{
				$display2 .= "<td>$full5<br/>$s5</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full6 != "")
				{
				$display2 .= "<td>$full6<br/>$s6</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				
				if($full7 != "")
				{
				$display2 .= "<td>$full7<br/>$s7</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full8 != "")
				{
				$display2 .= "<td>$full8<br/>$s8</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full9 != "")
				{
				$display2 .= "<td>$full9<br/>$s9</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full10 != "")
				{
				$display2 .= "<td>$full10<br/>$s10</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				*/
				$display2 .= "<td><input type=\"submit\" value=\"Details\">";
				$display2 .= "<input type=\"hidden\" name=\"sdept\" value=\"$sdept\">";
				$display2 .= "<input type=\"hidden\" name=\"sort\" value=\"sort\">";
				$display2 .= "<input type=\"hidden\" name=\"cardtlid2\" value=\"$cardtlid2\">";
				$display2 .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
				$display2 .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$display2 .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
                $display2 .= "<input type=\"hidden\" name=\"month\" value=\"$mth\"><input type=\"hidden\" name=\"month1\" value=\"$mth1\">";
				$display2 .= "<input type=\"hidden\" name=\"dtl\" value=\"dtl\">";
				$display2 .= "<input type=\"hidden\" name=\"year\" value=\"$yr\"></td></tr></form>";
				
				} //close while($row3 = mysql_fetch_array($select3Result))
				$display2 .= "<td align=\"right\">Total : $c</td>";
				$gtotal = $gtotal + $c; 
			}//close if($select3Result)
	
		
			        }
			    }
		  }	//close if(isset($_POST['sort']))
		  elseif(isset($_POST['sortso'])) //process form 2
			{
			
				if($_POST['sortso'] == "sortso")
				{
					$sodept = $_POST['sodept'];
					if($sodept == $omDept)
					{
						$count++;
						$c = 0;
			           
			$count2 = "select count(CARDTLID2) as codeCount from tblCARDTL2 where IssNumber = '$issNumber'";
			$c4 = mysql_query($count2); 
			$c5 = mysql_result($c4,0,"codeCount");
			$c5 = $c5 + 1;
			
			$display2 .= "<tr align = \"center\"><td valign=\"top\" rowspan=\"2\">$deptName</td><td valign=\"top\" rowspan=\"$c5\">$issNumber</td><td valign=\"top\" rowspan=\"$c5\">$osname</td><td valign=\"top\" rowspan=\"$c5\">$pn</td><td valign=\"top\" rowspan=\"$c5\">$status</td>";
			 
			$select3 = "select * from tblCARDTL2 where IssNumber='$issNumber'"; 
			$select3Result = mysql_query($select3);
			if($select3Result)
			{
				while($row3 = mysql_fetch_array($select3Result))
				{
					$c++;
					$cardtlid2 = $row3['CARDTLID2'];
					/*
					$code = $row3['Code'];
					if($code == "n/a")
					{
						$code = "";
					}
					*/
					$findings = $row3['Findings'];
					if($findings == "n/a")
					{
						$findings = "";
					}
					$analysis = $row3['Analysis'];
					if($analysis == "n/a")
					{
						$analysis = "";
					}
					/*
					$corrAct = $row3['CorrAct'];
					if($corrAct == "n/a")
					{
						$corrAct = "";
					}
					*/
					$dDate = $row3['DDate'];
					$dMonth = $row3['DMonth'];
					$dYear = $row3['DYear'];
					if(($dDate != 0)&&($dMonth != 0)&&($dYear != 0))
					{
						$dueDate = $dDate."/".$dMonth."/".$dYear;
					}
					else
					{
						$dueDate = "";
					}
				
					/*
					$carStatus = $row3['CARStatus'];
					
					$dInspect = $row3['DInspect'];
					$mInspect = $row3['MInspect'];
					$yInspect = $row3['YInspect'];
					if(($dInspect != 0)&&($mInspect != 0)&&($yInspect != 0))
					{
						$dateInspect = $dInspect."/".$mInspect."/".$yInspect;
					}
					else
					{
						$dateInspect = "";
					}
				*/
					$remark = $row3['Remark'];
					if($remark == "n/a")
					{
						$remark = "";
					}
					/*
					$cDate = $row3['ClosedDate'];
					$cMonth = $row3['ClosedMonth'];
					$cYear = $row3['ClosedYear'];
					if(($cDate != 0)&&($cMonth != 0)&&($cYear != 0))
					{
						$closedDate =$cDate."/".$cMonth."/".$cYear;
					}
					else
					{
						$closedDate = "";
					}
				*/
					$iso = $row3['ISORef'];
					if($iso == "n/a")
					{
					$iso = "";
					}
					$category = $row3['Category'];
					if($category == "n/a")
					{
					$category = "";
					}
					
					/*
					$pic1 = $row3['PICID1'];
					$pic2 = $row3['PICID2'];
					$pic3 = $row3['PICID3'];
					$pic4 = $row3['PICID4'];
					$pic5 = $row3['PICID5'];
					$pic6 = $row3['PICID6'];
					$pic7 = $row3['PICID7'];
					$pic8 = $row3['PICID8'];
					$pic9 = $row3['PICID9'];
					$pic10 = $row3['PICID10'];
					$pupdate = $row3['PUpdate'];
                	$dupdate = $row3['DUpdate']; 
                	$mupdate = $row3['MUpdate']; 
                	$yupdate = $row3['YUpdate']; 
				*/
				
				$display2 .= "<form method=\"post\" action=\"printreportdtl.php\">";
				/*$display2 .= "<td align=\"center\">$iso</td><td align=\"center\">$category</td>";
				
				$full1 = "";
				$full2 = "";
				$full3 = "";
				$full4 = "";
				$full5 = "";
				$full6 = "";
				$full7 = "";
				$full8 = "";
				$full9 = "";
				$full10 = "";
				$s1 = "";
				$s2 = "";
				$s3 = "";
				$s4 = "";
				$s5 = "";
				$s6 = "";
				$s7 = "";
				$s8 = "";
				$s9 = "";
				$s10 = "";
				
				if($pic1 != 0)//get pic name and section
				{
				$select9 ="select Name,Section from tblMUAccount where MUserID = $pic1";
				
				
				$select9Result = mysql_query($select9);
					while($row4 = mysql_fetch_array($select9Result))
					{
						$full1 = $row4['Name'];
						$s1 = $row4['Section'];
					}
				}
				
				if($pic2 != 0)//get pic name and section
				{
				$select10 ="select Name,Section from tblMUAccount where MUserID = $pic2";
				$select10Result = mysql_query($select10);
					while($row5 = mysql_fetch_array($select10Result))
					{
						$full2 = $row5['Name'];
						$s2 = $row5['Section'];
					}
				}
				
				if($pic3 != 0)//get pic name and section
				{
				$select11 ="select Name,Section from tblMUAccount where MUserID = $pic3";
				$select11Result = mysql_query($select11);
					while($row6 = mysql_fetch_array($select11Result))
					{
						$full3 = $row6['Name'];
						$s3 = $row6['Section'];
					}
				}
				
				if($pic4 != 0)//get pic name and section
				{
				$select12 ="select Name,Section from tblMUAccount where MUserID = $pic4";
				$select12Result = mysql_query($select12);
					while($row7 = mysql_fetch_array($select12Result))
					{
						$full4 = $row7['Name'];
						$s4 = $row7['Section'];
					}
				}
				
				if($pic5 != 0)//get pic name and section
				{
				$select13 ="select Name,Section from tblMUAccount where MUserID = $pic5";
				$select13Result = mysql_query($select13);
					while($row8 = mysql_fetch_array($select13Result))
					{
						$full5 = $row8['Name'];
						$s5 = $row8['Section'];
					}
				}
				
				if($pic6 != 0)//get pic name and section
				{
				$select14 ="select Name,Section from tblMUAccount where MUserID = $pic6";
				$select14Result = mysql_query($select14);
					while($row9 = mysql_fetch_array($select14Result))
					{
						$full6 = $row9['Name'];
						$s6 = $row9['Section'];
					}
				}
				
				if($pic7 != 0)//get pic name and section
				{
				$select15 ="select Name,Section from tblMUAccount where MUserID = $pic7";
				$select15Result = mysql_query($select15);
					while($row10 = mysql_fetch_array($select15Result))
					{
						$full7 = $row10['Name'];
						$s7 = $row10['Section'];
					}
				}
				
				if($pic8 != 0)//get pic name and section
				{
				$select16 ="select Name,Section from tblMUAccount where MUserID = $pic8";
				$select16Result = mysql_query($select16);
					while($row11 = mysql_fetch_array($select16Result))
					{
						$full8 = $row11['Name'];
						$s8 = $row11['Section'];
					}
				}
				
				if($pic9 != 0)//get pic name and section
				{
				$select17 ="select Name,Section from tblMUAccount where MUserID = $pic9";
				$select17Result = mysql_query($select17);
					while($row12 = mysql_fetch_array($select17Result))
					{
						$full9 = $row12['Name'];
						$s9 = $row12['Section'];
					}
				}
				
				if($pic10 != 0)//get pic name and section
				{
				$select18 ="select Name,Section from tblMUAccount where MUserID = $pic10";
				$select18Result = mysql_query($select18);
					while($row13 = mysql_fetch_array($select18Result))
					{
						$full10 = $row13['Name'];
						$s10 = $row13['Section'];
					}
				}
				
				if($full1 != "")
				{
				$display2 .= "<td align=\"center\">$full1<br/>$s1</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full2 != "")
				{
				$display2 .= "<td align=\"center\">$full2<br/>$s2</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full3 != "")
				{
				$display2 .= "<td align=\"center\">$full3<br/>$s3</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full4 != "")
				{
				$display2 .= "<td align=\"center\">$full4<br/>$s4</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full5 != "")
				{
				$display2 .= "<td align=\"center\">$full5<br/>$s5</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full6 != "")
				{
				$display2 .= "<td align=\"center\">$full6<br/>$s6</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				
				if($full7 != "")
				{
				$display2 .= "<td align=\"center\">$full7<br/>$s7</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full8 != "")
				{
				$display2 .= "<td align=\"center\">$full8<br/>$s8</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full9 != "")
				{
				$display2 .= "<td align=\"center\">$full9<br/>$s9</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full10 != "")
				{
				$display2 .= "<td align=\"center\">$full10<br/>$s10</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				*/
				
				$display2 .= "<td><input type=\"submit\" value=\"Details\">";
				$display2 .= "<input type=\"hidden\" name=\"sodept\" value=\"$sodept\">";
				$display2 .= "<input type=\"hidden\" name=\"sortso\" value=\"sortso\">";
				$display2 .= "<input type=\"hidden\" name=\"cardtlid2\" value=\"$cardtlid2\">";
				$display2 .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
				$display2 .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$display2 .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
                $display2 .= "<input type=\"hidden\" name=\"month\" value=\"$mth\"><input type=\"hidden\" name=\"month1\" value=\"$mth1\">";
				$display2 .= "<input type=\"hidden\" name=\"dtl\" value=\"dtl\">";
				$display2 .= "<input type=\"hidden\" name=\"year\" value=\"$yr\"></td></tr></form>";
				
				} //close while($row3 = mysql_fetch_array($select3Result))
				$display2 .= "<td colspan =\"14\" align=\"right\">Total : $c</td>";
				$gtotal = $gtotal + $c; 
			}//close if($select3Result)
			
	        else
			{
			print mysql_error(); 
			}
		
			        }
					
			    }
				
		  }	//close if(isset($_POST['sort']))
		  
		   else
		   {
			$c = 0;
			
			if(isset($_POST['srch']))
			{
			
			if($_POST['srch'] == "srch")
			{
				/*
				if(isset($_POST['scode']))
				{
				$scode1 = $_POST['scode'];
				}
				else
				{
				$scode1 = "";
				}
				*/
				if(isset($_POST['scat']))
				{
				$scat1 = $_POST['scat'];
				}
				else
				{
				$scat1 = "";
				}
				if(isset($_POST['siso']))
				{
				$siso1 = $_POST['siso'];
				}
				else
				{
				$siso1 = "";
				}
                
	   	 		$count = "SELECT count(CARDTLID2) as codeCount FROM tblCARDTL2";
				if(($_POST['siso'] != "")&&($_POST['scat'] != ""))
				{
					$count .=" WHERE ISORef = '$siso1' AND Category = '$scat1' AND IssNumber='$issNumber'";
				}
				
				
				//iso ref is not empty
				if(($_POST['siso'] != "")&&($_POST['scat'] == ""))
				{
					$count .=" WHERE ISORef = '$siso1' AND IssNumber='$issNumber'";
				}
				
				// category is not empty
				if(($_POST['siso'] == "")&&($_POST['scat'] != ""))
				{
					$count .=" WHERE Category = '$scat1' AND IssNumber='$issNumber'";
				}
				
				if(($_POST['siso'] == "")&&($_POST['scat'] == ""))
				{
					$count .=" WHERE IssNumber='$issNumber'";
				}
				
             		
			}
    	}//close if(isset($_POST['srch']))
		else
		{
			$count = "select count(CARDTLID2) as codeCount from tblCARDTL2 where IssNumber = '$issNumber'";
		}
			$c1 = mysql_query($count); 
			$c2 = mysql_result($c1,0,"codeCount");
			$c2 = $c2 + 1;
			
			
			
			$display2 .= "<tr align = \"center\"><td valign=\"top\" rowspan=\"2\">$deptName</td><td  valign=\"top\" rowspan=\"$c2\">$issNumber</td><td  valign=\"top\" rowspan=\"$c2\">$osname</td><td valign=\"top\" rowspan=\"$c2\">$pn</td><td valign=\"top\" rowspan=\"$c2\">$status</td>"; 
			 
			if(isset($_POST['srch']))
			{
			
			if($_POST['srch'] == "srch")
			{
				/*
				if(isset($_POST['scode']))
				{
				$scode = $_POST['scode'];
				}
				else
				{
				$scode = "";
				}
				*/
				if(isset($_POST['scat']))
				{
				$scat = $_POST['scat'];
				}
				else
				{
				$scat = "";
				}
				if(isset($_POST['siso']))
				{
				$siso = $_POST['siso'];
				}
				else
				{
				$siso = "";
				}
                
	   	 		$select3 = "SELECT * FROM tblCARDTL2";
				if(($_POST['siso'] != "")&&($_POST['scat'] != ""))
				{
					$select3 .=" WHERE ISORef = '$siso' AND Category = '$scat' AND IssNumber='$issNumber'";
				}
				
				//iso ref is not empty
				if(($_POST['siso'] != "")&&($_POST['scat'] == ""))
				{
					$select3 .=" WHERE ISORef = '$siso' AND IssNumber='$issNumber'";
				}
				
				// category is not empty
				if(($_POST['siso'] == "")&&($_POST['scat'] != ""))
				{
					$select3 .=" WHERE Category = '$scat' AND IssNumber='$issNumber'";
				}
				
				
				
				
				//iso ref and category are empty
				if(($_POST['siso'] == "")&&($_POST['scat'] == ""))
				{
					$select3 .=" WHERE IssNumber='$issNumber'";
				}
				
				
             		
			}
    	}//close if(isset($_POST['srch']))
		else
		{ 
			$select3 = "select * from tblCARDTL2 where IssNumber='$issNumber'"; 
		}
			$select3Result = mysql_query($select3);
			if($select3Result)
			{
				while($row3 = mysql_fetch_array($select3Result))
				{
					$c++;
					$cardtlid2 = $row3['CARDTLID2'];
					/*
					$code = $row3['Code'];
					if($code == "n/a")
					{
						$code = "";
					}
					*/
					$findings = $row3['Findings'];
					if($findings == "n/a")
					{
						$findings = "";
					}
					$analysis = $row3['Analysis'];
					if($analysis == "n/a")
					{
						$analysis = "";
					}
					/*
					$corrAct = $row3['CorrAct'];
					if($corrAct == "n/a")
					{
						$corrAct = "";
					}
					*/
					$dDate = $row3['DDate'];
					$dMonth = $row3['DMonth'];
					$dYear = $row3['DYear'];
					if(($dDate != 0)&&($dMonth != 0)&&($dYear != 0))
					{
						$dueDate = $dDate."/".$dMonth."/".$dYear;
					}
					else
					{
						$dueDate = "";
					}
				
				/*
					$carStatus = $row3['CARStatus'];
					$dInspect = $row3['DInspect'];
					$mInspect = $row3['MInspect'];
					$yInspect = $row3['YInspect'];
					if(($dInspect != 0)&&($mInspect != 0)&&($yInspect != 0))
					{
						$dateInspect = $dInspect."/".$mInspect."/".$yInspect;
					}
					else
					{
						$dateInspect = "";
					}
				*/
					$remark = $row3['Remark'];
					if($remark == "n/a")
					{
						$remark = "";
					}
					/*
					$cDate = $row3['ClosedDate'];
					$cMonth = $row3['ClosedMonth'];
					$cYear = $row3['ClosedYear'];
					if(($cDate != 0)&&($cMonth != 0)&&($cYear != 0))
					{
						$closedDate =$cDate."/".$cMonth."/".$cYear;
					}
					else
					{
						$closedDate = "";
					}
					*/
				
					$iso = $row3['ISORef'];
					if($iso == "n/a")
					{
					$iso = "";
					}
					$category = $row3['Category'];
					if($category == "n/a")
					{
					$category = "";
					}
					
					/*
					$pic1 = $row3['PICID1'];
					$pic2 = $row3['PICID2'];
					$pic3 = $row3['PICID3'];
					$pic4 = $row3['PICID4'];
					$pic5 = $row3['PICID5'];
					$pic6 = $row3['PICID6'];
					$pic7 = $row3['PICID7'];
					$pic8 = $row3['PICID8'];
					$pic9 = $row3['PICID9'];
					$pic10 = $row3['PICID10'];
					$pupdate = $row3['PUpdate'];
                	$dupdate = $row3['DUpdate']; 
                	$mupdate = $row3['MUpdate']; 
                	$yupdate = $row3['YUpdate']; 
				*/
				
				$display2 .= "<form method=\"post\" action=\"printreportdtl.php\">";
				//$display2 .= "<td align=\"center\">$iso</td><td align=\"center\">$category</td>";
				/*
				$full1 = "";
				$full2 = "";
				$full3 = "";
				$full4 = "";
				$full5 = "";
				$full6 = "";
				$full7 = "";
				$full8 = "";
				$full9 = "";
				$full10 = "";
				$s1 = "";
				$s2 = "";
				$s3 = "";
				$s4 = "";
				$s5 = "";
				$s6 = "";
				$s7 = "";
				$s8 = "";
				$s9 = "";
				$s10 = "";
				
				if($pic1 != 0)//get pic name and section
				{
				$select9 ="select Name,Section from tblMUAccount where MUserID = $pic1";
				
				
				$select9Result = mysql_query($select9);
					while($row4 = mysql_fetch_array($select9Result))
					{
						$full1 = $row4['Name'];
						$s1 = $row4['Section'];
					}
				}
				
				if($pic2 != 0)//get pic name and section
				{
				$select10 ="select Name,Section from tblMUAccount where MUserID = $pic2";
				$select10Result = mysql_query($select10);
					while($row5 = mysql_fetch_array($select10Result))
					{
						$full2 = $row5['Name'];
						$s2 = $row5['Section'];
					}
				}
				
				if($pic3 != 0)//get pic name and section
				{
				$select11 ="select Name,Section from tblMUAccount where MUserID = $pic3";
				$select11Result = mysql_query($select11);
					while($row6 = mysql_fetch_array($select11Result))
					{
						$full3 = $row6['Name'];
						$s3 = $row6['Section'];
					}
				}
				
				if($pic4 != 0)//get pic name and section
				{
				$select12 ="select Name,Section from tblMUAccount where MUserID = $pic4";
				$select12Result = mysql_query($select12);
					while($row7 = mysql_fetch_array($select12Result))
					{
						$full4 = $row7['Name'];
						$s4 = $row7['Section'];
					}
				}
				
				if($pic5 != 0)//get pic name and section
				{
				$select13 ="select Name,Section from tblMUAccount where MUserID = $pic5";
				$select13Result = mysql_query($select13);
					while($row8 = mysql_fetch_array($select13Result))
					{
						$full5 = $row8['Name'];
						$s5 = $row8['Section'];
					}
				}
				
				if($pic6 != 0)//get pic name and section
				{
				$select14 ="select Name,Section from tblMUAccount where MUserID = $pic6";
				$select14Result = mysql_query($select14);
					while($row9 = mysql_fetch_array($select14Result))
					{
						$full6 = $row9['Name'];
						$s6 = $row9['Section'];
					}
				}
				
				
				if($pic7 != 0)//get pic name and section
				{
				$select15 ="select Name,Section from tblMUAccount where MUserID = $pic7";
				$select15Result = mysql_query($select15);
					while($row10 = mysql_fetch_array($select15Result))
					{
						$full7 = $row10['Name'];
						$s7 = $row10['Section'];
					}
				}
				
				if($pic8 != 0)//get pic name and section
				{
				$select16 ="select Name,Section from tblMUAccount where MUserID = $pic8";
				$select16Result = mysql_query($select16);
					while($row11 = mysql_fetch_array($select16Result))
					{
						$full8 = $row11['Name'];
						$s8 = $row11['Section'];
					}
				}
				
				if($pic9 != 0)//get pic name and section
				{
				$select17 ="select Name,Section from tblMUAccount where MUserID = $pic9";
				$select17Result = mysql_query($select17);
					while($row12 = mysql_fetch_array($select17Result))
					{
						$full9 = $row12['Name'];
						$s9 = $row12['Section'];
					}
				}
				
				if($pic10 != 0)//get pic name and section
				{
				$select18 ="select Name,Section from tblMUAccount where MUserID = $pic10";
				$select18Result = mysql_query($select18);
					while($row13 = mysql_fetch_array($select18Result))
					{
						$full10 = $row13['Name'];
						$s10 = $row13['Section'];
					}
				}
				
				
				if($full1 != "")
				{
				$display2 .= "<td align=\"center\">$full1<br/>$s1</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full2 != "")
				{
				$display2 .= "<td align=\"center\">$full2<br/>$s2</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full3 != "")
				{
				$display2 .= "<td align=\"center\">$full3<br/>$s3</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full4 != "")
				{
				$display2 .= "<td align=\"center\">$full4<br/>$s4</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full5 != "")
				{
				$display2 .= "<td align=\"center\">$full5<br/>$s5</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full6 != "")
				{
				$display2 .= "<td align=\"center\">$full6<br/>$s6</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				
				if($full7 != "")
				{
				$display2 .= "<td align=\"center\">$full7<br/>$s7</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full8 != "")
				{
				$display2 .= "<td align=\"center\">$full8<br/>$s8</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full9 != "")
				{
				$display2 .= "<td align=\"center\">$full9<br/>$s9</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				if($full10 != "")
				{
				$display2 .= "<td align=\"center\">$full10<br/>$s10</td>";
				}
				else
				{
				$display2 .= "<td></td>";
				}
				*/
				
				$display2 .= "<td><input type=\"submit\" value=\"Details\">";
				if(isset($_POST['srch']))
				{
				$display2 .= "<input type=\"hidden\" name=\"srch\" value=\"srch\">";
				//$display2 .= "<input type=\"hidden\" name=\"scode\" value=\"$scode\">";
				$display2 .= "<input type=\"hidden\" name=\"siso\" value=\"$siso\">";
				$display2 .= "<input type=\"hidden\" name=\"scat\" value=\"$scat\">";
				}
				$display2 .= "<input type=\"hidden\" name=\"cardtlid2\" value=\"$cardtlid2\">";
				$display2 .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
				$display2 .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
				$display2 .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
                $display2 .= "<input type=\"hidden\" name=\"month\" value=\"$mth\"><input type=\"hidden\" name=\"month1\" value=\"$mth1\">";
				$display2 .= "<input type=\"hidden\" name=\"dtl\" value=\"dtl\">";
				$display2 .= "<input type=\"hidden\" name=\"year\" value=\"$yr\"></td></tr></form>";
				
				} //close while($row3 = mysql_fetch_array($select3Result))
				$display2 .= "<td align=\"right\">Total : $c</td>";
				$gtotal = $gtotal + $c;
			}//close if($select3Result)
			
			$offset++; 
		} //close else 
		
		} //close while($row = mysql_fetch_array($select1Result))
		
		
		$display2 .= "<tr><td align=\"right\" colspan=\"11\">grandtotal : $gtotal</td></tr></table>"; 
		
		}
		
		
   		if($display2 !="")
   		{
    		print $display2; 
			
 		}
	
	
	if((!isset($_POST['what']))&&(!isset($_POST['sort']))&&(!isset($_POST['sortso']))&&(!isset($_POST['srch']))) // page is not in search mode or sort mode
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
 
   <?php
   }
   print "<br/>";
  // if(isset($_POST['dtl']))
//{
//include("printreportdtl.php");
//}

   ?>



</div>

</body>
</html>
<?php
}

function next_page($offset)  
{ 
     $group = $_POST['group'];
	 $id = $_POST['id'];
	 $mth = $_POST['month'];
	 $yr = $_POST['year'];
	 $mth1 = $_POST['month1'];
	 
	 $carCount = retrieve_car_count();
     if ($offset < $carCount) 
	 { 
	      $displayNext = "<div align=\"center\">";
          $displayNext .= "<table width=\"1\" border=\"0\"><tr>";
          $displayNext .= "<td><form name=\"form1\" method=\"post\" action=\"printreport.php\">";
		  $displayNext .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayNext .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		  $displayNext .= "<input type=\"hidden\" name=\"month\" value=\"$mth\"><input type=\"hidden\" name=\"month1\" value=\"$mth1\">";
		  $displayNext .= "<input type=\"hidden\" name=\"year\" value=\"$yr\">";
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
	 $id = $_POST['id'];
	 $mth = $_POST['month'];
	 $mth1 = $_POST['month1'];
	 $yr = $_POST['year'];
	 if ($offset - $totalRows > 0)  
     { 
          $offset = $offset - $totalRows -25; 
		  $displayPrevious = "<div align=\"center\">";
          $displayPrevious .= "<table width=\"1\" border=\"0\"><tr>";
          $displayPrevious .= "<td><form name=\"form1\" method=\"post\" action=\"printreport.php\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"month\" value=\"$mth\"><input type=\"hidden\" name=\"month1\" value=\"$mth1\">";
		  $displayPrevious .= "<input type=\"hidden\" name=\"year\" value=\"$yr\">";
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
   $date_array =getdate(); 
foreach($date_array as $key => $val)
{
 	$key = $val;
}

if($_POST['month'] != "")
{
$mth = $_POST['month'];
}
else
{
$mth = $date_array['mon'];
}
if($_POST['month1'] != "")
{
$mth1 = $_POST['month1'];
}
else
{
$mth1 = "";
}

if($_POST['year'] != "")
{
$yr = $_POST['year'];
}
else
{
$yr = $date_array['year'];;
}

if($mth == "")
{
	$countQuery = "select count(CARID) as carCount from tblCAR where IssYear = $yr order by CARID";
}
else
{
	if($mth1 != "")
	{
			$countQuery = "select count(CARID) as carCount from tblCAR where IssMonth between $mth and $mth1 and IssYear = $yr";
	}
	else
	{
		   $countQuery = "select count(CARID) as carCount from tblCAR where IssMonth = $mth and IssYear = $yr";
	}
	
}
    $countResult = mysql_query($countQuery); if(!$countResult){print $countQuery;}
    return mysql_result($countResult,0,"carCount"); 
} 


?>

