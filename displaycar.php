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
<script type="text/javascript">
<!--
/* http://www.alistapart.com/articles/zebratables/ */
function removeClassName (elem, className) {
	elem.className = elem.className.replace(className, "").trim();
}

function addCSSClass (elem, className) {
	removeClassName (elem, className);
	elem.className = (elem.className + " " + className).trim();
}

String.prototype.trim = function() {
	return this.replace( /^\s+|\s+$/, "" );
}

function stripedTable() {
	if (document.getElementById && document.getElementsByTagName) {  
		var allTables = document.getElementsByTagName('table');
		if (!allTables) { return; }

		for (var i = 0; i < allTables.length; i++) {
			if (allTables[i].className.match(/[\w\s ]*scrollTable[\w\s ]*/)) {
				var trs = allTables[i].getElementsByTagName("tr");
				for (var j = 0; j < trs.length; j++) {
					removeClassName(trs[j], 'alternateRow');
					addCSSClass(trs[j], 'normalRow');
				}
				for (var k = 0; k < trs.length; k += 2) {
					removeClassName(trs[k], 'normalRow');
					addCSSClass(trs[k], 'alternateRow');
				}
			}
		}
	}
}

window.onload = function() { stripedTable(); }
-->
</script>
<style type="text/css">
<!--
/* Terence Ordona, portal[AT]imaputz[DOT]com         */
/* http://creativecommons.org/licenses/by-sa/2.0/    */

/* begin some basic styling here                     */
body {
	background: #FFF;
	color: #000;
	font: normal normal 12px Verdana, Geneva, Arial, Helvetica, sans-serif;
	margin: 10px;
	padding: 0
}

table, td, a {
	color: #000;
	font: normal normal 12px Verdana, Geneva, Arial, Helvetica, sans-serif
}

h1 {
	font: normal normal 18px Verdana, Geneva, Arial, Helvetica, sans-serif;
	margin: 0 0 5px 0
}

h2 {
	font: normal normal 16px Verdana, Geneva, Arial, Helvetica, sans-serif;
	margin: 0 0 5px 0
}

h3 {
	font: normal normal 13px Verdana, Geneva, Arial, Helvetica, sans-serif;
	color: #008000;
	margin: 0 0 15px 0
}
/* end basic styling                                 */

/* define height and width of scrollable area. Add 16px to width for scrollbar          */
div.tableContainer {
	clear: both;
	border: 1px solid #963;
	height: 285px;
	overflow: auto;
	width: 900px
}

/* Reset overflow value to hidden for all non-IE browsers. */
html>body div.tableContainer {
	overflow: hidden;
	width: 900px
}

/* define width of table. IE browsers only                 */
div.tableContainer table {
	float: left;
	width: 900px
}

/* define width of table. Add 16px to width for scrollbar.           */
/* All other non-IE browsers.                                        */
html>body div.tableContainer table {
	width: 900px
}

/* set table header to a fixed position. WinIE 6.x only                                       */
/* In WinIE 6.x, any element with a position property set to relative and is a child of       */
/* an element that has an overflow property set, the relative value translates into fixed.    */
/* Ex: parent element DIV with a class of tableContainer has an overflow property set to auto */
thead.fixedHeader tr {
	position: relative
}

/* set THEAD element to have block level attributes. All other non-IE browsers            */
/* this enables overflow to work on TBODY element. All other non-IE, non-Mozilla browsers */
html>body thead.fixedHeader tr {
	display: block
}

/* make the TH elements pretty */
thead.fixedHeader th {
	background: #C96;
	border-left: 1px solid #EB8;
	border-right: 1px solid #B74;
	border-top: 1px solid #EB8;
	font-weight: normal;
	padding: 4px 3px;
	text-align: left
}

/* make the A elements pretty. makes for nice clickable headers                */
thead.fixedHeader a, thead.fixedHeader a:link, thead.fixedHeader a:visited {
	color: #FFF;
	display: block;
	text-decoration: none;
	width: 100%
}

/* make the A elements pretty. makes for nice clickable headers                */
/* WARNING: swapping the background on hover may cause problems in WinIE 6.x   */
thead.fixedHeader a:hover {
	color: #FFF;
	display: block;
	text-decoration: underline;
	width: 100%
}

/* define the table content to be scrollable                                              */
/* set TBODY element to have block level attributes. All other non-IE browsers            */
/* this enables overflow to work on TBODY element. All other non-IE, non-Mozilla browsers */
/* induced side effect is that child TDs no longer accept width: auto                     */
html>body tbody.scrollContent {
	display:block;
	height: 262px;
	overflow: auto;
	width: 900px;
}

/* make TD elements pretty. Provide alternating classes for striping the table */
/* http://www.alistapart.com/articles/zebratables/                             */
tbody.scrollContent td, tbody.scrollContent tr.normalRow td {
	background: #669900;
	border-bottom: none;
	border-left: none;
	border-right: 1px solid #CCC;
	border-top: 1px solid #DDD;
	padding: 2px 3px 3px 4px
}

