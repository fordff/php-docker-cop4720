<?
function getFieldNames($db,$table){
 $fields = array(); $colCnt = 0;
 $sql_query = "SHOW columns FROM $table";
 $db->queryDB($sql_query);
 while($db->fetch()){
        $cols = $db->result_array;
	    $fields[$colCnt]  = $cols['Field'];
	    $colCnt++;
  }  
 return $fields;
}


function getFieldLengths($db,$table){
 $length = array(); $type = array();$cols=array();
 $colCnt = 0;$temp='';
 $sql_query = "SHOW columns FROM $table";
 $db->queryDB($sql_query);
  while($db->fetch()){
        $cols = $db->result_array;
	$type[$colCnt] = $cols['Type'];
	$colCnt++;
  }
   $colCnt = sizeof($type);
   for($i=0; $i< $colCnt; $i++){
   $temp = $type[$i]; 	
   $length[$i] = chop(substr($temp, (strpos($temp, '(') + 1), (strpos($temp, ')') - strpos($temp, '(') - 1)));	
   }
 return $length;
}


//displays a query box search form
function outputSearchForm($db,$table){
   $fields  = getFieldNames($db,$table);
   $colCnt  = sizeof($fields);
   $output  = '  <form method="post" enctype="multipart/form-data" target="_self">'. "\n";
   $output .= '  <table border="0" cellspacing="1" cellpadding="3" class="box">'. "\n";
   $output .='         <tr class="tbletitle">'. "\n";
   $output .= '     <td colspan="2">'.ucfirst($table).' Search </td>'. "\n";
   $output .= '  </tr>'. "\n";

   $output .= '  <tr>'. "\n";
   $output .= '  <td  align="right">Search For </td>'. "\n";
   $output .= '  <td>'. "\n";
   $output .= '    <input name="searchFor" type="text" size="35" maxlength="25"></td>'. "\n";
   $output .= '  </tr>'. "\n";

   $output .= '  <tr>'. "\n";
   $output .= '  <td align="right">Search By </td>'. "\n";
   $output .= '  <td align="left">'. "\n";
   $output .= '  <select name="searchBy" id="searchBy">'. "\n"; 
   for($i=1;$i < $colCnt; $i++){
     $output .= '     <option value="'.$fields[$i].'">'.$fields[$i].'</option>'. "\n";
   }
   $output .= '  </select>'. "\n";
   $output .= '  </td>'. "\n";
   $output .= '  </tr>'. "\n";

   $output .= '  <tr>'. "\n";
   $output .= '    <td align="right" class="style4"> </td>'. "\n";
   $output .= '    <td align="Right">'. "\n";
   $output .= '      <input type="submit" name="Query" value="Search">'. "\n";
   $output .= '    </td>'. "\n";
   $output .= '  </tr>'. "\n";
   $output .= '</table>'. "\n";
   $output .= '</form>'. "\n";
echo($output);
}

//modify database table
function modifyTable($db,$table,$id,$key,$formData)
{
     $cnt = 0;	
     $fields = getFieldNames($db,$table);
     $cnt = sizeof($fields);
	 for($i=0;$i<$cnt;$i++){
	    $str = $fields[$i];
	    $temp[$i] = $formData[$str];
	}
      if ($key  == '') $key = $field[0];
	  $condition = $key." = ".$var_id;
      for($i=0; $i < $cnt; $i++){
	   $updateString =$temp[$i]; 	
	   $set =  $fields[$i]."= '".$updateString."'";
	   $db->updateDB($table,$set,$condition);	
      } 	
  
} 

