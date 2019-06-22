<?php
class DB_Functions {
// Script written by Frank F. Ford
// December 2005 Worlwide Inc. 	
#class  Global variables
var $connection    = "";          #database conncetion Link
var $result_array  = ARRAY();     #results given  back from database lookup
var $theStatment   = "";          #Query connection Link
var $commit        ='1';          #boolean for commitment to database

var $database      = "orcl";      #database name
var $user_id       = "consult_fford";     #User ID for Database ie (root)
var $pwd           = "dion#*93";  #User Password
var $host          = "localhost"; #Database Host


#Logs onto the database
function logOn() {
   	$database = $this->database;
	$user_id  = $this->user_id;
	$pwd      = $this->pwd;
	$host     = $this->host;
	$this->connection = mysql_connect($host,$user_id,$pwd);
	if (!$this->connection){
           echo "Unable to connect to DB: " . mysql_error();
           exit;
    } 
     mysql_select_db($database,$this->connection);
}

#Logs off the database
function logOff(){
	 mysql_close($this->connection);
	} 



#Creates Database Query
function queryDB($sql_query){
   //echo("<pre>".$sql_query."</pre><br>");
        $this->theStatement = mysql_query($sql_query);
		if (!$this->theStatement) {
                      echo "Could not successfully run query ($sql_query) from DB: " . mysql_error();
	              exit;
		}		
}

#Fetches Query Info in form of Asssociative Array
function fetch(){ 
       return $this->result_array =  mysql_fetch_assoc($this->theStatement);
}

#SQL Update of Database Table Values
function updateDB($table, $set, $condition) {
	$qsvUpdate = "
		UPDATE		$table
		SET		$set
		WHERE		$condition";
    //echo("<pre>".$qsvUpdate."</pre><br>");		
	$this->theStatement = mysql_query($qsvUpdate);
}
#SQL Delete of Database Table Values
function deleteDB($table,$condition){
 	$qsvDelete ="		
		DELETE FROM $table
		WHERE       $condition";
	  //  echo("<pre>".$qsvDelete."</pre><br>");			
	$this->theStatement = mysql_query($qsvDelete);
}

#Inset Record into Database Table		
function insertDB($table,$values){
   $fields = mysql_list_fields($this->database, $table,$this->connection);
   $column_num = mysql_num_fields($fields);
   for ($i = 1; $i < $column_num; $i++) {
      $columns = $columns.mysql_field_name($fields, $i).",";
   }
   $columns = substr($columns, 0, -1); 
   for ($i = 0; $i < count($values); $i++) {
		if (is_integer($values[$i]))
		 $valueStr = $valueStr.$values[$i];
		else 
		 $valueStr = $valueStr."'".$values[$i]."'";
		if($i+1 < count($values))
			$valueStr = $valueStr.", ";
	}
	
	$qsvAdd = "
		INSERT INTO	$table ($columns)
		VALUES		($valueStr)";
		//echo($qsvAdd."<br>");
		
	$this->theStatement = mysql_query($qsvAdd);	
	if (!$this->theStatement) {
              die('Invalid query: ' . mysql_error());
         } 
}//end insertDB

#Returns ID(primary Key)  of Inserted Record 
function getID(){
		return mysql_insert_id($this->connection);
}

} //end db_functions class
?>