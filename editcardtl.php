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
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">

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
$view = $_POST['view'];

$cardtlid2 = $_POST['cardtlid2'];

include ("conn.php");

 

	if($group == "os")
	{
	?>
	<center>
	<form name="form2" method="post" action="cardetail.php">
	<?php
	}
	else
	{
	?>
	<form name="form2" method="post" action="omcardetail.php">
	<?php
	}
	?>
	   <input type="hidden" name="view" value="<?php echo $view;?>">
		<input type="hidden" name="group" value="<?php echo $group;?>">
	  <input type="hidden" name="inum" value="<?php echo $inum;?>">
	  <input type="hidden" name="id" value="<?php echo $id11;?>">
        <input type="submit" name="Submit2" value="Back">
  </form>
  </center>
  <?php

if(($_SERVER['REQUEST_METHOD'] == "POST") && (isset($_POST['what'])))
{
        
		if($_POST['what'] == "del")
		{
		
		$fid = $_POST['fid'];
		$flnm = $_POST['flnm'];
		
						//if($deletefiles)
						//{
						$delete5 = "DELETE FROM tblAttach where AFID = $fid";
						$delqry5 = mysql_query($delete5);
						
						if($delqry5)
						{
						$filedir = "192.168.1.36\attachment\\$flnm"; //path to directory of actual files
				        $deletefiles = unlink ($filedir); //delete files 
						print "<p align=\"center\" class=\"style2\">Selected files has been deleted</p><br>";
						}
						//}
		}//close if($_POST['what'] == "delete")
		
		
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
		
		if($_POST['what'] == "update")
		{
			$up = 0;
			$up1 = 0;
			/*
			if($_POST['code'] != "")
			{
				$code = $_POST['code'];
			}
			else
			{
				$code = "n/a";
			}
			*/
			$findings = $_POST['findings'];
			/*
			if($_POST['ddate'] != "")
			{
				$ddate = $_POST['ddate'];
			}
			else
			{
				$ddate = "0";
			}
			if($_POST['dmonth'] != "")
			{
				$dmonth = $_POST['dmonth'];
			}
			else
			{
				$dmonth = "0";
			}
			if($_POST['dyear'] != "")
			{
				$dyear = $_POST['dyear'];
			}
			else
			{
				$dyear = "0";
			}
			
			*/
			            $date_array1 =getdate(); 
						foreach($date_array1 as $key => $val)
						{
 							$key = $val;
						}

						$curmth = $date_array1['mon'];
						$curdate = $date_array1['mday'];
						$curyr = $date_array1['year'];

						
						

/*
//today : 21 june 2006
//due date 20 june 2006
if (($curdate > $ddate)&&($curmth == $dmonth)&&($curyr == $dyear))
{
//give warning
$up = 1;
}

//today : 21 june 2006
//due date 21 may 2006
else if (($curdate == $ddate)&&($curmth > $dmonth)&&($curyr == $dyear))
{
//give warning
$up = 1;
}



//today 21 july 2006
//due date 15 june 2006
else if(($curdate > $ddate)&&($curmth > $dmonth)&&($curyr == $dyear))
{
//give warning
$up = 1;
}


//today 21 june 2006
//due date 26 maret 2006
else if(($curdate < $ddate) && ($curmth > $dmonth) && ($curyr == $dyear))
{
//give warning
$up = 1;
}

//today 12 january 2007
//due date 11 december 2006
else if(($curdate > $ddate)&&($curmth < $dmonth)&&($curyr > $dyear))
{
//give warning
$up = 1;
}

//today 21 june 2007
//due date 25 december 2006
else if(($curdate < $ddate)&&($curmth < $dmonth)&&($curyr > $dyear))
{
//give warning
$up = 1;
}
//today 21 june 2007
//due date 26 maret 2006
else if(($curdate < $ddate) && ($curmth > $dmonth) && ($curyr > $dyear))
{
//give warning
$up = 1;
}

//today 21 june 2007
//due date 22 july 2006
else if(($curdate > $ddate) && ($curmth > $dmonth) && ($curyr > $dyear))
{
//give warning
$up = 1;
}

//today 21 june 2007
//due date 21 june 2006
else if(($curdate == $ddate) && ($curmth == $dmonth) && ($curyr > $dyear))
{
//give warning
$up = 1;
}

else
{
$up = 0;
}
			
			if($_POST['status'] != "")
			{
				$status = $_POST['status'];
			}
			*/
			if($_POST['analysis'] != "")
			{
			/*
			if($_POST['dinspect'] != "")
			{
				$dinspect = $_POST['dinspect'];
			}
			else
			{
				$dinspect = "0";
			}
			if($_POST['minspect'] != "")
			{
				$minspect = $_POST['minspect'];
			}
			else
			{
				$minspect = "0";
			}
			if($_POST['yinspect'] != "")
			{
				$yinspect = $_POST['yinspect'];
			}
			else
			{
				$yinspect = "0";
			}
			



//today : 21 june 2006
//inspect date 20 june 2006
if (($curdate > $dinspect)&&($curmth == $minspect)&&($curyr == $yinspect))
{
//give warning
$up1 = 1;
}

//same year ,  current month > dmonth, current date < ddate

//today 21 july 2006
//inspect date 28 june 2006
else if(($curdate < $dinspect)&&($curmth > $minspect)&&($curyr == $yinspect))
{
//give warning
$up1 = 1;
}

//today : 21 june 2006
//inspect date 21 may 2006
else if (($curdate == $dinspect)&&($curmth > $minspect)&&($curyr == $yinspect))
{
//give warning
$up = 1;
}


//today 21 july 2006
//inspect date 15 june 2006
else if(($curdate > $dinspect)&&($curmth > $minspect)&&($curyr == $yinspect))
{
//give warning
$up1 = 1;
}

//today 21 june 2006
//inspect date 26 maret 2006
else if(($curdate < $dinspect) && ($curmth > $minspect) && ($curyr == $yinspect))
{
//give warning
$up1 = 1;
}

//today 12 january 2007
//inspect date 11 december 2006
else if(($curdate > $dinspect)&&($curmth < $minspect)&&($curyr>$yinspect))
{
//give warning
$up1 = 1;
}

//today 21 june 2007
//inspect date 25 december 2006
else if(($curdate < $dinspect)&&($curmth < $minspect)&&($curyr > $yinspect))
{
//give warning
$up1 = 1;
}

//today 21 june 2007
//inspect date 26 maret 2006
else if(($curdate < $dinspect) && ($curmth > $minspect) && ($curyr > $yinspect))
{
//give warning
$up1 = 1;
}

//today 21 june 2007
//inspect date 22 july 2006
else if(($curdate > $dinspect) && ($curmth > $minspect) && ($curyr > $yinspect))
{
//give warning
$up1 = 1;
}

//today 21 june 2007
//due date 21 june 2006
else if(($curdate == $dinspect) && ($curmth == $minspect) && ($curyr > $yinspect))
{
//give warning
$up = 1;
}

else
{
$up1 = 0;
}
*/
			if($_POST['remark'] != "")
			{
				$remark = $_POST['remark'];
			}
			else
			{
				$remark= "n/a";
			}
			/*
			if($_POST['cdate'] != "")
			{
				$cdate = $_POST['cdate'];
			}
			else
			{
				$cdate = "0";
			}
			if($_POST['cmonth'] != "")
			{
				$cmonth = $_POST['cmonth'];
			}
			else
			{
				$cmonth = "0";
			}
			if($_POST['cyear'] != "")
			{
				$cyear = $_POST['cyear'];
			}
			else
			{
				$cyear = "0";
			}
			*/
			}
			
			if($_POST['iso'] != "")
			{
				$iso = $_POST['iso'];
			}
			else
			{
				$iso= "n/a";
			}
			if($_POST['category'] != "")
			{
				$category = $_POST['category'];
			}
			else
			{
				$category = "n/a";
			}
			
			/*
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
						$insert1 = "insert into tblPIC (PICID,IssNumber,CARDTLID2) VALUES ($pic1,'$inum',$cardtlid2)";
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
						$insert2 = "insert into tblPIC (PICID,IssNumber,CARDTLID2) VALUES ($pic2,'$inum',$cardtlid2)";
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
						$insert3 = "insert into tblPIC (PICID,IssNumber,CARDTLID2) VALUES ($pic3,'$inum',$cardtlid2)";
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
						$insert4 = "insert into tblPIC (PICID,IssNumber,CARDTLID2) VALUES ($pic4,'$inum',$cardtlid2)";
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
						$insert5 = "insert into tblPIC (PICID,IssNumber,CARDTLID2) VALUES ($pic5,'$inum',$cardtlid2)";
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
						$insert6 = "insert into tblPIC (PICID,IssNumber,CARDTLID2) VALUES ($pic6,'$inum',$cardtlid2)";
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
			
			}
*/
             if(($up != 1) && ($up1 != 1))
			 {
			$update = "UPDATE tblCARDTL2 SET Findings = '$findings',"; //DDate=$ddate,DMonth=$dmonth,DYear=$dyear,CARStatus='$status',";
			/*if($_POST['analysis'] != "")
			{
			$update  .= "DInspect=$dinspect,MInspect=$minspect,YInspect=$yinspect,ClosedDate=$cdate,ClosedMonth=$cmonth,ClosedYear=$cyear,";
			}
			*/
			$update  .= "ISORef='$iso',Category='$category' ";//PICID1=$pic1,PICID2=$pic2,PICID3=$pic3,PICID4=$pic4,PICID5=$pic5,PICID6=$pic6,PICID7=$pic7,PICID8=$pic8,PICID9=$pic9,PICID10=$pic10 ";
			$update .= "WHERE CARDTLID2 = $cardtlid2";
    		
    		$updateResult = mysql_query($update);
			if($updateResult)
			{
				/*$cs = "select CARStatus from tblCARDTL2 where IssNumber= '$inum'";
				$csResult = mysql_query($cs);
				if($csResult)
				{
					$s = "";
					while($row111  = mysql_fetch_array($csResult))
					{
						$cstat = $row111['CARStatus'];
						if($cstat == "open")
						{
						$s = "o";
						}
					}
					if($s != "o")
					{
						//update status header to close
						$date_array =getdate(); 
						foreach($date_array as $key => $val)
						{
 							$key = $val;
						}

						$cmonth = $date_array['mon'];
						$cdate = $date_array['mday'];
						$cyear = $date_array['year'];
	
						$upstat = "UPDATE tblCAR SET CARStatus='closed',CDate =$cdate,CMonth=$cmonth,CYear=$cyear WHERE IssNumber='$inum'";
						$upstatResult = mysql_query($upstat);
					}
				}//close if($csResult)
				*/
				print "<center><p class =\"style2\">CAR Detail has been updated</center></p>";
			}// close if($updateResult)
			else
			{
				
				print "<center><p class =\"style2\">Failed to update CAR Detail</center></p>";
			}
			}//close if($up == 0)
			else
			{
			if (($up == 1) && ($up1 == 0))
			{
			print "<center><p class =\"style2\">Due date must be this present or the following date </center></p>";
			}
			else if(($up1 == 1) && ($up == 0))
			{
			print "<center><p class =\"style2\">Inspection date must be this present or the following date</center></p>";
			}
			else
			{
			print "<center><p class =\"style2\">Due Date and Inspection date must be this present or the following date</center></p>";
			}
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
				//$dcode = $row['Code'];
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
				/*
				$dpic1 = $row['PICID1'];
				$dpic2 = $row['PICID2'];
				$dpic3 = $row['PICID3'];
				$dpic4 = $row['PICID4'];
				$dpic5 = $row['PICID5'];
				$dpic6 = $row['PICID6'];
				$dpic7 = $row['PICID7'];
				$dpic8 = $row['PICID8'];
				$dpic9 = $row['PICID9'];
				$dpic10 = $row['PICID10'];
				*/
				}
}			
			

?>
<body>
<?php

//if($_POST['what'] != "delete")
//{

?>
<form action="editcardtl.php" method="post" name="form1" onSubmit="MM_validateForm('findings','','R');return document.MM_returnValue">
  <p align="center" class="style2">Editing CAR Details</p>
  <table align="center" class="tbl">
    <!--<tr>
      <td width="159">Code : </td>
	  <?php
	  //if($dcode != "n/a")
	  //{
	  ?>
      <td width="704"><input name="code" type="text" id="code" size="20" maxlength="20" value="<?php //echo $dcode; ?>"></td>
	  <?php
	  //}
	  //else
	  //{
	  ?>
	  <td width="120"><input name="code" type="text" id="code" size="20" maxlength="20"></td>
	  <?php
	 // }
	  ?>
    </tr>-->
    <tr>
      <td class="t2">Problem : </td>
      <td class="t1" width = "500"><textarea name="findings" cols="100" rows="20"><?php echo $dfindings; ?></textarea></td>
    </tr>
	<!--
    <tr>
      <td>Due Date : </td>
      <td> 
	  <select name="ddate">
	  <?php
	 // if($dddate != 0)
	 // {
	  ?>
	  <option value="<?php echo $dddate; ?>" selected><?php echo $dddate; ?></option>
	  <?php
	 // }
	  ?>
	  
	  
		<option value=""></option>
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
        
        <select name="dmonth">
		<?php
		/*
		if($ddmonth != 0)
	 
	  {
	  if($ddmonth == 1)
	  {
	  $dismth = "January";
	  }
	  else if($ddmonth == 2)
	  {
	  $dismth = "February";
	  }
	  else if($ddmonth == 3)
	  {
	  $dismth = "March";
	  }
	  else if($ddmonth == 4)
	  {
	  $dismth = "April";
	  }
	  else if($ddmonth == 5)
	  {
	  $dismth = "May";
	  }
	  else if($ddmonth == 6)
	  {
	  $dismth = "June";
	  }
	  else if($ddmonth == 7)
	  {
	  $dismth = "July";
	  }
	  else if($ddmonth == 8)
	  {
	  $dismth = "August";
	  }
	  else if($ddmonth == 9)
	  {
	  $dismth = "September";
	  }
	  else if($ddmonth == 10)
	  {
	  $dismth = "October";
	  }
	  else if($ddmonth == 11)
	  {
	  $dismth = "November";
	  }
	  else if($ddmonth == 12)
	  {
	  $dismth = "December";
	  }
	  else
	  {
	  $dismth = "";
	  }
	  */
	  ?>
	  <option value="<?php //echo $ddmonth; ?>" selected><?php //echo $dismth; ?></option>
	  <?php
	 // }
	  ?>
          <option value=""></option>
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
		<select name="dyear">
		<?php
		//if($ddyear!= 0)
		
		//{
		?>
		<option value="<//?php //echo $ddyear; ?>" selected><//?php echo //$ddyear; ?></option> 
		<?php
		//}
		
		?>
        
           <option value=""></option>
	       <option value="2006">2006</option>
	       <option value="2007">2007</option>
	       <option value="2008">2008</option>
	       <option value="2009">2009</option>
	       <option value="2010">2010</option>
	       <option value="2011">2011</option>
	       <option value="2012">2012</option>
	       <option value="2013">2013</option>
	       <option value="2014">2014</option>
	       <option value="2015">2015</option>
		   <option value="2016">2016</option>
		   <option value="2017">2017</option>
           <option value="2018">2018</option>
	       <option value="2019">2019</option>
	       <option value="2020">2020</option>
	       <option value="2021">2021</option>
           <option value="2022">2022</option>
           <option value="2023">2023</option>
	       <option value="2024">2024</option>
	       <option value="2025">2025</option>
	    </select>      
	    
             
      </td>
    </tr>
	
	<tr>
      <td>Status : </td>
      <td><select name="status">
	  <?php
	 // if($dcarStatus != "")
	  //{
	  ?>
	  <option value="<?php //echo $dcarStatus; ?>" selected><?php //echo $dcarStatus; ?></option>
	  <?php
	  //}
	  ?>
        <option value="open">open</option>
        <option value="close">close</option>
      </select></td>
    </tr>
	-->
	<?php
	if($danalysis != "")
	{
	?>
	<!--
	<tr>
      <td>Date inspected : </td>
      <td>
	  <select name="dinspect">
	  <?php
	  //if($ddinspect != 0)
	  //{
	 
	  ?>
	  <option value="<?php //echo $ddinspect; ?>" selected><?php //echo $ddinspect; ?></option>
	  <?php
	  //}
	  ?>
		<option value=""></option>
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
        
        <select name="minspect">
		<?php
		/*
		if($dminspect != 0)
	   if($dminspect == 1)
	  {
	  $dismth1 = "January";
	  }
	  else if($dminspect == 2)
	  {
	  $dismth1 = "February";
	  }
	  else if($dminspect == 3)
	  {
	  $dismth1 = "March";
	  }
	  else if($dminspect == 4)
	  {
	  $dismth1 = "April";
	  }
	  else if($dminspect == 5)
	  {
	  $dismth1 = "May";
	  }
	  else if($dminspect == 6)
	  {
	  $dismth1 = "June";
	  }
	  else if($dminspect == 7)
	  {
	  $dismth1 = "July";
	  }
	  else if($dminspect == 8)
	  {
	  $dismth1 = "August";
	  }
	  else if($dminspect == 9)
	  {
	  $dismth1 = "September";
	  }
	  else if($dminspect == 10)
	  {
	  $dismth1 = "October";
	  }
	  else if($dminspect == 11)
	  {
	  $dismth1 = "November";
	  }
	  else if($dminspect == 12)
	  {
	  $dismth1 = "December";
	  }
	  else
	  {
	  $dismth1 = "";
	  }
	  {
	  */
	  ?>
	  <option value="<?php //echo $dminspect; ?>" selected><?php //echo $dismth1; ?></option>
	  <?php
	 // }
	  ?>
          <option value=""></option>
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
		<select name="yinspect">
		<?php
		//if($dyinspect != 0)
        
		//{
		?>
		<option value="<?php //echo $dyinspect; ?>" selected><?php //echo $dyinspect; ?></option>  
		<?php
		//}
		?>
         <option value=""></option>
	       <option value="2006">2006</option>
	       <option value="2007">2007</option>
	       <option value="2008">2008</option>
	       <option value="2009">2009</option>
	       <option value="2010">2010</option>
	       <option value="2011">2011</option>
	       <option value="2012">2012</option>
	       <option value="2013">2013</option>
	       <option value="2014">2014</option>
	       <option value="2015">2015</option>
		   <option value="2016">2016</option>
		   <option value="2017">2017</option>
           <option value="2018">2018</option>
	       <option value="2019">2019</option>
	       <option value="2020">2020</option>
	       <option value="2021">2021</option>
           <option value="2022">2022</option>
           <option value="2023">2023</option>
	       <option value="2024">2024</option>
	       <option value="2025">2025</option>
	    </select>      
        
	  </td>
    </tr>
	-->
	<tr>
      <td class="t2">Follow up by Originator :</td>
      <td class="t1">
	  <?php
	   if($dremark != "n/a")
	  {
	  ?>
	  <textarea name="remark" cols="100" rows="10" id="remark"><?php echo $dremark;?></textarea>
	  <?php
	  }
	  else
	  {
	  ?>
	  <textarea name="remark" cols="100" rows="10" id="remark"></textarea>
	  <?php
	  }
	  ?>
	  </td>
	</tr>
	<!--
	<tr>
      <td>Closed Date : </td>
      <td>
	  <select name="cdate">
	  <?php
	 // if($dcdate != 0)
	 
	  //{
	  ?>
	  <option value="<?php //echo $dcdate; ?>" selected><?php //echo $dcdate; ?></option>
	  <?php
	  //}
	  ?>
		<option value=""></option>
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
        
        <select name="cmonth">
          
		  <?php
		  //if($dcmonth != 0)
	
	 // {
	  ?>
	  <option value="<?php //echo $dcmonth; ?>" selected><?php //echo $dcmonth; ?></option>
	  <?php
	 // }
	  ?>
           <option value=""></option>
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
		<select name="cyear">
        <?php
		//if($dcyear != 0)
        
		//{
		?>
		<option value="<?php //echo $dcyear; ?>" selected><?php //echo $dcyear; ?></option>
		<?php
		//}
		
		?>
         <option value=""></option>
	       <option value="2006">2006</option>
	       <option value="2007">2007</option>
	       <option value="2008">2008</option>
	       <option value="2009">2009</option>
	       <option value="2010">2010</option>
	       <option value="2011">2011</option>
	       <option value="2012">2012</option>
	       <option value="2013">2013</option>
	       <option value="2014">2014</option>
	       <option value="2015">2015</option>
		   <option value="2016">2016</option>
		   <option value="2017">2017</option>
           <option value="2018">2018</option>
	       <option value="2019">2019</option>
	       <option value="2020">2020</option>
	       <option value="2021">2021</option>
           <option value="2022">2022</option>
           <option value="2023">2023</option>
	       <option value="2024">2024</option>
	       <option value="2025">2025</option>
	    </select>      
	  </td>
    </tr>
	-->
	<?php
	}
	?>
    <tr>
	
      <td class="t2">ISO Ref : </td>
      <td class="t1">
	  <?php
        if($diso != "n/a")
		{
		?>
	  <input name="iso" type="text" id="iso" size="25" maxlength="25" value="<?php echo $diso;?>">
	  <?php
	  }
	  else
	  {
	  ?>
	  <input name="iso" type="text" id="iso" size="25" maxlength="25">
	  <?php
	  }
	  ?>
	  </td>
    </tr>
    <tr>
      <td class="t2">Category : </td>
      <td class="t1">
	  <select name="category" id="category">
	  <?php
        if($dcategory != "n/a")
		{
		?>
		<option value="<?php echo $dcategory; ?>" selected><?php echo $dcategory; ?></option>
	  <?php
	  }
	  
	  ?>
	  
          <option value="Non confirmance">Non confirmance</option>
          <option value="Major">Major</option>
          <option value="Minor">Minor</option>
          <option value="Observation">Observation</option>
          <option value="SFI">SFI</option>
          <option value="RC">RC</option>
        </select>
	  
	  </td>
    </tr>
	<!--
    <tr>
	
      <td>PIC 1: </td>
      <td>
	  <select name="pic1" id="pic1">
	  <?php
	  /*
	  if($dpic1 != 0)//display existing pic
	  {
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
				*/
				?>
            	<option value="<//?php //echo $getid11; ?>" selected><//?php echo //$displaypic; ?></option>
				<?php
				/*
				}
			}
	  
	  }//close display existing pic
	  */
	  ?>
	  <option value=""></option>
	 <?php
	 /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<//?php //echo $id;?>"><//?php echo //$display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
        </select>			
	  </td>
    </tr>
    <tr>
      <td>PIC 2 :</td>
      <td>
	  <select name="pic2" id="pic2">
	  <?php
	  /*
	  if($dpic2 != 0)//display existing pic
	  {
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
				*/
				?>
            	<option value="<?php //echo $getid11; ?>" selected><?php //echo $displaypic; ?></option>
				<?php
				/*
				}
			}
	  
	  }
	  */
	  ?>
	  <option value=""></option>
	  <?php
	  /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 3 :</td>
      <td>
	  <select name="pic3" id="pic3">
	  <?php
	  /*
	  if($dpic3 != 0)//display existing pic
	  {
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
	 */
	  ?>
	  <option value=""></option>
	 <?php
	 /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 4 :</td>
      <td>
	  <select name="pic4" id="pic4">
	  <?php
	  /*
	  if($dpic4 != 0)//display existing pic
	  {
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
				*/
				?>
            	<option value="<?php //echo $getid11; ?>" selected><?php //echo $displaypic; ?></option>
				<?php
				/*
				}
			}
	  
	  }
	  */
	  ?>
	  <option value=""></option>
	  <?php
	  /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 5 :</td>
      <td>
	  <select name="pic5" id="pic5">
	  <?php
	  /*
	  if($dpic5 != 0)//display existing pic
	  {
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
				*/
				?>
            	<option value="<?php //echo $getid11; ?>" selected><?php //echo $displaypic; ?></option>
				<?php
				/*
				}
			}
	  
	  }
	 */
	  ?>
	  <option value=""></option>
	 <?php
	 /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 6 :</td>
      <td>
	  <select name="pic6" id="pic6">
	  <?php
	  /*
	  if($dpic6 != 0)//display existing pic
	  {
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
				*/
				?>
            	<option value="<?php //echo $getid11; ?>" selected><?php //echo $displaypic; ?></option>
				<?php
				/*
				}
			}
	  
	  }
	 */
	  ?>
	  <option value=""></option>
	  <?php
	  /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
	
      </select>
	  </td>
    </tr>
	
    <tr>
      <td>PIC 7 :</td>
      <td>
	  <select name="pic7" id="pic7">
	  
	  <?php
	  /*
	  if($dpic7 != 0)//display existing pic
	  {
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
	 */
	  ?>
	  <option value=""></option>
	  <?php
	  /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
		
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 8 :</td>
      <td>
	  <select name="pic8" id="pic8"> 
	  
	  <?php
	  /*
	  if($dpic8 != 0)//display existing pic
	  {
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
				?>
            	<option value="<?php echo $getid11; ?>" selected><?php echo $displaypic; ?></option>
				<?php
				}
			}
	  
	  }
	*/
	  ?>
	 <option value=""></option>
	 <?php
	 /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
		
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 9 :</td>
      <td>
	  <select name="pic9" id="pic9">
	  <?php
	  /*
	  if($dpic9 != 0)//display existing pic
	  {
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
	 */
	  ?>
	  <option value=""></option>
	  <?php
	  /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
		
      </select>
	  </td>
    </tr>
    <tr>
      <td>PIC 10 :</td>
      <td>
	  <select name="pic10" id="pic10">
	  <?php
	  /*
	  if($dpic10 != 0)//display existing pic
	  {
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
	 */
	  ?>
	  <option value=""></option>
	  <?php
	  /*
	    $geti = "select CAMID from tblCARDTL1 where IssNumber = '$inum'";
	    $getiResult = mysql_query($geti);
		if($getiResult)
		{
			while($row1 = mysql_fetch_array($getiResult))
			{
				$camid = $row1['CAMID'];
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $camid";
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
					$display = $nm." "." Dept. ".$catDept1;*/
					
		  ?>
                	
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
				
				
		    }//close while($row2 = mysql_fetch_array($getdResult))
			
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
		
      </select>
	  </td>
    </tr>
	-->
    <tr>
      <td class="t2"><br/><input type="hidden" name="group" value="<?php echo $group;?>">
	  <input type="hidden" name="inum" value="<?php echo $inum;?>">
	  <input type="hidden" name="id" value="<?php echo $id11;?>">
	  <input type="hidden" name="analysis" value="<?php echo $danalysis;?>">
	  <input type="hidden" name="corract" value="<?php echo $dcorract;?>">
	   <input type="hidden" name="cardtlid2" value="<?php echo $dcardtlid2;?>">
	   <input type="hidden" name="view" value="<?php echo $view;?>">
	  <input type="hidden" name="what" value="update">
      <br/></td>
      <td class="t1"><input type="submit" name="Submit" value="Update">
