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
<title>Editing CAR Details</title>
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
			/*
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
			*/
			}

			$update = "UPDATE tblCARDTL2 SET ";
			$update .= "PICID1=$pic1,PICID2=$pic2,PICID3=$pic3,PICID4=$pic4,PICID5=$pic5,PICID6=$pic6 ";//,PICID7=$pic7,PICID8=$pic8,PICID9=$pic9,PICID10=$pic10 ";
			$update .= "WHERE CARDTLID2 = $cardtlid2";
    		
    		$updateResult = mysql_query($update);
			if($updateResult)
			{
				print "<center><p class =\"style2\">PIC has been updated</center></p>";
			}
			else
			{
				print mysql_error();
				print "<center><p class =\"style2\">Failed to update PIC</center></p>";
			}
		}
}		

				//$dcode = "";
				$dfindings = "";
				$danalysis = "";
				$dcorrAct = "";
				$ddDate = "";
				$ddMonth = "";
				$ddYear = "";
				$dcarStatus = "";
				$ddInspect = "";
				$dmInspect = "";
				$dyInspect = "";
				$dremark = "";
				$dcDate = "";
				$dcMonth = "";
				$dcYear = "";
				$diso = "";
				$dcategory = "";

$select6 = "select * from tblCARDTL2 where IssNumber ='$inum' and CARDTLID2=$cardtlid2";
$select6Result = mysql_query($select6);
if($select6Result)
{
			
			while($row = mysql_fetch_array($select6Result))
			{
                $dcardtlid2 = $row['CARDTLID2'];
				$dcode = $row['Code'];
				$dfindings = $row['Findings'];
				$danalysis = $row['Analysis'];
				$dcorract = $row['CorrAct'];
				$dddate = $row['DDate'];
				$ddmonth = $row['DMonth'];
				$ddyear = $row['DYear'];
				$dcarStatus = $row['CARStatus'];
				$ddinspect = $row['DInspect'];
				$dminspect = $row['MInspect'];
				$dyinspect = $row['YInspect'];
				$dremark = $row['Remark'];
				$dcdate = $row['ClosedDate'];
				$dcmonth = $row['ClosedMonth'];
				$dcyear = $row['ClosedYear'];
				$diso = $row['ISORef'];
				$dcategory = $row['Category'];
				$dpic1 = $row['PICID1'];
				$dpic2 = $row['PICID2'];
				$dpic3 = $row['PICID3'];
				$dpic4 = $row['PICID4'];
				$dpic5 = $row['PICID5'];
				$dpic6 = $row['PICID6'];
				//$dpic7 = $row['PICID7'];
				//$dpic8 = $row['PICID8'];
				//$dpic9 = $row['PICID9'];
				//$dpic10 = $row['PICID10'];
				}
}			
			

?>
<body>
<?php


