<?
session_start();
if (!session_is_registered('USER_ID'))
       header("Location: .././login.php");
import_request_variables("gP","var_");  // get all  post variables and append with var
include("../db_class_info.php");      //include oracle class file
if (isset($var_Add))
	{
				 $results = array();	
	             $db = new Oracle;  
   	             $db->logOn();
     			 $blank = "";
		 	     $regdate = date("Y\-m\-d"); 
				 $table = $db->Patients_table;
				 $theValues = array();
				 $id = $_SESSION['USER_ID'];
				 $theValues[0]     = mt_rand();
				 $theValues[1]     = stripslashes($var_medrecnum);
				 $theValues[2]     = $var_hospital;
				 $theValues[3]     = stripslashes(ucfirst($var_lastname));
				 $theValues[4]     = stripslashes(ucfirst($var_firstname));
				 $theValues[5]     = stripslashes(ucwords($var_address));
				 $theValues[6]     = stripslashes(ucfirst($var_city));
				 $theValues[7]     = $var_State;
				 $theValues[8]     = stripslashes($var_zip);
				 $theValues[9]     = stripslashes($var_DOB);
				 $theValues[10]    = $regdate;
				 $theValues[11]    = $id;
				 $theValues[12]    = $id; 
				 $db->insertDB($table,$theValues); 
				 $db->logOff();
			 //}
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
       <a href="../Admin/UserInfo.php">Admin</a> | 
	   <a href="PatientInfo.php">Patient</a> |
	   <a href="Procedure.php">Procedures</a> |
	   <a href="../Reports/Activity_Report.php">Reports</a> |
       <a href="../../../news.php">Images</a> | <a href="../../../contact.php">Contact</a> | 
       <hr ALIGN="LEFT" WIDTH="100%" SIZE="1" NOSHADE> 
   
</div>

<div id="content">
<form action="" method="post" enctype="multipart/form-data" name="new_entry" target="_self" id="new_entry">
 

	<table width="100%" border="0" align="center" class="border">
      <tr> 
        <td colspan="5" class="tbletitle">Patient Infomation</td>
      </tr>
      <tr> 
        <td width="109" class="style4"><div align="right">Medical Record </div></td>
        <td colspan="4"> <input name="medrecnum" type="text" id="medrecnum" size="25" maxlength="25"></td>
      </tr>
      <tr> 
        <td class="style4"><div align="right">Last Name</div></td>
        <td width="131"><input name="lastname" type="text" id="lastname" size="25" maxlength="25"></td>
        <td width="80" class="style4"><div align="right">First Name</div></td>
        <td width="330"><input name="firstname" type="text" id="firstname" size="25" maxlength="25"></td>
        <td width="12">&nbsp;</td>
      </tr>
      <tr> 
        <td class="style4"><div align="right">Address</div></td>
        <td colspan="4"><input name="address" type="text" id="address2" size="25" maxlength="25"></td>
      </tr>
      <tr> 
        <td class="style4"><div align="right">City</div></td>
        <td><input name="city" type="text" id="city" size="25" maxlength="25"></td>
        <td class="style4"><div align="right">State</div></td>
        <td><select name="State">
           <option value="AL">Alabama</option>
          <option value="AK">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="DC">District of Columbia</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
          <option value="PR">Puerto Rico</option>
          <option value="VI">Virgin Island</option>
          <option value="MP">Northern Mariana Islands</option>
          <option value="GU">Guam</option>
          <option value="AS">American Samoa</option>
          <option value="PW">Palau</option>
        </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td class="style4"><div align="right">Zip</div></td>
        <td colspan="4"><input name="zip" type="text" id="zip" size="8" maxlength="8"></td>
      </tr>
      <tr> 
        <td class="style4"><div align="right">Date Of Birth</div></td>
        <td colspan="4"><input name="DOB" type="text" id="DOB" size="15" maxlength="15">
          <span class="style4">Format: YYYY-MM-DD example 1999-05-31 </span></td>
      </tr>
      <tr> 
        <td class="style4"><div align="right">Treating Hospital</div></td>
        <td colspan="4"><select name="hospital">
          <option value="UF" selected>Shands at UF</option>
          <option value="Shands">Shands at AGH</option>
          <option value="VA">Verterans Administration-Gainesville</option>
        </select></td>
      </tr>
      <tr> 
        <td class="style4"><div align="right"></div></td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr> 
        <td height="26" class="style4">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr> 
        <td height="26">&nbsp;</td>
        <td colspan="4"><input name="Add" type="submit" id="Add" value="Add Patient">
          <input type="reset" name="Reset" value="Reset"></td>
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
					echo('<h4>Patient Functions</h4>');
	                echo('<li> <a href="./Add_Patient.php">Add Patient</a> </li>');
					echo('<li> <a href="./View_Patient.php">View/Edit Patient</a> </li>');
	                echo('<li> <a href="./Diagnosis.php">Diagnosis</a> </li>');
					 echo('<li> <a href="./Procedure.php">Procedure</a> </li>');
					echo('<li> <a href="./Outcome.php">Outcomes</a> </li>');
	                echo('<li> <a href="./Complication.php">Complications</a> </li>');
	                echo('<li> <a href="./Images.php">Images</a> </li>');
					  
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
