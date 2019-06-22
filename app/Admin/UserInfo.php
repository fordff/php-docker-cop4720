<?
session_start();
if (!session_is_registered('USER_ID'))
       header("Location: ./login.php");
if ($_SESSION['PERMISSIONS'] == 1 || $_SESSION['PERMISSIONS'] == 2)
   header("Location:.././Menu.php");	
include("../db_class_info.php");      //include oracle class file
import_request_variables("gP","var_");  // get all  post variables and append with var
?>
<html>
<head>
<title>User Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="pragma" content="no-cache">
<link href="../../StyleSheets/mypage.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
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
 <form method="post" enctype="multipart/form-data" name="query" target="_self" id="query">
              <table width="100%" border="0" align="center" class="border">
    <tr class="tbletitle"> 
      <td colspan="3" align="center">User Search </td>
    </tr>
    <tr>
      <td width="18%"  align="right" class="style4"><div align="right">Search For
              
      </div></td>
      <td width="24%" ><input name="query" type="text" size="35" maxlength="25"></td>
      <td width="58%"><span class="style4">
        Search By &nbsp;
<select name="search_by" id="search_by">
          <option value="Last_Name" selected>Lastname</option>
          <option value="First_Name">Firstname</option>
          <option value="Userid">Userid</option>
        </select>
      </span></td>
    </tr>
    <tr> 
      <td  align="right" class="style4"><div align="right">Type of User </div></td>
      <td >        <span class="style4">
        <select name="user_type" id="select4">
          <option value="all" selected>All</option>
          <option value="admin">Admin</option>
          <option value="surgeon">Surgeon</option>
          <option value="user">User</option>
        </select>
        </span></td>
          <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="style4"><div align="right"><span class="style4">Sort by&nbsp;</span>
      </div></td>
      <td align="left"><span class="style4">
        <select name="sort_by" size="1" id="select2">
          <option value="Userid" selected>Userid</option>
          <option value="Last_Name">Last name</option>
          <option value="First_Name">First name</option>
        </select>
      </span></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" class="style4"><div align="right" class="style4"></div></td>
      <td align="left"><div align="left"><span class="style4">
        <input type="submit" name="Query" value="Search">
      </span>
      </div></td>
      <td align="left">&nbsp;</td>
    </tr>
  </table>
  </form> <hr>
            <?	if(isset($var_Query))
	{
	 $results = array();	
	 $db = new Oracle;  
   	 $db->logOn();
	 $select= "*";
	 $from = $db->User_table;
     switch($var_user_type)
			{
			 case "all" :
			 $where = $var_search_by." LIKE '%$var_query%'";
			 break;
			 case "admin" :
			 $where = $var_search_by." LIKE '%$var_query%' and Position = '1'";
			  break;
			 case "surgeon":
			 $where = $var_search_by." LIKE '%$var_query%' and Position = '2'";
			 break;
			 case "user":
			 $where = $var_search_by." LIKE '%$var_query%' and Position =  '3'";
			 break;
			}
	 $db->queryDB($select,$from,$where);
	 $i = 0;
	 while ($db->fetch()) //check password
	      {  
		    $i++;
             if ($i==1)  
 				{
					echo('<form action="EditUserInfo.php" method="post"  name="form2" id="form2" >
							<table width="100%" border="0" class="border">
							  <tr class="style4">
								<th width="13%"  scope="col">Record</th>
								<th width="13%"  scope="col">Userid</th>
								<th width="13%"  scope="col">Last Name</th>
								<th width="13%"  scope="col">Firstname</th>
								<th width="13%"  scope="col">Hospid</th>
								<th width="13%"  scope="col">Position</th>
								<th width="13%"   scope="col"></th>
							  </tr>');
				}
	      	if ($i%2 == 0)
	      	  $bg = "#CCCCCC";
	      	else $bg = "#B1C3D9";  
	        $found = "true";
            $results=$db->result_array; 
			$userid	   = $results['Userid'];
	        $lastname  = $results['Last_Name'];   
			$firstname = $results['First_Name'];   
	        $address1  = $results['Address1'];   
	        $city      = $results['City'];
			$state     = $results['State'];   
			$zip       = $results['Zip'];   
	        $pwd1      = $results['Passwd11'];   
	        $pwd2      = $results['Passwd2'];   
			$regdate   = $results['REG_DATE'];
			$hospid	   = $results['Hospid'];
			$position  = $results['Position'];
		    echo('<tr class="style4">
                <td align= "right" bgcolor='.$bg.'>'.$i.'</td>
				<td align= "right" bgcolor='.$bg.'>'.$userid.'</td>
                <td align= "right" bgcolor='.$bg.'>'.$lastname.'</td> 
				<td align= "right" bgcolor='.$bg.'>'.$firstname.'</td>
                <td align= "right" bgcolor='.$bg.'>'.$hospid.' </td> 
				<td align= "right" bgcolor='.$bg.'>'.$position.' </td>
                <td align="center" bgcolor='.$bg.'> <a href ="./EditUserInfo.php?pg=1&id='.$userid.'">[INFO]</a></td>
             </tr>');
					  
          }  
	     echo('</table></form> <br>'); 
		 if ($i==0 || $found!="true") 
		   {
		    echo('<p align="center" class = "style4">Record Not Found<p>');
		   }
        $db->logOff();  
     }//end like query
 
	 
?>


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
	                echo('<li> <a href="../Patient/PatientInfo.php">Diagnosis</a> </li>');
					 echo('<li> <a href="../Patient/PatientInfo.php">Procedure</a> </li>');
					echo('<li> <a href="../Patient/PatientInfo.php">Outcomes</a> </li>');
	                echo('<li> <a href="../Patient/PatientInfo.php">Complications</a> </li>');
	                echo('<li> <a href="../Patient/PatientInfo.php">Images</a> </li>');
	                
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
					  echo('<li> <a href="../Patient/Add_Patient.php">Add Patient</a> </li>');
					  echo('<li> <a href="../Patient/View_Patient.php">View/Edit Patient</a> </li>');
					  echo('<li> <a href="../Patient/PatientInfo.php">Diagnosis</a> </li>');
					  echo('<li> <a href="../Patient/PatientInfo.php">Procdure</a> </li>');
					  echo('<li> <a href="../Patient/PatientInfo.php">Outcome</a> </li>');
					  echo('<li> <a href="../Patient/PatientInfo.php">Complication</a> </li>');
					  echo('<li> <a href="../Patient/PatientInfo.php">Image</a> </li>');
					  
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