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
    } } } else if (test.charAt(0) == 'R') errors = ' coba cek apakah penerima car / problem sudah diisi.\n'; }
  } if (errors) alert(errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<LINK href="tbldesign.css" rel="stylesheet" type="text/css">
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

include ("conn.php");

if(isset($_POST['what']))
{
       
	    if($_POST['what'] == "request")
		{
			$up = 0;
			$up1 = 0;
		
	        //originator manager
			$omngr = "";
			$mcc = "";
			$d = "";
			$omEmail = "";
            $s = "select DeptID from tblMUAccount where MUserID = $id";
			//echo $s;
			$sResult = mysql_query($s);
			while($r1 = mysql_fetch_array($sResult))
			{
				$d = $r1['DeptID'];
			}	

			$gdc = "select DID from tblDept where DeptID = $d";	
			$gdcr = mysql_query($gdc);
			
			if($gdcr)
			{
			while($rdc = mysql_fetch_array($gdcr))
			{
			$dc = $rdc['DID'];
			}
			}
			
			    $gmcc = "select DeptMngr from tblDept where DeptID = $d";
			    $gmccr = mysql_query($gmcc);
				//echo $gmcc;
				
			    if($gmccr)
			    {
					while($rmcc = mysql_fetch_array($gmccr))
					{
						$mcc = $rmcc['DeptMngr'];
					}
			    }
				
				$o = "select MUserID,Email from tblMUAccount where Name = '$mcc' and GroupID = 'om' and DeptID = $d";				
				//echo $o;
				$or = mysql_query($o);
				if($or)
				{
					while($ror = mysql_fetch_array($or))
					{
						$omngr = $ror['MUserID'];
						$omEmail = $ror['Email'];
						//echo "isinya:" .$omngr;
					}
				}
			
			//  pic
			$d1 = "";
			$uid1 = "";
			$picEmail = "";
			if($_POST['to'] != "")
			{
				$to = $_POST['to'];
				$s1 = "select MUserID,DeptID,Email from tblMUAccount where MUsername = '$to' and GroupID = 'cat'";
				//echo $s1;
				$s1Result = mysql_query($s1);
				while($rp = mysql_fetch_array($s1Result))
				{
					$d1 = $rp['DeptID'];
					$uid1 = $rp['MUserID'];
					$picEmail = $rp['Email'];
				}
				
			
			}
			else 
			{
			$to = "";
			$up1 = 1;
			}		


			//in charge manager
			
			     $mbcc = "";
				 $amngr = "";
				 $amEmail = "";
				$gmbcc = "select DeptMngr from tblDept where DeptID = $d1";
			    $gmbccr = mysql_query($gmbcc);
				//echo $gmbcc;
			    if($gmbccr)
			    {
					while($rmbcc = mysql_fetch_array($gmbccr))
					{
						$mbcc = $rmbcc['DeptMngr'];
					}
			    }
				
    
				
				$a = "select MUserID,Email from tblMUAccount where Name = '$mbcc' and GroupID = 'am' and DeptID = $d1";
				//print $a;
				$ar = mysql_query($a);
				if($ar)
				{
					while($rar = mysql_fetch_array($ar))
					{
						$amngr = $rar['MUserID'];
						$amEmail = $rar['Email'];
							//print $amngr;
					}
				}
				

     
			$findings = $_POST['findings'];
			if($_POST['date'] != "")
			{
				$date = $_POST['date'];
			}
			else
			{
				$date = "0";
			}
			if($_POST['month'] != "")
			{
				$month = $_POST['month'];
			}
			else
			{
				$month = "0";
			}
			if($_POST['year'] != "")
			{
				$year = $_POST['year'];
			}
			else
			{
				$year = "0";
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
			
			if($_POST['catid'] != "")
			{
				$catid = $_POST['catid'];
			}
			else
			{
				$catid = "0";
			}
			
			
			$date_array =getdate(); 
	   		foreach($date_array as $key => $val)
	   		{
 				$key = $val;
	   		}
	   
			$issDate = $date_array['mday'];
			$issMonth = $date_array['mon'];
			$issYear = $date_array['year'];
			
			//*********************
            // due date validation*
			//*********************			
			
			//today : 21 june 2006
			//due date 20 june 2006
			if (($issDate > $date)&&($issMonth == $month)&&($issYear == $year))
			{
			//give warning
				$up = 1;
			}

			//today : 21 june 2006
			//due date 21 may 2006
			else if (($issDate == $date)&&($issMonth > $month)&&($issYear == $year))
			{
				//give warning
				$up = 1;
			}

			//today 21 july 2006
			//due date 15 june 2006
			else if(($issDate > $date)&&($issMonth > $month)&&($issYear == $year))
			{
				//give warning
				$up = 1;
			}


			//today 21 june 2006
			//due date 26 maret 2006
			else if(($issDate < $date) && ($issMonth > $month) && ($issYear == $year))
			{
				//give warning
				$up = 1;
			}

			//today 12 january 2007
			//due date 11 december 2006
			else if(($issDate > $date)&&($issMonth < $month)&&($issYear > $year))
			{
				//give warning
				$up = 1;
			}

			//today 21 june 2007
			//due date 25 december 2006
			else if(($issDate < $date)&&($issMonth < $month)&&($issYear > $year))
			{
				//give warning
				$up = 1;
			}
			
			//today 21 june 2007
			//due date 26 maret 2006
			else if(($issDate < $date) && ($issMonth > $month) && ($issYear > $year))
			{
				//give warning
				$up = 1;
			}

			//today 21 june 2007
			//due date 22 july 2006
			else if(($issDate > $date) && ($issMonth > $month) && ($issYear > $year))
			{
				//give warning
				$up = 1;
			}

			//today 21 june 2007
			//due date 21 june 2006
			else if(($issDate == $date) && ($issMonth == $month) && ($issYear > $year))
			{
				//give warning
				$up = 1;
			}

			else
			{
				$up = 0;
			}
			
			if(($up == 0)&&($up1 == 0)) // create car
			{
			
			//**********************
			//creating Issue number*
			//**********************
			
			//get counter
			//echo "get counter";
			$c = 1;
			$getctr = "select Counter from tblCounter where IMonth = $issMonth and IYear = $issYear";
			$getctrr = mysql_query($getctr);
			while($rcntr = mysql_fetch_array($getctrr))
			{
			$cntr = $rcntr['Counter'];
			if($cntr != "")
			{
			$c = $cntr + 1;
			}
			else
			{
			$c = 1;
			}
			}          
			
					

		
			if(($c > 0)&&($c < 10))
			{
			$c2 = "00".$c;
			}
			else
			{
			$c2 = "0".$c;
			}
			
			
			$inum = "T/".$dc."-".$c2."/".$issMonth."/".$issYear;
			
		    //insert to table pic
		    //get cardtlid2 and increment by 1
			$lastid = get_last_row();
		    $cardtlid2 = $lastid + 1;
				
			
			$insert1 = "insert into tblPIC (PICID,IssNumber,CARDTLID2) VALUES ($uid1,'$inum',$cardtlid2)";    
			$insert1Result = mysql_query($insert1);
			//echo $insert1;
			
			
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
			
			$sql = "INSERT INTO tblCAR ";
    		$sql .= "(IssNumber,IssDate,IssMonth,IssYear,CarStatus,OSID,OMID,AMID)";
    		$sql .= "VALUES ( ";
    		$sql .= "'$inum',$issDate,$issMonth,$issYear,'open',$id,$omngr,$amngr)"; 
			//echo $sql; 'error disini
    		$result = mysql_query($sql);
			


			if($result)
			{
				$sql2 = "INSERT INTO tblCARDTL2 ";
    			$sql2 .= "(IssNumber,Findings,DDate,DMonth,DYear,CARStatus,ISORef,Category,PICID1,CatID)";
				$sql2 .= "VALUES ( ";
    			$sql2 .= "'$inum','$findings',$date,$month,$year,'open','$iso','$category',$uid1,$catid)";
				//echo $sql2;
				
				$result2 = mysql_query($sql2);
				//echo 'debug..tblcardtl2' ;  
			    if($result2)
			    {
					$sc = "select Counter from tblCounter where IMonth = $issMonth and IYear = $issYear";
					$scr = mysql_query($sc);
					
					$ctr = "";
					if($scr)
					{
					while ($rctr = mysql_fetch_array($scr))
					{
						$ctr = $rctr['Counter'];
					}
					}
					if($ctr == "")//insert counter
					{
					$ictr = "INSERT INTO tblCounter (IMonth,IYear,Counter) VALUES ($issMonth,$issYear,1)";
					$ictrr = mysql_query($ictr);
					}
					else//update counter
					{
					$ctr1 = $ctr + 1;
					$uctr = "UPDATE tblCounter SET Counter = $ctr1 where IMonth = $issMonth and IYear = $issYear";
					$uctrr = mysql_query($uctr);
					}
					
					
					print "<p align =\"center\" class =\"style2\">CAR has been added</p>";
					
					//send notification to originator manager and incharge manager
					//originator email is not empty 
					if(($omEmail != "") && ($amEmail == "") && ($picEmail == ""))
					{
					print "<p align =\"center\" class =\"p\"><a href=\"mailto:$omEmail\" TITLE=\"CAR Notification\">Send Notification</a></p>";
					}
					//in charge manager email is not empty
					if(($omEmail == "") && ($amEmail != "") && ($picEmail == ""))
					{
					print "<p align =\"center\" class =\"p\"><a href=\"mailto:$amEmail\" TITLE=\"CAR Notification\">Send Notification</a></p>";
					}
					
					//pic email is not empty
					if(($omEmail == "") && ($amEmail == "") && ($picEmail != ""))
					{
					print "<p align =\"center\" class =\"p\"><a href=\"mailto:$picEmail\" TITLE=\"CAR Notification\">Send Notification</a></p>";
					}
					
					// originator manager and in charge manager email are not empty
					if(($omEmail != "") && ($amEmail != "") && ($picEmail == ""))
					{
					print "<p align =\"center\" class =\"p\"><a href=\"mailto:$omEmail;$amEmail\" TITLE=\"CAR Notification\">Send Notification</a></p>";
					}
					
					//originator and pic email are not empty
					if(($omEmail != "") && ($amEmail == "") && ($picEmail != ""))
					{
					print "<p align =\"center\" class =\"p\"><a href=\"mailto:$omEmail;$picEmail\" TITLE=\"CAR Notification\">Send Notification</a></p>";
					}
					
					//in charge and pic email are not empty 
					if(($omEmail == "") && ($amEmail != "") && ($picEmail != ""))
					{
					print "<p align =\"center\" class =\"p\"><a href=\"mailto:$amEmail;$picEmail\" TITLE=\"CAR Notification\">Send Notification</a></p>";
					}
					
					//originator,pic,in charge manager email are not empty
					if(($omEmail != "") && ($amEmail != "") && ($picEmail != ""))
					{
					print "<p align =\"center\" class =\"p\"><a href=\"mailto:$omEmail;$amEmail;$picEmail\" TITLE=\"CAR Notification\">Send Notification</a></p>";
					}
					
					?>
					<div align ="center"><form method="post" action="<?php echo $group;?>.php">
	  <input type="submit" value="back"><input type="hidden" name="group" value="<?php echo $group;?>"><input type="hidden" name="id" value="<?php echo $id;?>"></form></center>
					<?php
					
					$form = "<table align=\"center\"><tr><td><form action=\"attach.php\" method=\"post\">";
					$form .= "<input type=\"submit\" value=\"Attach more files\">";
					$form .= "<input type=\"hidden\" name=\"group\" value=\"$group\">";
					$form .= "<input type=\"hidden\" name=\"id\" value=\"$id\">";
					$form .= "<input type=\"hidden\" name=\"inum\" value=\"$inum\">";
					$form .= "</form></td></tr></table>";
					print $form;
					
					
				}
				else
				{
       
                //echo $sql2;									
                print mysql_error(); 
				
				}
			}
			else
			{

				print mysql_error(); 
			}
			}//close if ($up == 0)&&($up1 == 0)
			else
			{
				if($up == 1)
				{
					print "<p  align =\"center\" class =\"style2\">Due date must be this present or the following date </p>";
				}
				else if($up == 1)
				{
					print "<p  align =\"center\" class =\"style2\">You need to select CAR recipient</p>";
				}
				else
				{
					print "<p  align =\"center\" class =\"style2\">Error in submitting CAR, please try again</p>";
				}
			}
				
		}// close if($_POST['what'] == "request")

	}	//close if(isset($_POST['what']))
?>
<body>
<p align="center" class="style2"> Request CAR	</p>
<form action="requestcar.php" method="post" name="form1"  ENCTYPE="multipart/form-data" onSubmit="MM_validateForm('to','','R','findings','','R');return document.MM_returnValue">
  <table width="732" align="center" class="tbl">
    <tr>
      <td class="t2" width="70">From : </td>
	   
      <td class="t1"><?php 
	  $gnm = "select Name from tblMUAccount where MUserID = $id";
	  $gnmr = mysql_query($gnm);
	  while($rnm = mysql_fetch_array($gnmr))
	  {
	  $n = $rnm['Name'];
	  }
	  print $n;
	  ?></td>
    </tr>
    <tr>
      <td class="t2">To : </td>
      <td class="t1"><select name="to" size="150px"><option value=""></option>
	  <?php
	  $sid = "select MUsername,Name,DeptID from tblMUAccount where GroupID ='cat' AND StatusActive = 1 order by name ASC";
	  $sidr = mysql_query($sid);
	  while($r = mysql_fetch_array($sidr))
	  {
	  
	  	$munm = $r['MUsername'];
	  	$nm = $r['Name'];
	  	$did = $r['DeptID'];
	  	$gd = "select DeptName from tblDept where DeptID = $did";
	  	$gdr = mysql_query($gd);
	  	while($r1 = mysql_fetch_array($gdr))
	  	{
	  		$dn = $r1['DeptName'];
	  		$display = $nm." (".$dn.")";	
	  		?>
	  		<option value="<?php echo $munm; ?>"><?php echo $display; ?></option>
	  		<?php
	  	}
	  }
	  ?>  
	 
	  </select></td>
    </tr>
	
	  
	  
	
    <tr>
      <td class="t2">Problem : </td>
      <td class="t1"><textarea name="findings" cols="100" rows="20" id="findings"></textarea></td>
    </tr>
	<tr>
      <td class="t2">Due Date : </td>
      <td class="t1"> <select name="date">
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
        
        <select name="month">
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
        <select name="year">
           <option value="" selected>yyyy</option>
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
		   <!--
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
		   -->
	    </select>      
             
      </td>
    </tr>
    <tr>
      <td class="t2">ISO Ref : </td>
      <td class="t1"><input name="iso" type="text" id="iso" size="25" maxlength="25"></td>
    </tr>
    <tr>
      <td class="t2">Ranking : </td>
      <td class="t1">        <select name="category" id="category">
          <option value="Non Confirmance">Non Confirmance</option>
          <option value="Major">Major</option>
          <option value="Minor">Minor</option>
          <option value="Observation">Observation</option>
          <option value="SFI">SFI</option>
          <option value="RC">RC</option>
        </select></td>
    </tr>
   <tr>
    <td class="t2"><span class="style25">Attachment :</span></td>
    <td class="t1"><p class="style27">
      <input type="file" name="file"> <i> Note : It is recommended to create a unique file name</i>
    </td>
  </tr>
  
  <tr>
  	<td class="t2">Category :</td>  
  	<td class="t1"><select name="catid" size="150px"><option value=""></option>
  
  	<?php
	  $sid = "select CatID,Category from tblCategory order by CatID ASC";
	  $scat = mysql_query($sid);
	  while($r = mysql_fetch_array($scat))
	  { 
	  	$catid = $r['CatID'];
		$cata = $r['Category'];
  		?> 
		<option value="<?php echo $catid; ?>"><?php echo $cata; ?></option>
		<?php
	  }
		?>  
    </select></td>
  </tr>
  
  
	<tr>
      <td class="t2"><input type ="hidden" name="what" value="request">
	  <input type ="hidden" name="group" value="<?php echo $group; ?>"><input type ="hidden" name="id" value="<?php echo $id; ?>"></td>
      <td class="t1"><input type="submit" name="Submit" value="Create CAR"></form></td>
	  <?php //echo "id =" + $id ?>
    </tr>
  </table>
  <?php
}
?>

</body>
</html>
<?php
function get_last_row() 
{ 

   $lastRow = "SELECT max(CARDTLID2) as lastRow FROM tblCARDTL2"; 
	
     $lastRowResult = mysql_query($lastRow); 

     return mysql_result($lastRowResult,0,"lastRow"); 

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