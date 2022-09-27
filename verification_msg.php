<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?php
$date1   = trim($_POST['date1']);
$comment = trim($_POST['comment']);
$inum    =  trim($_POST['inum']);
$sub     = trim($_POST['sub']);
$flag     = trim($_POST['flag']);

//echo "testing".$inum;

echo 'flag1' . $flag;

if (isset ($_POST['delete']) ) 
{
  		$flag = 'delete'; 
  		//echo "Delete.!";
}
//else
//{
//  echo "Not Delete..!";
//}

//echo 'flag2' . $flag;

if ( (!$_POST['date1'])or($_POST['date1'] == "")or(!$_POST['comment'])or($_POST['comment'] == "") or(!$_POST['inum'])or($_POST['inum'] == "") 
	 or(!$_POST['sub'])or($_POST['sub'] == "") or(!$_POST['flag'])or($_POST['flag'] == "")   	
   )
{
	// redirect to login page
	?>
<script type"text/javascript">
	   alert("Input belum lengkap, silakan diperiksa kembali ..");
	   history.back()
	</script>
	  
	<?php
	include ("redirectlogin.php");
}
else
{

	include("conn.php");
	


	  	if ($flag == "insert")
		{
	  		$sql3 = "INSERT INTO tblcardtl3 ";
    		$sql3 .= "(IssNumber,Dated,verification) ";
    		$sql3 .= "VALUES ( ";
    		$sql3 .= "'$inum','$date1','$comment')"; 
    		$result3 = mysql_query($sql3, $connection);
			//echo "insert done.."; ?>
			<script type"text/javascript">
	   			alert("Insert Sukses..");
				history.go(-3)
			</script>
			<?php 
		}
		else if ($flag == "edit")
		{
	  		$sql3 = "UPDATE tblcardtl3 ";
    		$sql3 .= "set Dated = '$date1', verification = '$comment'  ";
			$sql3 .= " where IssNumber = '$inum' and sub = $sub  ";
    		$result3 = mysql_query($sql3, $connection);
			?>
			<script type"text/javascript">
	   			alert("Update Sukses..");
				history.go(-3)
			</script>
			
			<?php
			//echo "update done..";
  		}
		else if ($flag == "delete")
		{
	  		$sql3 = "DELETE FROM tblcardtl3 ";
			$sql3 .= " where IssNumber = '$inum' and sub = $sub  ";
    		$result3 = mysql_query($sql3, $connection);
			//echo $sql3;
			//echo "delete done..";
			?>
			
			<script type"text/javascript">
	   			alert("Delete Sukses..");
				history.go(-3)
			</script>
			
			<?php

  		}

	

	

}

?>
    <p>&nbsp;        </p>
	<button onClick="history.go(-3);"> &lt;&lt; Back to Detil </button>
</body>
</html>
