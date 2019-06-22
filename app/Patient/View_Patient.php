<?
session_start();
if (!session_is_registered('USER_ID'))
       header("Location: .././login.php");
  // get all  post variables and append with var
include("../db_class_info.php");      //include oracle class file
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
<form action="" method="post" enctype="multipart/form-data" target="_self">
 <table width="100%" border="0" align="center" cellpadding="3" class="border">
    <tr class="tbletitle"> 
      <td colspan="4" align="center" class="MyCSS">Patient Search </td>
    </tr>
    <tr> 
      <td width="76" align="right" class="style4">Search For</td>
      <td width="204">
         <input name="query" type="text" size="30" maxlength="25">
      </td>
      
    </tr>
    <tr>
      <td align="right" class="style4">Search By </td>
      <td colspan="3" ><select name="search_by" id="select2">
        <option value="Lastname" selected>Lastname</option>
        <option value="Firstname">Firstname</option>
        <option value="Med_Record_Num">Medical Record</option>
        <option value="Birthdate">Birthdate</option>
        <option value="Hospid">Hospital</option>
            </select></td>
    </tr>
    <tr>
      <td align="right" class="style4">SortBy</td>
      <td colspan="3" ><select name="sort_by" size="1" id="select2">
          <option value="Med_Record_Num">Medical Record</option>
          <option value="Last_Name" selected>Last name</option>
          <option value="First_Name">First name</option>
        </select>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" class="style4"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td colspan="3" ><input type="submit" name="Query" value="Search"></td>
    </tr>
    
  </table>
  
  </form>
			<?	if(isset($var_Query))
	{
	 $results = array();	
	 $db = new Oracle;  
   	 $db->logOn();
	 $select= "*";
	 $from = $db->Patients_table;
	 $where = $var_search_by." LIKE '%$var_query%'";
	 echo($where);
	 $db->queryDB($select,$from,$where);
	 $i = 0;
	 while ($db->fetch()) //check password
	      {  
			$i++;
			if ($i==1)
			{
			 echo('<form action="./PatientInfo2.php" method="post"  name="form2" id="form2">
			   <table width="100%" border="0" class="border">
              <tr class="style4">
                <th width="13%"  scope="col">Record</th>
                <th width="13%"  scope="col">Medical Record</th>
                <th width="13%"  scope="col">Last Name </th>
                <th width="13%"  scope="col">Firstname</th>
                <th width="13%"  scope="col">Hospid</th>
                <th width="13%"  scope="col">DOB</th>
                <th width="13%"  scope="col">Info</th>
                
              </tr>');
			}

	      	if ($i%2 == 0)
	      	  $bg = "#CCCCCC";
	      	else $bg = "#B1C3D9";  

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
             //<input name="Info" type="submit" id="Info" value="Edit">
		    echo('<tr class="style4" bgcolor='.$bg.'>
                <td align= "right">'.$i.'</td> <td align= "right">'.$medrec.'</td>
                <td align= "right">'.$lastname.'</td> <td align= "right">'.$firstname.'</td>
                <td align= "right">'.$hospid.' &nbsp;</td>  <td align= "right">'.$dob.' &nbsp;</td>
                <td align="center"> 
				<a href = "./PatientInfo2.php?pg=1&id='.$patid.' ">[Info]</a?
				</td>
               
              </tr>');
			 
			  
          }  
	     echo('</table></form> <br>'); 
          if ($i==0 || $found!="true") 
		   {
		    echo('<p align="center" class = "style4">Record Not Found<p>');
		   }
        $db->logOff();  
    
  }		 
?>




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
	                echo('<li> <a href="../Admin/Add_Hospital.php"> New Hospital</a> </li>');
	                echo('<li> <a href="../Admin/Modify_Hospital.php">Modify Hospital</a> </li>');
	                echo('<li> <a href="../Admin/Reports.php">Generate Reports</a> </li>');
	                echo('<li> <a href="../Admin/Edit_Lists.php">Maintain Lists</a> </li>');
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