<input type="reset" name="Submit3"></form>
	  <!--
	  <form name="form2" method="post" action="editcardtl.php">
	   <input type="hidden" name="view" value="<?php //echo $view;?>">
	    <input type="hidden" name="group" value="<?php //echo $group;?>">
	  <input type="hidden" name="inum" value="<?php //echo $inum;?>">
	  <input type="hidden" name="id" value="<?php //echo $id11;?>">
		<input type="hidden" name="cardtlid2" value="<?php //echo $dcardtlid2;?>">
		<input type="hidden" name="what" value="delete">
        <input type="submit" name="Submit22" value="Delete">
      </form>--></td>
    </tr>
  </table>

<?php
//}
?>

<p align="center" class="style2">Attachment</p>
<table border="0" align="center">
<tr>
<td>
<table class="tbl">
<?php
//display files
	$afid = "";
	$fn = "";
	$sf = "select * from tblAttach where IssNumber = '$inum'";
	$sfr = mysql_query($sf);
	if($sfr)
	{
		while($rf = mysql_fetch_array($sfr))
		{
			?>
			<tr><td>
			<?php
			$afid = $rf['AFID'];
			$fn = $rf['FileName'];
            print $fn;
	
			?>
			</td><td><br/>
			<form method = "post" action = "editcardtl.php">
			<input type ="hidden" name="what" value="del"><input type = "hidden" name = "fid" value = "<?php echo $afid;?>">
			<input type = "hidden" name = "flnm" value = "<?php echo $fn;?>">
			<input type ="hidden" name="group" value="<?php echo $group; ?>"><input type ="hidden" name="id" value="<?php echo $id11; ?>">
	  <input type ="hidden" name="inum" value="<?php echo $inum; ?>"> <input type="hidden" name="view" value="<?php echo $view;?>">
	  <input type="hidden" name="cardtlid2" value="<?php echo $dcardtlid2;?>">
			<input type= "submit" value = "delete" name = "delete">
			</form>
</td></tr>
<?php
		}
	}
?>
</table>
</td>

</tr>
</table>

<form action="editcardtl.php" method="post" name="form1"  ENCTYPE="multipart/form-data" >
<table border="0" align="center">
   <tr>
    <td align ="center">
	<p class="style1"><i>It is recommended to create a unique file name</i></p>
      <input type="file" name="file">
    </td>
  </tr>
	<tr>
      <td align = "center"><input type ="hidden" name="what" value="attach">
	  <input type ="hidden" name="group" value="<?php echo $group; ?>"><input type ="hidden" name="id" value="<?php echo $id11; ?>">
	  <input type ="hidden" name="inum" value="<?php echo $inum; ?>"> <input type="hidden" name="view" value="<?php echo $view;?>">
	  <input type="hidden" name="cardtlid2" value="<?php echo $dcardtlid2;?>"><input type="submit" name="Submit" value="Attach"></td>
	</tr>
	
  </table>
  </form>
 
</body>
</html>
<?php
}

function upload_file()
{
	
	$uploaddir = "attachment";
	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{
		move_uploaded_file($_FILES['file']['tmp_name'],$uploaddir.'/'.$_FILES['file']['name']);
	}
	
}
?>