?>
<form name="form1" method="post" action="cameditdtl.php">
  <p align="center" class="style3">Editing CAR Details</p>
  <table width="650" border="1" align="center" class="style1">
  <!--
    <tr>
      <td width="115">Code : </td>
	  <?php
	 // if($dcode != "n/a")
	  //{
	  ?>
      <td width="326"><//?php echo //$dcode; ?></td>
	  <?php
	  //}
	?>
    </tr>
	-->
    <tr>
      <td>Findings : </td>
      <td>
	  <?php
	  if($dfindings != "n/a")
	  {
	  print $dfindings; 
	  }
	  ?>
	  </td>
    </tr>
    <tr>
      <td>Due Date : </td>
      <td> 
	  <?php
	  if(($dddate != 0)&&($ddmonth != 0)&&($ddyear != 0))
	  {
	  print $dddate."/".$ddmonth."/".$ddyear; 
	  }
	  ?>
	  </td>
    </tr>
	<tr>
      <td>Status : </td>
      <td>
	  <?php
	  if($dcarStatus != "")
	  {
	  print $dcarStatus; 
	  }
	  ?>
       </td>
    </tr>
	<tr>
      <td>Date inspected : </td>
      <td>
	 
	  <?php
	  if(($ddinspect != 0)&&($dminspect != 0)&&($dyinspect != 0))
	  {
	  	print $ddinspect."/".$dminspect."/".$dyinspect; 
	  }
	  ?>
	  </td>
    </tr>
	<tr>
      <td>Remark : </td>
      <td>
	  <?php
	   if($dremark != "n/a")
	  {
	  print $dremark;
	  }
	?>
	  </td>
	</tr>
	<tr>
      <td>Closed Date : </td>
      <td>
	  
	  <?php
	  if(($dcdate != 0)&&($dcmonth != 0)&&($dcyear != 0))
	  {
	  	print $dcdate."/".$dcmonth."/".$dcyear; 
	  }
	  ?>
    </td>
    </tr>
    <tr>
      <td>ISO Ref : </td>
      <td>
	  <?php
        if($diso != "n/a")
		{
		print $diso;
	    }
	 ?>
	  </td>
    </tr>
    <tr>
      <td>Category : </td>
      <td>
	 
	  <?php
        if($dcategory != "n/a")
		{
		print $dcategory; 
	    }
	  ?>
	  
          
	  </td>
    </tr>
    <tr>
	
      <td>PIC 1: </td>
      <td>
	  <select name="pic1" id="pic1">
	  <?php
	  if($dpic1 != 0)//display existing pic
	  {
	  
	  //get dept of Corrective Action Manager
	  
	        $getad1 = "select DeptID from tblMUAccount where MUserID = $id11";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic1"; 
	  $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }//close display existing pic
	  if(($deptid == $getdeptid11) || ($dpic1 == 0))
	  {
	  ?>
	  <option value=""></option>
	 <?php
	  			$getd = "select DeptID from tblMUAccount where MUserID = $id11";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
					$d = $row2['DeptID'];
					$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
               	 	$picResult = mysql_query($pic);
		       	    while($row = mysql_fetch_array($picResult))
			   		{
			   			$id = $row['MUserID'];
						$nm = $row['Name'];
						$display = "";
			    		$catDept = "select DeptName from tblDept where DeptID = $d";
						$catDeptResult = mysql_query($catDept);
						if($catDeptResult)
						{
							while($row1 = mysql_fetch_array($catDeptResult))
							{
								$catDept1 = $row1['DeptName'];
							}
						}
					$display = $nm." "." Dept. ".$catDept1;
		  ?>
                	
					<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
	
	 }//close if($deptid == $getdeptid11)
		?>
        </select>			
	  </td>
    </tr>
    <tr>
      <td>PIC 2 :</td>
      <td>
	  <select name="pic2" id="pic2">
	  <?php
	  if($dpic2 != 0)//display existing pic
	  {
	  
	  
	        $getad1 = "select DeptID from tblMUAccount where MUserID = $id11";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  
	  
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic2";
	  $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	  if(($deptid == $getdeptid11) || ($dpic2 == 0))
	  {
	  ?>
	  <option value=""></option>
	  <?php
	    $getd = "select DeptID from tblMUAccount where MUserID = $id11";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
					$d = $row2['DeptID'];
					$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
               	 	$picResult = mysql_query($pic);
		       	    while($row = mysql_fetch_array($picResult))
			   		{
			   			$id = $row['MUserID'];
						$nm = $row['Name'];
						$display = "";
			    		$catDept = "select DeptName from tblDept where DeptID = $d";
						$catDeptResult = mysql_query($catDept);
						if($catDeptResult)
						{
							while($row1 = mysql_fetch_array($catDeptResult))
							{
								$catDept1 = $row1['DeptName'];
							}
						}
					$display = $nm." "." Dept. ".$catDept1;
		  ?>
                	
					<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
	 }//close if($deptid == $getdeptid11)
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 3 :</td>
      <td>
	  <select name="pic3" id="pic3">
	  <?php
	  if($dpic3 != 0)//display existing pic
	  {
			$getad1 = "select DeptID from tblMUAccount where MUserID = $id11";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  
	  
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic3";
	  $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 if(($deptid == $getdeptid11) || ($dpic3 == 0))
	  {
	  ?>
	  <option value=""></option>
	 <?php
	    $getd = "select DeptID from tblMUAccount where MUserID = $id11";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
					$d = $row2['DeptID'];
					$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
               	 	$picResult = mysql_query($pic);
		       	    while($row = mysql_fetch_array($picResult))
			   		{
			   			$id = $row['MUserID'];
						$nm = $row['Name'];
						$display = "";
			    		$catDept = "select DeptName from tblDept where DeptID = $d";
						$catDeptResult = mysql_query($catDept);
						if($catDeptResult)
						{
							while($row1 = mysql_fetch_array($catDeptResult))
							{
								$catDept1 = $row1['DeptName'];
							}
						}
					$display = $nm." "." Dept. ".$catDept1;
		  ?>
                	
					<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
	 }//close if($deptid == $getdeptid11)
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 4 :</td>
      <td>
	  <select name="pic4" id="pic4">
	  <?php
	  if($dpic4 != 0)//display existing pic
	  {
	  		$getad1 = "select DeptID from tblMUAccount where MUserID = $id11";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  
	  
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic4";
	 $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	  if(($deptid == $getdeptid11) || ($dpic4 == 0))
	  {
	  ?>
	  <option value=""></option>
	  <?php
	    $getd = "select DeptID from tblMUAccount where MUserID = $id11";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
					$d = $row2['DeptID'];
					$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
               	 	$picResult = mysql_query($pic);
		       	    while($row = mysql_fetch_array($picResult))
			   		{
			   			$id = $row['MUserID'];
						$nm = $row['Name'];
						$display = "";
			    		$catDept = "select DeptName from tblDept where DeptID = $d";
						$catDeptResult = mysql_query($catDept);
						if($catDeptResult)
						{
							while($row1 = mysql_fetch_array($catDeptResult))
							{
								$catDept1 = $row1['DeptName'];
							}
						}
					$display = $nm." "." Dept. ".$catDept1;
		  ?>
                	
					<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
	 }//close if($deptid == $getdeptid11)
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 5 :</td>
      <td>
	  <select name="pic5" id="pic5">
	  <?php
	  if($dpic5 != 0)//display existing pic
	  {
			$getad1 = "select DeptID from tblMUAccount where MUserID = $id11";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic5";
	  $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 if(($deptid == $getdeptid11) || ($dpic5 == 0))
	  {
	  ?>
	  <option value=""></option>
	 <?php
	    $getd = "select DeptID from tblMUAccount where MUserID = $id11";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
					$d = $row2['DeptID'];
					$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
               	 	$picResult = mysql_query($pic);
		       	    while($row = mysql_fetch_array($picResult))
			   		{
			   			$id = $row['MUserID'];
						$nm = $row['Name'];
						$display = "";
			    		$catDept = "select DeptName from tblDept where DeptID = $d";
						$catDeptResult = mysql_query($catDept);
						if($catDeptResult)
						{
							while($row1 = mysql_fetch_array($catDeptResult))
							{
								$catDept1 = $row1['DeptName'];
							}
						}
					$display = $nm." "." Dept. ".$catDept1;
		  ?>
                	
					<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
	 }//close if($deptid == $getdeptid11)
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 6 :</td>
      <td>
	  <select name="pic6" id="pic6">
	  <?php
	  if($dpic6 != 0)//display existing pic
	  {
	  
			$getad1 = "select DeptID from tblMUAccount where MUserID = $id11";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic6";
	  $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 if(($deptid == $getdeptid11) || ($dpic6 == 0))
	  {
	  ?>
	  <option value=""></option>
	  <?php
	     $getd = "select DeptID from tblMUAccount where MUserID = $id11";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
					$d = $row2['DeptID'];
					$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
               	 	$picResult = mysql_query($pic);
		       	    while($row = mysql_fetch_array($picResult))
			   		{
			   			$id = $row['MUserID'];
						$nm = $row['Name'];
						$display = "";
			    		$catDept = "select DeptName from tblDept where DeptID = $d";
						$catDeptResult = mysql_query($catDept);
						if($catDeptResult)
						{
							while($row1 = mysql_fetch_array($catDeptResult))
							{
								$catDept1 = $row1['DeptName'];
							}
						}
					$display = $nm." "." Dept. ".$catDept1;
		  ?>
                	
					<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
	 }//close if($deptid == $getdeptid11)
		?>
      </select>
	  </td>
    </tr>
   <!--
      <td>PIC 7 :</td>
      <td>
	  <select name="pic7" id="pic7">
	  -->
	  <?php
	  /*
	  if($dpic7 != 0)//display existing pic
	  {
	  
	  //get dept of the in charge manager
	  
	  $getad = "select AMID from tblCAR where IssNumber = '$inum'";
	  $getadResult = mysql_query($getad);
	  if($getadResult)
	  {
	  		while($row101 = mysql_fetch_array($getadResult))
			{
					$amid = $row101['AMID'];
			}
			$getad1 = "select DeptID from tblMUAccount where MUserID = $amid";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  }
	  
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic7";
	  $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 if(($deptid == $getdeptid11) || ($dpic7 == 0))
	  {
	  */
	  ?>
	  <!--<option value=""></option>-->
	  <?php
	  /*
	     $geti = "select AMID from tblCAR where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$amid1 = $row1['AMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $amid1";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
				$d = $row2['DeptID'];
				$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
                $picResult = mysql_query($pic);
		        while($row = mysql_fetch_array($picResult))
			   {
			   		$id = $row['MUserID'];
					$nm = $row['Name'];
					$display = "";
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $nm." "." Dept. ".$catDept1;
					*/
		  ?>
                	
					<!--<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>-->
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 }//close if($deptid == $getdeptid11)
	 */
		?>
		<!--
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 8 :</td>
      <td>
	  <select name="pic8" id="pic8">
	  -->
	  <?php
	  /*
	  if($dpic8 != 0)//display existing pic
	  {
	  
	  //get dept of the in charge manager
	  
	  $getad = "select AMID from tblCAR where IssNumber = '$inum'";
	  $getadResult = mysql_query($getad);
	  if($getadResult)
	  {
	  		while($row101 = mysql_fetch_array($getadResult))
			{
					$amid = $row101['AMID'];
			}
			$getad1 = "select DeptID from tblMUAccount where MUserID = $amid";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  }
	  
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic8";
	 $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				*/
				?>
            	<!--<option value="<?php //echo $getid11; ?>" selected><?php //echo $displaypic; ?></option>-->
				<?php
				/*
				}
			}
	  
	  }
	  if(($deptid == $getdeptid11) || ($dpic8 == 0))
	  {
	  */
	  ?>
	  <!--<option value=""></option>-->
	 <?php
	 /*
	     $geti = "select AMID from tblCAR where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$amid1 = $row1['AMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $amid1";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
				$d = $row2['DeptID'];
				$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
                $picResult = mysql_query($pic);
		        while($row = mysql_fetch_array($picResult))
			   {
			   		$id = $row['MUserID'];
					$nm = $row['Name'];
					$display = "";
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $nm." "." Dept. ".$catDept1;
					*/
		  ?>
                	
					<!--<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>-->
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 }//close if($deptid == $getdeptid11)
	 */
		?>
		<!--
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 9 :</td>
      <td>
	  <select name="pic9" id="pic9">
	  -->
	  <?php
	  /*
	  if($dpic9 != 0)//display existing pic
	  {
	  
	  //get dept of the in charge manager
	  
	  $getad = "select AMID from tblCAR where IssNumber = '$inum'";
	  $getadResult = mysql_query($getad);
	  if($getadResult)
	  {
	  		while($row101 = mysql_fetch_array($getadResult))
			{
					$amid = $row101['AMID'];
			}
			$getad1 = "select DeptID from tblMUAccount where MUserID = $amid";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  }
	  
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic9";
	 $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 if(($deptid == $getdeptid11) || ($dpic9 == 0))
	  {
	  */
	  ?>
	  <!--<option value=""></option>-->
	  <?php
	  /*
	     $geti = "select AMID from tblCAR where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$amid1 = $row1['AMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $amid1";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
				$d = $row2['DeptID'];
				$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
                $picResult = mysql_query($pic);
		        while($row = mysql_fetch_array($picResult))
			   {
			   		$id = $row['MUserID'];
					$nm = $row['Name'];
					$display = "";
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $nm." "." Dept. ".$catDept1;
					*/
		  ?>
                	
					<!--<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>-->
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 }//close if($deptid == $getdeptid11)
	 */
		?>
		<!--
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 10 :</td>
      <td>
	  <select name="pic10" id="pic10">
	  -->
	  <?php
	  /*
	  if($dpic10 != 0)//display existing pic
	  {
	  
	  //get dept of the in charge manager
	  
	  $getad = "select AMID from tblCAR where IssNumber = '$inum'";
	  $getadResult = mysql_query($getad);
	  if($getadResult)
	  {
	  		while($row101 = mysql_fetch_array($getadResult))
			{
					$amid = $row101['AMID'];
			}
			$getad1 = "select DeptID from tblMUAccount where MUserID = $amid";
			$getadResult1 = mysql_query($getad1);
			if($getadResult1)
			{
				while($row102 = mysql_fetch_array($getadResult1))
				{
					$deptid = $row102['DeptID'];
				}
			}
	  }
	  
	  
	  $getpic = "select MUserID,Name,DeptID from tblMUAccount where MUserID = $dpic10";
	  $getpicResult11 = mysql_query($getpic);
	  		if($getpicResult11)
	  		{
				while($row11 = mysql_fetch_array($getpicResult11))
				{
				$getid11 = $row11['MUserID'];
				$getname11 = $row11['Name'];
				$getdeptid11 = $row11['DeptID'];
				
					$picDept11 = "select DeptName from tblDept where DeptID = $getdeptid11";
					$picDeptResult11 = mysql_query($picDept11);
					if($picDeptResult11)
					{
						while($row12 = mysql_fetch_array($picDeptResult11))
						{
							$picDeptName = $row12['DeptName'];
						}
					}
				
				$displaypic = $getname11." Dept. ".$picDeptName;
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	 if(($deptid == $getdeptid11) || ($dpic10 == 0))
	  {
	  */
	  ?>
	 <!-- <option value=""></option>-->
	  <?php
	  /*
	    $geti = "select AMID from tblCAR where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$amid1 = $row1['AMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $amid1";
				$getdResult = mysql_query($getd);
				while($row2 = mysql_fetch_array($getdResult))
				{
				$d = $row2['DeptID'];
				$pic = "select MUserID,Name,DeptID from tblMUAccount where GroupID ='cat' AND DeptID = $d order by Name ASC";
                $picResult = mysql_query($pic);
		        while($row = mysql_fetch_array($picResult))
			   {
			   		$id = $row['MUserID'];
					$nm = $row['Name'];
					$display = "";
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $nm." "." Dept. ".$catDept1;
					*/
		  ?>
                	
					<!--<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>-->
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 }//close if($deptid == $getdeptid11)
	 */
		?>
      <!--</select>
	  </td>
    </tr>-->
    <tr>
      <td><br/><input type="hidden" name="group" value="<?php echo $group;?>">
	  <input type="hidden" name="inum" value="<?php echo $inum;?>">
	  <input type="hidden" name="id" value="<?php echo $id11;?>">
	   <input type="hidden" name="cardtlid2" value="<?php echo $dcardtlid2;?>">
	  <input type="hidden" name="what" value="update">
      <br/></td>
      <td><input type="submit" name="Submit" value="Update">
      <input type="reset" name="Submit3"></td>
    </tr>
  </table>
</form>

<?php
}

?>
<br/>
<div align="center">
<table border="0">
  <tr>
    <td width="170"></td>
    <td width="474">
	
	
	
	<form name="form2" method="post" action="camcardetail.php">
	<input type="hidden" name="group" value="<?php echo $group;?>">
	  <input type="hidden" name="inum" value="<?php echo $inum;?>">
	  <input type="hidden" name="id" value="<?php echo $id11;?>">
        <input type="submit" name="Submit2" value="Back">
  </form></td>
  </tr>
</table>
<br/>
 
</div>

</body>
</html>




