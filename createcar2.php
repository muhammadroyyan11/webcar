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
<title>Adding CAR Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif; font-size:small;}
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
$id11 = $_POST['id'];
$rid = $_POST['rid']; 


include ("conn.php");

	

if(isset($_POST['what']))
{
        if($_POST['what'] == "addinfo")
		{
			
			$ostaff = "";
			$gn3 = "select RFrom from tblRequest where RequestID = $rid";
			$gnr3 = mysql_query($gn3);
			if($gnr3)
			{
			while($rn3 = mysql_fetch_array($gnr3))
			{
				$rcc3 = $rn3['RFrom'];
				$os = "select MUserID from tblMUAccount where Name = '$rcc3'";
				$osr = mysql_query($os);
				if($osr)
				{
					while($ror1 = mysql_fetch_array($osr))
					{
						$ostaff = $ror1['MUserID'];
					}
				}
			}
			}
			
			$omngr = "";
			$gn2 = "select RCC from tblRequest where RequestID = $rid";
			$gnr2 = mysql_query($gn2);
			if($gnr2)
			{
			while($rn2 = mysql_fetch_array($gnr2))
			{
				$rcc2 = $rn2['RCC'];
				
				$gmcc = "select DeptMngr from tblDept where DeptID = $rcc2";
			    $gmccr = mysql_query($gmcc);
			    if($gmccr)
			    {
				while($rmcc = mysql_fetch_array($gmccr))
				{
					$mcc = $rmcc['DeptMngr'];
				}
			    }
				
				$o = "select MUserID from tblMUAccount where Name = '$mcc' and GroupID = 'om' and DeptID = $rcc2";
				$or = mysql_query($o);
				if($or)
				{
					while($ror = mysql_fetch_array($or))
					{
						$omngr = $ror['MUserID'];
					}
				}
			}
			}
			
			$gn3 = "select RBCC from tblRequest where RequestID = $rid";
			$gnr3 = mysql_query($gn3);
			if($gnr3)
			{
			while($rn3 = mysql_fetch_array($gnr3))
			{
				$rbcc2 = $rn3['RBCC'];
				
				$gmbcc = "select DeptMngr from tblDept where DeptID = '$rbcc2'";
			    $gmbccr = mysql_query($gmbcc);
			    if($gmbccr)
			    {
				while($rmbcc = mysql_fetch_array($gmbccr))
				{
					$mbcc = $rmbcc['DeptMngr'];
				}
			    }
				
				$a = "select MUserID from tblMUAccount where Name = '$mbcc' and GroupID = 'am' and DeptID = '$rbcc2'";
				$ar = mysql_query($a);
				if($ar)
				{
					while($rar = mysql_fetch_array($ar))
					{
						$amngr = $rar['MUserID'];
					}
				}
			}
			}
			
			
			$date_array =getdate(); 
	   		foreach($date_array as $key => $val)
	   		{
 				$key = $val;
	   		}
	   
			$issDate = $date_array['mday'];
			$issMonth = $date_array['mon'];
			$issYear = $date_array['year'];
			
			//get dept 
			$d = "";
			$did = "";
			$ga = "select DeptID from tblMUAccount where MUserID = $ostaff";
			$gar = mysql_query($ga);
			if($gar)
			{
				while($r = mysql_fetch_array($gar))
				{
					$d = $r['DeptID'];
					$gd = "select DID from tblDept where DeptID = $d";
					$gdr = mysql_query($gd);
					{
						while($r1 = mysql_fetch_array($gdr))
						{
							$did = $r1['DID'];
						}
					}
				}
			}
			$c = car_count();
			
			if($c == 0)
			{
			$c1 = 1;
			}
			else
			{
			$c1 = $c+1;
			}
			
			if(($c1 > 0)&&($c1 < 10))
			{
			$c2 = "00".$c1;
			}
			else
			{
			$c2 = "0".$c1;
			}
			
			//creating Issue number
			$inum = "T/".$did."-".$c2."/".$issMonth."/".$issYear;
			
			$grb = "select RFrom from tblRequest where RequestID = $rid";
			$grbr = mysql_query($grb);
			while($rrb = mysql_fetch_array($grbr))
			{
				$rb = $rrb['RFrom'];
			}
			
			$grt = "select RTo from tblRequest where RequestID = $rid";
			$grtr = mysql_query($grt);
			while($rrt = mysql_fetch_array($grtr))
			{
				$rt = $rrt['RTo'];
			}
			
		
			$sql = "INSERT INTO tblCAR ";
    		$sql .= "(IssNumber,IssDate,IssMonth,IssYear,CarStatus,OSID,OMID,AMID,RNumber,RequestBy,RequestTo)";
    		$sql .= "VALUES ( ";
    		$sql .= "'$inum',$issDate,$issMonth,$issYear,'open',$id11,$omngr,$amngr,$rid,'$rb','$rt')"; 
    		$result = mysql_query($sql);
			if($result)
			{
			 $insertcam = "INSERT INTO tblCARDTL1(IssNumber,CAMID)VALUES('$inum',$amngr)";
			 $insertcamResult = mysql_query($insertcam); 
			}
			else
			{
				print mysql_error();
				
			}
		}
		
		if($_POST['what'] == "add")
		{
			$inum = $_POST['inum'];
			$rid = $_POST['rid'];
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
			
			//get cardtlid2 and increment by 1
			
			$lastid = get_last_row();
			$cardtlid2 = $lastid + 1;
			
			
			if($_POST['pic1'] != "")
			{
					$pic1 = $_POST['pic1'];
					$select1 = "select PICID from tblPIC where PICID = $pic1 AND IssNumber ='$inum'"; // check whether pic is already in the project
					$select1Result = mysql_query($select1);
					$pi1="";
               		while($row = mysql_fetch_array($select1Result))
               		{
	          			$pi1 = $row['PICID'];
               		}

            		if($pi1 =="") 
             		{
						//insert to table pic
						$insert1 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic1,'$inum',$cardtlid2,'open')";
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
						$insert2 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic2,'$inum',$cardtlid2,'open')";
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
						$insert3 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic3,'$inum',$cardtlid2,'open')";
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
						$insert4 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic4,'$inum',$cardtlid2,'open')";
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
						$insert5 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic5,'$inum',$cardtlid2,'open')";
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
						$insert6 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic6,'$inum',$cardtlid2,'open')";
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
						$insert10 = "insert into tblPIC (PICID,IssNumber,CARDTLID2,PICStat) VALUES ($pic10,'$inum',$cardtlid2,'open')";
						$insert10Result = mysql_query($insert10);
             		}
			}
			else
			{
				$pic10 = "0";
			}
            */
			$sql = "INSERT INTO tblCARDTL2 ";
    		$sql .= "(IssNumber,Findings,DDate,DMonth,DYear,CARStatus,ISORef,Category,";
			$sql .= "PICID1,PICID2,PICID3,PICID4,PICID5,PICID6)"; //,PICID7,PICID8,PICID9,PICID10)";
			$sql .= "VALUES ( ";
    		$sql .= "'$inum','$findings',$date,$month,$year,'open','$iso','$category',";
			$sql .= "$pic1,$pic2,$pic3,$pic4,$pic5,$pic6)"; //,$pic7,$pic8,$pic9,$pic10)"; 
    		$result = mysql_query($sql);
			if($result)
			{
				print "<p align =\"center\" class =\"style2\">CAR Detail has been added</p>";
				//delete request
				$delete = "delete from tblRequest where RequestID = $rid";
				$deleteResult = mysql_query($delete);
				
			}
			else
			{
				print mysql_error(); 
				print "<p  align =\"center\" class =\"style2\">Failed to add CAR Detail</p>";
			}
		}
}		

