
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
	include ("conn.php"); //connection to database
	if($_SERVER['REQUEST_METHOD'] == "POST") //upload button is clicked
	{
	
	if(isset($_POST['what']))
	{
	
	// check if there the file is uploaded
	if($_FILES['file']['size'] != 0)
	{
		$filename = $_FILES['file']['name']; //get filename
		//check whether file is already in the database
		$getFile = "select FileName from file where FileName ='$filename'";
		$getFileResult = mysql_query($getFile);
		$f = "";
		while($row = mysql_fetch_array($getFileResult))
        {
	    	$f = $row['FileName'];
		}

		if($f !="")
		{
				print "<strong><h2><center><font color =\"red\" >$filename is already in the database</font></center></h3></strong><br>";
		}
		else 
		{
		//check file extension
		$ext = strrchr($filename, '.');
		if (($ext == ".txt") or ($ext == ".doc") or ($ext == ".xls"))// allow to upload if it is a textfile or document
		{
			upload_file(); 
			
			//$topic = "n/a";
			$idate = "0";
			$imonth = "0";
			$iyear = "0";
			$inum = "n/a";
			$status = "n/a";
			$dept = "0";
			$percent = "0";
			
			//if($_POST['topic'] != "")
			//{
			//$topic = trim($_POST['topic']);
			//}
			if($_POST['idate'] != "")
			{
			$idate = $_POST['idate'];
			}
			if($_POST['imonth'] != "")
			{
			$imonth = $_POST['imonth'];
			}
			if($_POST['iyear'] != "")
			{
			$iyear = $_POST['iyear'];
			}
			if($_POST['inum'] != "")
			{
			$inum = trim($_POST['inum']);
			}
			if($_POST['status'] != "")
			{
			$status = $_POST['status'];
			}
			if($_POST['dept'] != "")
			{
			$dept = $_POST['dept'];
			}
			//if($_POST['percent'] != "")
			//{
			//$percent = $_POST['percent'];
    		//}
     // connect to database to store files information
		
		$sql = "INSERT INTO file ";
    	$sql .= "(FileName,IDate,IMonth,IYear,INumber,FStatus,DeptID,Percent) ";
    	$sql .= "VALUES ( ";
    	$sql .= "'$filename',$idate,$imonth,$iyear,'$inum','$status',$dept,$percent)"; 
    	$result = mysql_query($sql, $connection);
		
   	 	if ($result)
		{ 
    		print "<strong><h2><center><font color =\"red\" >CAR Files has been uploaded</font></center></h3></strong><br>";
		}
    	else 
		{
			print "<strong><h2><center><font color =\"red\" >Unable to store CAR file information</font></center></h3></strong><br>";
			
		}
  
    	mysql_close();
		
	} //close if ($ext == ".txt")
	
	else
	{
		print "<strong><h2><center><font color =\"red\" >The file type is not allowed</font></h3></center></strong><br>";
	}
	}
} //close if($_FILES['file']['size'] != 0)

	else // if filesize == 0
	{
		if($_FILES['file']['size'] == 0)
		{
		print "<strong><center><h2><font color =\"red\" >No file is selected</font></h3></strong></center><br> ";
		}
		
	}
	
	}
} //close if($_SERVER['REQUEST_METHOD'] == "POST") 
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Upload CAR Files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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

</head>

<body>
<form name="form1" method="post" action="upload.php" ENCTYPE="multipart/form-data">
  <p align="center" class="style23">Upload CAR Files</p>
  <table width="548" border="3" align="center">
  <tr class="style17">
    <td width="203"><span class="style25">Issued Number :</span></td>
    <td width="325"><input name="inum" type="text" id="inum" size="20" maxlength="20"></td>
  </tr>
  <tr class="style17">
    <td width="203"><span class="style25">Issued Date :</span></td>
      <td> <span class="style26">
        <select name="idate" id="idate">
		  <option value="" selected>dd</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        / 
        
        <select name="imonth" id="imonth">
          <option value="" selected>mm</option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
        /
         <select name="iyear">
           <option value="" selected>yyyy</option>
	       <option value="1990">1990</option>
	       <option value="1991">1991</option>
	       <option value="1992">1992</option>
	       <option value="1993">1993</option>
	       <option value="1994">1994</option>
	       <option value="1995">1995</option>
	       <option value="1996">1996</option>
	       <option value="1997">1997</option>
	       <option value="1998">1998</option>
	       <option value="1999">1999</option>
		   <option value="2000">2000</option>
		   <option value="2001">2001</option>
           <option value="2002">2002</option>
	       <option value="2003">2003</option>
	       <option value="2004">2004</option>
	       <option value="2005">2005</option>
           <option value="2006">2006</option>
           <option value="2007">2007</option>
	       <option value="2008">2008</option>
	       <option value="2009">2009</option>
	       <option value="2010">2010</option>
	      
         </select>      
      </span></td>
  </tr>
  <tr class="style17">
    <td width="203"><span class="style25">Status  :</span></td>
    <td width="325"><span class="style26">
      <select name="status" id="status">
	   <option value=""></option>
        <option value="open">open</option>
        <option value="closed">close</option>
      </select>
      </span></td>
  </tr>
  <tr class="style17">
    <td width="203"><span class="style25">Departement  :</span></td>
    <td width="325"><span class="style25">
      <select name="dept">
		        <option value="" selected></option>
		    <?php
			include("conn.php");
		  $getDept = "select DeptID,DeptName from tblDept ORDER BY DeptName ASC";
		  $getDeptResult = mysql_query($getDept);
		  while($row = mysql_fetch_array($getDeptResult))
			{
			$deptid = $row['DeptID'];

		  ?>
                <option value="<?php echo $deptid;?>"><?php echo $row['DeptName']; ?></option>
          <?php
		  }
		  
		  ?>
        </select>
    </span></td>
  </tr>
  
  <tr>
    <td><span class="style25">Choose file :</span></td>
    <td><p class="style27">
      <input type="file" name="file">
    </p>
      <p class="style17 style20 style22">*document/excel files (.txt / .doc/ .xls) only* </p></td>
  </tr>
  <tr valign="middle">
    <td>      <center>
        <p>&nbsp;        </p>
    </center>
  <input type ="hidden" name="group" value="<?php echo $group; ?>">
      <input type ="hidden" name="what" value="upload">
      </td>
    <td><input name="Submit" type="submit" value="upload"></td>
  </tr>
</table>
</form>


<table width="550" border="0" align="center">
  <tr>
    <td width="210" height="45"><div align="center"></div></td>
    <td width="330"><div align="left">
      <form name="form2" method="post" action="viewfiles.php">
	  <input type="hidden" name="group" value="<?php echo $group; ?>">
        <input type="submit" name="Submit2" value="Back">
      </form>
    </div></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
</body>
</html>
<?php

function upload_file()
{
	
	$uploaddir = "archived";
	$max_size = "2000000"; 
	if($_FILES['file']['size'] > $max_size)
	{
		print "File size is too big!";
		//display upload form
		
		exit;
	}

	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		move_uploaded_file($_FILES['file']['tmp_name'],$uploaddir.'/'.$_FILES['file']['name']);
	}
	
}


?>

