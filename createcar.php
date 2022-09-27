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
<title>Creating New CAR</title>
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
$rid = $_POST['rid']; 

include ("conn.php");

$step = 1;

if(isset($_POST['what']))
{
       
	    if($_POST['what'] == "add")
		{
            /*
			if($_POST['omngr'] != "")
			{
				$omngr = $_POST['omngr'];
			}
			else
			{
				$omngr = "0";
			}
			if($_POST['amngr'] != "")
			{
				$amngr = $_POST['amngr'];
			}
			else
			{
				$amngr = "0";
			}
			*/
			
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
				
				$o = "select MUserID from tblMUAccount where Name = '$mcc' and GroupID = 'om'";
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
				
				$a = "select MUserID from tblMUAccount where Name = '$rbcc2'";
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
    		$sql .= "'$inum',$issDate,$issMonth,$issYear,'open',$id,$omngr,$amngr,$rid,'$rb','$rt')"; 
    		$result = mysql_query($sql);
			if($result)
			{
			//direct to the next step
			//$insertcam = "INSERT INTO tblCARDTL1(IssNumber,CAMID)VALUES('$inum',$amngr)";
			//$insertcamResult = mysql_query($insertcam);
			
	         $step = 2;     
			}
			else
			{
				print mysql_error();
				
			}
		}// close if($_POST['what'] == "add")
		$cam1 = "";
		  if($_POST['what'] == "addcam")
		  {
			$step = 2;
			
			$inum = $_POST['inum'];
			
			
			if($_POST['cam'] != "")
			{
				$cam1 = $_POST['cam'];
			}
			else
			{
				$cam1 = "";
			}
			
			$getMngr = "select Name from tblMUAccount where MUserID = $cam1";
			$getMngrResult = mysql_query($getMngr);
			if($getMngrResult)
			{
			
			while($row8 = mysql_fetch_array($getMngrResult))
					{
					$camName = $row8['Name'];
					}
			}
			
			$sql = "INSERT INTO tblCARDTL1 ";
    		$sql .= "(IssNumber,CAMID)";
    		$sql .= "VALUES ( ";
    		$sql .= "'$inum',$cam1)"; 
    		$result = mysql_query($sql);
			if($result)
			{
				print "<p align=\"center\" class =\"style2\">$camName has been added as corrective action manager</p>";
			}
			else
			{
				print "<p align =\"center\" class =\"style2\"><center>Failed to add selected corrective action manager</p>";
			}
		} //if($_POST['what'] == "addcam")
	}	//close if(isset($_POST['what']))
			

