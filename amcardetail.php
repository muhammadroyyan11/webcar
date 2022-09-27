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
<LINK  href="tbldesign.css" rel="stylesheet" type="text/css">

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

include ("conn.php");

$form3 = "<form name=\"form1\" target =\"blank\" method=\"post\" action=\"dtl1.php\">";
$form3 .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
$form3 .= "<input type=\"hidden\" name=\"id\" value=\"$id11\">";
$form3 .= "<input type=\"hidden\" name=\"inum\" value=\"$inum\">";
$form3 .= "<input type=\"hidden\" name=\"action\" value=\"vd\">";
$form3 .=  "<input type=\"submit\" name=\"Submit\" value=\"Print Version\">";
$form3 .= "</form>";

/*
if(isset($_POST['what']))
{
	if($_POST['what'] == "update")
	{
		$amstatus = $_POST['amstatus'];
		$reason = $_POST['reason'];
		
		if($amstatus == "rejected")
		{
			$r = "am";
		}
		else
		{
			$r = "";
		}
		
		$update = "update tblCAR set AMStat = '$amstatus',RejectReason='$reason',RejectBy='$r' where IssNumber='$inum'";
		$updateResult = mysql_query($update);
		if($updateResult)
		{
			print "<p class=\"style2\">In Charge Manager status has been updated</p>";
		}
		else
		{
			print mysql_error();
			
		
		}
	}
}
*/

$select1 = "select * from tblCAR where IssNumber = '$inum'";
$select1Result = mysql_query($select1);

	if($select1Result)
	{
		while($row = mysql_fetch_array($select1Result))
		{
		
		$carid = $row['CARID'];
		$issNumber1 = $row['IssNumber'];
		$issDate = $row['IssDate'];
		$issMonth = $row['IssMonth'];
		$issYear = $row['IssYear'];
		$status = $row['CARStatus'];
		$osid1 = $row['OSID'];
		$omid1 = $row['OMID'];
		$amid1 = $row['AMID'];
		$osStat = $row['OSStat'];
		$omStat = $row['OMStat'];
		$amStat = $row['AMStat'];
		$issuedDate = $issDate."/".$issMonth."/".$issYear;
		$reason = $row['RejectReason'];
		$cdate1 = $row['CDate'];
		$cmonth1 = $row['CMonth'];
		$cyear1 = $row['CYear'];
		$fcdate = $cdate1."/".$cmonth1."/".$cyear1;
		$topic = $row['CTopic'];
		$percent = $row['Percent'];
		$by = $row['RejectBy'];
?>

</head>

<body>
<table border="0" class="style1">
    <tr>
	<td><?php print $form3;?></td>
     <td><form name="form1" method="post" action="am.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		 <input type="hidden" name="id" value="<?php echo $id11; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
	  </tr>
	  <tr>
	<!--
      <td width="261"><form name="form2" method="post" action="amcardetail.php">
	    <p>
          <input type="hidden" name="group" value="<?php //echo $group; ?>">
		 <input type="hidden" name="id" value="<?php// echo $id11; ?>">
		<input type="hidden" name="what" value="update">
	  <input type="hidden" name="inum" value="<?php //echo $issNumber1; ?>">
	        <b>Action :</b> 
	        <select name="amstatus">
	          <option value="approved">approve</option>
	          <option value="rejected">reject</option>
	          </select>
</p>
	    <p>Reason  :(if reject)
	      <textarea name="reason" cols="50"></textarea> 
    	    </p>
	    <p>            <input type="submit" name="Submit2" value="Submit">
            </p>
      </form></td>
	 -->
    </tr>
</table>
<table><tr><td valign="top">
<table border="0" class="tbl">
          
         <tr>
            <td class = "t2"><strong>CAR Number : </strong></td>
            <td class = "t1"><?php echo $issNumber1; ?></td>
          </tr>
          <tr>
            <td class = "t2"><strong>Issued Date :</strong></td>
            <td class = "t1"><?php echo $issuedDate; ?></td>
          </tr>
          <tr>
            <td class = "t2"><strong>CAR Status : </strong></td>
			<td class = "t1"><?php echo $status;?></td>
          </tr>
		  <?php
		  if($status == "closed")
		  {
		  ?>
		  <tr><td class = "t2"><strong>Closed Date :</strong></td><td class = "t1"><?php echo $fcdate; ?></td></tr>
		  <?php
		  }
		  ?>
</table>
		</td>
		
<?php
		}
	}
		
		
		$select2 = "select * from tblMUAccount where MUserID = $osid1";
		$select2Result = mysql_query($select2);
		if($select2Result)
		{
			while($row = mysql_fetch_array($select2Result))
			{
		
			$osid2 = $row['MUserID'];
			$osName = $row['Name'];
			$osDept = $row['DeptID'];
			$osSec = $row['Section'];
			
				$deptName1 = "";
			    $getDept1 = "select DeptName from tblDept where DeptID = $osDept";
				$getDeptResult1 = mysql_query($getDept1);
				if($getDeptResult1)
				{
					while($row1 = mysql_fetch_array($getDeptResult1))
					{
					$deptName1 = $row1['DeptName'];
					}
				}
			}
			
		}
		
		$select3 ="select * from tblMUAccount where MUserID = $omid1";
		$select3Result = mysql_query($select3);
		if($select3Result)
		{
			while($row = mysql_fetch_array($select3Result))
			{
		
			$omid2 = $row['MUserID'];
			$omName = $row['Name'];
			$omDept = $row['DeptID'];
			$omSec = $row['Section'];
			
				$deptName2 = "";
			    $getDept2 = "select DeptName from tblDept where DeptID = $omDept";
				$getDeptResult2 = mysql_query($getDept2);
				if($getDeptResult2)
				{
					while($row1 = mysql_fetch_array($getDeptResult2))
					{
					$deptName2 = $row1['DeptName'];
					}
				}
			}
			
		}
		
		$select4 ="select * from tblMUAccount where MUserID = $amid1";
		$select4Result = mysql_query($select4);
		if($select4Result)
		{
			while($row = mysql_fetch_array($select4Result))
			{
		   $amid2 = $row['MUserID'];
			$amName = $row['Name'];
			$amDept = $row['DeptID'];
			$amSec = $row['Section'];
			
				$deptName3 = "";
			    $getDept3 = "select DeptName from tblDept where DeptID = $amDept";
				$getDeptResult3 = mysql_query($getDept3);
				if($getDeptResult3)
				{
					while($row1 = mysql_fetch_array($getDeptResult3))
					{
					$deptName3 = $row1['DeptName'];
					}
				}
			}
			
		}
		$dnpic = "";
		$rp = "";
		$pn = "";
		$pd = "";
		$ps = "";
		$sp ="select distinct PICID from tblPIC where IssNumber = '$issNumber1'";
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
							$pd = $rpic1['DeptID'];
							$ps = $rpic1['Section'];
							
							
			   		    	$gdpic = "select DeptName from tblDept where DeptID = $pd";
							$gdpicr = mysql_query($gdpic);
							if($gdpicr)
							{
								while($rpic2 = mysql_fetch_array($gdpicr))
								{
									$dnpic = $rpic2['DeptName'];
								}
							}
						}
					}//close if($spr1)
				}
			}//close if($spr)
	