tbody.scrollContent tr.alternateRow td {
	background: #EEE;
	border-bottom: none;
	border-left: none;
	border-right: 1px solid #CCC;
	border-top: 1px solid #DDD;
	padding: 2px 3px 3px 4px
}

/* define width of TH elements: 1st, 2nd, and 3rd respectively.          */
/* Add 16px to last TH for scrollbar padding. All other non-IE browsers. */
/* http://www.w3.org/TR/REC-CSS2/selector.html#adjacent-selectors        */
html>body thead.fixedHeader th {
	width: 500px
}

html>body thead.fixedHeader th + th {
	width: 240px
}

html>body thead.fixedHeader th + th + th {
	width: 316px
}

/* define width of TD elements: 1st, 2nd, and 3rd respectively.          */
/* All other non-IE browsers.                                            */
/* http://www.w3.org/TR/REC-CSS2/selector.html#adjacent-selectors        */
html>body tbody.scrollContent td {
	width: 200px
}

html>body tbody.scrollContent td + td {
	width: 240px
}

html>body tbody.scrollContent td + td + td {
	width: 300px
}
-->
</style>
<?php
if ((!$_POST['group'])or($_POST['group'] == ""))
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
		$topic = $row['CTopic'];
		$percent = $row['Percent'];
		
		
?>


</head>

<body>

<table border="0" align="left">
    <tr>
      <td width="74"><form name="form1" method="post" action="<?php echo $group; ?>.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		 <input type="hidden" name="id" value="<?php echo $id11; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
    </tr>
</table>
<br/><br/><br/><br/>

<table width="242" border="0" class="tbl">
          
          <tr>
            <td class = "t2" width="115"><strong>CAR Number : </strong></td>
            <td class = "t1" width="111"><?php echo $issNumber1; ?></td>
          </tr>
          <tr>
            <td class = "t2"><strong>Issued Date :</strong></td>
            <td class = "t1"><?php echo $issuedDate; ?></td>
          </tr>
          <tr>
            <td class = "t2"><strong>CAR Status : </strong></td>
            <td class = "t1"><?php echo $status;?> 
			</td>
          </tr>
</table>
		
		
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
		
	
?>	
<br/>
<table width="684" border="0" class="tbl">
  <tr>
    <td width="116">&nbsp;</td>
    <td width="180" class = "t2"><div align="center"><strong>Originator </strong></div></td>
    <td width="180" class = "t2"><div align="center"><strong>Originator Manager </strong></div></td>
    <td width="180" class = "t2"> <div align="center"><strong>In Charge Manager </strong></div></td>
  </tr>
  <tr>
    <td class = "t2"><strong>Name :</strong></td>
    <td class = "t1"><?php echo $osName; ?></td>
    <td class = "t1"><?php echo $omName; ?></td>
    <td class = "t1"><?php echo $amName; ?></td>
  </tr>
  <tr>
    <td class = "t2"><strong>Departement :</strong></td>
    <td class = "t1"><?php echo $deptName1; ?></td>
    <td class = "t1"><?php echo $deptName2; ?></td>
    <td class = "t1"><?php echo $deptName3; ?></td>
  </tr>
  <tr>
    <td class = "t2"><strong>Section :</strong></td>
    <td class = "t1"><?php echo $osSec; ?></td>
    <td class = "t1"><?php echo $omSec; ?></td>
    <td class = "t1"><?php echo $amSec; ?></td>
  </tr>
  <tr>
    <td class = "t2"><strong>Status :</strong></td>
    <td class = "t1"><?php echo $osStat;?></td>
    <td class = "t1"><?php echo $omStat; ?></td>
    <td class = "t1"><?php echo $amStat; ?></td>
  </tr>
</table><p></p>
<table>
<tr valign="top"><td>
<p class="p">Corrective Action Manager</p>
<?php 
$select5 = "select * from tblCARDTL1 where IssNumber ='$issNumber1'";
$select5Result = mysql_query($select5);
if($select5Result)
		{
			$display = "<table border=\"0\" class=\"tbl\"><tr><th class = \"t2\">Name</th><th class = \"t2\">Departement</th><th class = \"t2\">Status</th></tr>";
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
				
				$camStat = $row['CAMStat'];
				$display .= "<tr align = \"center\">";
				$display .= "<td class = \"t1\">$camName</td>";
				$display .= "<td class = \"t1\">$deptName4</td>";
				$display .= "<td class = \"t1\">$camStat</td>";
				$display .= "</tr>";
			}
			$display .="</table><p></p>";
			print $display;
		}	
		
		print "</td><td><p class=\"p\">Corrective Action Team</p>";
			
			
			$select7 ="select distinct PICID,PICStat from tblPIC where IssNumber = '$issNumber1'";
			$select7Result = mysql_query($select7);
			if($select7Result)
			{
			$display3 = "<table border=\"0\" class =\"tbl\"><tr><th class = \"t2\">Name</th><th class = \"t2\">Departement</th><th class = \"t2\">Section</th><th class = \"t2\">Status</th></tr>";	
			while($row = mysql_fetch_array($select7Result))
			{
		     	
				$pic = $row['PICID'];
				$picStat = $row['PICStat'];
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
				            $display3 .= "<td class = \"t1\">$picName</td><td class = \"t1\">$deptName5</td><td class = \"t1\">$catSec</td><td class = \"t1\">$picStat</td>";
				            $display3 .= "</tr>";
						}
						
						
				}
				
			}
			$display3 .="</table><p></p>";
			print $display3."</td></tr></table>";
			}
			
		
