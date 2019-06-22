<?
include("db_class_info.php");   //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
function makeRandomPassword() { 
  $salt = "abchefghjkmnpqrstuvwxyz0123456789"; 
  srand((double)microtime()*1000000); 
      $i = 0; 
      while ($i <= 7) { 
            $num = rand() % 33; 
            $tmp = substr($salt, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
      } 
      return $pass; 
} 
if (isset($var_Submit_PW))
   {
       if(!$var_userid || !$var_lastname || !$var_firstname)
	     $error = "Required Field Empty";
	   if(!$error)
	   {  
	     $results = array();
   	     $db = new Oracle;  
   	     $db->logOn();
   	     $select = "*";
   	     $table = $db->User_table;
	     $query = "Userid ='$var_user_id' and Last_Name = '$var_lastname' and First_Name = '$var_firstname'";
	     $db->queryDB($select,$table,$query);
		 if ($db->fetch()) //check password
		  	    {
		  	     $results=$db->result_array;
		  	     $new_pwd1 = makeRandomPassword();
		  	     $new_pwd2 = makeRandomPassword();
		  	     $id = $results['USERID'];
		  	     $condition = "Userid = '".$id."'";
			     $set =  "Passwd1 = '".$new_pwd1."'";
	             $db->updateDB($table,$set,$condition);
	             $set =  "Passwd2 = '".$new_pwd2."'";
	             $db->updateDB($table,$set,$condition);
				}
			 else $error = "User Not Found Please Contatct System Adminstration";	 
			 $db->logOff(); 
	   }
  } //end submit 

?>
<html>
<head>
<title>Untitled Document</title>
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
<form action="" method="post" enctype="multipart/form-data" name="new_entry" target="_self" class="mydiv" id="new_entry">
              
              <table width="396" border="0" class="border">
    <tr> 
      <td colspan="2" class="tbletitle">User Info</td>
    </tr>
    <tr> 
      <td><div align="right">User ID</div></td>
      <td><input name="userid" type="text" id="userid" size="25" maxlength="15"></td>
    </tr>
    <tr> 
      <td width="112"><div align="right">Last Name</div></td>
      <td><input name="lastname" type="text" id="lastname" size="25" maxlength="30"></td>
    </tr>
    <tr> 
      <td><div align="right">First Name</div></td>
      <td><input name="firstname" type="text" id="firstname" size="25" maxlength="30"></td>
    </tr>
    <tr> 
      <td height="26">&nbsp;</td>
      <td><input name="Submit_PW" type="submit" id="Submit_PW" value="Submit"> </td>
    </tr>
  </table>
    
            </form>
			</div>

		<div id="navBar"> 
  <div id="search">  </div> 
   <div class="relatedLinks"> 
   <div id="navlist">
       <ul>
           <li> <a href="../../about.htm">Home</a> </li>
           <li> <a href="./login.php">Login</a> </li>
         
       </ul>
     </div>
  </div> 
  <div id="headlines"></div> 
</div> 
<!--end navbar --> 
<div id="siteInfo">  <a href="Mysql/DBSoftwareProject.pdf">Project Info</a>| <a href="#">Site
Map</a> | <a href="#">Privacy Policy</a> | <a href="http://www.ufl.edu">Contact Us</a> | &copy;2003 COP4720 Database Mangement Project </div> 		 
				
</body>
</html>