?>	
<br/>
<td valign="top">
<table border="0" class="tbl">
  <tr>
    <td class = "t2">&nbsp;</td>
    <td class = "t2"><div align="center"><strong>Originator</strong></div></td>
    <td class = "t2"><div align="center"><strong>Originator Manager </strong></div></td>
    <td class = "t2"> <div align="center"><strong>In Charge Manager </strong></div></td>
	<td class = "t2"> <div align="center"><strong>PIC </strong></div></td>
  </tr>
  <tr>
    <td class = "t2"><strong>Name</strong></td>
    <td class = "t1"><?php echo $osName; ?></td>
    <td class = "t1"><?php echo $omName; ?></td>
    <td class = "t1"><?php echo $amName; ?></td>
	<td class = "t1"><?php echo $pn; ?></td>
  </tr>
  <tr>
    <td class = "t2"><strong>Departement</strong></td>
     <td class = "t1"><?php echo $deptName1; ?></td>
    <td class = "t1"><?php echo $deptName2; ?></td>
    <td class = "t1"><?php echo $deptName3; ?></td>
	<td class = "t1"><?php echo $dnpic; ?></td>
  </tr>
  <tr>
    <td class = "t2"><strong>Section </strong></td>
    <td class = "t1"><?php echo $osSec; ?></td>
    <td class = "t1"><?php echo $omSec; ?></td>
    <td class = "t1"><?php echo $amSec; ?></td>
	<?php
	//if($reason != "")
	//{
	?>
	<!--<td class = "t2"><b>Remark</b></td>-->
	<?php
	//}
	?>
	<td class = "t1"><?php echo $ps; ?></td>
  </tr>
  
  <!--
  <tr>
    <td class = "t2"><strong>Status</strong></td>
   <td class = "t1"><?php //echo $osStat;?></td>
   -->
	<?php
	/*
	if($by != "")
	{
	$dis = "";
	if($by == "om")
	{
	$dis = " by Originator Manager";
	}
	*/
	?>
	<!--
    <td class = "t3"><//?php echo //$omStat; ?> <//?php echo //$dis; ?></td>
	-->
	<?php
	/*
	$dis = "";
	}
	else
	{
	if($omStat != "approved")
	{
	*/
	?>
	<!--
	<td class = "t3">
	-->
	<?php
	/*
	}
	else
	{
	*/
	?>
	<!--
	<td class = "t1">
	-->
	<?php
	/*
	}
	 echo $omStat; ?></td>
	<?php
	}
	
	if($by != "")
	{
	$dis1 = "";
	if($by == "am")
	{
	$dis1 = " by In Charge Manager";
	}
	
	*/
	?>
    <!--<td class = "t3"><?php //echo $amStat; ?> <?php //echo $dis1; ?></td>-->
	<?php
	/*
	$dis1 = "";
	}
	else
	{
	if($amStat != "approved")
	{
	*/
	?>
	<!-- <td class = "t3">-->
	<?php
	/*
	}
	else
	{
	*/
	?>
	<!--<td class = "t1">-->
	<?php
	/*
	}
	 echo $amStat; */ ?>
	 <!--</td>-->
	<?php
	/*
	}
	
	if($reason != "")
	{
	*/
	?>
	<!--<td class = "t3"><?php //echo $reason; ?></td>-->
	<?php
	/*
	}
	*/
	?>
  </tr>