//return output string of table html formated
function showTable($db,$table,$searchBy,$searchFor,$order,$sort,$goto){

  $searchBy  = trim($searchBy);
  $searchFor = trim($searchFor);
  if($searchFor == ''){
      $where = '1';
   } else{
    $where = "$searchBy LIKE '%$searchFor%'"; 
  }
  $output  = '<table width="100%" border="0" cellspacing="1" cellpadding="3" >'. "\n";
  $output .= '    <tr>'. "\n";
  $cols = array();
  $colCnt = 0;
  //get Table Field Names
  $sql_query = " SHOW columns FROM $table";
  $db->queryDB($sql_query);
  if ($sort == 'ASC') $asc ='DESC'; else $asc='ASC';
  while($db->fetch()){
    $cols = $db->result_array;
    $Fields[$colCnt]  = $cols['Field'];
    $output .=' <th bgcolor="#d3dce3">'. "\n";
    $output .='   <a href="MainAdmin.php?table='.$table.'&order='.$cols['Field'].'&sort='.$asc.'&where='.$where.'">'.$cols['Field'].'</a>'."\n";
    $output .='	</th>'. "\n";
    $colCnt++;
  }  
  $output .= '      <th bgcolor="#d3dce3">&nbsp;</th>'. "\n";
  $output .= '    </tr>'. "\n";
  if($order ==''){
	   $order = $Fields[0];
	   $sort = 'ASC';
   }
 $sql_query2 = "SELECT * FROM $table WHERE $where ORDER BY '$order' $sort";
 $db->queryDB($sql_query2);
  $i = 0;
  while ($results = $db->fetch()) {
  	 $bg     = ($i % 2) ? "#CCCCCC" : "#B1C3D9";
	 $output.='    <tr>'. "\n"; 
	 $num    = count($results); //since we get two indexs assoc and num
	  for($x=0; $x < $num ; $x++){
	       $output.='      <td align= "right" bgcolor='.$bg.' class="smallfont">'.$results[$Fields[$x]].'</td>'. "\n";
	  } 
     $output.='        <td bgcolor='.$bg.' align="center"><a href="'.$goto.'?table='.$table.'&id='.$results[$Fields[0]].'&key='.$Fields[0].'">[INFO]</a></td> '. "\n";  
     $output.='    </tr>'. "\n";
  $i++;
  }
 $output.='</table> <hr size="1" width="95%">'. "\n";
 if ($i == 0) echo('<div align= "center" class="error">No Records Found</div>');
  else echo($output);
}

 
function editTable($db,$table,$id,$key){
  $found = 'false';
  $output .= '   <table  bordercolorlight="black" border="0" class="box" width="55%">'. "\n";
  $output .= '     <tr class="tbletitle">'. "\n";
  $output .= '          <td colspan="2"> '.ucfirst($table).' Edit Info </td>'. "\n";
  $output .= '     </tr> '. "\n";
  $fields  = array();$index=0;
  $sql_query = "SHOW columns FROM $table";
  $db->queryDB($sql_query);
  while($db->fetch()){
        $cols = $db->result_array;
	$fields[$index]  = $cols['Field'];
	$type[$index] = $cols['Type'];
	$temp = $type[$index]; 	
	
	if(eregi('date',$temp)){
          $lengths[$index] = 25;
        }	 else $lengths[$index] = chop(substr($temp, (strpos($temp, '(') + 1), (strpos($temp, ')') - strpos($temp, '(') - 1)));	
	
	$index++;
  }//end get column info
    
  $colCnt  = sizeof($fields);
  $results = array();
  if ($key == '') $key = $fields[0];
  $sql_query = "SELECT * FROM $table WHERE $key = '$id'";
  $db->queryDB($sql_query);
  while ($db->fetch()) {
  	$found = 'true';
	$results = $db->result_array;
        $formData = array();
        for($i=1; $i < $colCnt; $i++){ 
           $bg         = ($i % 2) ? "#CCCCCC" : "#EFEFEF"; 
           $output .='     <tr>'. "\n";
           $output .='       <th align="right" width="20%" bgcolor="#cfdaf0">'.$fields[$i].'</th>'. "\n";
           $size = (($lengths[$i] > 40 ) ? 40 : $lengths[$i]);
	   $output.= '       <td bgcolor="#f4f7fe"> '. "\n";
	   $output.= '           <input name="formData[]" type="text" size="'.$size.'" maxlength="'.$lengths[$i].'" value="'.$results[$fields[$i]].'" >'. "\n";
           $output.= '       </td>'. "\n";
           $output .='     </tr>'. "\n"; 
        }
  
  }
    $output.='   </table>'."\n";
    if ($found == 'true')  return($output);
} //end edit Function	


//----------------------------------------------------------------------------- 
//get file images form database and saves them to a file
//creates an img url string
function getBlob($db,$id){
  $srcFolder = "./images/";
  $sql = "SELECT * FROM image WHERE cid='$id'";
  $db->queryDB($sql);
  $images = array() ; $results = array();
  $i = 0;
  while ($db->fetch()) {
     $results = $db->result_array;
     $found = 'true';
	 $src  = $results['image'];
	 $src = base64_decode($src);
     $name = $results['imageName'];
	 $type = $results['imageType'];
	 $size = $results['imageSize'];
	 $imageDest = $srcFolder.$name;
	 $handle = fopen($imageDest, "w");
	 fwrite($handle, $src);
	 $src =  $srcFolder.$name;
	 chmod($src,0644);
	 $images[$i] = '         <img name="'.$name.'" src="'.$src.'" width="250" height="250"  alt="'.$name.'" />'. "\n";
	 $i++;
  } 
   return $images;
 }
 
 function view($db,$table,$id,$key){
  $colCnt = 0;
  $sql_query = " SHOW columns FROM $table";
  $db->queryDB($sql_query);
  while($db->fetch()){
    $cols = $db->result_array;
    $Fields[$colCnt]  = $cols['Field'];
    $colCnt++;
  }  
  $output .= '<table width="75%" border="0" cellspacing="1" cellpadding="3" >'. "\n";
  $output .= '    <tr>'. "\n";
   for($x=1 ;$x < $colCnt-1 ; $x++){
     $output .=' <th bgcolor="#d3dce3">'.$Fields[$x].'</th>'. "\n";
  }
  
 $output .= '    </tr>'. "\n";
 $where = "$key='$id'";  
 $sql_query2 = "SELECT * FROM $table WHERE $where";
 $db->queryDB($sql_query2);
  $i = 0;
  while ($results = $db->fetch()) {
  	 $bg     = ($i % 2) ? "#CCCCCC" : "#B1C3D9";
	 $output.='    <tr>'. "\n"; 
	 $num    = count($results); //since we get two indexs assoc and num
	  for($x=1; $x < $num-1 ; $x++){
	       $output.='      <td align= "right" bgcolor='.$bg.' class="smallfont">'.$results[$Fields[$x]].'</td>'. "\n";
	  } 
	 $output.='    </tr>'. "\n";
  $i++;
  }
 $output.='</table><br/>'. "\n";
 return $output;
} //end view

function is_image($filename)
        {
        $retour=0;
        if(eregi("\.png$|\.bmp$|\.jpg$|\.jpeg$|\.gif$",$filename)) {$retour=1;}
        return $retour;
        }


 ?>