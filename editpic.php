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
<title>Editing PIC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
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
if ((!$_POST['name'])or($_POST['name'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
$name = $_POST['name'];
$inum = $_POST['inum'];
$cardtlid2 = $_POST['cardtlid2'];


include ("conn.php");

if(isset($_POST['what']))
{
        if($_POST['what'] == "update")
		{
			
			$delete = "delete from tblPIC where IssNumber='$inum' and CARDTLID2=$cardtlid2";
			$deleteResult = mysql_query($delete);
			if($deleteResult)
			{
			
			
			if($_POST['pic1'] != "")
			{
					$pic1 = $_POST['pic1'];
					$select1 = "select PICID from tblPIC where PICID = $pic1 AND IssNumber ='$inum' AND CARDTLID2=$cardtlid2"; // check whether pic is already in the corrective action team
					$select1Result = mysql_query($select1);
					$pi1="";
               		while($row = mysql_fetch_array($select1Result))
               		{
	          			$pi1 = $row['PICID'];
               		}

            		if($pi1 =="") //pic is not in the corrective action team yet
             		{
						//insert pic to corrective action team
						$insert1 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic1,'$inum',$cardtlid2,'no response')";
						$insert1Result = mysql_query($insert1);
             		}
			}
			else
			{
				$pic1 = "0";
			}
			if($_POST['pic2'] != "")
			{
				$pic2 = $_POST['pic2'];
				$select2 = "select PICID from tblPIC where PICID = $pic2 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select2Result = mysql_query($select2);
					$pi2="";
               		while($row = mysql_fetch_array($select2Result))
               		{
	          			$pi2 = $row['PICID'];
               		}

            		if($pi2 =="") 
             		{
						//insert to table pic
						$insert2 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic2,'$inum',$cardtlid2,'no response')";
						$insert2Result = mysql_query($insert2);
             		}
			}
			else
			{
				$pic2 = "0";
			}
			if($_POST['pic3'] != "")
			{
				$pic3 = $_POST['pic3'];
				$select3 = "select PICID from tblPIC where PICID = $pic3 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select3Result = mysql_query($select3);
					$pi3="";
               		while($row = mysql_fetch_array($select3Result))
               		{
	          			$pi3 = $row['PICID'];
               		}

            		if($pi3 =="") 
             		{
						//insert to table pic
						$insert3 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic3,'$inum',$cardtlid2,'no response')";
						$insert3Result = mysql_query($insert3);
             		}
			}
			else
			{
				$pic3 = "0";
			}
			if($_POST['pic4'] != "")
			{
				$pic4 = $_POST['pic4'];
				$select4 = "select PICID from tblPIC where PICID = $pic4 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select4Result = mysql_query($select4);
					$pi4="";
               		while($row = mysql_fetch_array($select4Result))
               		{
	          			$pi4 = $row['PICID'];
               		}

            		if($pi4 =="") 
             		{
						//insert to table pic
						$insert4 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic4,'$inum',$cardtlid2,'no response')";
						$insert4Result = mysql_query($insert4);
             		}
			}
			else
			{
				$pic4 = "0";
			}
			if($_POST['pic5'] != "")
			{
				$pic5 = $_POST['pic5'];
				$select5 = "select PICID from tblPIC where PICID = $pic5 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select5Result = mysql_query($select5);
					$pi5="";
               		while($row = mysql_fetch_array($select5Result))
               		{
	          			$pi5 = $row['PICID'];
               		}

            		if($pi5 =="") 
             		{
						//insert to table pic
						$insert5 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic5,'$inum',$cardtlid2,'no response')";
						$insert5Result = mysql_query($insert5);
             		}
			}
			else
			{
				$pic5 = "0";
			}
			if($_POST['pic6'] != "")
			{
				$pic6 = $_POST['pic6'];
				$select6 = "select PICID from tblPIC where PICID = $pic6 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select6Result = mysql_query($select6);
					$pi6="";
               		while($row = mysql_fetch_array($select6Result))
               		{
	          			$pi6 = $row['PICID'];
               		}

            		if($pi6 =="") 
             		{
						//insert to table pic
						$insert6 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic6,'$inum',$cardtlid2,'no response')";
						$insert6Result = mysql_query($insert6);
             		}
			}
			else
			{
				$pic6 = "0";
			}
			if($_POST['pic7'] != "")
			{
				$pic7 = $_POST['pic7'];
				$select7 = "select PICID from tblPIC where PICID = $pic7 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select7Result = mysql_query($select7);
					$pi7="";
               		while($row = mysql_fetch_array($select7Result))
               		{
	          			$pi7 = $row['PICID'];
               		}

            		if($pi7 =="") 
             		{
						//insert to table pic
						$insert7 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic7,'$inum',$cardtlid2,'no response')";
						$insert7Result = mysql_query($insert7);
             		}
			}
			else
			{
				$pic7 = "0";
			}
			if($_POST['pic8'] != "")
			{
				$pic8 = $_POST['pic8'];
				$select8 = "select PICID from tblPIC where PICID = $pic8 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select8Result = mysql_query($select8);
					$pi8="";
               		while($row = mysql_fetch_array($select8Result))
               		{
	          			$pi8 = $row['PICID'];
               		}

            		if($pi8 =="") 
             		{
						//insert to table pic
						$insert8 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic8,'$inum',$cardtlid2,'no response')";
						$insert8Result = mysql_query($insert8);
             		}
			}
			else
			{
				$pic8 = "0";
			}
			if($_POST['pic9'] != "")
			{
				$pic9 = $_POST['pic9'];
				$select9 = "select PICID from tblPIC where PICID = $pic9 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select9Result = mysql_query($select9);
					$pi9="";
               		while($row = mysql_fetch_array($select9Result))
               		{
	          			$pi9 = $row['PICID'];
               		}

            		if($pi9 =="") 
             		{
						//insert to table pic
						$insert9 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic9,'$inum',$cardtlid2,'no response')";
						$insert9Result = mysql_query($insert9);
             		}
			}
			else
			{
				$pic9 = "0";
			}
			if($_POST['pic10'] != "")
			{
				$pic10 = $_POST['pic10'];
				$select10 = "select PICID from tblPIC where PICID = $pic10 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select10Result = mysql_query($select10);
					$pi10="";
               		while($row = mysql_fetch_array($select10Result))
               		{
	          			$pi10 = $row['PICID'];
               		}

            		if($pi10 =="") 
             		{
						//insert to table pic
						$insert10 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic10,'$inum',$cardtlid2,'no response')";
						$insert10Result = mysql_query($insert10);
             		}
			}
			else
			{
				$pic10 = "0";
			}

			$sql = "UPDATE tblCARDTL2 ";
    		$sql .= "SET PICID1=$pic1,PICID2=$pic2,PICID3=$pic3,PICID4=$pic4,PICID5=$pic5,PICID6=$pic6,PICID7=$pic7,PICID8=$pic8,PICID9=$pic9,PICID10=$pic10 ";
			$sql .= "WHERE CARDTLID2 =$cardtlid2";
 
    		$result = mysql_query($sql);
			if($result)
			{
			?>
				<table class="style2" width="402" border="0" align="center">
  <tr>
    <td width="68"></td>
    <td width="324">
	
    PIC has been updated</td>
  </tr>
</table>
			<?php	
			}
			else
			{
				print mysql_error(); 
				print "<p class =\"style2\"><center>Failed to updated PIC</center></style></p>";
			}
			}
		}
}		