?>
<body>
<table width="80" border="0" align="center">
    <tr>
      <td width="74"><form name="form1" method="post" action="<?php echo $group; ?>.php">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		<input type="hidden" name="id" value="<?php echo $id11; ?>">
        <input type="submit" name="Submit" value="Back to Menu">
      </form></td>
	   
    </tr>
</table>
<?php
if($_POST['what'] != "add")
{
?>
<form name="form1" method="post" action="createcar2.php">
  <p align="center" class="style3">CAR Details</p>
  <table width="650" border="1" align="center" class="style1">
    <!--<tr>
      <td width="115">Code : </td>
      <td width="326"><input name="code" type="text" id="code" size="20" maxlength="20"></td>
    </tr>-->
	<tr>
      <td>Originator : </td>
      <td>
	  <span class="style1">
            <?php
			$getos ="select Name from tblMUAccount where MUserID = $id11";
			$getosResult = mysql_query($getos);
			if($getosResult)
			{
				while($row20 = mysql_fetch_array($getosResult))
				{
					$osName = $row20['Name'];
				}
			}
			print $osName;
			?>
          </span>
	  </td>
    </tr>
	<tr>
      <td>Originator Manager : </td>
      <td>
	  <span class="style1">
			<?php
			$gn = "select RCC from tblRequest where RequestID = $rid";
			$gnr = mysql_query($gn);
			if($gnr)
			{
			while($rn = mysql_fetch_array($gnr))
			{
				$rcc = $rn['RCC'];
				$gmcc = "select DeptMngr from tblDept where DeptID = $rcc";
			    $gmccr = mysql_query($gmcc);
			    if($gmccr)
			    {
				 	while($rmcc = mysql_fetch_array($gmccr))
					{
						$mcc = $rmcc['DeptMngr'];
					}
				}
			}
			
			print $mcc;
			}
			else 
			{
			print mysql_error();
			}
			?>
          </span> 
	  </td>
    </tr>
	<tr>
      <td>In Charge Manager : </td>
      <td>
	  <span class="style1">
		
			<?php
			$gn1 = "select RBCC from tblRequest where RequestID = $rid";
			$gnr1 = mysql_query($gn1);
			if($gnr1)
			{
			while($rn1 = mysql_fetch_array($gnr1))
			{
				$rbcc = $rn1['RBCC'];
				$gmbcc = "select DeptMngr from tblDept where DeptID = $rbcc";
			    $gmbccr = mysql_query($gmbcc);
			    if($gmbccr)
			    {
				while($rmbcc = mysql_fetch_array($gmbccr))
				{
					$mbcc = $rmbcc['DeptMngr'];
				}
			}
			
			}
			
			print $mbcc;
			}
			else 
			{
			print mysql_error();
			}
			
		  ?>
          
          
          </span>
	  </td>
    </tr>
	<tr>
      <td>Corrective Action Manager : </td>
      <td>
	 <span class="style1">
		
			<?php
			$gn1 = "select RBCC from tblRequest where RequestID = $rid";
			$gnr1 = mysql_query($gn1);
			if($gnr1)
			{
			while($rn1 = mysql_fetch_array($gnr1))
			{
				$rbcc = $rn1['RBCC'];
				$gmbcc = "select DeptMngr from tblDept where DeptID = $rbcc";
			    $gmbccr = mysql_query($gmbcc);
			    if($gmbccr)
			    {
				while($rmbcc = mysql_fetch_array($gmbccr))
				{
					$mbcc = $rmbcc['DeptMngr'];
				}
			}
			
			}
			
			print $mbcc;
			}
			else 
			{
			print mysql_error();
			}
			
		  ?>
          
          
          </span>
	  </td>
    </tr>
    <tr>
      <td>Findings : </td>
      <td>
	  <?php
	 
	  
	  $gfdg = "select RFindings from tblRequest where RequestID = $rid";
	  
	  $gfdgr = mysql_query($gfdg);
	  while($rfdg = mysql_fetch_array($gfdgr))
	  {
	  	$fdg = $rfdg['RFindings'];
		print $fdg;
	  }
	  
	  ?>
	  </td>
    </tr>
    <tr>
      <td>Due Date : </td>
      <td> <select name="date">
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
      <td>ISO Ref : </td>
      <td><input name="iso" type="text" id="iso" size="25" maxlength="25"></td>
    </tr>
    <tr>
      <td>Category : </td>
      <td>        <select name="category" id="category">
          <option value="Non Confirmance">Non Confirmance</option>
          <option value="Major">Major</option>
          <option value="Minor">Minor</option>
          <option value="Observation">Observation</option>
          <option value="SFI">SFI</option>
          <option value="RC">RC</option>
        </select></td>
    </tr>
    <tr>
	
      <td>PIC 1: </td>
      <td><select name="pic1" id="pic1">
	  <option value="" selected></option>
	   
	  <?php
	   
			
		        $getd = "select DeptID from tblMUAccount where MUserID = $amngr";
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
			
			
	 
		?>
            </select></td>
    </tr>
    <tr>
      <td>PIC 2 :</td>
      <td><select name="pic2" id="pic2">
	  <option value="" selected></option>
	  <?php
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
		  ?>
                	<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
		    }//close while($row2 = mysql_fetch_array($getdResult))
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 
		?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 3 :</td>
      <td><select name="pic3" id="pic3">
	  <option value="" selected></option>
	   <?php
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
		  ?>
                	<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
		    }//close while($row2 = mysql_fetch_array($getdResult))
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 
		?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 4 :</td>
      <td><select name="pic4" id="pic4">
	  <option value="" selected></option>
	   <?php
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
		  ?>
                	<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
		    }//close while($row2 = mysql_fetch_array($getdResult))
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 
		?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 5 :</td>
      <td><select name="pic5" id="pic5">
	  <option value="" selected></option>
	  <?php
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
		  ?>
                	<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
		    }//close while($row2 = mysql_fetch_array($getdResult))
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 
		?>
      </select></td>
    </tr>
    <tr>
      <td>PIC 6 :</td>
      <td><select name="pic6" id="pic6">
	  <option value="" selected></option>
	   <?php
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
		  ?>
                	<option value="<?php echo $id;?>"><?php echo $display; ?></option>
          <?php
		  		} //close while($row = mysql_fetch_array($picResult))
		    }//close while($row2 = mysql_fetch_array($getdResult))
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 
		?>
      </select></td>
    </tr>
    <tr>
	<!--
      <td>PIC 7 :</td>
      <td><select name="pic7" id="pic7">
	  <option value="" selected></option>
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
					*/
		  ?>
                	<!--
					<option value="<?php //echo $id;?>"><?php //echo $display; ?></option>
					-->
          <?php
		  /*
		  		} //close while($row = mysql_fetch_array($picResult))
		    }//close while($row2 = mysql_fetch_array($getdResult))
			}//close while($row1 = mysql_fetch_array($getiResult))
		} //close if($getiResult)
	 */
		?>
		<!--
      </select></td>
    </tr>
    <tr>
      <td>PIC 8 :</td>
      <td><select name="pic8" id="pic8">
	  <option value="" selected></option>
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
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
      </select></td>
    </tr>
    <tr>
      <td>PIC 9 :</td>
      <td><select name="pic9" id="pic9">
	  <option value="" selected></option>
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
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
      </select></td>
    </tr>
    <tr>
      <td>PIC 10 :</td>
      <td><select name="pic10" id="pic10">
	  <option value="" selected></option>
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
					
			    	$catDept = "select DeptName from tblDept where DeptID = $d";
					$catDeptResult = mysql_query($catDept);
					if($catDeptResult)
					{
						while($row1 = mysql_fetch_array($catDeptResult))
						{
							$catDept1 = $row1['DeptName'];
						}
					}
					$display = $row['Name']." "." Dept. ".$catDept1;
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
      </select></td>
    </tr>
	-->
    <tr>
	
      <td><!--<br/><input type="hidden" name="group" value="<?php //echo $group;?>">
	  <input type="hidden" name="inum" value="<?php //echo $inum;?>">
	  <input type="hidden" name="id" value="<?php //echo $id11;?>">
	 
      <br/>--></td>
	  
      <td><!--<br/><input type="submit" name="Submit" value="Add">
      <input type="reset" name="Submit3"></form>--><form name="form2" method="post" action="createcar2.php">
	   <input type="hidden" name="what" value="add">
	    <input type="hidden" name="group" value="<?php echo $group; ?>">
		<input type="hidden" name="inum" value="<?php echo $inum;?>">
		<input type="hidden" name="id" value="<?php echo $id11;?>">
		<input type="hidden" name="findings" value="<?php echo $fdg;?>">
		<input type="hidden" name="rid" value="<?php echo $rid;?>">
        <input type="submit" name="Submit2" value="Add">
      </form></td>
    </tr>
  </table>
<?php
}
?>
 
  

</body>
</html>
<?php
} //close else(user authorized)
 
function get_last_row() 
{ 

   $lastRow = "SELECT max(CARDTLID2) as lastRow FROM tblCARDTL2"; 
	
     $lastRowResult = mysql_query($lastRow); 

     return mysql_result($lastRowResult,0,"lastRow"); 

} 

function car_count() 
{ 
            $date_array1 =getdate(); 
	   		foreach($date_array1 as $key => $val)
	   		{
 				$key = $val;
	   		}
	
			$curMonth = $date_array1['mon'];
			$curYear = $date_array1['year'];

$countQry = "SELECT count(CARID) as carCount FROM tblCAR where IssMonth = $curMonth and IssYear = $curYear";
$countRsult = mysql_query($countQry); 

return mysql_result($countRsult,0,"carCount"); 

}

?>
