<?
session_start();
if (!session_is_registered('USER_ID'))
       header("Location: ./login.php");
if ($_SESSION['PERMISSIONS'] == 1 || $_SESSION['PERMISSIONS'] == 2)
   header("Location:.././Menu.php");	
include("../db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
if (isset($var_add))
	{
     $results = array();	
	 $db = new Oracle;  
   	 $db->logOn();
	 $select= "*";
	 $from = $db->User_table;
	 $where = "Userid ='$var_userid'";
	 $db->queryDB($select,$from,$where);
	 if ($db->fetch()) //check password
	      {  
	        $found = "true";
            $error	   = "User Already in Database";
	      }  
	       else 
			 {				
				 $blank = "";
		 	     $regdate = date("d\-M\-y"); 
				 $table = $db->User_table;
				 $theValues = array();
				 $theValues[0]     = stripslashes($var_userid);
				 $theValues[1]     = stripslashes($var_lastname);
				 $theValues[2]     = stripslashes($var_firstname);
				 $theValues[3]     = stripslashes($var_address);
				 $theValues[4]     = stripslashes($var_city);
				 $theValues[5]     = $var_State;
				 $theValues[6]     = stripslashes($var_zip);
				 $theValues[7]     = stripslashes($var_pwd1);
				 $theValues[8]     = stripslashes($var_pwd2);
				 $theValues[9]     = $regdate;
				 $theValues[10]    = $var_hospital;
				 $theValues[11]    = $_SESSION['USER_ID'];
				 $theValues[12]    = $regdate;//to_date($date, 'mm-dd-yyyy hh:mi:ssam');
				 $db->insertDB($table,$theValues); 
				 $db->logOff();
			 }
	  $_SESSION['ERROR'] = $error;
	}
?>
<html>
<head>
<title>Add Patient</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../StyleSheets/mypage.css" rel="stylesheet" type="text/css">
</head>

<body>


<div id="masthead"><h1>PIS Medical Information Systems</h1></div>
    <div id="globalNav"> 
       <a href="Admin/UserInfo.php?action=admin">Admin</a> | 
	   <a href="Patient/PatientInfo.php?action=patient">Patient</a> |
	   <a href="Patient/Procedure.php?action=procedure">Procedures</a> |
	   <a href="Reports/Activity_Report.php?action=reports">Reports</a> |
       <a href="news.php?action=images">Images</a> | <a href="contact.php">Contact</a> | 
       <hr ALIGN="LEFT" WIDTH="100%" SIZE="1" NOSHADE> 
   
</div>

<div id="content">
<form action="" method="post" enctype="multipart/form-data" name="new_entry" target="_self" id="new_entry">

  </form>
</div>


<div id="navBar"> 
    <div class="relatedLinks"> 
       <?php
		if ($_SESSION['PERMISSIONS'] == 3)
		{
		  	$links .= '<div id="navlist"> <ul>'."\n";
			$links .= '<h4>Admin Functions </h4>'."\n";
	                $links .= '<li> <a href="./UserAdd.php">Add User</a> </li>'."\n";
	                $links .= '<li> <a href="./UserInfo.php">View/Edit User</a> </li>'."\n";
	                $links .= '<h4>Patient Functions</h4>'."\n";
	                $links .= '<li> <a href="../Patient/Add_Patient.php">Add Patient</a> </li>'."\n";
			$links .= '<li> <a href="../Patient/View_Patient.php">View/Edit Patient</a> </li>'."\n";
	                $links .= '<li> <a href="../Patient/Diagnosis.php">Diagnosis</a> </li>'."\n";
			$links .= '<li> <a href="../Patient/Procedure.php">Procedure</a> </li>'."\n";
			$links .= '<li> <a href="../Patient/Outcome.php">Outcomes</a> </li>'."\n";
	                $links .= '<li> <a href="../Patient/Complication.php">Complications</a> </li>'."\n";
	                $links .= '<li> <a href="../Patient/Images.php">Images</a> </li>'."\n";
	                $links .= '<h4>Hospital Functions</h4>'."\n";
	                $links .= '<li> <a href="./Add_Hospital.php"> New Hospital</a> </li>'."\n";
	                $links .= '<li> <a href="./Modify_Hospital.php">Modify Hospital</a> </li>'."\n";
	                $links .= '<li> <a href="./Reports.php">Generate Reports</a> </li>'."\n";
	                $links .= '<li> <a href="./Edit_Lists.php">Maintain Lists</a> </li>'."\n";
			$links .= '<li> <a href="../logout.php">Logout</a></li>'."\n";
	                $links .= '</ul> </div>'."\n";
                  }
                  else if ($_SESSION['PERMISSIONS'] == 1 || $_SESSION['PERMISSIONS'] == 2)
                    {
                      echo('<div id="navlist"> <ul>');	
					echo('<h4>Patient Functions</h4>');
	                echo('<li> <a href="../Patient/Add_Patient.php">Add Patient</a> </li>');
					echo('<li> <a href="../Patient/View_Patient.php">View/Edit Patient</a> </li>');
	                echo('<li> <a href="../Patient/Diagnosis.php">Diagnosis</a> </li>');
					 echo('<li> <a href="../Patient/Procedure.php">Procedure</a> </li>');
					echo('<li> <a href="../Patient/Outcome.php">Outcomes</a> </li>');
	                echo('<li> <a href="../Patient/Complication.php">Complications</a> </li>');
	                echo('<li> <a href="../Patient/Images.php">Images</a> </li>');
					  
					  echo('<li> <a href="../logout.php">Logout</a></li>');
					  echo('</ul> </div>');
                     }	
                ?>
  </div> 
  
</div> 
<!--end navbar --> 
<div id="siteInfo">
  <a href="../Mysql/DBSoftwareProject.pdf">Project Info</a>|
  <a href="../sql/project4.sql">SQL Schema </a>|
  <a href="../sql/insert.txt">Sample Data</a> |
  <a href="http://www.ufl.edu">Contact Us</a> |
   &copy;2003 COP4720 Database Mangement Project
 </div>  
				 
</body>

</body>
</html>
