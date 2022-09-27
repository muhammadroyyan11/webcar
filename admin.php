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
<title>CAR Administrator Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK  href="tbldesign.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if ((!$_POST['group'])or($_POST['group'] == ""))
{
// redirect to login page
include ("redirectlogin.php");
}

else
{
//display admin menu
$group = $_POST['group'];
?>

<table border="0" align="center">
<tr>
    <td width = "200" class="t3" ><p  class="p1" align="center" class="style6">Departement </p>
      <table width="70" border="0" align="center">
        <tr>
          
		  <td><form name="form1" method="post" action="editdept.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View/Edit">
          </form></td>
        </tr>
      </table>      
   </td>
  
    <td width = "200" class="t3"><p  class="p1" align="center" class="style6">CAR/Request List </p>
      <table width="70" border="0" align="center">
        <tr>
          
		  <td><form name="form1" method="post" action="carlist.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View/Edit">
          </form></td>
        </tr>
      </table>      
   </td>
  
<!--
    <td width="160" class="t3"><p  class="p1" align="center" class="style6"> Archived CAR Files </p>
      <table width="50" border="0" align="center">
        <tr>
          
          
		  <td width="44"><form name="form1" method="post" action="viewfiles.php">
		  <input type="hidden" name="group" value="<//?php echo //$group;?>">
            <input type="submit" name="Submit" value="View/Edit">
          </form></td>
        </tr>
      </table>      
   </td>
  -->

    <td width = "200" class="t3"><p  class="p1" align="center" class="style6">Master Data </p>
      <table border="0" align="center">
        <tr>
		
		  
          <td><form name="form1" method="post" action="viewmaster.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View/Edit">
          </form></td>
        </tr>
      </table>      
   </td>
   <td class="t3"><p  class="p1" align="center" class="style6"> Settings </p>
	  <table border="0" align="center">
        <tr>
          <td><form name="form1" method="post" action="adminsettings.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View/Edit">
          </form></td>
        </tr>
      </table></td></tr>
  
  <tr>
    <td  width = "200" class="t3"><p  class="p1" align="center" class="style6">Originator </p>
      <table border="0" align="center">
        <tr>
          <td><form name="form1" method="post" action="ostaff.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View">
          </form></td>
        </tr>
      </table>      
   </td>
  
  
    <td  width = "200" class="t3"><p  class="p1" align="center" class="style6">Originator Manager </p>  
	<table border="0" align="center">
        <tr>
          <td ><form name="form1" method="post" action="omngr.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View">
          </form></td>
        </tr>
      </table>  
    </td>
  
  
    <td  width = "200" class="t3"><p  class="p1" align="center" class="style6">In Charge Manager </p>
	<table border="0" align="center">
        <tr>
          <td><form name="form1" method="post" action="amngr.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View">
          </form></td>
        </tr>
      </table>
    </td>
  
  <!--
    <td class="t3"><p  class="p1" align="center" class="style6">Correction Action Manager </p>
	<table border="0" align="center">
        <tr>
          <td><form name="form1" method="post" action="camngr.php">
		  <input type="hidden" name="group" value="<?php //echo $group;?>">
            <input type="submit" name="Submit" value="View">
          </form></td>
        </tr>
      </table>
    </td>
  -->
  
    <td width = "200" class="t3"><p  class="p1" align="center" class="style6">Correction Action Team </p>
	<table border="0" align="center">
        <tr>
          <td><form name="form1" method="post" action="corractteam.php">
		  <input type="hidden" name="group" value="<?php echo $group;?>">
            <input type="submit" name="Submit" value="View">
          </form></td>
        </tr>
      </table>
    </td>
</table>  
 <br/>
    
	<table border="0" align="center">
        <tr>
          <td><form name="form1" method="post" action="login.php">
            <input type="submit" name="Submit" value="Log Out">
          </form></td>
        </tr>
      </table>
  

<?php
}
?>
</body>
</html>



