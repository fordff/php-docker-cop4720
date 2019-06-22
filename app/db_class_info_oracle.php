<?php
 class Oracle
 {
     #class  Global variables
        var $connection;    #database conncetion string argument
	var $result_array = ARRAY();  #results given  back from database lookup
	var $theStatment;   #execuation error statement
	var $commit='1';    #boolean for commitment to database
	var $Surgical_Images_Tree;
	var $Surgical_Images;
	var $Workswith; 
	var $Outcomes; 
	var $Scale; 
	var $Tests; 
	var $Reports;
	var $Complication_Tree;
	var $Complications_table; 
	var $List_Complication;
	var $Procedure_Tree; 
	var $Patient_Procedure; 
	var $Procedures_table; 
	var $List_Procedure;  
	var $Diagnosis_Tree; 
	var $Patient_Diagnosis; 
	var $Diagnosis_table; 
	var $List_Diagnosis; 
	var $Patients_table; 
	var $Auth_Personnel; 
	var $Surgeons; 
	var $Admin; 
	var $User_table; 
	var $Hospitals_table; 
	
  	#reads a user created file 
	#and logs on the user defined database
	function logOn()
	 {
	 	 $this->Surgical_Images_Tree	="Surgical_Images_Tree";
		 $this->Surgical_Images		="Surgical_Images";
		 $this->Workswith 		="Workswith";
		 $this->Outcomes 		="Outcomes";
		 $this->Scale 			="Scale";
		 $this->Tests 			="Tests";
		 $this->Reports			="Reports";
		 $this->Complication_Tree 	="Complication_Tree";
		 $this->Complications_table	="Complications";
		 $this->List_Complication	="List_Complication";
		 $this->Procedure_Tree 		="Procedure_Tree";
		 $this->Patient_Procedure 	="Patient_Procedure";
		 $this->Procedures_table	="Proceudres";
		 $this->List_Procedure  	="List_Procedure";
		 $this->Diagnosis_Tree 		="Diagnosis_Tree";
		 $this->Patient_Diagnosis 	="Patient_Diagnosis";
		 $this->Diagnosis_table		="Diagnosis";
		 $this->List_Diagnosis 		="List_Diagnosis";
		 $this->Patients_table 		="Patients";
		 $this->Auth_Personnel 		="Auth_Personnel";
		 $this->Surgeons 		="Surgeons";
		 $this->Admin 			="Admin";
		 $this->User_table		="Users";
		 $this->Hospitals_table		="Hospitals";
	      	
	   	$database            =  "orcl";
		$user_id             =  "fford";
		$pwd                 =  "dion#*93";
		$oracle_home         =  "ORACLE_HOME=/usr/local/libexec/oracle-client/";
		putenv($oracle_home);
			$this->connection = OCILogon($user_id,$pwd,$database);	
       
       		
	}
	
	#Logs of the database
	function logOff()
	{
		OCILogOff($this->connection);
		
	}

    # Database QUERY command
    # Takes in: a table and a condition
    # Returns: the query as a statement
    # SelectQuery
    # Desc: Retrieve data from the database.
    # Parms: 
    #   $tables - comma separated list of table names.
    #   $fields - comma separated list of field names or "*".
    #   $where - SQL Where clause (e.g. "where id=2").

	function queryDB($fields,$table,$where)
	 {
	       $qsvQuery = "
			SELECT $fields 
			FROM   $table
			WHERE  $where";
			echo($qsvQuery);
        	$iStatement = @OCIParse($this->connection,$qsvQuery);
		@OCIExecute($iStatement,OCI_DEFAULT);
		$this->theStatement = $iStatement;
	}
	
	
	function fetch() 
	{
		
		return @OCIFetchInto($this->theStatement,&$this->result_array,OCI_ASSOC+OCI_RETURN_NULL);
		
                #Important key value must be in all caps were callling an associative array
		#OCI Assoc return an associative array ie array index by key instead of numrically
		#OCI_RETURN_NULLS  ALSO RETURN THE EMPTY COLUMNS OF TABLE
		#NOTE THE AMPERSAND IN FRONT OF THE $THIS REFERENCE
		#
	}
	
	# Database UPDATE command
	# Takes in: a table, the value to be changed and it's new value
	#	    and a condition
	# Returns: nothing
	function updateDB($table, $set, $condition) 
	{
		$qsvUpdate = "
			UPDATE		$table
			SET		$set
			WHERE		$condition";
		//echo($qsvUpdate);echo("<br>");
		$iStatement = @OCIParse($this->connection,$qsvUpdate);
		@OCIExecute($iStatement,OCI_DEFAULT);
		$commit=OCICommit($this->connection);
	}
	
	function deleteDB($table,$condition)
	{
	   
		$qsvDelete ="		
			DELETE FROM $table
			WHERE       $condition";
		$iStatement = @OCIParse($this->connection,$qsvDelete);
		@OCIExecute($iStatement,OCI_DEFAULT);
		$commit=OCICommit($this->connection);
	}
		
		
	# Database INSERT command
	# Takes in: a table and an array of values
	# Returns: nothing
	function insertDB($table, $values)
	 {
		for ($i = 0; $i < count($values); $i++) 
		{
			$valueStr = $valueStr."'".$values[$i]."'";
			if($i+1 < count($values))
				$valueStr = $valueStr.", ";
				
		}
		$qsvAdd = "
			INSERT INTO	$table
			VALUES		($valueStr)";
		
		$iStatement = @OCIParse($this->connection,$qsvAdd);
		$this->checkError($iStatement);
		@OCIExecute($iStatement, OCI_DEFAULT);
		$this->checkError($iStatement);
		OCICommit($this->connection);
	}//end inssertDB
	
	
	function checkError($statement)
	 {
		$arrError = OCIError($statement);
		if ($arrError['code'])
		 {
			print $arrError['message'];
			OCIRollback($this->connection);
			OCILogOff($this->connection);
			exit;
		}
	}#end error check
	
 }//end class			
		
?>