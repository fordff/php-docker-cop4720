<?
session_start();
include("./db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
if (isset($var_Submit))
   {
  	   if ($var_pwd1 == $var_pwd2)
	     $error = "Passwords are identical";
	   if(!$var_user_id | !$var_pwd1 | !$var_pwd2)
	     $error = "Required Field Empty";
	   if(!$error)
	   {  
	     $results = array();
   	     $db = new Oracle;  
   	     $db->logOn();
   	     $select = "*";
   	     $table = $db->User_table;
		 $var_user_id = strtolower($var_user_id);
	     $query = "Userid ='$var_user_id'";
	     $db->queryDB($select,$table,$query);
			    if ($db->fetch()) //check user_id
			     {
				    $var_pwd1 = strtolower($var_pwd1);
			     	$query = "Passwd1='$var_pwd1'"; 
				    $db->queryDB($select,$table,$query);
			     	if ($db->fetch()) //check password
			     	{
			     		$var_pwd2 = strtolower($var_pwd2);
			     		$query = "Passwd2='$var_pwd2'"; 
				        $db->queryDB($select,$table,$query);
				          if ($db->fetch()) //check password
			           	{
			     		
			                  $results=$db->result_array;
							  session_register('USER_ID');
							  session_register('LASTNAME');
							  session_register('FIRSTNAME');
							  session_register('HOSPID'); 
							  session_register('POSITION');
							  session_register('PERMISSIONS');
							  $_SESSION['USER_ID']	    = $results['Userid'];
							  $_SESSION['LASTNAME']	    = $results['Last_Name'];
			                  $_SESSION['FIRSTNAME']	= $results['First_Name'];
			                  $_SESSION['HOSPID']	    = $results['Hospid'];
							  $_SESSION['PERMISSIONS']  = $results['Position'];
			                  $db->logOff();
							  header("Location:./Menu.php");						   
			           	} else $error = "User Not Found";
			         }else $error = "Password Invalid";
			     }else $error =  "User ID Invalid";		
			 $db->logOff(); 
	   }
	 session_register('Error');
    $_SESSION['ERROR'] = $error;
	 
	 
  } //end submit 

?>
<html>
<head>
<title>login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../StyleSheets/mypage.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="masthead"><h1>PIS Medical Information Systems</h1></div>
    <div id="globalNav"> 
       <a href="Admin/UserInfo.php">Admin</a> | 
	   <a href="Patient/PatientInfo.php">Patient</a> |
	   <a href="Patient/Procedure.php">Procedures</a> |
	   <a href="Reports/Activity_Report.php">Reports</a> |
       <a href="../../news.php">Images</a> | <a href="../../contact.php">Contact</a> | 
       <hr ALIGN="LEFT" WIDTH="100%" SIZE="1" NOSHADE> 
   
</div>


<div id="content">
<form action="" method="post" enctype="multipart/form-data" name="form1" target="_self" >
              <table width="44%" border="0" class="border" align="center" >
                <!--DWLayoutTable-->
    <tr align="center">
      <td colspan="3" class="tbletitle">Login</td>
        </tr>
    <tr> 
      <td width="121"><div align="right" class="style4">User ID</div></td>
      <td width="264" colspan="2"><input name="user_id" type="text" value="1" size="21" maxlength="15">
      </td>
      </tr>
    <tr> 
      <td><div align="right" class="style4">Password 1</div></td>
      <td colspan="2"><input name="pwd1" type="password" id="pwd1" value="pwd1" size="21" maxlength="15">
      </td>
      </tr>
    <tr> 
      <td><div align="right" class="style4">Password 2</div></td>
      <td colspan="2"><input name="pwd2" type="password" id="pwd2" value="pwd2" size="21" maxlength="15">
      </td>
      </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td colspan="2">
        <input type="submit" name="Submit" value="Login">
        <input name="reset _form" type="reset" id="reset _form" value="Reset"></td>
      </tr>
  </table>
  </form>
</div>
		<div id="navBar"> 
    <div class="relatedLinks">
     <div id="navlist">
       <ul>
           <li> <a href="../../Projects.html">Home</a> </li>
           <li> <a href="./lostPwd.php">Lost Password</a> </li>
         
       </ul>
     </div>
</div> 
  <div id="headlines"></div> 
</div> 
<!--end navbar --> 
<div id="siteInfo">
  <a href="Mysql/DBSoftwareProject.pdf">Project Info</a>|
  <a href="sql/project4.sql">SQL Schema </a>|
  <a href="sql/insert.txt">Sample Data</a> |
  <a href="http://www.ufl.edu">Contact Us</a> |
   &copy;2003 COP4720 Database Mangement Project
 </div> 		 
				 
				 
</body>
</html>
