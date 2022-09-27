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
<title>Summary Progress CAR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
 
if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
?>

<table border="0" align="center">
    <tr align="center">
       <td><form name="form1" method="post" action="guest.php">
	   <input type="hidden" name="group" value="<?php echo $group;?>">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
         <input type="submit" name="Submit" value="back">
         </form></td>
  </tr>
</table>
  <table class = "tbl" align="center">
    <tr align="center" class = "t5">
	<form name="form1" method="post" action="summary.php">
	<td>Year :  <select name="year">
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
	    </select>      </td>
       <td>
	   <input type="hidden" name="group" value="<?php echo $group;?>">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
		   <input type="hidden" name="what" value="selectyear">
         <input type="submit" name="Submit" value="create report">
         </td></form>
  </tr>
</table>
<p align="center" class="p"> SUMMARY CAR PROGRESS</p>
<table class="tbl" align="center">
<?php

$group = $_POST['group'];
$id = $_POST['id'];

include("conn.php");

$date_array =getdate(); 
foreach($date_array as $key => $val)
{
 	$key = $val;
}

$curmth = $date_array['mon'];
if (isset($_POST['what']))
{
	if ($_POST['year'] != "")
	{
		$curyr = $_POST['year'];
	}
}

else
{
$curyr = $date_array['year'];
}
$lastmth = $curmth - 1;
$lastyr = $curyr - 1;

?>