?>
<body>
<p align="center"><span class="style3">Creating New CAR </span></p>
<?php
if($step == 1)
{
?>
<table border="0" align="center" class="style1">
  <tr>
    <td><form action="createcar.php" method="post" name="form1" >
      <table border="1">
        <tr>
          <td><span class="style1">Originator  : </span></td>
		   <td><span class="style1">
            <?php
			$getos ="select Name from tblMUAccount where MUserID = $id";
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
          </span></td>
        </tr>
        <tr>
          <td><span class="style1">Originator Manager : </span></td>
          <td><span class="style1">
		  <!--
            <select name="omngr">
			<option value="" selected></option>
			-->
			<?php
			$gn = "select RCC from tblRequest where RequestID = $rid";
			$gnr = mysql_query($gn);
			if($gnr)
			{
			while($rn = mysql_fetch_array($gnr))
			{
				$rcc = $rn['RCC'];
			}
			
			print $rcc;
			}
			else 
			{
			print mysql_error();
			}
			/*
		  $om = "select MUserID,Name,DeptID from tblMUAccount where GroupID = 'om' order by Name ASC";
		  $omResult = mysql_query($om);
		  while($row2 = mysql_fetch_array($omResult))
			{
			$omid = $row2['MUserID'];
			$omd = $row2['DeptID'];
			$omDept = "";
			    $getDept1 = "select DeptName from tblDept where DeptID = $omd";
				$getDeptResult1 = mysql_query($getDept1);
				if($getDeptResult1)
				{
					while($row3 = mysql_fetch_array($getDeptResult1))
					{
					$omDept = $row3['DeptName'];
					}
				}
			$omDisplay = $row2['Name']." Dept. ".$omDept;*/
		  ?>
               <!-- <option value="<?php //echo $omid;?>"><?php //echo $omDisplay; ?></option>-->
          <?php
		  //}
		  ?>
           <!-- </select>-->
          </span> </td>
        </tr>
        <tr>
          <td><span class="style1">In Charge Manager : </span></td>
          <td><span class="style1">
		  <!--
            <select name="amngr">
			<option value="" selected></option>
			-->
			<?php
			$gn1 = "select RBCC from tblRequest where RequestID = $rid";
			$gnr1 = mysql_query($gn1);
			if($gnr1)
			{
			while($rn1 = mysql_fetch_array($gnr1))
			{
				$rbcc = $rn1['RBCC'];
			}
			
			print $rbcc;
			}
			else 
			{
			print mysql_error();
			}
			/*
		  $am = "select MUserID,Name,DeptID from tblMUAccount where GroupID = 'am' order by Name ASC";
		  $amResult = mysql_query($am);
		  while($row4 = mysql_fetch_array($amResult))
			{
			$amid = $row4['MUserID'];
			$amd = $row4['DeptID'];
			$amDept = "";
			    $getDept2 = "select DeptName from tblDept where DeptID = $amd";
				$getDeptResult2 = mysql_query($getDept2);
				if($getDeptResult2)
				{
					while($row5 = mysql_fetch_array($getDeptResult2))
					{
					$amDept = $row5['DeptName'];
					}
				}
			$amDisplay = $row4['Name']." Dept. ".$amDept;
			*/
		  ?>
                <!--<option value="<?php //echo $amid;?>"><?php //echo $amDisplay; ?></option>-->
          <?php
		 // }
		  ?>
          <!--  </select>-->
          </span></td>
        </tr>
		 
        <tr>
          <td><br/><br/><input type="hidden" name="group" value="<?php echo $group;?>">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
		  <input type="hidden" name="rid" value="<?php echo $rid;?>">
		  <input type="hidden" name="what" value="add"><span class="style1"></span></td>
          <td><input name="Submit" type="submit" value="Next"></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<?php
} //close step 1
else
{
if($step == 2)
{
?>
<div align="center">
<p></p>
  <form name="form1" method="post" action="createcar.php">
    <table  class ="style1" width="471" border="0">
      <tr>
        <td width="217">Corrective Action Manager : </td>
        <td width="244"><select name="cam">
		<option value="" selected></option>
			<?php
			
			
			
		  $cam = "select MUserID,Name,DeptID from tblMUAccount where GroupID = 'cam'  order by Name ASC";
		  $camResult = mysql_query($cam);
		  while($row6 = mysql_fetch_array($camResult))
			{
			$camid = $row6['MUserID'];
			$camd = $row6['DeptID'];
			$camDept = "";
			    $getDept3 = "select DeptName from tblDept where DeptID = $camd";
				$getDeptResult3 = mysql_query($getDept3);
				if($getDeptResult3)
				{
					while($row7 = mysql_fetch_array($getDeptResult3))
					{
					$camDept = $row7['DeptName'];
					}
				}
			$camDisplay = $row6['Name']." Dept. ".$camDept;
			
		  ?>
                <option value="<?php echo $camid;?>"><?php echo $camDisplay; ?></option>
          <?php
		  }
		  ?>
        </select></td>
      </tr>
      <tr>
        <td><br/><br/>
		<input type="hidden" name="what" value="addcam"></td>
		
		<input type ="hidden" name="group" value="<?php echo $group; ?>">
	  <input type ="hidden" name="inum" value="<?php echo $inum; ?>">
	  <input type ="hidden" name="id" value="<?php echo $id; ?>">
	  <input type="hidden" name="rid" value="<?php echo $rid;?>">
        <td><input type="submit" name="Submit" value="Add"> </td>
      </tr>
    </table>
  </form>
  <?php
  if($cam1 != "")
  {
  ?>
  <table width="462" border="0">
    <tr>
      <td width="209">&nbsp;</td>
      <td width="243"><form name="form2" method="post" action="createcar2.php">
	  <input type ="hidden" name="group" value="<?php echo $group; ?>">
	  <input type ="hidden" name="inum" value="<?php echo $inum; ?>">
	  <input type ="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="Submit2" value="Go to next step">
      </form></td>
    </tr>
  </table>
  <?php
  }
  ?>
  <p>&nbsp;  </p>
</div>
<?php
}// close if step 2
} //close else(step2)


?>
</body>
</html>

<?php
} //close else (if user authorized

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
