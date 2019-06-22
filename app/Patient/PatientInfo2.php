<?
session_start();
if (!session_is_registered('USER_ID'))
       header("Location: .././login.php");
include("../db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var

 if($var_Delete)
   {
     $db = new Oracle;  
   	 $db->logOn();
     $from = $db->Patients_table;
     $where = "Patid =  '$var_Old_id'";
     $db->deleteDB($from,$where);
     $db->logOff();  
    } //end delete
	
	  if($var_Modify)
    {
     $db = new Oracle;  
   	 $db->logOn();
     $table = $db->Patients_table;
	 $condition = "Patid = '".$var_Old_id."'";
	 $set = "Med_Record_NumLastName = '".$var_new_medrec."'";
	 $db->updateDB($table,$set,$condition);
	 $set = "LastName = '".$var_new_lastname."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "FirstName = '".$var_new_firstname."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "Address1 = '".$var_new_address1."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "City = '".$var_new_city."'";
	 $db->updateDB($table,$set,$condition);
     $set =  "State = '".$var_State."'";
	 $db->updateDB($table,$set,$condition);
	  $set =  "Zip = '".$var_new_zip."'";
	 $db->updateDB($table,$set,$condition);
     $set =  "Hospid= '".$var_hospital."'";
	 $db->updateDB($table,$set,$condition);
	 $db->logOff();
   }//end modify
   
   if ($var_pg == '1')
   {
	 $results = array();	
	 $db = new Oracle;  
   	 $db->logOn();
	 $select= "*";
	 $from = $db->Patients_table;
	 $var_patid = $var_id;
	 $where = "patid = '$var_patid'";
	 $db->queryDB($select,$from,$where);
	 $i = 0;
	 while ($db->fetch()) //check password
	      {  
			$i++;
            $found = "true";
         	$results=$db->result_array; 
			$patid     = $results['Patid'];
			$medrec	   = $results['Med_Record_Num'];
	        $lastname  = $results['Lastname'];   
			$firstname = $results['Firstname'];   
	        $address1  = $results['Address1'];   
	        $city      = $results['City'];
			$state     = $results['State'];   
			$zip       = $results['Zip'];  
			$dob 	   = $results['Birthdate'];
	        $surgid    = $results['Surgid'];
			$id		   = $results['Creators_id']; 
			$hospid    = $results['Hospid'];
                 }  
	        $db->logOff();  
    }
		 
?>
<html>
<head>
<title>Patient Info</title>
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
 <form method="post" enctype="multipart/form-data" name="patient_info" target="_self" id="patient_info">
		  <table width="100%" border="0" align="left" class="border">
          <tr>
            <td colspan="4" class="tbletitle">Patient Info</td>
          </tr>
          <tr>
            <td width="162" class="style4"><div align="right">Medical Record </div></td>
            <td width="285" class="style4"><?php
	   echo("<input name='new_medrec' type='text' id='new_medrec' size='25' maxlength='25' value = '$medrec'>");
	     echo("<input name='Old_id' type='hidden' id='Old_id' value = '$patid'>");
	   ?>
            </td>
            <td width="107" class="style4"><div align="right"><a href="Diagnosis.php?pg=1">[Diagnosis]</a></div></td>
            <td width="367" rowspan="3" class="style4">
			<textarea name="diagnosis" cols="45" rows="5" readonly wrap="VIRTUAL" id="diagnosis"><?
//SELECT *
//FROM patient_diagnosis as p ,list_diagnosis as d
//where p.patid = 1 and d.diag_list_id = p.diagid;
 $results = array();
 $db = new Oracle;
 $db->logon();
 $select = "*";
 $from = "Patient_diagnosis as P, List_diagnosis as D";
 $where = "P.patid = ".$var_id." and D.diag_list_id = P.diagid";
 $db->queryDB($select,$from,$where);
  while($db->fetch())
   {
     $found = true;
     $results = $db->result_array;
     $name = $results["Diag_Name"];
     //$id = $results["diag_list_id"];
    echo($name ." | ");
}
$db->logoff();
?>
			
			</textarea></td>
          </tr>
          <tr>
            <td class="style4"><div align="right">Last Name</div></td>
            <td class="style4"><?php
	   echo("<input name='new_lastname' type='text' id='new_lastname' size='25' maxlength='25' value = '$lastname'>");
	   ?></td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td class="style4"><div align="right">First Name</div></td>
            <td class="style4"><?php
	   echo("<input name='new_firstname' type='text' id='new_firstname' size='25' maxlength='25' value = '$firstname'>");
	   ?></td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td class="style4"><div align="right">Date of Birth</div></td>
            <td class="style4"><?php echo(" <input name='new_$dob' type='text' id='new_dob size='25' maxlength='25' value = '$dob'>"); ?>&nbsp; Format: MM-DD-YY</td>
            <td class="style4"><div align="right"><a href="Procedure.php?pg=1">[Procedure]</a></div></td>
            <td rowspan="3" class="style4">
			<textarea name="procedure" cols="45" rows="5" id="procedure" readonly>
<?			
//SELECT *
//FROM patient_diagnosis as p ,list_diagnosis as d
//where p.patid = 1 and d.diag_list_id = p.diagid;
 $results = array();
 $db = new Oracle;
 $db->logon();
 $select = "*";
 $from = "Patient_procedure as P, List_procedure as D";
 $where = "P.patid = ".$var_id." and D.proc_list_id = P.proc_id";
 $db->queryDB($select,$from,$where);
  while($db->fetch())
   {
     $found = true;
     $results = $db->result_array;
     $name = $results["Proc_Name"];
     //$id = $results["diag_list_id"];
    echo($name ." | ");
}
$db->logoff();
?>			
			
			</textarea></td>
          </tr>
          <tr>
            <td class="style4"><div align="right">Address</div></td>
            <td class="style4"><?php echo(" <input name='new_address1' type='text' id='new_address1' size='25' maxlength='25' value = '$address1'>"); ?></td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td class="style4"><div align="right">City</div></td>
            <td class="style4"><?php echo(" <input name='new_city' type='text' id='new_city' size='25' maxlength='25' value = '$city'>"); ?></td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td class="style4"><div align="right">State</div></td>
            <td class="style4"><SELECT name="State">
                <option value="default" selected>Select State</option>
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
            </SELECT></td>
            <td class="style4"><div align="right"><a href="Outcome.php?pg=1">[Outcome]</a></div></td>
            <td rowspan="3" class="style4">
			<textarea name="outcome" cols="45" rows="5" id="outcome" readonly>
			
			</textarea></td>
          </tr>
          <tr>
            <td class="style4"><div align="right">Zip</div></td>
            <td class="style4"><?php echo("  <input name='new_zip' type='text' id='new_zip' size='8' maxlength='8' value = '$zip'>"); ?></td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td height="26" class="style4"><div align="right">Treating Hospital</div></td>
            <td class="style4"><select name="hospital" id="hospital">
              <option value="UF">Shands at UF</option>
              <option value="Shands">Shands at AGH</option>
              <option value="VA">Verterans Administration-Gainesville</option>
            </select></td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td height="26" align="right" class="style4">Primary Physican </td>
            <td class="style4">&nbsp;</td>
            <td class="style4"><div align="right"><a href="Complication.php?pg=1">[Complication]</a></div></td>
            <td rowspan="3" class="style4">
			<textarea name="complication" cols="45" rows="5" id="complication" readonly>
<?
//SELECT *
//FROM patient_diagnosis as p ,list_diagnosis as d
//where p.patid = 1 and d.diag_list_id = p.diagid;
/* $results = array();
 $db = new Oracle;
 $db->logon();
 $select = "*";
 $from = "Patient_diagnosis as P, List_diagnosis as D";
 $where = "P.patid = ".$var_id." and D.diag_list_id = P.diagid";
 $db->queryDB($select,$from,$where);
  while($db->fetch())
   {
     $found = true;
     $results = $db->result_array;
     $name = $results["Diag_Name"];
     //$id = $results["diag_list_id"];
    echo($name ." | ");
}
$db->logoff();*/
?>			
			
			</textarea></td>
          </tr>
          <tr>
            <td height="26" align="right" class="style4">Seconday Physcian </td>
            <td class="style4">&nbsp;</td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td height="26" align="right" class="style4">&nbsp;</td>
            <td class="style4">&nbsp;</td>
            <td class="style4"><div align="right"></div></td>
            </tr>
          <tr>
            <td height="26" align="right">&nbsp;</td>
            <td class="style4">              <input name="Modify" type="submit" id="Modify" value="Commit Changes">
              <input name="Delete" type="submit" id="Delete" value="Delete Patient"></td>
            <td class="style4"><div align="right"></div></td>
            <td class="style4">&nbsp;</td>
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
	                echo('<li> <a href="./PatientInfo.php">Diagnosis</a> </li>');
					 echo('<li> <a href="./PatientInfo.php">Procedure</a> </li>');
					echo('<li> <a href="./PatientInfo.php">Outcomes</a> </li>');
	                echo('<li> <a href="./PatientInfo.php">Complications</a> </li>');
	                echo('<li> <a href="./PatientInfo.php">Images</a> </li>');
	                
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
					  echo('<li> <a href="./PatientInfo.php">Diagnosis</a> </li>');
					  echo('<li> <a href="./PatientInfo.php">Procdure</a> </li>');
					  echo('<li> <a href="./PatientInfo.php">Outcome</a> </li>');
					  echo('<li> <a href="./PatientInfo.php">Complication</a> </li>');
					  echo('<li> <a href="./PatientInfo.php">Image</a> </li>');
					  
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