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
<title>Edit Analysis</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK  href="tbldesign.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style3 {font-family: Arial, Helvetica, sans-serif; font-size: 18px; }
.style2 {
font-family: Arial, Helvetica, sans-serif; font-size: 18px;
color:#990000; 
}
.style22 {font-size: 12px; font-weight: bold; color: #990000; }
-->
</style>
</head>
<?php
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['inum'])or($_POST['inum'] == "")or(!$_POST['cardtlid2'])or($_POST['cardtlid2'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$group = $_POST['group'];
$inum = $_POST['inum'];
$id11 = $_POST['id'];
$cardtlid2 = $_POST['cardtlid2'];

include ("conn.php");

if(($_SERVER['REQUEST_METHOD'] == "POST") && (isset($_POST['what'])))
{
        if($_POST['what'] == "add")
		{
			if($_POST['analysis'] != "")
			{
				$analysis = $_POST['analysis'];
			}
			else
			{
				$analysis = "n/a";
			}
			/*
			if($_POST['corract'] != "")
			{
				$corract = $_POST['corract'];
			}
			else
			{
				$corract = "n/a";
			}
			*/
			$date_array =getdate(); 
	   		foreach($date_array as $key => $val)
	   		{
 				$key = $val;
	   		}
	   
			$du = $date_array['mday'];
			$mu = $date_array['mon'];
			$yu = $date_array['year'];
			
			$update = "UPDATE tblCARDTL2 SET Analysis='$analysis',PUpdate=$id11,DUpdate=$du,MUpdate=$mu,YUpdate=$yu WHERE CARDTLID2=$cardtlid2";
    		
    		$updateResult = mysql_query($update);
			if($updateResult)
			{
				print "<center><p class =\"style2\">Analysis has been updated</center></p>";
			}
			else
			{
				print mysql_error(); 
				print "<center><p class =\"style2\">Failed to update Analysis</center></p>";
			}
		}
}		

$select = "SELECT Findings,Analysis,CorrAct FROM tblCARDTL2 WHERE CARDTLID2 = $cardtlid2";
$selectResult = mysql_query($select);

$a = "";
$c = "";

if($selectResult)
{
		while($row = mysql_fetch_array($selectResult))
		{
			//$cde = $row['Code'];
			$fdg = $row['Findings'];
			$a = $row['Analysis'];
			$c = $row['CorrAct'];
		}
}					
							



?>
<body>
<form name="form1" method="post" action="catedit.php">
  <p align="center" class="p">Analysis for CAR Number <?php echo $inum; ?></p>
  <table width="940" align="center" class="tbl">
  <!--
    <tr>
	<td>Code :</td>
	<td><?php //echo $cde;?></td>
	</tr>
	<tr>
	-->
	<td class="t2">Problem :</td>
	<td class="t1"><?php echo $fdg; ?></td>
	</tr>
	<tr>
      <td class="t2">Analysis : </td>
      <td class="t1" width="640">
	  <textarea name="analysis" cols="100" rows="20" id="analysis">
	  <?php
	  if($a != "")
	  {
	  print $a;
	  }
	  ?>
	  </textarea>	  </td>
    </tr>
	<!--
    <tr>
      <td>Corrective Action : </td>
      <td>
	  <textarea name="corract" cols="100" rows="20" id="corract">
	  <?php
	  //if($c != "")
	  //{
	  //print $c;
	  //}
	  ?>
	  </textarea>	  </td>
    </tr>
	-->
    <tr>
      <td class="t2"><br/><input type="hidden" name="group" value="<?php echo $group;?>">
	  <input type="hidden" name="inum" value="<?php echo $inum;?>">
	  <input type="hidden" name="id" value="<?php echo $id11;?>">
	  <input type="hidden" name="cardtlid2" value="<?php echo $cardtlid2;?>">
	  <input type="hidden" name="what" value="add">
      <br/></td>
      <td class="t1"><input type="submit" name="Submit" value="Submit">
      <input type="reset" name="Submit3"></form><form name="form2" method="post" action="catcardetail.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		<input type="hidden" name="inum" value="<?php echo $inum;?>">
		<input type="hidden" name="id" value="<?php echo $id11;?>">
        <input type="submit" name="Submit2" value="Back">
      </form></td>
    </tr>
  </table>

 

</body>
</html>
<?php
}

?>