</table></td>
<?php
            $afid1 = "";
			$sf1 = "select AFID from tblAttach where IssNumber = '$inum'";
			$sfr1 = mysql_query($sf1);
			if($sfr1)
			{
				while($rf1 = mysql_fetch_array($sfr1))
				{
					$afid1 = $rf1['AFID'];
				}
			}
			if($afid1 != "")
			{
?>
<td valign="top"><table class="tbl"><tr><td class="t2">Attachment</td></tr><tr><td class="t1">
<?php
//display files
	$afid = "";
	$fn = "";
	$sf = "select * from tblAttach where IssNumber = '$inum'";
	$sfr = mysql_query($sf);
	if($sfr)
	{
		while($rf = mysql_fetch_array($sfr))
		{
			$afid = $rf['AFID'];
			$fn = $rf['FileName']
?>
<a href ="http://192.168.1.36/webcar/attachment/<?php echo $fn;?>" target="_blank"><img src="paper-clip.jpg"></a>
<?php
		}
	}
?>
</td></tr></table></td>
<?php
}
?>
</tr></table><p></p>
<!--
<table>
<tr valign="top"><td>
<p class="p">Corrective Action Manager</p>
-->
<?php 
/*
$select5 = "select * from tblCARDTL1 where IssNumber ='$issNumber1'";
$select5Result = mysql_query($select5);
if($select5Result)
		{
			$display = "<table border=\"0\" class=\"tbl\" align=\"center\"><tr><th class = \"t2\">Name</th><th class = \"t2\">Departement</th></tr>";
			while($row = mysql_fetch_array($select5Result))
			{
				$camid2 = $row['CAMID'];
				
				
				
				$select19 = "select * from tblMUAccount where MUserID = $camid2";
				$select19Result = mysql_query($select19);
				if($select19Result)
				{
					while($row12 = mysql_fetch_array($select19Result))
					{
						$camName = $row12['Name'];
						$camDept = $row12['DeptID'];
						
						$deptName4 = "";
			   		    $getDept4 = "select DeptName from tblDept where DeptID = $camDept";
						$getDeptResult4 = mysql_query($getDept4);
						if($getDeptResult4)
						{
							while($row1 = mysql_fetch_array($getDeptResult4))
							{
								$deptName4 = $row1['DeptName'];
							}
						}
						
					}
				}
				
				//$camStat = $row['CAMStat'];
				
			
				$display .= "<tr align = \"center\">";
				$display .= "<td class = \"t1\">$camName</td>";
				$display .= "<td class = \"t1\">$deptName4</td>";
				//$display .= "<td class = \"t1\">$camStat</td>";
				$display .= "</tr>";
				
			}
			$display .="</table><p></p>";
			print $display;
		}	
		
		print "</td><td width=\"15\"></td><td><p class=\"p\" align=\"center\">Corrective Action Team</p>";
			
			
			$select7 ="select distinct PICID from tblPIC where IssNumber = '$issNumber1'";
			$select7Result = mysql_query($select7);
			if($select7Result)
			{
			 $display3 = "<table border=\"0\" class =\"tbl\" align=\"center\"><tr><th class = \"t2\">Name</th><th class = \"t2\">Departement</th><th class = \"t2\">Section</th></tr>";	
			while($row = mysql_fetch_array($select7Result))
			{
		     	
				$pic = $row['PICID'];
				//$picStat = $row['PICStat'];
				$select8 = "select * from tblMUAccount where MUserID = $pic";
				$select8Result = mysql_query($select8);
				
				if($select8Result)
				{
						
						while($row1 = mysql_fetch_array($select8Result))
						{
							$picName = $row1['Name'];
							$catDept = $row1['DeptID'];
							$catSec = $row1['Section'];
							
							$deptName5 = "";
			   		    	$getDept5 = "select DeptName from tblDept where DeptID = $catDept";
							$getDeptResult5 = mysql_query($getDept5);
							if($getDeptResult5)
							{
								while($row2 = mysql_fetch_array($getDeptResult5))
								{
									$deptName5 = $row2['DeptName'];
								}
							}
							
							$display3 .= "<tr align = \"center\">";
				            $display3 .= "<td class = \"t1\">$picName</td><td class = \"t1\">$deptName5</td><td class = \"t1\">$catSec</td>"; //<td class = \"t1\">$picStat</td>";
                            $display3 .= "</tr>";
						}
						
						
				}
				
			}
			$display3 .="</table><p></p>";
			print $display3."</td></tr></table>";
			}
			*/
		
			$select6 = "select * from tblCARDTL2 where IssNumber ='$issNumber1'";
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
				/*"
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
				
				/*$carStatus = $row['CARStatus'];
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
				
				$display2 .= "<form method=\"post\" action=\"ameditdtl.php\">";
				$display2 .= "<tr valign=\"top\" align = \"center\"><td colspan = \"2\" class = \"t2\">$inum</td>";
				$display2 .= "<td class = \"t2\">Problem</td>";
				$display2 .= "<td class = \"t2\">Analysis</td>";
				$display2 .= "<td class = \"t2\">Corrective Action</td>";
				$display2 .= "<td class = \"t2\">Verification by Originator</td>";
				//$display2 .= "<td class = \"t2\">Date Inspected</td><td class = \"t1\">$dateInspect</td>";
				$display2 .= "</tr><tr valign=\"top\"><td class = \"t2\">Due Date</td><td class = \"t1\">$dueDate</td>";
				$display2 .= "<td  valign=\"top\" rowspan=\"7\" width=\"500\" class = \"t1\">$findings</td>";
				$display2 .= "<td  valign=\"top\" rowspan=\"7\" width=\"500\" class = \"t1\">$analysis</td>";
				$display2 .= "<td  valign=\"top\" rowspan=\"7\" class = \"t1\"><table width =\"350\" border = \"1\">";
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
				
												//tabel verification by originator
				$display2 .= "<td  valign=\"top\" rowspan=\"6\" class = \"t1\"><table width =\"300\" border = \"1\">";
				$display2 .= "<tr><th>Date</th><th>Comment</th></tr>";
				//$display2 .= "<tr><th>22-April-2013</th><th>Comment1 Comment1 Comment1 Comment1 Comment1 Comment1 Comment1 Comment1</th></tr>";
				$sub = 0;
				$select1 = "select * from tblcardtl3 where IssNumber = '$inum'";
				$select1Result = mysql_query($select1);
				if($select1Result)
				{
					while($row = mysql_fetch_array($select1Result))
					{
						$display2 .= "<tr>";
						$display2 .= "<td class =\"t1\">".$row['DATED']."</td>";
						$display2 .= "<td class =\"t1\">".$row['VERIFICATION']."</a></td>";
						$display2 .= "</tr>";
						
						//$display2 .= "<td  valign=\"top\" rowspan=\"6\" width=\"75\" class = \"t1\">". $row['DATED'] ."</td>";
						//$display2 .= "<td  valign=\"top\" rowspan=\"6\" width=\"225\" class = \"t1\">". $row['VERIFICATION'] ."</td></tr>";
							
					
					}
				}
				//$display2 .= "<tr><th><a href=\"verification.php?flag=insert&inum=". $inum . "&sub=" . $sub .  "\">Add ++ </a></th></tr>";
				$display2 .= "</table></td>";				

				
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
				
				
				$display2 .= "<input type =\"hidden\" name=\"group\" value=\"$group\">";
				$display2 .= "<input type =\"hidden\" name=\"id\" value=\"$id11\">";
				$display2 .= "<input type =\"hidden\" name=\"inum\" value=\"$inum\">";
				$display2 .= "<input type =\"hidden\" name=\"cardtlid2\" value=\"$cardtlid2\">";
				$display2 .= "<input type =\"hidden\" name=\"view\" value=\"view\">";
				$display2 .= "<input type =\"hidden\" name=\"what\" value=\"whatever\">";
                //$display2 .= "<tr><td colspan=\"7\"><input type =\"submit\" value=\"Edit\"></td></tr>";
				$display2 .= "</form>";
				
			}
			$display2 .="</table>";
			
			
			print $display2;
			}

?>
</body>
</html>
<?php
}
?>


