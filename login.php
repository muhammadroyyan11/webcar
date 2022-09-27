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
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK  href="tbldesign.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {	font-size: 18px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style4 {
	font-size: 36px;
	color: #999999;
	font-weight: bold;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style5 {font-family: Arial, Helvetica, sans-serif}
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }

.style7 {font-family:Arial, Helvetica, sans-serif; font-size:10px;)
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
          if (num<min || max<num) errors+=+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>

<body>
<table align="center">
  <tr>
    <td valign="top"><form action="login1.php" method="post" name="login" onSubmit="MM_validateForm('username','','R','password','','R');return document.MM_returnValue">
        <input type="hidden" name="what" value="login">
		<table class="tbl" align="center" bgcolor="#CCFFFF">
          <tr class="t5">
            <td align ="center" class= "style4" colspan="2">  Login
                        
                <hr noshade>
           </td>
          </tr>
          <tr class="t5">
            <td>Group:</td>
            <td>
              <select name="group">
                <option value="os">Originator</option>
                <option value="om">Originator Manager</option>
                <option value="am">In Charge Manager</option>
				<!--<option value="cam">Corrective Action Manager</option>-->
                <option value="cat">Corrective Action Team</option>
                <option value="admin">Administrator</option>
              </select>
            </td>
          </tr>
		  <tr class="t5" >
            <td>Username:</td>
            <td><input name="username" type="text" size="25" maxlength="25"></td>
          </tr>
          <tr class="t5">
            <td>Password:</td>
            <td><input name="password" type="password" size="10" maxlength="10"></td>
          </tr>
          <tr class="t5">
            <td align="right"><br/><br/></td>
            <td>
              <p class="p">
                <input type="submit" name="Submit" value="Login">
            </p></td>
          </tr>
        </table>
    </form></td>
  </tr>
</table>

      <table class="tbl" align="center" bgcolor="#CCFFFF">
	  <form action="login2.php" method="post" name="form1" onSubmit="MM_validateForm('guest password','','R');return document.MM_returnValue">
        <tr class="t5">
          <td>Password : </td>
          <td><input name="guestpassword" type="password" id="guest password" size="10" maxlength="10"> 
		  <input type="hidden" name="group" value="guest">
		  <input type="submit" name="Submit2" value="Login As Guest"></td>
        </tr>
	    </form>
      </table>
<br/>
<table align ="center" class="style7" >
<tr align="center"><td>CARWeb  Version 1.0</td></tr>
<tr align="center"><td>Program Revised on July 2006</td></tr>
<tr align="center"><td>PT Trias Sentosa, Tbk all rights reserved.</td></tr>
 
<tr align="center"><td><br/>If problem occurs please contact : </td></tr>
<tr align="center"><td>Riezky Angga Besthani (IA & DCC) - 374</td>
</tr>
<tr align="center"><td>Mualifi (IT) - 796</td>
</tr>
<tr align="center">
  <td>&nbsp;</td>
</tr>
<tr align="center"><td  align="left" ><br/><br/><a href="privacy.php" target="blank">Privacy dan Ketentuan Penggunaan CARWeb version 1.0 </a>

</td></tr>
</table>
</body>
</html>
