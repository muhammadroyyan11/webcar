<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>..:: Add/Update/Delete Verification Form ::..</title>
<?php

if (  (!$_GET['inum'])or($_GET['inum'] == "") or (!$_GET['flag'])or($_GET['flag'] == "") )
{
	// redirect to login page
	include ("redirectlogin.php");
}
else
{

	$inum = $_GET['inum'];
	$sub = $_GET['sub'];
	$flag = $_GET['flag'];
	include ("conn.php");
    
	
	$select1 = "select * from tblcardtl3 where IssNumber = '$inum' and sub = $sub ";
	$select1Result = mysql_query($select1);
	if($select1Result)
	{
		while($row = mysql_fetch_array($select1Result))
		{
			$dated = $row['DATED'];
			$comment = $row['VERIFICATION'];
		}
	}

}

?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-size: smaller}
.style2 {
	font-size: large;
	font-weight: bold;
}
-->
</style>
</head>

<body>
 <p><span class="style2">..:: ADD/UPDATE/DELETE VERIFICATION FORM ::..</span><script language="javascript" type="text/javascript" src="js/datetimepicker.js">

//Date Time Picker script- by TengYong Ng of http://www.rainforestnet.com
//Script featured on JavaScript Kit (http://www.javascriptkit.com)
//For this script, visit http://www.javascriptkit.com

     </script>
 </p>
 <form name="form1" method="post" action="verification_msg.php">
  <table width="100%"  border="1" bgcolor="#66CCFF">
   
    <tr>
      <th scope="row">Car Number </th>
      <td>&nbsp;</td>
      <td class="t1"><?php echo $inum ?></td>
    </tr>
    <tr>
      <th width="22%" scope="row"><span class="style1">Verification Date </span></th>
      <td width="2%">:</td>
	  
	  <td class="t1"><input name="date1" type="text" id="date1" value=" <?php if ($flag == "edit") { echo $dated; } else { echo trim(date('Y-m-d'));}  ?> " size="25">        <a href="javascript:NewCal('date1','yyyymmdd')"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	  
    </tr>
    <tr>
      <th height="241" scope="row"><span class="style1">Comment</span></th>
	  <input name="inum" type="hidden" value=" <?php echo $inum;  ?>   ">
	  <input name="sub" type="hidden" value=" <?php echo $sub;  ?>   ">
	  <input name="flag" type="hidden" value=" <?php echo $flag;  ?>   ">
      <td>:</td>
      <td class="t1" ><textarea name="comment" cols="100" rows="15"><?php if ($flag == "edit") { echo $comment; } ?></textarea></td>
    </tr>
    <tr>
      <th colspan="3" scope="row"><div align="left">
	    <?php
		  if ($flag == 'insert' )
		  {
		    echo "<input name=\"delete\" type=\"checkbox\" value=\"delete\"  disabled=\"disabled\" >Delete record";
          }
		  else
		  {
		    echo "<input name=\"delete\" type=\"checkbox\" value=\"delete\">Delete record";
		  }
		?>
		
        <input type="submit" name="Submit" value="Submit">
		
      </div></th>
    </tr>
  </table>
  
</form>
<button onClick="history.back();"> &lt;&lt; Cancel </button>
</body>
</html>
