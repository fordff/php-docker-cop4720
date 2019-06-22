<?
session_start();

include("../db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
//echo($_FILES['userfile']['error']) ; //The original name of the file on the client machine. 
//echo($_FILES['userfile']['size']);
//echo($_FILES['userfile']['tmp_name']);
//echo($_FILES['userfile']['name']);
//$datafile = $_FILES['userfile']['tmp_name'];

$uploaddir = "c:\\tmp\\";
$datafile = $uploaddir . $_FILES['userfile']['name'];
echo($datafile);
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $datafile))
{
    print "File is valid, and was successfully uploaded. ";
    print "Here's some more debugging info:\n";
    print_r($_FILES);
}
$handle = fopen($datafile,'rb');
$val = fread($handle, filesize($datafile));
 if (!empty($val)) {
                $val = '0x' . bin2hex($val);
                $seen_binary = TRUE;
                $check_stop = TRUE;
            }
 echo($seen_binary);


?>
<html>
<head>
<title>Diagnosis</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../StyleSheets/mypage.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="masthead"><h1>PIS Medical Information Systems</h1></div>
    <div id="globalNav"> 
       <a href="../Admin/UserInfo.php">Admin</a> | 
	   <a href="PatientInfo.php">Patient</a> |
	   <a href="Procedure.php">Procedures</a> |
	   <a href="../Reports/Activity_Report.php">Reports</a> |
       <a href="../../../news.php">Images</a> | <a href="../../../contact.php">Contact</a> | 
       <hr ALIGN="LEFT" WIDTH="100%" SIZE="1" NOSHADE> 
   
</div>

<div id="content">
<form method="post" enctype="multipart/form-data" name="image_entry" target="_self" id="image_entry">
			<table width="477"  border="0" cellpadding="3" cellspacing="3" class="border">
                <tr class="tbletitle">
                  <td colspan="2">Images</td>
                </tr>
                <tr>
                  <td align="left">
				  <input type="hidden" name="MAX_FILE_SIZE" value="7000000"> 
				  <input name="userfile" type="file" id="userfile" size="25" maxlength="80">
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><input type="submit" name="Submit" value="Submit">
                  <input type="reset" name="Reset" value="Reset"></td>
				 				  
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form>


</div>

<div id="navBar"> 
    <div class="relatedLinks"> 
       <?php
		if ($_SESSION['PERMISSIONS'] == 3)
		{
		  	echo('<div id="navlist"> <ul>');
			echo('<h4>Admin Functions </h4>');
	                echo('<li> <a href="../Admin/UserAdd.php">Add User</a> </li>');
	                echo('<li> <a href="../Admin/UserInfo.php">View/Edit User</a> </li>');
	                
					echo('<h4>Patient Functions</h4>');
	                echo('<li> <a href="./Add_Patient.php">Add Patient</a> </li>');
					echo('<li> <a href="./View_Patient.php">View/Edit Patient</a> </li>');
	                echo('<li> <a href="./Diagnosis.php">Diagnosis</a> </li>');
					 echo('<li> <a href="./Procedure.php">Procedure</a> </li>');
					echo('<li> <a href="./Outcome.php">Outcomes</a> </li>');
	                echo('<li> <a href="./Complication.php">Complications</a> </li>');
	                echo('<li> <a href="./Images.php">Images</a> </li>');
	                
					echo('<h4>Hospital Functions</h4>');
	                echo('<li> <a href="./Add_Hospital.php"> New Hospital</a> </li>');
	                echo('<li> <a href="./Modify_Hospital.php">Modify Hospital</a> </li>');
	                echo('<li> <a href="./Reports.php">Generate Reports</a> </li>');
	                echo('<li> <a href="./Edit_Lists.php">Maintain Lists</a> </li>');
					echo('<li> <a href="../logout.php">Logout</a></li>');
	                echo('</ul> </div>');
                  }
                  else if ($_SESSION['PERMISSIONS'] == 1 || $_SESSION['PERMISSIONS'] == 2)
                    {
                      echo('<div id="navlist"> <ul>');	
					  echo('<li class="tbletitle"> <div align="center">Patient Functions</div> </li>');
					  echo('<li> <a href="./Add_Patient.php">Add Patient</a> </li>');
					  echo('<li> <a href="./View_Patient.php">View/Edit Patient</a> </li>');
					  echo('<li> <a href="./Diagnosis.php">Diagnosis</a> </li>');
					  echo('<li> <a href="./Prcoedure.php">Procdure</a> </li>');
					  echo('<li> <a href="./Outcome.php">Outcome</a> </li>');
					  echo('<li> <a href="./Complication.php">Complication</a> </li>');
					  echo('<li> <a href="./Images.php">Image</a> </li>');
					  
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


</html>