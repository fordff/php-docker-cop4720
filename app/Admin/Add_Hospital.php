<?
session_start();
if (!session_is_registered('USER_ID'))
       header("Location: .././login.php");
include("../db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
?>
<html>

<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../StyleSheets/mypage.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="masthead"><h1>PIS Medical Information Systems</h1></div>
    <div id="globalNav"> 
       <a href="UserInfo.php">Admin</a> | 
	   <a href="../Patient/PatientInfo.php">Patient</a> |
	   <a href="../Patient/Procedure.php">Procedures</a> |
	   <a href="../Reports/Activity_Report.php">Reports</a> |
       <a href="../../../news.php">Images</a> | <a href="../../../contact.php">Contact</a> | 
       <hr ALIGN="LEFT" WIDTH="100%" SIZE="1" NOSHADE> 
   
</div>

<div id="content">
<form action="" method="post" enctype="multipart/form-data" name="new_entry" target="_self" id="new_entry">
  <table width="100%" border="0" align="center" class="border">
    <tr> 
      <td colspan="2" class="tbletitle">Hospital Info</td>
    </tr>
    <tr> 
      <td width="112" class="style4"><div align="right">Hospital Name</div></td>
      <td class="style4"><input name="hosName" type="text" id="hosName" size="25" maxlength="30"></td>
    </tr>
    <tr> 
      <td class="style4"><div align="right">Record Format</div></td>
      <td class="style4"><select name="format" id="format">
          <option value="format 1" selected>00-00-00-00</option>
          <option value="format 2">000-00-0000</option>
          <option value="unique">Unique</option>
        </select></td>
    </tr>
    <tr> 
      <td class="style4"><div align="right">Address</div></td>
      <td class="style4"><input name="address" type="text" id="address" size="25" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="style4"><div align="right">City</div></td>
      <td class="style4"><input name="city" type="text" id="city" size="25" maxlength="25"></td>
    </tr>
    <tr> 
      <td class="style4"><div align="right">State</div></td>
      <td class="style4"><SELECT name="State">
          <option value="AL" selected>Alabama</option>
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
        </SELECT></td>
    </tr>
    <tr> 
      <td class="style4"><div align="right">Zip</div></td>
      <td class="style4"><input name="zip" type="text" id="zip" size="9" maxlength="9"></td>
    </tr>
    <tr> 
      <td ><div align="right"> 
          <input name="Submit" type="submit" id="Submit" value="Submit">
        </div></td>
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
	                echo('<li> <a href="./UserAdd.php">Add User</a> </li>');
	                echo('<li> <a href="./UserInfo.php">View/Edit User</a> </li>');
	                
					echo('<h4>Patient Functions</h4>');
	                echo('<li> <a href="../Patient/Add_Patient.php">Add Patient</a> </li>');
					echo('<li> <a href="../Patient/View_Patient.php">View/Edit Patient</a> </li>');
	                echo('<li> <a href="../Patient/Diagnosis.php">Diagnosis</a> </li>');
					 echo('<li> <a href="../Patient/Procedure.php">Procedure</a> </li>');
					echo('<li> <a href="../Patient/Outcome.php">Outcomes</a> </li>');
	                echo('<li> <a href="../Patient/Complication.php">Complications</a> </li>');
	                echo('<li> <a href="../Patient/Images.php">Images</a> </li>');
	                
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
  <a href="Mysql/DBSoftwareProject.pdf">Project Info</a>|
  <a href="sql/project4.sql">SQL Schema </a>|
  <a href="sql/insert.txt">Sample Data</a> |
  <a href="http://www.ufl.edu">Contact Us</a> |
   &copy;2003 COP4720 Database Mangement Project
 </div>
				 

</body>

</html>
