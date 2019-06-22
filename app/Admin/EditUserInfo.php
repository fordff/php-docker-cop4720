<?
session_start();
if (!session_is_registered('USER_ID'))
     header("Location: ../login.php");

if ($_SESSION['PERMISSIONS'] == 1 || $_SESSION['PERMISSIONS'] == 2)
 header("Location:.././Menu.php");	
   	
include("../db_class_info.php");      //include oracle class file
 $_SESSION['PERMISSIONS'] == 2;
import_request_variables("gP","var_");  // get all  post variables and append with var  
if($var_Modify)
    {
	 //echo("Modify");
     $db = new Oracle;  
   	 $db->logOn();
     $table = $db->User_table;
	 $condition = "Userid = '".$var_old_id."'";
	 
	 $set = "Last_Name = '".$var_new_lastname."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "First_Name = '".$var_new_firstname."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "Address1 = '".$var_new_address1."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "City = '".$var_new_city."'";
	 $db->updateDB($table,$set,$condition);
     $set =  "State = '".$var_State."'";
	 $db->updateDB($table,$set,$condition);
	  $set =  "Zip = '".$var_new_zip."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "Passwd1 = '".$var_new_pwd1."'";
	 $db->updateDB($table,$set,$condition);
	 $set =  "Passwd2 = '".$var_new_pwd2."'";
	 $db->updateDB($table,$set,$condition);
     $set =  "Position= '".$var_position."'";
	 $db->updateDB($table,$set,$condition);
     $set =  "Hospid= '".$var_hospital."'";
	 $db->updateDB($table,$set,$condition);
	 $db->logOff();
   }//end 
   
   
if($var_Delete)
   {
    // echo("delete");
     $db = new Oracle;  
   	 $db->logOn();
     $from = $db->User_table;
     $where = "Userid =  '$var_old_id'";
     $db->deleteDB($from,$where);
     $db->logOff();  
     
    }
	
	
if ($var_pg =='1')
{	
 $results = array();	
	 $db = new Oracle;  
   	 $db->logOn();
	 $select= "*";
	 $from = $db->User_table;
	 $where = "userid = '$var_id'";
	 $db->queryDB($select,$from,$where);
	 $i = 0;
	 while ($db->fetch()) //check password
	      {  
		    $i++;
            $found = "true";
            $results=$db->result_array; 
			$userid	   = $results['Userid'];
	        $lastname  = $results['Last_Name'];   
			$firstname = $results['First_Name'];   
	        $address1  = $results['Address1'];   
	        $city      = $results['City'];
			$state     = $results['State'];   
			$zip       = $results['Zip'];   
	        $pwd1      = $results['Passwd1'];   
	        $pwd2      = $results['Passwd2'];   
			$regdate   = $results['REG_DATE'];
			$hospid	   = $results['Hospid'];
			$position  = $results['Position'];
		   }
        $db->logOff();  
		}
 ?>
<html>
<head>
<title>User Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="pragma" content="no-cache">
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
<table width="100%"  border="0" class="story">
  <tr class="tbletitle">
    <td colspan="2">User Info </td>
  </tr>
  <tr>
    <td width="7%" align="right">Last name </td>
    <td width="93%">
      <?php
	   echo("<input name='new_lastname' type='text' id='new_lastname' size='25' maxlength='25' value = '$lastname'>");
	   echo("<input name='old_id' type='hidden' id='old_id' value = '$userid'>");
	   ?>
    </td>
  </tr>
  <tr>
    <td align="right">First name </td>
    <td><?php echo(" <input name='new_firstname' type='text' id='new_firstname' size='25' maxlength='25' value = '$firstname'>"); ?></td>
  </tr>
  <tr>
    <td align="right">Address</td>
    <td><?php echo(" <input name='new_address1' type='text' id='new_address1' size='25' maxlength='25' value = '$address1'>"); ?></td>
  </tr>
  <tr>
    <td align="right">City</td>
    <td><?php echo(" <input name='new_city' type='text' id='new_city' size='25' maxlength='25' value = '$city'>"); ?></td>
  </tr>
  <tr>
    <td align="right">State</td>
    <td>
      <select name="State">
        <option value="AL" >Alabama</option>
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
      </select>
    <? echo($state); ?></td>
  </tr>
  <tr>
    <td align="right">Zip</td>
    <td><?php echo("  <input name='new_zip' type='text' id='new_zip' size='8' maxlength='8' value = '$zip'>"); ?></td>
  </tr>
  <tr>
    <td align="right">Password 1 </td>
    <td><?php echo("  <input name='new_pwd1' type='text' id='new_pwd1' size='25' maxlength='25' value = '$pwd1'> "); ?></td>
  </tr>
  <tr>
    <td align="right">Password 2 </td>
    <td><?php echo("  <input name='new_pwd2' type='text' id='new_pwd2' size='25' maxlength='25' value = '$pwd2'>") ;?></td>
  </tr>
  <tr>
    <td align="right">Job Title </td>
    <td>
      <select name="position" id="position">
        <option value="1" selected>User</option>
        <option value="2">Surgeon</option>
        <option value="3">Adminstrator</option>
      </select>
    <? echo($position); ?></td>
  </tr>
  <tr>
    <td align="right">Hospital</td>
    <td>
      <select name="hospital" id="select3">
        <option value="UF" selected>Shands at UF</option>
        <option value="Shands">Shands at AGH</option>
        <option value="VA">Verterans Administration-Gainesville</option>
      </select>
    <? echo($hospid); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input name="Modify" type="submit" id="Modify" value="Modify">
      <input name="Delete" type="submit" id="Delete" value="Delete">
    </td>
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
  <a href="../Mysql/DBSoftwareProject.pdf">Project Info</a>|
  <a href="../sql/project4.sql">SQL Schema </a>|
  <a href="../sql/insert.txt">Sample Data</a> |
  <a href="http://www.ufl.edu">Contact Us</a> |
   &copy;2003 COP4720 Database Mangement Project
 </div>  
				 
</body>
</html>