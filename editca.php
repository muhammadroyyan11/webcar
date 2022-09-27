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
<title>Edit Corrective Action</title>
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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>
<?php
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['inum'])or($_POST['inum'] == "")or(!$_POST['caid'])or($_POST['caid'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$group = $_POST['group'];
$inum = $_POST['inum'];
$id11 = $_POST['id'];
$caid = $_POST['caid'];
$cardtlid2 = $_POST['cardtlid2'];

include ("conn.php");

if(($_SERVER['REQUEST_METHOD'] == "POST") && (isset($_POST['what'])))
{
       
	    if($_POST['what'] == "delete")
		{
		$del = "delete from tblCA where CAID = $caid";
		$delr = mysql_query($del);
		if($delr)
		{
		print "<p align=\"center\" class =\"style2\">Corrective Action has been deleted</p>";
		?>
		<center>
		<form name="form2" method="post" action="catcardetail.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		<input type="hidden" name="inum" value="<?php echo $inum;?>">
		<input type="hidden" name="id" value="<?php echo $id11;?>">
        <input type="submit" name="Submit2" value="back">
      </form>
	  </center>
	  <?php
		}
		}
	    if($_POST['what'] == "update")
		{
			
			$activity = $_POST['activity'];
			$pic = $_POST['pic'];
			
			$date_array =getdate(); 
	   		foreach($date_array as $key => $val)
	   		{
 				$key = $val;
	   		}
	   
			$du = $date_array['mday'];
			$mu = $date_array['mon'];
			$yu = $date_array['year'];
			
			$upact = "update tblCA set Activity = '$activity',DoneBy = $pic where CAID = $caid";
    		
    		$upactResult = mysql_query($upact);
			if($upactResult)
			{
				$update = "UPDATE tblCARDTL2 SET PUpdate=$id11,DUpdate=$du,MUpdate=$mu,YUpdate=$yu WHERE CARDTLID2=$cardtlid2";
				$updateResult = mysql_query($update);
				if($update)
				{
				print "<p align=\"center\" class =\"style2\">Corrective Action has been updated</p>";
				}
			}
			else
			{
				print mysql_error(); 
				print "<p align=\"center\" class =\"style2\">Failed to update Corrective Action</p>";
			}
		}
}		

$select = "SELECT Activity,DoneBy FROM tblCA WHERE CAID = $caid";
$selectResult = mysql_query($select);

$act = "";
$team = "";
$tnm = "";
$tdid = "";
$dname = "";
$disname = "";
if($selectResult)
{
		while($row = mysql_fetch_array($selectResult))
		{
			
			$act = $row['Activity'];
			$team = $row['DoneBy'];
			
			$gt = "select Name,DeptID from tblMUAccount where MUserID = $team";
			$gtr = mysql_query($gt);
			if($gtr)
			{
			while($rtnm = mysql_fetch_array($gtr))
			{
			 	$tnm = $rtnm['Name'];
			 	$tdid = $rtnm['DeptID'];
			 
			 	$gt1 = "select DeptName from tblDept where DeptID = $tdid";
			 	$gtr1 = mysql_query($gt1);
			 	if($gtr1)
			 	{
			 		while($rdname = mysql_fetch_array($gtr1))
			 		{
			 			$dname = $rdname['DeptName'];
			 		}
			 	}
				$disname = $tnm." Dept. ".$dname;
			}
			}
		}
}		//close		if($selectResult)	
							


if($_POST['what'] != "delete")
{
?>
<body>

<form action="editca.php" method="post" name="form1" onSubmit="MM_validateForm('activity','','R','pic','','R');return document.MM_returnValue">
  <p align="center" class="style3">Corrective Action for CAR Number <?php echo $inum; ?></p>
  <table align="center" class="tbl">
  
      <td class="t2">Activity : </td>
	
      <td class="t1"><textarea name="activity" cols="100" rows="20"><?php echo $act; ?></textarea></td>
    </tr>
	<tr>
      <td class="t2">PIC : </td>
      <td class="t1"><select name="pic"><option value="<?php echo $team; ?>"><?php echo $disname; ?></option>
	  <?php
	  $cid = "";
	  $did = "";
	  $name = "";
	  $dn = "";
	  $dis = "";
	  $gp = "select MUserID,DeptID,Name from tblMUAccount where GroupID = 'cat' StatusActive = 1 order by Name ASC";
	  $gpr = mysql_query($gp);
	  if($gpr)
	  {
	  		while ($rp = mysql_fetch_array($gpr))
	        {
			$cid = $rp['MUserID'];
			$did = $rp['DeptID'];
			$name = $rp['Name'];
		
		    $gdn = "select DeptName from tblDept where DeptID = $did";
			$gdnr = mysql_query($gdn);
			if($gdnr)
			{
				while($rdn = mysql_fetch_array($gdnr))
				{
					$dn = $rdn['DeptName'];
					$dis = $name." Dept ".$dn;
					?>
					<option value="<?php echo $cid; ?>"><?php echo $dis; ?></option>
					<?php
					
				}
			}
			}
	  }
	  ?>
	  </select></td>
    </tr>
	
    <tr>
      <td class="t2"><br/>
      <br/></td>
      <td class="t1"><input type="hidden" name="group" value="<?php echo $group;?>">
	  <input type="hidden" name="inum" value="<?php echo $inum;?>">
	  <input type="hidden" name="id" value="<?php echo $id11;?>">
	  <input type="hidden" name="caid" value="<?php echo $caid;?>">
	  <input type="hidden" name="cardtlid2" value="<?php echo $cardtlid2;?>">
	  <input type="hidden" name="what" value="update"><input type="submit" name="Submit" value="update">
<input type="reset" name="Submit3"></form><table><tr><td><form name="form2" method="post" action="editca.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		<input type="hidden" name="inum" value="<?php echo $inum;?>">
		<input type="hidden" name="id" value="<?php echo $id11;?>">
		<input type="hidden" name="caid" value="<?php echo $caid;?>">
	  <input type="hidden" name="cardtlid2" value="<?php echo $cardtlid2;?>">
	   <input type="hidden" name="what" value="delete">
        <input type="submit" value="delete">
      </form></td><td><form name="form2" method="post" action="catcardetail.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		<input type="hidden" name="inum" value="<?php echo $inum;?>">
		<input type="hidden" name="id" value="<?php echo $id11;?>">
        <input type="submit" name="Submit2" value="back">
      </form></td></tr></table></td>
    </tr>
  </table>

 

</body>
</html>
<?php
}
}

?>



