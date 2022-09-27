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
<title><?php echo $_POST['inum'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif;
font-size:12px}
.style2 {font-family: Arial, Helvetica, sans-serif;
font-size:18px;
font-weight:bold}
-->
</style>
<?php
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['inum'])or($_POST['inum'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$group = $_POST['group'];
$inum = $_POST['inum'];
$id11 = $_POST['id'];
$mth = $_POST['month'];
$yr = $_POST['year'];
$cardtlid2 = $_POST['cardtlid2'];
$dtl = $_POST['dtl'];
$mth1 = $_POST['month1'];

include ("conn.php");

$select1 = "select * from tblCAR where IssNumber = '$inum'";
$select1Result = mysql_query($select1);

	if($select1Result)
	{
		while($row = mysql_fetch_array($select1Result))
		{
		$issNumber1 = $row['IssNumber'];
?>


</head>

<body>
<form name="form1" method="post" action="report.php">
  
  <?php
  if(isset($_POST['sort']))
  {
  $sdept = $_POST['sdept'];
  ?>
  <input type="hidden" name="sort" value="sort">
  <input type="hidden" name="sdept" value="<?php echo $sdept; ?>">
  <?php
  }
  if(isset($_POST['sortso']))
  {
  $sodept = $_POST['sodept'];
  ?>
  <input type="hidden" name="sortso" value="sortso">
  <input type="hidden" name="sodept" value="<?php echo $sodept; ?>">
  <?php
  }
  if(isset($_POST['srch']))
  {
  //$scode = $_POST['scode'];
  $siso = $_POST['siso'];
  $scat = $_POST['scat'];
  ?>
  
  <input type="hidden" name="srch" value="srch">
  <!--<input type="hidden" name="scode" value="<?php //echo $scode;?>">-->
  <input type="hidden" name="siso" value="<?php echo $siso;?>">
  <input type="hidden" name="scat" value="<?php echo $scat;?>">
  <?php
  }
  ?>
  <input type="hidden" name="group" value="<?php echo $group;?>">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
		  <input type="hidden" name="month" value="<?php echo $mth;?>">
		  <input type="hidden" name="month1" value="<?php echo $mth1;?>">
		  <input type="hidden" name="year" value="<?php echo $yr;?>">
		  <input type="submit" name="Submit" value="back">
</form><br/>
		
<?php
		}
	}
		


		
	        $select6 = "select * from tblCARDTL2 where IssNumber ='$issNumber1' and CARDTLID2 = $cardtlid2";
			$select6Result = mysql_query($select6);
			if($select6Result)
			{
			$display2 = "<table border=\"0\" class=\"tbl\" align=\"left\">";
			/*
			$display2 = "<thead class=\"\"><tr><th class = \"t2\">Code</th><th class = \"t2\">Findings</th><th class = \"t2\">Analysis</th><th class = \"t2\">Corrective Action</th><th class = \"t2\">Due Date</th><th class = \"t2\">Status</th>";
			$display2 .= "<th class = \"t2\">Date Inspected</th><th class = \"t2\">Remark</th><th class = \"t2\">Closed Date</th><th class = \"t2\">ISO Ref</th><th class = \"t2\">Category</th>";
			$display2 .= "<th class = \"t2\">PIC1</th>";
		    $display2 .= "<th class = \"t2\">PIC2</th>";
			$display2 .= "<th class = \"t2\">PIC3</th>";
			$display2 .= "<th class = \"t2\">PIC4</th>";
			$display2 .= "<th class = \"t2\">PIC5</th>";
			$display2 .= "<th class = \"t2\">PIC6</th>";
			
			$display2 .= "<th class = \"t2\">PIC7</th>";
			$display2 .= "<th class = \"t2\">PIC8</th>";
			$display2 .= "<th class = \"t2\">PIC9</th>";
			$display2 .= "<th class = \"t2\">PIC10</th>";
			
			$display2 .= "<th class = \"t2\">Update By</th>";
			$display2 .= "<th class = \"t2\">Date</th>";
			$display2 .= "</tr></thead><tbody class=\"\">";
			*/
			while($row = mysql_fetch_array($select6Result))
			{

				$cardtlid2 = $row['CARDTLID2'];
				/*
				$code = $row['Code'];
				if($code == "n/a")
				{
				$code = "";
				}
				*/
				$findings = $row['Findings'];
				if($findings == "n/a")
				{
				$findings = "";
				}
				$analysis = $row['Analysis'];
				if($analysis == "n/a")
				{
				$analysis = "";
				}
				/*
				$corrAct = $row['CorrAct'];
				if($corrAct == "n/a")
				{
				$corrAct = "";
				}
				*/
				$dDate = $row['DDate'];
				$dMonth = $row['DMonth'];
				$dYear = $row['DYear'];
				if(($dDate != 0)&&($dMonth != 0)&&($dYear != 0))
				{
					$dueDate = $dDate."/".$dMonth."/".$dYear;
				}
				else
				{
					$dueDate = "";
				}
				/*
				$carStatus = $row['CARStatus'];
				$dInspect = $row['DInspect'];
				$mInspect = $row['MInspect'];
				$yInspect = $row['YInspect'];
				if(($dInspect != 0)&&($mInspect != 0)&&($yInspect != 0))
				{
					$dateInspect = $dInspect."/".$mInspect."/".$yInspect;
				}
				else
				{
					$dateInspect = "";
				}
				*/
				$remark = $row['Remark'];
				if($remark == "n/a")
				{
				$remark = "";
				}
				/*
				$cDate = $row['ClosedDate'];
				$cMonth = $row['ClosedMonth'];
				$cYear = $row['ClosedYear'];
				if(($cDate != 0)&&($cMonth != 0)&&($cYear != 0))
				{
					$closedDate =$cDate."/".$cMonth."/".$cYear;
				}
				else
				{
					$closedDate = "";
				}
				*/
				$iso = $row['ISORef'];
				if($iso == "n/a")
				{
				$iso = "";
				}
				$category = $row['Category'];
				if($category == "n/a")
				{
				$category = "";
				}
				/*
				$pic1 = $row['PICID1'];
				$pic2 = $row['PICID2'];
				$pic3 = $row['PICID3'];
				$pic4 = $row['PICID4'];
				$pic5 = $row['PICID5'];
				$pic6 = $row['PICID6'];
				
				$pic7 = $row['PICID7'];
				$pic8 = $row['PICID8'];
				$pic9 = $row['PICID9'];
				$pic10 = $row['PICID10'];
				*/
				$pupdate = $row['PUpdate'];
                $dupdate = $row['DUpdate']; 
                $mupdate = $row['MUpdate']; 
                $yupdate = $row['YUpdate']; 
				
				$display2 .= "<tr valign=\"top\" align = \"center\"><td colspan = \"2\" class = \"t2\">$inum</td>";
				$display2 .= "<td class = \"t2\">Findings</td>";
				$display2 .= "<td class = \"t2\">Analysis</td>";
				$display2 .= "<td class = \"t2\">Corrective Action</td>";
				//$display2 .= "<td class = \"t2\">Date Inspected</td><td class = \"t1\">$dateInspect</td>";
				$display2 .= "</tr><tr valign=\"top\"><td class = \"t2\">Due Date</td><td class = \"t1\">$dueDate</td>";
				$display2 .= "<td  valign=\"top\" rowspan=\"6\" width=\"500\" class = \"t1\">$findings</td>";
				$display2 .= "<td  valign=\"top\" rowspan=\"6\" width=\"500\" class = \"t1\">$analysis</td>";
				$display2 .= "<td  valign=\"top\" rowspan=\"6\" class = \"t1\"><table width =\"350\" border = \"1\">";
				$caid11 = "";
				$gca1 = "select CAID from tblCA where CDTL2 = $cardtlid2";
				$gcar1 = mysql_query($gca1);
				if($gcar1)
				{
				while($check1 = mysql_fetch_array($gcar1))
				{
				$caid11 = $check1['CAID'];
				}
				if($caid11 != "")
				{
				$display2 .= "<tr><th>Activity</th><th>Team</th><th>Status</th><th>Closed Date</th></tr>";
				}
				}
				
				
				
				
				$gca = "select * from tblCA where CDTL2 = $cardtlid2";
				$gcar = mysql_query($gca);
				while($rca = mysql_fetch_array($gcar))
				{
					$ac = "";
				    $db = "";
				    $cas = "";
				    $cad = "";
				    $camth = "";
				    $cayr = "";
				    $cafd = "";
					$ac = $rca['Activity'];
					$db = $rca['DoneBy'];
					$cas = $rca['CAStatus'];
					$cad = $rca['CADate'];
					$camth = $rca['CAMonth'];
					$cayr = $rca['CAYear'];
					if(($cad != "")&&($camth != "")&&($cayr != ""))
					{
						$cafd = $cad."/".$camth."/".$cayr;
					}
					$gdb = "select Name from tblMUAccount where MUserID = $db";
					$gdbr = mysql_query($gdb);
					if($gdbr)
					{
						while($rdb = mysql_fetch_array($gdbr))
						{
							$dbnm = $rdb['Name'];
						}
					}
					
					$display2 .= "<tr><td valign=\"top\">$ac</td><td valign=\"top\">$dbnm</td><td valign=\"top\">$cas</td><td valign=\"top\">";
					if($cas == "closed")
					{
					$display2 .= "$cafd";
					}
					$display2 .= "</td></tr>";
					
				}
				
				$display2 .= "</table>";
				$display2 .= "</td>";
				$display2 .= "<tr  valign=\"top\"><td class = \"t2\">Follow Up By Originator </td><td class = \"t1\">$remark</td></tr>";
				//$display2 .= "<tr  valign=\"top\"><td class = \"t2\">Closed Date</td><td class = \"t1\">$closedDate</td></tr>";
				$display2 .= "<tr  valign=\"top\"><td class = \"t2\">ISO Ref </td><td class = \"t1\">$iso</td></tr>";
				$display2 .= "<tr valign=\"top\"><td class = \"t2\">Category</td><td class = \"t1\">$category</td></tr>";
				$display2 .= "<tr  valign=\"top\"><td class = \"t2\">Last Updated By</td>";
				
				$pf = "";
				if($pupdate != "")
				{
				$gp ="select Name from tblMUAccount where MUserID = $pupdate";
				$gpResult = mysql_query($gp);
				while($rowgp = mysql_fetch_array($gpResult))
				{
						$pf = $rowgp['Name'];
				}
				}
				
				if($pf != "")
				{
					$display2 .= "<td  valign=\"top\" class = \"t1\">$pf</td></tr>";
				}
				else
				{
					$display2 .= "<td  valign=\"top\" class = \"t1\"></td></tr>";
				}
				
				$display2 .= "<tr  valign=\"top\"><td class = \"t2\">Date :</td>";
				if(($dupdate != "")&&($mupdate != "")&&($yupdate != ""))
				{
					$ldate = $dupdate."/".$mupdate."/".$yupdate;
					$display2 .= "<td  valign=\"top\" class = \"t1\">$ldate</td></tr>";
				}
				else
				{
					$display2 .= "<td  valign=\"top\" class = \"t1\"></td></tr>";
				}
				
				
				
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
				
				
				if($pic1 != 0)//get pic name
				{
				$select9 ="select Name from tblMUAccount where MUserID = $pic1";
				
				
				$select9Result = mysql_query($select9);
					while($row2 = mysql_fetch_array($select9Result))
					{
						$full1 = $row2['Name'];
					}
				}
				
				if($pic2 != 0)//get pic name
				{
				$select10 ="select Name from tblMUAccount where MUserID = $pic2";
				$select10Result = mysql_query($select10);
					while($row3 = mysql_fetch_array($select10Result))
					{
						$full2 = $row3['Name'];
					}
				}
				
				if($pic3 != 0)//get pic name
				{
				$select11 ="select Name from tblMUAccount where MUserID = $pic3";
				$select11Result = mysql_query($select11);
					while($row4 = mysql_fetch_array($select11Result))
					{
						$full3 = $row4['Name'];
					}
				}
				
				if($pic4 != 0)//get pic name
				{
				$select12 ="select Name from tblMUAccount where MUserID = $pic4";
				$select12Result = mysql_query($select12);
					while($row5 = mysql_fetch_array($select12Result))
					{
						$full4 = $row5['Name'];
					}
				}
				
				if($pic5 != 0)//get pic name
				{
				$select13 ="select Name from tblMUAccount where MUserID = $pic5";
				$select13Result = mysql_query($select13);
					while($row6 = mysql_fetch_array($select13Result))
					{
						$full5 = $row6['Name'];
					}
				}
				
				if($pic6 != 0)//get pic name
				{
				$select14 ="select Name from tblMUAccount where MUserID = $pic6";
				$select14Result = mysql_query($select14);
					while($row7 = mysql_fetch_array($select14Result))
					{
						$full6 = $row7['Name'];
					}
				}
				
				/*
				if($pic7 != 0)//get pic name
				{
				$select15 ="select Name from tblMUAccount where MUserID = $pic7";
				$select15Result = mysql_query($select15);
					while($row8 = mysql_fetch_array($select15Result))
					{
						$full7 = $row8['Name'];
					}
				}
				
				
				if($pic8 != 0)//get pic name
				{
				$select16 ="select Name from tblMUAccount where MUserID = $pic8";
				$select16Result = mysql_query($select16);
					while($row9 = mysql_fetch_array($select16Result))
					{
						$full8 = $row9['Name'];
					}
				}
				
				if($pic9 != 0)//get pic name
				{
				$select17 ="select Name from tblMUAccount where MUserID = $pic9";
				$select17Result = mysql_query($select17);
					while($row10 = mysql_fetch_array($select17Result))
					{
						$full9 = $row10['Name'];
					}
				}
				
				if($pic10 != 0)//get pic name
				{
				$select18 ="select Name from tblMUAccount where MUserID = $pic10";
				$select18Result = mysql_query($select18);
					while($row11 = mysql_fetch_array($select18Result))
					{
						$full10 = $row11['Name'];
					}
				}
				
				
				if($full1 != "")
				{
				$display2 .= "<td class = \"t1\">$full1</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full2 != "")
				{
				$display2 .= "<td class = \"t1\">$full2</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full3 != "")
				{
				$display2 .= "<td class = \"t1\">$full3</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full4 != "")
				{
				$display2 .= "<td class = \"t1\">$full4</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full5 != "")
				{
				$display2 .= "<td class = \"t1\">$full5</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full6 != "")
				{
				$display2 .= "<td class = \"t1\">$full6</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				/*
				if($full7 != "")
				{
				$display2 .= "<td>$full7</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full8 != "")
				{
				$display2 .= "<td>$full8</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full9 != "")
				{
				$display2 .= "<td>$full9</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				if($full10 != "")
				{
				$display2 .= "<td>$full10</td>";
				}
				else
				{
				$display2 .= "<td class = \"t1\"></td>";
				}
				*/
				
				
				
			}
			$display2 .="</table>";
			
			
			//print "<div style=\"width: 900px; height: 150px;overflow: auto; padding: 5px\">".$display2."</div><br/>";
			print $display2;
		}	
		
		

?>


</center>
</body>
</html>
<?php
}
?>

