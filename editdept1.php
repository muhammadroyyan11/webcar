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
<title>Edit Departement</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
font-family: Arial, Helvetica, sans-serif;
font-size:14px;
color:#990000;
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
<?php 
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['id'])or($_POST['id'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else //user authorized
	{
	
	include ("conn.php");
	
	$id = $_POST['id'];
	$group = $_POST['group'];
	
	if($_SERVER['REQUEST_METHOD'] == "POST") //update button is clicked
	{
		if(isset($_POST['what']))
		{
			if($_POST['what'] == "update")
			{
				$dept = $_POST['departement'];
				$mngr = $_POST['manager'];
				$did = $_POST['DeptID'];
				
				$sql = "UPDATE tblDept SET ";
				$sql .= "DeptName = '$dept', DeptMngr = '$mngr',DID='$did'";
				$sql .= " WHERE DeptID=$id";
    			$result = mysql_query($sql, $connection);
		
   	 			if ($result)
				{ 
					print "<p class =\"p\" align=\"center\">Department Information has been updated</p>";
				}
    			else 
				{
					print mysql_error();
				}
   			}
	
		if($_POST['what'] == "delete")
   		{
            $delete = "DELETE FROM tblDept WHERE DeptID = '$_POST[id]'";
		    $delqry = mysql_query($delete);
		    if ($delqry) 
			{
			print "<p class = \"p\" align=\"center\">Selected Department has been delete</p>";
			?>
			<table width="113" border="0" align="center">
              <tr>
                <td><form name="form1" method="post" action="editdept.php">
                  <input type="hidden" name="group" value="<?php echo $group; ?>">
                  <input type="submit" name="Submit3" value="Back">
                </form></td>
              </tr>
            </table>
<?php
			
			}

}
}
	}
	$select= "SELECT * FROM tblDept WHERE DeptID = $id "; 
	$selectResult = mysql_query($select);
		if ($selectResult)
		{
		while($row = mysql_fetch_array($selectResult))
			{
	?>

<body>

<p align="center" class="p">Edit Departement</p>
<table border="0" align="center">
  <tr>
    <td><form action="editdept1.php" method="post" name="form1" onSubmit="MM_validateForm('departement','','R','manager','','R','DeptID','','R');return document.MM_returnValue">
      <table border="0" align="center">
        <tr>
          <td class="t2">Departement Name : </td>
          <td class="t1"><input name="departement" type="text" id="departement" size="25" maxlength="25" value ="<?php echo $row['DeptName']; ?>"></td>
        </tr>
        <tr>
          <td class="t2">Departement Manager : </td>
          <td class="t1"><input name="manager" type="text" id="manager" size="25" maxlength="25" value ="<?php echo $row['DeptMngr']; ?>"></td>
        </tr>
        <tr>
		<tr>
          <td class="t2">Departement ID : </td>
          <td class="t1"><input name="DeptID" type="text" id="DeptID" size="25" maxlength="25" value ="<?php echo $row['DID']; ?>"></td>
        </tr>
        <tr>
          <td><br></td>
          <td><br><input type="hidden" name="what" value="update">
		  <input type="hidden" name="group" value="<?php echo $group; ?>">
		  <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="Submit" value="update"> 
            <input name="Reset" type="reset" id="Reset" value="reset"></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<table  border="0" align="center">
  <tr>
    
   <td ><form name="form1" method="post" action="editdept.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="back">
      </form></td>
  </tr>
</table>


<p>&nbsp;</p>

<?php
}
}
}


?>
</body>
</html>
