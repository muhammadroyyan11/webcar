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
<title>Corrective Action Team</title>
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
	width: 756px
}

/* Reset overflow value to hidden for all non-IE browsers. */
html>body div.tableContainer {
	overflow: hidden;
	width: 756px
}

/* define width of table. IE browsers only                 */
div.tableContainer table {
	float: left;
	width: 740px
}

/* define width of table. Add 16px to width for scrollbar.           */
/* All other non-IE browsers.                                        */
html>body div.tableContainer table {
	width: 756px
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
	background: #99CCFF;
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
	display: block;
	height: 262px;
	overflow: auto;
	width: 100%
}

/* make TD elements pretty. Provide alternating classes for striping the table */
/* http://www.alistapart.com/articles/zebratables/                             */
tbody.scrollContent td, tbody.scrollContent tr.normalRow td {
	background: #FFF;
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
	width: 200px
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
$id = $_POST['id'];

include ("conn.php");




?>
<body>

<div align="center">
  <table border="0" align="center">
    <tr align="center">
	<!--
	<td><form name="form1" method="post" action="requestcar.php">
          <input type="hidden" name="group" value="<?php //echo $group;?>">
		  <input type="hidden" name="id" value="<?php //echo $id;?>">
          <input type="submit" name="Submit" value="Request CAR">
        </form></td>
	  <td><form name="form1" method="post" action="viewarc.php">
          <input type="hidden" name="group" value="<?php //echo $group;?>">
		  <input type="hidden" name="id" value="<?php //echo $id;?>">
          <input type="submit" name="Submit" value="View Archived">
        
        
      </form></td>
	  -->
	  <td><form name="form1" method="post" action="login.php">
         
          <input type="submit" name="Submit" value="Log Out">
        
        
      </form></td>
    </tr>
  </table>
  
  <?php

$count = 0;

$form = "<center><table><tr><td>";
$form .= "<form method=\"POST\" action=\"cat.php\">";
$form .= "<table class =\"style1\">";
$form .= "<tr>";
$form .= "<td>CAR Number :</td><td><select name=\"inum\"><option value=\"\"></option>";

$gpi = "select distinct IssNumber from tblPIC where PICID = $id";
$gpir = mysql_query($gpi);
while($rpi = mysql_fetch_array($gpir))
{
$inr = $rpi['IssNumber'];
	$gcn = "select * from tblCAR where IssNumber = '$inr'";
	$gcnr = mysql_query($gcn);
	if($gcnr)
	{
		while ($rcn = mysql_fetch_array($gcnr))
		{
			$cn = $rcn['IssNumber'];
			$form .= "<option value=\"$cn\">$cn</option>";
		}
	}
}



$form .= "</select></td>";
$form .= "<td>CAR Status:</td><td>";
$form .= "<select name=\"stat\"><option value=\"\" selected></option><option value=\"open\">open</option><option value=\"closed\">close</option>";
$form .= "</select></td>";
$form .= "<td><input type=\"hidden\" name=\"what\" value=\"search\">";
$form .= "<input type=\"hidden\" name=\"group\" value=\"$group\"><input type=\"hidden\" name=\"id\" value=\"$id\">";
$form .= "</td><td><input type=\"submit\" value=\"Search\"></td>";
//$form .= "</tr>";
//$form .= "</table>";
$form .= "</form></td>";
print $form;

$form1 = "<td><form method=\"POST\" action=\"cat.php\">";
$form1 .= "<td>Dept</td><td>";
$form1 .= "<select name=\"sdept\"><option value=\"\"></option>";

$gam = "select distinct PICID from tblPIC where PICID = $id";
		$gamResult = mysql_query($gam);
		if($gamResult)
		{
			while($ra = mysql_fetch_array($gamResult))
			{
				$ai = $ra['PICID'];
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
				
             		$select1 .= " ORDER BY CARID DESC";
			}
    	}

		else
		{
			$select1 = "select * from tblCAR order by CARID DESC";
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
			$display = "<table align = \"center\" border = \"0\" class =\"tbl\"><thead class=\"fixedHeader\"><tr><th class=\"t2\">CAR Number</th><th class=\"t2\">Issued Date</th><th class=\"t2\">CAR Status</th>";
			$display .= "<th class=\"t2\">Originator</th><th class=\"t2\">Originator Manager</th><th class=\"t2\">In Charge Manager</th><th class=\"t2\">Departement</th><th class=\"t2\"></th></tr></thead>";
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
			
			$geti = "select distinct IssNumber from tblPIC where PICID = $id";
			$getiResult = mysql_query($geti);
			if($getiResult)
			{
			 	while($row103 = mysql_fetch_array($getiResult))
				{
				 	$i = $row103['IssNumber'];
				    if($i == $issNumber)
			        {
							 
							if(isset($_POST['sort']))
							{
			
								if($_POST['sort'] == "sort")
								{
								
									$sdept = $_POST['sdept'];
									if($sdept == $amDept)
									{
			                            $count ++;
										$display .= "<form method=\"post\" action=\"catcardetail.php\">";
		    			            $display .= "<tr align = \"center\">";
		    			            $display .= "<td class=\"t1\">$issNumber</td>";
		    			            $display .= "<td class=\"t1\">$issuedDate</td>";
						            $display .= "<td class=\"t1\">$status</td>";
						            $display .= "<td class=\"t1\">$osName</td>";
						            $display .= "<td class=\"t1\">$omName</td>";
						            $display .= "<td class=\"t1\">$amName</td>";
						            $display .= "<td class=\"t1\">$deptName</td>";
						            $display .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
						            $display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
						            $display .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
						            $display .= "<td class=\"t1\"><input type =\"submit\" value=\"Details\"></td>";
									if($afid != "")
						            {
										$display .= "<td class=\"t1\"><img src=\"paper-clip.jpg\"></td>";
									}
						            $display .= "</tr>";
						            $display .= "</form>";
								}
							}
						}	
						else
						{
                            $count++;
							$display .= "<form method=\"post\" action=\"catcardetail.php\">";
							$display .= "<tr align = \"center\">";
							$display .= "<td class=\"t1\">$issNumber</td>";
							$display .= "<td class=\"t1\">$issuedDate</td>";
							$display .= "<td class=\"t1\">$status</td>";
							$display .= "<td class=\"t1\">$osName</td>";
							$display .= "<td class=\"t1\">$omName</td>";
							$display .= "<td class=\"t1\">$amName</td>";
							$display .= "<td class=\"t1\">$deptName</td>";
							$display .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
							$display .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
							$display .= "<input type=\"hidden\" name=\"inum\" value=\"$issNumber\">";
							$display .= "<td class=\"t1\"><input type =\"submit\" value=\"Details\"></td>";
							if($afid != "")
							{
								$display .= "<td class=\"t1\"><img src=\"paper-clip.jpg\"></td>";
							}
							$display .= "</tr>";
							$display .= "</form>";
							}
						}//close if($i == $issNumber)
				} //close while($row103 = mysql_fetch_array($getiResult))
			} //close if($getiResult)	
			
		}
		$display .= "</table>"; 
		if($count == 0)
		{
		print "<center><p class = \"p\"> CAR is not found</p><br/>";
		}
		else
		{
		print "<center><p class = \"p\">$count CAR files are found</p><br/>";
		} 
		
   		if($display !="")
   		{
    		print "<div style=\"width: 900px; height: 500px;overflow: auto; padding: 5px\">".$display;
 		}
	}
	
	if((isset($_POST['what']))or(isset($_POST['sort']))) // page is in search mode or sort mode
	
	{

?>
</head>

<body>
<p></p>
 <table width="78" border="0">
     <tr>
       <td><form name="form2" method="post" action="cat.php">
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
}






?>
