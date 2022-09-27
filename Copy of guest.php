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
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">
</head>
<?php 
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['id'])or($_POST['id'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{

print "<p class =\"p\">".date("D, d M Y ")."</p>";
$group = $_POST['group'];
$id = $_POST['id'];

include ("conn.php");

$form = "<form method=\"POST\" action=\"guest.php\">";
$form .= "<table align=\"left\">";
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
$form .= "<td>Status</td><td>";
$form .= "<select name=\"stat\"><option value=\"\" selected></option><option value=\"open\">open</option><option value=\"closed\">close</option>";
$form .= "</select></td>";
$form .= "<input type=\"hidden\" name=\"what\" value=\"search\">";
$form .= "<input type=\"hidden\" name=\"group\" value=\"$group\"><input type=\"hidden\" name=\"id\" value=\"$id\">";
$form .= "<td></td><td><input type=\"submit\" value=\"Search\"></td>";
$form .= "</tr></table></form>";

$form1 = "<form method=\"POST\" action=\"guest.php\" align=\"center\">";
$form1 .= "<table align =\"left\"><tr><td>Dept</td><td>";
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
$form1 .= "</select></td><td><input type=\"submit\" value=\"Sort\"></td></tr></table></form>";

?>
<body>
  
    <table border="0" class="tbl" align="center" bgcolor="#99CCFF">
      <tr>
	   <!--
	  <td width="365" align="center">
	 <form name="form1" method="post" action="viewarc.php">
          <input type="hidden" name="group" value="<?php //echo $group;?>">
		  <input type="hidden" name="id" value="<?php //echo $id;?>">
          <input type="submit" name="Submit" value="View Archived"></form> 
		 </td>
		 --> 
		<td class="t5"> 
	  <form name="form3" method="post" action="report.php" >
        Month : 
        <select name="month">
         <option value="" selected></option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
		 to <select name="month1">
         <option value="" selected></option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
        Year :
        <select name="year">
           <option value="" selected></option>
	       <option value="2006">2006</option>
	       <option value="2007">2007</option>
	       <option value="2008">2008</option>
	       <option value="2009">2009</option>
	       <option value="2010">2010</option>
	       <option value="2011">2011</option>
	       <option value="2012">2012</option>
	       <option value="2013">2013</option>
	       <option value="2014">2014</option>
	       <option value="2015">2015</option>
		   <option value="2016">2016</option>
		   <option value="2017">2017</option>
           <option value="2018">2018</option>
	       <option value="2019">2019</option>
	       <option value="2020">2020</option>
	       <option value="2021">2021</option>
           <option value="2022">2022</option>
           <option value="2023">2023</option>
	       <option value="2024">2024</option>
	       <option value="2025">2025</option>
	    </select>      
        <input type="hidden" name="group" value="<?php echo $group;?>">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="Submit3" value="Create Report">        
	  </form></td><td class="t5" ><form name="form1" method="post" action="summary.php">
	   <input type="hidden" name="group" value="<?php echo $group;?>">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
         <input type="submit" name="Submit" value="Summary CAR Progress">
         </form></td>
      </tr>
	 <tr> <td class="t5"><?php  print $form; ?><?php print $form1; ?></td><td class="t5" align="center"><form name="form1" method="post" action="login.php">
        <br/> <input type="submit" name="Submit" value="Log Out">
        </form></td></tr>
</table>
 <br/>
<table border="0" align="left">
  
    <tr align="left" valign="top">
	

	
      <td width="300"><?php include("header.php"); ?></td>
	  
	  <td><?php include("dtl.php"); ?></td>
    </tr>
  </table>
  
 


</body>
</html>
<?php
}
?>

