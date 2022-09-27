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
			
			$insert = "insert into tblCA (IssNumber,CDTL2,Activity,DoneBy,CAStatus) VALUES ('$inum',$cardtlid2,'$activity',$pic,'open')";
    		
    		$insertResult = mysql_query($insert);
			if($insertResult)
			{
				$update = "UPDATE tblCARDTL2 SET PUpdate=$id11,DUpdate=$du,MUpdate=$mu,YUpdate=$yu WHERE CARDTLID2=$cardtlid2";
				$updateResult = mysql_query($update);
				if($update)
				{
				print "<p align=\"center\" class =\"style2\">Corrective Action has been added</p>";
				}
			}
			else
			{
				print mysql_error(); 
				print "<p align=\"center\" class =\"style2\">Failed to add Corrective Action</p>";
			}
		}
}		

$select = "SELECT Findings,Analysis FROM tblCARDTL2 WHERE CARDTLID2 = $cardtlid2";
$selectResult = mysql_query($select);

$a = "";
$fdg = "";

if($selectResult)
{
		while($row = mysql_fetch_array($selectResult))
		{
			
			$fdg = $row['Findings'];
			$a = $row['Analysis'];
			
		}
}					
							



?>
<body>
<form action="catedit1.php" method="post" name="form1" onSubmit="MM_validateForm('activity','','R','pic','','R');return document.MM_returnValue">
  <p align="center" class="style3">Corrective Action for CAR Number <?php echo $inum; ?></p>
  <table b align="center" class="tbl">
  
	<td class="t2">Problem :</td>
	<td class="t1"><?php echo $fdg; ?></td>
	</tr>
	<tr>
      <td class="t2">Analysis : </td>
      <td class="t1"><?php echo $a; ?></td>
    </tr>
	<tr>
      <td class="t2">Activity : </td>
      <td class="t1"><textarea name="activity" cols="100" rows="20"></textarea></td>
    </tr>
	<tr>
      <td class="t2" >PIC : </td>
      <td class="t1"><select name="pic"><option value=""></option>
	  <?php
	  $cid = "";
	  $did = "";
	  $name = "";
	  $dn = "";
	  $dis = "";
	  $gp = "select MUserID,DeptID,Name from tblMUAccount where GroupID = 'cat' AND StatusActive = 1 order by Name ASC";
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
					$dis = $name." ".$dn;
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