$select ="select PICID1,PICID2,PICID3,PICID4,PICID5,PICID6,PICID7,PICID8,PICID9,PICID10 from tblCARDTL2 where CARDTLID2=$cardtlid2";
$selectResult = mysql_query($select);
if($selectResult)
{
while($row = mysql_fetch_array($selectResult))
{
$picid1 = $row['PICID1'];
$picid2 = $row['PICID2'];
$picid3 = $row['PICID3'];
$picid4 = $row['PICID4'];
$picid5 = $row['PICID5'];
$picid6 = $row['PICID6'];
$picid7 = $row['PICID7'];
$picid8 = $row['PICID8'];
$picid9 = $row['PICID9'];
$picid10 = $row['PICID10'];
}
?>
<body>
<p></p>
<form name="form1" method="post" action="editpic.php">
  <table width="403" border="0" align="center" class="style1">
    <tr>
	
      <td width="69">PIC 1: </td>
      <td width="324">
	  <select name="pic1" id="pic1">
	  <?php
	  if($picid1 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid1";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	  
	  ?>
	  <option value=""></option>
	  <?php
	  
	
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
        </select>			</td>
    </tr>
    <tr>
      <td>PIC 2 :</td>
      <td><select name="pic2" id="pic2">
	  <?php
	  if($picid2 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid2";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	  
	  ?>
	  <option value=""></option>
	  <?php
	  
	  
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 3 :</td>
      <td><select name="pic3" id="pic3">
	  <?php
	  if($picid3 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid3";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 
	  ?>
	  <option value=""></option>
	  <?php
	  
	
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 4 :</td>
      <td><select name="pic4" id="pic4">
	  <?php
	  if($picid4 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid4";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	  
	  ?>
	  <option value=""></option>
	  <?php
	  
	 
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 5 :</td>
      <td><select name="pic5" id="pic5">
	  <?php
	  if($picid5 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid5";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 
	  ?>
	  <option value=""></option>
	  <?php
	  
	 
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 6 :</td>
      <td><select name="pic6" id="pic6">
	  <?php
	  if($picid6 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid6";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 
	  ?>
	  <option value=""></option>
	  <?php
	  
	 
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 7 :</td>
      <td><select name="pic7" id="pic7">
	  <?php
	  if($picid7 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid7";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 
	  ?>
	  <option value=""></option>
	  <?php
	  
	
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 8 :</td>
      <td><select name="pic8" id="pic8">
	  <?php
	  if($picid8 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid8";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	
	  ?>
	  <option value=""></option>
	  <?php
	  
	
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 9 :</td>
      <td><select name="pic9" id="pic9">
	  <?php
	  if($picid9 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid9";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 
	  ?>
	  <option value=""></option>
	  <?php
	  
	  
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 10 :</td>
      <td><select name="pic10" id="pic10">
	  <?php
	  if($picid10 != 0)//display existing pic
	  {
	  $getpic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT where CATID = $picid10";
	  $getpicResult = mysql_query($getpic);
	  		if($getpicResult)
	  		{
				while($row = mysql_fetch_array($getpicResult))
				{
				$getid =$row['CATID'];
				$displaypic = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
				?>
            	<option value="<?php echo $getid; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 
	  ?>
	  <option value=""></option>
	  <?php
	  
	 
		 $pic = "select CATID,CATFirstName,CATLastName,CATDept from tblCAT ORDER BY CATFirstName ASC";
        $picResult = mysql_query($pic);
		  while($row = mysql_fetch_array($picResult))
			{
			$id = $row['CATID'];
			$display = $row['CATFirstName']." ".$row['CATLastName']." Dept. ".$row['CATDept'];
		  ?>
                <option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  }
		  
		  ?>
      </select></td>
    </tr>
    <tr>
      <td><br/><input type="hidden" name="name" value="<?php echo $name;?>"><input type="hidden" name="inum" value="<?php echo $inum;?>">
	  <input type="hidden" name="what" value="update"><input type="hidden" name="cardtlid2" value="<?php echo $cardtlid2;?>">
      <br/></td>
      <td><input type="submit" name="Submit" value="save">
      <input type="reset" name="Submit3" value="reset"></td>
    </tr>
  </table>
</form>

<table width="402" border="0" align="center">
  <tr>
    <td width="68"></td>
    <td width="324"><form name="form2" method="post" action="camcardetail.php">
	 <input type="hidden" name="name" value="<?php echo $name; ?>">
	  <input type="hidden" name="inum" value="<?php echo $inum; ?>">
      <input type="submit" name="Submit2" value="back ">
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
}
}
?>