$select6 = "select * from tblCARDTL2 where IssNumber ='$issNumber1'";
$select6Result = mysql_query($select6);
if($select6Result)
{
			
			$display2 = "<div style=\" width:900px; height: 300px;overflow:auto; padding: 5px\">";
			$display2 .= "<table border=\"0\" class=\"tbl\"><thead class=\"\"><tr><th class = \"t2\">Code</th><th class = \"t2\">Findings</th><th class = \"t2\">Analysis</th><th class = \"t2\">Corrective Action</th><th class = \"t2\">Due Date</th><th class = \"t2\">Status</th>";
			$display2 .= "<th class = \"t2\">Date Inspected</th><th class = \"t2\">Remark</th><th class = \"t2\">Closed Date</th><th class = \"t2\">ISO Ref</th><th class = \"t2\">Category</th>";
			$display2 .= "<th class = \"t2\">PIC1</th>";
		    $display2 .= "<th class = \"t2\">PIC2</th>";
			$display2 .= "<th class = \"t2\">PIC3</th>";
			$display2 .= "<th class = \"t2\">PIC4</th>";
			$display2 .= "<th class = \"t2\">PIC5</th>";
			$display2 .= "<th class = \"t2\">PIC6</th>";
			/*
			$display2 .= "<th class = \"t2\">PIC7</th>";
			$display2 .= "<th class = \"t2\">PIC8</th>";
			$display2 .= "<th class = \"t2\">PIC9</th>";
			$display2 .= "<th class = \"t2\">PIC10</th>";
			*/
			$display2 .= "</tr></thead><tbody class=\"\">";
			
			while($row = mysql_fetch_array($select6Result))
			{

				$code = $row['Code'];
				$findings = $row['Findings'];
				$analysis = $row['Analysis'];
				$corrAct = $row['CorrAct'];
				$dDate = $row['DDate'];
				$dMonth = $row['DMonth'];
				$dYear = $row['DYear'];
				if(($dDate != "")&&($dMonth != "")&&($dYear != ""))
				{
					$dueDate = $dDate."/".$dMonth."/".$dYear;
				}
				else
				{
					$dueDate = "";
				}
				
				$carStatus = $row['CARStatus'];
				$dInspect = $row['DInspect'];
				$mInspect = $row['MInspect'];
				$yInspect = $row['YInspect'];
				if(($dInspect != "")&&($mInspect != "")&&($yInspect != ""))
				{
					$dateInspect = $dInspect."/".$mInspect."/".$yInspect;
				}
				else
				{
					$dateInspect = "";
				}
				
				$remark = $row['Remark'];
				$cDate = $row['ClosedDate'];
				$cMonth = $row['ClosedMonth'];
				$cYear = $row['ClosedYear'];
				if(($cDate != "")&&($cMonth != "")&&($cYear != ""))
				{
					$closedDate =$cDate."/".$cMonth."/".$cYear;
				}
				else
				{
					$closedDate = "";
				}
				
				$iso = $row['ISORef'];
				$category = $row['Category'];
				$pic1 = $row['PICID1'];
				$pic2 = $row['PICID2'];
				$pic3 = $row['PICID3'];
				$pic4 = $row['PICID4'];
				$pic5 = $row['PICID5'];
				$pic6 = $row['PICID6'];
				/*
				$pic7 = $row['PICID7'];
				$pic8 = $row['PICID8'];
				$pic9 = $row['PICID9'];
				$pic10 = $row['PICID10'];
				*/
				
				$display2 .= "<tr align = \"center\">";
				$display2 .= "<td class = \"t1\">$code</td><td class = \"t1\">$findings</td><td class = \"t1\">$analysis</td><td class = \"t1\">$corrAct</td><td class = \"t1\">$dueDate</td><td class = \"t1\">$carStatus</td><td class = \"t1\">$dateInspect</td>";
				$display2 .= "<td class = \"t1\">$remark</td><td class = \"t1\">$closedDate</td><td class = \"t1\">$iso</td><td class = \"t1\">$category</td>";
				
				$full1 = "";
				$full2 = "";
				$full3 = "";
				$full4 = "";
				$full5 = "";
				$full6 = "";
				/*
				$full7 = "";
				$full8 = "";
				$full9 = "";
				$full10 = "";
				*/
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
				*/
				
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
				
				
				if($full8 != "")
				{
				$display2 .= "<td>$full8</td>";
				}
				if($full9 != "")
				{
				$display2 .= "<td>$full9</td>";
				}
				if($full10 != "")
				{
				$display2 .= "<td>$full10</td>";
				}
				*/
				$display2 .= "</tr>";
			}
			$display2 .="</tbody></table>";
			
			
			print $display2."</div>";
		}	

?>
</body>
</html>
<?php
}
?>