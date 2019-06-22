<?
session_start();

include("../db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
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
<form method="post" enctype="multipart/form-data" name="diag_entry" target="_self" id="diag_entry">
			<table width="601"  border="0" cellpadding="3" cellspacing="3" class="border">
                <tr class="tbletitle">
                  <td colspan="2">Diagnosis</td>
              </tr>
                <tr>
                  <td width="337" align="left">
				  <?
				  $db = new Oracle;
				  $db->logon();
				  
				  if (!isset($var_Diag_F))
				     $var_diag_select = 0;
				  $select = "*";
				  $from = "List_Diagnosis as D, Diagnosis_Tree as T";
				  $where = "(T.Parent_Proc = ".$var_diag_select." and T.Child_Proc = D.diag_list_id)";
				  //$lastquery =$select.$from.where; need to keep track of last query in order to go back
				  echo($lastquery);
				  $db->queryDB($select,$from,$where);
				  echo('<select name = "diag_select"">');
				  while($db->fetch())
				  {
				     $found = true;
					 $results = $db->result_array;
					 $name = $results["Diag_Name"];
					 $id = $results["diag_list_id"];
					 echo("<option value=$id>$name</option>");
				}
				echo('<select>');
			  ?></td>
                  <td width="241"><input name="Diag_F" type="submit" id="Diag_F" value="Forward">
                  <input name="Diag" type="submit" id="Diag" value="Submit">
                  <input name="Diag_B" type="submit" id="Diag_B" value="Back"></td>
              </tr>
                <tr>
                  <td align="left">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="left">Patient Info </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="left">Name</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="left">Medical Record </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="left">Date of Birth</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;                    </td>
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