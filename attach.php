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
<title>Request CAR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

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
if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$group = $_POST['group'];
$id = $_POST['id'];
$inum = $_POST['inum'];

include ("conn.php");

if(isset($_POST['what']))
{
       
	    if($_POST['what'] == "attach")
		{
			
			// check if there is file uploaded
	        if($_FILES['file']['size'] != 0)
	        {
		   		$filename = $_FILES['file']['name']; //get filename
				
	
				//check file extension
				$ext = strrchr($filename,'.');
				if ($ext != ".exe")// allow to upload if it is not an executable file
		        {
					upload_file(); 
			
					// connect to database to store files information
		
		         $sql3 = "INSERT INTO tblAttach ";
    	         $sql3 .= "(FileName,IssNumber) ";
    	         $sql3 .= "VALUES ( ";
    	         $sql3 .= "'$filename','$inum')"; 
    	         $result3 = mysql_query($sql3, $connection);
		
   	 	         if ($result3)
		         { 
    					print "<p align=\"center\" class=\"style2\">CAR Files has been uploaded</p><br>";
				 }
    			 else 
				 {
						print "<p align=\"center\" class=\"style2\">Unable to store CAR file information</p><br>";
				 }
		
				} //close if ($ext != ".exe")
	
				else
				{
					print "<p align=\"center\" class=\"style2\">The file type is not allowed</font></p><br>";
				}
	
			} //close if($_FILES['file']['size'] != 0)
			else
			{
				print "<p align=\"center\" class=\"style2\">There is no file uploaded</font></p><br>";
			}
			
			
				
				
		}// close if($_POST['what'] == "attach")

	}	//close if(isset($_POST['what']))
?>
<body>
<p align="center" class="style2">Attachment</p>
<form action="attach.php" method="post" name="form1"  ENCTYPE="multipart/form-data" >
  <table border="1" align="center" class="style1">
   <tr>
    <td><span class="style25">Attachment :</span></td>
    <td><p class="style27">
      <input type="file" name="file">
    </td>
  </tr>
	<tr>
      <td><input type ="hidden" name="what" value="attach">
	  <input type ="hidden" name="group" value="<?php echo $group; ?>"><input type ="hidden" name="id" value="<?php echo $id; ?>"><input type ="hidden" name="inum" value="<?php echo $inum; ?>"></td>
      <td><input type="submit" name="Submit" value="Attach"></form><form method="post" action="<?php echo $group;?>.php">
	  <input type="submit" value="back"><input type="hidden" name="group" value="<?php echo $group;?>"><input type="hidden" name="id" value="<?php echo $id;?>"></form></td>
    </tr>
  </table>

<?php
}
?>
</body>
</html>
<?php


function upload_file()
{
	
	$uploaddir = "attachment";
	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		move_uploaded_file($_FILES['file']['tmp_name'],$uploaddir.'/'.$_FILES['file']['name']);
	}
	
}

?>
