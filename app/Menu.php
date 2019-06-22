<?
session_start();
if (!session_is_registered('USER_ID'))
       header("Location: ./login.php");
include("db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
?>
<html>
<head>
<title>Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../StyleSheets/mypage.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="masthead"><h1>PIS Medical Information Systems</h1></div>
    <div id="globalNav"> 
       <a href="./Admin/UserInfo.php">Admin</a> | 
	   <a href="./Patient/PatientInfo.php">Patient</a> |
	   <a href="./Patient/Procedure.php">Procedures</a> |
	   <a href="./Reports/Activity_Report.php">Reports</a> |
       <a href="../../news.php">Images</a> | <a href="../../contact.php">Contact</a> | 
       <hr ALIGN="LEFT" WIDTH="100%" SIZE="1" NOSHADE> 
   
</div>

<div id="content">

<table width="100%"  border="1">
  <tr>
    <td> <h2>WELCOME:  <? echo($_SESSION['LASTNAME'].", ".$_SESSION['FIRSTNAME']);  ?>  </h2></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <? echo("Hospital ID ".$_SESSION['HOSPID']); ?> 
      </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><? echo("Permissions  ".$_SESSION['PERMISSIONS']); ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

 					        
			
			
</div>


<div id="navBar"> 
    <div class="relatedLinks"> 
       <?php
		if ($_SESSION['PERMISSIONS'] == 3)
		{
		  	echo('<div id="navlist"> <ul>');
			echo('<h4>Admin Functions </h4>');
	                echo('<li> <a href="./Admin/UserAdd.php">Add User</a> </li>');
	                echo('<li> <a href="./Admin/UserInfo.php">View/Edit User</a> </li>');
	                
					echo('<h4>Patient Functions</h4>');
	                echo('<li> <a href="./Patient/Add_Patient.php">Add Patient</a> </li>');
					echo('<li> <a href="./Patient/View_Patient.php">View/Edit Patient</a> </li>');
	                echo('<li> <a href="./Patient/PatientInfo.php">Diagnosis</a> </li>');
					 echo('<li> <a href="./Patient/PatientInfo.php">Procedure</a> </li>');
					echo('<li> <a href="./Patient/PatientInfo.php">Outcomes</a> </li>');
	                echo('<li> <a href="./Patient/PatientInfo.php">Complications</a> </li>');
	                echo('<li> <a href="./Patient/PatientInfo.php">Images</a> </li>');
	                
					echo('<h4>Hospital Functions</h4>');
	                echo('<li> <a href="./Admin/Add_Hospital.php"> New Hospital</a> </li>');
	                echo('<li> <a href="./Admin/Modify_Hospital.php">Modify Hospital</a> </li>');
	                echo('<li> <a href="./Admin/Reports.php">Generate Reports</a> </li>');
	                echo('<li> <a href="./AdminEdit_Lists.php">Maintain Lists</a> </li>');
					echo('<li> <a href="./logout.php">Logout</a></li>');
	                echo('</ul> </div>');
                  }
                  else if ($_SESSION['PERMISSIONS'] == 1 || $_SESSION['PERMISSIONS'] == 2)
                    {
                      echo('<div id="navlist"> <ul>');	
					  echo('<li class="tbletitle"> <div align="center">Patient Functions</div> </li>');
					  echo('<li> <a href="./Patient/Add_Patient.php">Add Patient</a> </li>');
					  echo('<li> <a href="./Patient/View_Patient.php">View/Edit Patient</a> </li>');
					  echo('<li> <a href="./Patient/PatientInfo.php">Diagnosis</a> </li>');
					  echo('<li> <a href="./Patient/PatientInfo.php">Procdure</a> </li>');
					  echo('<li> <a href="./Patient/PatientInfo.php">Outcome</a> </li>');
					  echo('<li> <a href="./Patient/PatientInfo.php">Complication</a> </li>');
					  echo('<li> <a href="./Patient/PatientInfo.php">Image</a> </li>');
					  echo('<li> <a href="./logout.php">Logout</a></li>');
					  echo('</ul> </div>');
                     }	
                ?>
  </div> 
  
</div> 
<!--end navbar --> 
<div id="siteInfo">  <a href="Mysql/DBSoftwareProject.pdf">Project Info</a>| <a href="#">Site
Map</a> | <a href="#">Privacy Policy</a> | <a href="http://www.ufl.edu">Contact Us</a> | &copy;2003 COP4720 Database Mangement Project </div> 		 
</body>
</html>
