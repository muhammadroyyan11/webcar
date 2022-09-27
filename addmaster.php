
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
<title>Adding User Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK  href="tbldesign.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style17 {font-family: Georgia, "Times New Roman", Times, serif; font-size: x-small; }
.style20 {font-size: small}
.style22 {
	color: #FF0000;
	font-size: smaller;
	font-family: Arial, Helvetica, sans-serif;
}
.style23 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 36px;
	font-weight: bold;
	color: #999999;
}
.style25 {font-family: Arial, Helvetica, sans-serif; font-size: small; }
.style26 {font-family: Arial, Helvetica, sans-serif}
.style27 {font-family: Arial, Helvetica, sans-serif; font-size: x-small; }
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
        if (p<1 || p==(val.length-1)) errors+= nm+' is not in valid format.\n';
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

 	if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
	$group = $_POST['group'];
	
	include ("conn.php"); //connection to database
	if($_SERVER['REQUEST_METHOD'] == "POST") //upload button is clicked
	{
	
		if(isset($_POST['what']))
		{
	        
			if($_POST['what'] == "add")
			{
			$grp = $_POST['grp'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			
		    $section = "";
			if($_POST['section'] != "")
			{
				$section = $_POST['section'];
			}
			$dept = $_POST['dept'];
			if (isset($_POST['name'])) 
			{
				if ($_POST['name'] != "")
				{
				$name = $_POST['name'];
				}
				else // get the name of department manager
				{
				$getMngr = "select DeptMngr from tblDept where DeptID = $dept";
				$getMngrResult = mysql_query($getMngr);
					while($rowM = mysql_fetch_array($getMngrResult))
					{
					$name = $rowM['DeptMngr'];
					}
				}
			}
			$email = $_POST['email'];
			//check whether username and password are already exist in the database
			$getUser = "select * from tblMUAccount where MUsername = '$username' and MPassword = '$password' and GroupID = '$grp'";
			$getUserResult = mysql_query($getUser);
			if($getUserResult)
			{
					    $u = "";
						$p = "";
						$n = "";
						$g = "";
					while($row = mysql_fetch_array($getUserResult))
        			{
	    				$u = $row['MUsername'];
						$p = $row['MPassword'];
						$n = $row['Name'];
						$g = $row['GroupID'];
					}
                       
					if(($u != "")&&($p != ""))
					{
						
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
						print "<strong><h2><center><font color =\"red\" >Username and password is already registered for $n under $dp</font></center></h3></strong><br/>";
						//give option to add user to another group
						 $form = "<center>";
	                     $form .= "<form method=\"POST\" action=\"addmaster.php\">";
	                     $form .= "<table class =\"style1\">";
	                     $form .= "<tr>";
						 $form .= "<td><select name=\"grp1\" id=\"grp1\">";
						 $form .= "<option value=\"os\">Originator</option>";
      					 $form .= "<option value=\"om\">Originator Manager</option>";
      				     $form .= "<option value=\"am\">In Charge Manager</option>";
      					 //$form .= "<option value=\"cam\">Corrective Action Manager</option>";
      					 $form .= "<option value=\"cat\">Corrective Action Team</option>";
						 $form .= "</select>";
                         $form .= "<td><input type=\"hidden\" name=\"what\" value=\"addgroup\">";
						 $form .= "<input type=\"hidden\" name=\"username1\" value=\"$username\">";
						 $form .= "<input type=\"hidden\" name=\"password1\" value=\"$password\">";
						 $form .= "<input type=\"hidden\" name=\"name1\" value=\"$name\">";
						 $form .= "<input type=\"hidden\" name=\"dept1\" value=\"$dept\">";
						 $form .= "<input type=\"hidden\" name=\"sec1\" value=\"$section\">";
						 $form .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
						  $form .= "<input type=\"hidden\" name=\"email1\" value=\"$email\">";
						 $form .= "<td><input type=\"submit\" value=\"Add Group\"></td>";
	                     $form .= "</tr>";
	                     $form .= "</table>";
	                     $form .= "</form>";
	                     print $form;
                         print "<p></p>";
					}
					
					else
					{   //add user
						$insert = "INSERT INTO tblMUAccount ";
    					$insert .= "(MUsername,MPassword,Name,DeptID,Section,GroupID,Email) ";
    					$insert .= "VALUES ( ";
    					$insert .= "'$username','$password','$name',$dept,'$section','$grp','$email')"; 
    					$insertResult = mysql_query($insert, $connection);
		
   	 					if ($insertResult)
						{ 
						
									if($grp == "os")
									{
										$displayGroup = "Originator";
									}
									elseif($grp == "om")
									{
									$displayGroup = "Originator Manager";
									}
									elseif($grp == "am")
									{
										$displayGroup = "In Charge Manager";
									}
									/*
									elseif($grp == "cam")
									{
										$displayGroup = "Corrective Action Manager";
									}
									*/
									else
									{
										$displayGroup = "Corrective Action Team";
									}
						
						           print "<p align=\"center\" class=\"p\">$name has been added to $displayGroup list.</p><br>";
				           	
				}//close insertResult
			}//close else( add user)
					
		}//close if getUserResult
		else{
		print mysql_error();
		}
		
		} //close if $_POST['what'] == add
		else if($_POST['what'] == "addgroup")
		{
		//add to another group 
		
		$username1 = $_POST['username1'];
		$password1 = $_POST['password1'];
		$name1 = $_POST['name1'];
		$grp1 = $_POST['grp1'];
		$dept1 = $_POST['dept1'];
		$sec1 = $_POST['sec1'];
		$email1 = $_POST['email1'];
		
		$add = "INSERT INTO tblMUAccount ";
    	$add .= "(MUsername,MPassword,Name,DeptID,Section,GroupID,Email) ";
        $add .= "VALUES ( ";
    	$add .= "'$username1','$password1','$name1',$dept1,'$sec1','$grp1','$email1')"; 
    	$insertResult = mysql_query($add, $connection);
		
		
		
							if($grp1 == "os")
							{
								$displayGroup1 = "Originator";
							}
							elseif($grp1 == "om")
							{
								 $displayGroup1 = "Originator Manager";
							}
							elseif($grp1 == "am")
							{
								 $displayGroup1 = "In Charge Manager";
							}
							/*
							elseif($grp1 == "cam")
							{
								$displayGroup1 = "Corrective Action Manager";
							}
							*/
							elseif($group1 == "cat")
							{
								$displayGroup1 = "Corrective Action Team";
							}
							else
							{
								$displayGroup1 = "";
							}
						
						    print "<p align=\"center\" class=\"p\">$name1 has been added to $displayGroup1 list.</p><br>";
					
		} //close if($_POST['what'] == "addgroup")
	} //close if ($_POST['what']
} //close if($_SERVER['REQUEST_METHOD'] == "POST")




?>


<body>
<center>
<form name="form2" method="post" action="viewmaster.php">
	  <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit2" value="Back">
  </form>
</center>
<form action="addmaster.php" method="post" name="form1" onSubmit="MM_validateForm('username','','R','email','','NisEmail','password','','R');return document.MM_returnValue">
  <p align="center" class="p">New Account </p>
  <table align="center" class="tbl">
  <tr>
    <td class ="t2">Username :</td>
    <td class ="t1"><input name="username" type="text" id="username" size="25" maxlength="25"></td>
  </tr>
  <tr>
    <td class ="t2">Password :</td>
      <td class ="t1"><input name="password" type="password" id="password" size="25" maxlength="25"></td>
  </tr>
  <tr>
    <td class ="t2">Name : </td>
    <td class ="t1">
    <input name="name" type="text" id="name" size="50" maxlength="50"><br/>
    <i>(leave this blank if he or she is the manager of the department)</i>
</span></td>
  </tr>
  <tr>
    <td class ="t2">Departement  :</td>
    <td class ="t1">
	<select name="dept">
		    
		    <?php
			
		  $getDept = "select DeptID,DeptName from tblDept ORDER BY DeptName ASC";
		  $getDeptResult = mysql_query($getDept);
		  while($row = mysql_fetch_array($getDeptResult))
			{
			$deptid = $row['DeptID'];
			$deptname = $row['DeptName'];

		  ?>
                <option value="<?php echo $deptid;?>"><?php echo $deptname; ?></option>
          <?php
		  }
		  
		  ?>
        </select>    </td>
  </tr>
  <tr>
    <td  class ="t2" >Section : </td>
    <td class ="t1">
    <input name="section" type="text" id="section" size="25" maxlength="25">
</span></td>
  </tr>
  <tr>
    <td class ="t2">Group : </td>
    <td class ="t1"><select name="grp" id="grp">
      <option value="os">Originator</option>
      <option value="om">Originator Manager</option>
      <option value="am">In Charge Manager</option>
	  <!--
      <option value="cam">Corrective Action Manager</option>
	  -->
      <option value="cat">Corrective Action Team</option>
    </select>    
      </td>
  </tr>
   <tr>
    <td class ="t2">Email : </td>
    <td class ="t1"><input type="text" name="email" size="50" maxlength="50">   
      </td>
  </tr>
  <tr valign="middle">
    <td class ="t2">      <center>
       
    </center>
  <input type ="hidden" name="group" value="<?php echo $group; ?>">
      <input type ="hidden" name="what" value="add">      </td>
    <td class ="t1"><br/><input name="Submit" type="submit" value="Add"></td>
  </tr>
</table>
</form>

</body>
</html>
<?php
} //close else(user authorized to view the page
?>


