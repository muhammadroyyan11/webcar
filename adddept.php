<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
//display admin menu
$group = $_POST['group'];

if($_SERVER['REQUEST_METHOD'] == "POST") //add button is clicked
{
    if((isset($_POST['what'])) && ($_POST['what'] == "add"))

	{
	$name = $_POST['departement'];
	$manager = $_POST['manager'];
	$did = $_POST['id'];
	
	include("conn.php");
		
    $sql = "INSERT INTO tblDept ";
    $sql .= "(DeptName,DeptMngr,DID)";
    $sql .= "VALUES ( ";
    $sql .= "'$name','$manager','$did')"; 
    $result = mysql_query($sql, $connection);
		
		if($result)
		{
			print "<center><p class=\"style2\">".$name." "."has been added to department list</p></style></center>";
		}
		
	}
		
	
}
?>
<html>
<head>
<title>Adding Departement</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
font-family: Arial, Helvetica, sans-serif;
font-size: 24px;
color:#990000;
}

.style3 {
font-family: Arial, Helvetica, sans-serif;
font-size: 24px;
}
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
    } } } else if (test.charAt(0) == 'R') errors += nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>

<body>
<table width="48" border="0" align="center">
    <tr>
      <td width="42"><form name="form1" method="post" action="editdept.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="Department List">
      </form></td>
    
  
    </tr>
</table>
<p align="center" class="style3"><strong> Add Departement </strong></p>
<table width="366" border="0" align="center" class="tbl">
  <tr>
    <td width="360" class="style1"><form action="adddept.php" method="post" name="form1" onSubmit="MM_validateForm('departement','','R','manager','','R','id','','R');return document.MM_returnValue" >
      <table width="360" border="0" align="center">
        <tr>
          <td class="t2">Departemen Name : </td>
          <td class="t1"><input name="departement" type="text" id="departement" size="25" maxlength="25"></td>
        </tr>
        <tr>
          <td class="t2">Departemen Manager  : </td>
          <td class="t1"><input name="manager" type="text" id="manager" size="25" maxlength="25"></td>
        </tr>
		<tr>
          <td class="t2">Departemen ID  : </td>
          <td class="t1"><input name="id" type="text" id="id" size="10" maxlength="10"></td>
        </tr>
        <tr>
          <td class="t2"><br></td>
          <td class="t1"><br><input type="hidden" name="what" value="add"><input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="Add"> <input name="Reset" type="reset" id="Reset" value="Reset"></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>

</body>
</html>
<?php
}
?>