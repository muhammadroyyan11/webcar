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
<title>Edit Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



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
        if (p<1 || p==(val.length-1)) errors+= nm+' is not in valid format.\n';
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
if ((!$_POST['group'])or($_POST['group'] == "")or(!$_POST['userid'])or($_POST['userid'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else //user authorized
	{
	
	include ("conn.php");
	
	$userid = $_POST['userid'];
	$group = $_POST['group'];
	
	if($_SERVER['REQUEST_METHOD'] == "POST") //update button is clicked
	{
		if(isset($_POST['what']))
		{
			if($_POST['what'] == "update")
			{
				$uname = $_POST['username'];
				$pwd = $_POST['password'];
				$nm = $_POST['name'];
				$dpt = $_POST['departement'];
				$eml = $_POST['email'];
				if($_POST['section'] != "")
				{
					$sect = $_POST['section'];
				}
				else 
				{
				$sect = "";
				}
				
				
				$sql = "UPDATE tblMUAccount SET ";
				$sql .= "MPassword = '$pwd',DeptID = $dpt,Name = '$nm',Section = '$sect',Email = '$eml'";
				$sql .= " WHERE MUsername = '$uname'";
    			$result = mysql_query($sql, $connection);
		
   	 			if ($result)
				{ 
					//update all other account with same username and password
					print "<p align =\"center\" class =\"style2\">Account for  $nm has been updated</p>";
				}
    			else 
				{
					print mysql_error();
				}
   			} // close update
	
		if($_POST['what'] == "delete")
   		{
             
						$delete = "DELETE FROM tblMUAccount WHERE MUserID = '$_POST[userid]'";
		                $delqry = mysql_query($delete);
						print "<p align =\"center\" = \"p\" class=\"style2\">Selected Account has been deleted</p>";
						?>
						<table width="80" border="0" align="center">
    					<tr>
     					 <td width="74"><form name="form1" method="post" action="viewmaster.php">
	    				<input type="hidden" name="group" value="<?php echo $group; ?>">
        				<input type="submit" name="Submit" value="Back">
      					</form></td>
    					</tr>
						</table>
						<?php
	    }
		
		if($_POST['what'] == "addgroup")
   		{
             $grp1 = $_POST['grp1'];
			 $un = $_POST['uname1'];
			 
			 //check whether user is already in the group
			 $check = "select * from tblMUAccount WHERE MUsername = '$un'";
			 $checkResult = mysql_query($check);
			 
			 $nm = "";
			 $g = "";
			 $e = "empty"; 
			 
			 if($checkResult)
			 {
			 while($row1 = mysql_fetch_array($checkResult))
            {
					$nm = $row1['Name'];
					$g = $row1['GroupID'];
					
					if($g == $grp1)
					{
						$e = "full";
						
						if($g == "os")
						{
							$dp = "Originator";
						}
						elseif($g == "om")
						{
							$dp = "Originator Manager";
					    }
						elseif($g == "am")
					    {
							$dp = "In Charge Manager";
						}
						/*
						elseif($g == "cam")
						{
							$dp = "Corrective Action Manager";
					    }
						*/
						else
						{
							$dp = "Corrective Action Team";
						}
						print "<p align=\"center\" class=\"style2\" >$nm is already registered under $dp</p><br/>";
					} // close if($g == $grp1)
					
			}
			}//close if($checkResult)
			
			 
			 if($e == "empty") //enter data
			 {
			 $u = "";
			 $p = "";
			 $n = "";
			 $i = "";
			 $s = "";
			 $eml1 = "";
			 $ui = $_POST['userid'];
			 
			 $getData = "select * from tblMUAccount WHERE MUserID = $ui";
		     $getDataResult = mysql_query($getData);
			 if($getDataResult)
			 {
			 while($row = mysql_fetch_array($getDataResult))
            {
	    			$u = $row['MUsername'];
					$p = $row['MPassword'];
					$n = $row['Name'];
					$d = $row['DeptID'];
					$s = $row['Section'];
					$eml1 = $row['Email'];
					
			}
			}			
			if(($u != "") && ($p != "")&& ($n != "")&& ($d != ""))
			{
			
				$insert = "INSERT INTO tblMUAccount ";
    			$insert .= "(MUsername,MPassword,Name,DeptID,Section,GroupID,Email) ";
    			$insert .= "VALUES ( ";
    			$insert .= "'$u','$p','$n',$d,'$s','$grp1','$eml1')"; 
    			$insertResult = mysql_query($insert, $connection);
				
				if($insertResult)
				{
					if($grp1 == "os")
					{
							$displayGroup = "Originator";
					}
					elseif($grp1 == "om")
					{
							$displayGroup = "Originator Manager";
					}
					elseif($grp1 == "am")
					{
							$displayGroup = "In Charge Manager";
					}
					/*
					elseif($grp1 == "cam")
					{
							$displayGroup = "Corrective Action Manager";
					}
					*/
					else
					{
							$displayGroup = "Corrective Action Team";
					}
						
				 print "<p align =\"center\" class=\"style2\">$n has been added to $displayGroup list.</p><br>";
				}
			} //close if(insertResult)
						
		}
						
						
						
						
	    }//close if($_POST['what'] == "addgroup")
			
} //close what
	
	$select= "SELECT * FROM tblMUAccount WHERE MUserID = $userid "; 
	$selectResult = mysql_query($select);
		if ($selectResult)
		{
		while($row = mysql_fetch_array($selectResult))
			{
				$userID = $row['MUserID'];
				$userName = $row['MUsername'];
				$pass = $row['MPassword'];
				$name = $row['Name'];
				$deptID = $row['DeptID'];
				$sec = $row['Section'];
				$grp = $row['GroupID'];
				$email = $row['Email'];
			
			
	?>

<body>
<p></p>
<table width="80" border="0" align="center">
    <tr>
      <td width="74"></td>
    </tr>
</table>
<p align="center" class="style2"><strong> Edit Account </strong></p>
<table width="707" border="0" align="center">
  <tr>
    <td width="337" class="style1"><form action="editmaster.php" method="post" name="form1" onSubmit="MM_validateForm('password','','R','name','','R','email','','NisEmail');return document.MM_returnValue">
      <table width="337" border="0" align="center">
        <tr>
          <td width="121" class="style1">Username : </td>
          <td width="363" class="style1"><?php echo $userName; ?>
          </td>
        </tr>
        <tr>
          <td class="style1">Password : </td>
          <td>        <input name="password" type="text" id="password" size="25" maxlength="25" value ="<?php echo $pass; ?>"></td>
        </tr>
		<tr>
          <td width="121" class="style1">Name : </td>
          <td width="363" class="style1">
            <input name="name" type="text" id="name" size="25" maxlength="50" value ="<?php echo $name; ?>">
          </td>
        </tr>
        <tr>
          <td class="style1">Departement : </td>
          <td>      <select name="departement">
		      
		    <?php
		 
		  $getDept = "select DeptID,DeptName from tblDept Where DeptID = $deptID";
		  $getDeptResult = mysql_query($getDept);
		  while($row1 = mysql_fetch_array($getDeptResult))
			{
			$deptid1 = $row1['DeptID'];
			$deptname1 = $row1['DeptName'];
			}
			
            ?>
                <option value="<?php echo $deptid1;?>"><?php echo $deptname1; ?></option>
                <?php
		  
		  ?>
		   <option value=""></option>
		   <?php
		  $getDept1 = "select DeptID,DeptName from tblDept";
		  $getDeptResult1 = mysql_query($getDept1);
		  while($row2 = mysql_fetch_array($getDeptResult1))
			{
			$deptid2 = $row2['DeptID'];
			$deptname2 = $row2['DeptName'];
			
		  ?>
                <option value="<?php echo $deptid2;?>"><?php echo $deptname2; ?></option>
                <?php
		  }
		  ?>
            </select>      </td>
        </tr>
		<tr>
          <td width="121" class="style1">Section : </td>
          <td width="363">		    <input name="section" type="text" id="section" size="25" maxlength="25" value ="<?php echo $sec; ?>"></td>
        </tr>
		<tr>
          <td width="121" class="style1">Email : </td>
          <td width="363">		    <input name="email" type="text" id="email" size="25" maxlength="25" value ="<?php echo $email; ?>"></td>
        </tr>
        <tr>
          <td class="style1"><br>
          </td>
          <td class="style1"><br>
              <input type="hidden" name="what" value="update">
			  <input type="hidden" name="username" value="<?php echo $userName; ?>">
		      <input type="hidden" name="group" value="<?php echo $group; ?>">
		      <input type="hidden" name="userid" value="<?php echo $userid; ?>">
              <input type="submit" name="Submit" value="update"> 
              <input name="Reset" type="reset" id="Reset" value="reset">
          </td>
        </tr>
      </table>
    </form></td><td  valign="top" width="360"><form name="form3" method="post" action="editmaster.php"><select name="grp1" id="grp1">
					<option value="os">Originator</option>
      				<option value="om">Originator Manager</option>
      				<option value="am">In Charge Manager</option>
					<!--
      				<option value="cam">Corrective Action Manager</option>
					-->
      				<option value="cat">Corrective Action Team</option>
					</select>
                    <input type="hidden" name="what" value="addgroup">
					<input type="hidden" name="uname1" value="<?php echo $userName; ?>">
					<input type="hidden" name="userid" value="<?php echo $userid; ?>">
					<input type="hidden" name="group" value="<?php echo $group; ?>">
      
        <input type="submit" name="Submit3" value="add group">
      </form></td>
  </tr>
</table>

<table border="0" align="center">
  <tr>
   
	<!--
    <td width="54" ><form name="form2" method="post" action="editmaster.php">
	<input type="hidden" name="what" value="delete">
	<input type="hidden" name="group" value="<?php //echo $group; ?>">
		  <input type="hidden" name="userid" value="<?php //echo $userid; ?>">
      <input type="submit" name="Submit2" value="delete">
	  
    </form></td>
	--><td><form name="form1" method="post" action="viewmaster.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit" value="back">
      </form></td>
  </tr>
</table>

<table width="339" border="0" align="center">
  <tr>
  <td width="10"></td>
    <td width="164"></td>
  </tr>
</table>



<?php
}
}
}
}


?>
</body>
</html>