<table width="1050" border="1" align="center" class = "tbl">
  <tr>
    <td width="308" class ="t2"><strong>Summary Progress CAR </strong></td>
    <td width="50" class ="t2"><strong>Jan</strong></td>
    <td width="50" class ="t2"><strong>Feb</strong></td>
    <td width="50" class ="t2"><strong>Mar</strong></td>
    <td width="50" class ="t2"><strong>Apr</strong></td>
    <td width="50" class ="t2"><strong>May</strong></td>
    <td width="50" class ="t2"><strong>Jun</strong></td>
    <td width="50" class ="t2"><strong>Jul</strong></td>
    <td width="50" class ="t2"><strong>Aug</strong></td>
    <td width="50" class ="t2"><strong>Sept</strong></td>
    <td width="50" class ="t2"><strong>Oct</strong></td>
    <td width="50" class ="t2"><strong>Nov</strong></td>
    <td width="50" class ="t2"><strong>Dec</strong></td>
  </tr>
  <tr>
    <td class ="t2"><strong>CAR opened this month : </strong></td>
	<?php
	for ( $counter = 1; $counter <= 12;)
	{
	$one = "select count(CARID) as carCount from tblCAR where IssMonth = $counter and IssYear = $curyr";
	$oneR = mysql_query($one);
	$oneRR = mysql_result($oneR,0,"carCount");
	
	
	
	?>
	
    <td class ="t1">
	<?php 
	if($oneRR != 0) 
	{ 
	print $oneRR;  
	} 
	?>
	</td>
    <?php
	
	$counter ++;
	}
	?>
  </tr>
  <tr>
    <td class ="t2"><strong>CAR that are still open from last month : </strong></td>
	<?php
	
	$two = "select count(CARID) as carCount2 from tblCAR where IssMonth = 12 and IssYear = $lastyr and CARStatus = 'open'";
	$twoR = mysql_query($two);
	$twoRR = mysql_result($twoR,0,"carCount2");
	?>
    <td class ="t1">
	<?php
	if($twoRR != 0)
	{
	print $twoRR;
	}
	?>
	</td>
	<?php
	
	for ( $counter2 = 1; $counter2 <= 11;)
	{
    $two1 = "select count(CARID) as carCount21 from tblCAR where IssMonth <= $counter2 and IssYear = $curyr and CARStatus = 'open'";
	$twoR1 = mysql_query($two1);
	$twoRR1 = mysql_result($twoR1,0,"carCount21");
	
	?>
    <td class ="t1">
	<?php
	if($counter2 < $curmth)
	{
	if($twoRR1 != 0)
	{
	print $twoRR1; 
	}
	}
	?>
	</td>
	<?php
	
	$counter2++;
    }
	?>
  </tr>
  <tr>
    <td class ="t2"><strong>Total open CAR : </strong></td>
	<?php
	$three = "select count(CARID) as carCount3 from tblCAR where IssMonth  = 1 and IssYear = $curyr and CARStatus = 'open'";
	$threeR = mysql_query($three);
	$threeRR = mysql_result($threeR,0,"carCount3");
	?>
    <td class ="t1">
	<?php
	if($threeRR != 0)
	{
	print $threeRR;
	}
	?>
	</td>
	<?php
	$c3 = 1;
	for ( $counter3 = 2; $counter3 <= 12;)
	{
	$three1 = "select count(CARID) as carCount31 from tblCAR where IssMonth between  1 and $counter3 and IssYear = $curyr and CARStatus = 'open'";
	$threeR1 = mysql_query($three1);
	$threeRR1 = mysql_result($threeR1,0,"carCount31");
	?>
    <td class ="t1">
	<?php
	if($c3 < $curmth)
	{
	if($threeRR1 != 0)
	{
	print $threeRR1; 
	}
	}
	?>
	</td>
   <?php
   $c3++;
   $counter3++;
   }
   ?>
  </tr>
  <tr>
    <td class ="t2"><strong>CAR closed this month : </strong></td>
	<?php
	for ($counter4 = 1; $counter4 <= 12;)
	{
	$four = "select count(CARID) as carCount4 from tblCAR where CMonth = $counter4 and CYear = $curyr";
	$fourR = mysql_query($four);
	$fourRR = mysql_result($fourR,0,"carCount4");
	?>
    <td class ="t1">
	<?php
	if($fourRR != 0)
	{
	print $fourRR; 
	}
	?>
	</td>
    <?php
	$counter4++; 
	}
	?>
  </tr>
  <tr>
    <td class ="t2"><strong>CAR that are still open until the end of the month : </strong></td>
	<?php
	$c5 = 0;
	for ($counter5 = 1; $counter5 <= 12;)
	{
	$five = "select count(CARID) as carCount5 from tblCAR where CARStatus = 'open' and IssMonth between 1 and $counter5  and IssYear = $curyr";
	$fiveR = mysql_query($five);
	$fiveRR = mysql_result($fiveR,0,"carCount5");
	?>
    <td class ="t1">
	<?php
	if($c5 < $curmth)
	{
	if($fiveRR != "0")
	{
	print $fiveRR; 
	}
	}
	?>
	</td>
	<?php
	$c5++;
	$counter5++;
	
	}
	?>
    
  </tr>
  <tr>
    <td class ="t2"><strong>CAR passed the due date : </strong></td>
	<?php
	$six = "select count(CARDTLID2) as carCount6 from tblCARDTL2 where DYear < $curyr and DYear > 0 and CARStatus = 'open'";
	$sixR = mysql_query($six);
	$sixRR = mysql_result($sixR,0,"carCount6");
	?>
	
    <td class ="t1">
	<?php
	if($sixRR != 0)
	{
	print $sixRR; 
	}
	?>
	</td>
	<?php
	$c6 = 2;
	for ($counter6 = 1; $counter6 <= 11;)
	{
	$six1 = "select count(CARDTLID2) as carCount61 from tblCARDTL2 where DMonth < $c6 and DYear = $curyr and CARStatus = 'open'";
	$sixR1 = mysql_query($six1);
	$sixRR1 = mysql_result($sixR1,0,"carCount61");
	
	?>
    <td class ="t1">
	<?php
	
	if($sixRR1 != 0)
	{
	if($c6 <= $curmth) 
	{
	print $sixRR1; 
	}
	}
	
	?>
	</td>
	<?php
	
	
	$counter6++;
	$c6++;
	
	}
	?>
    
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
}
?>
