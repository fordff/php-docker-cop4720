 $db = new Oracle;
			  $db->logon();
		      $select = "*";
			  $from = "Patient_diagnosis as D, List_Diagnosis as D";
				  $where = "P.patid = ".$id." and D.diag_list_id = P.diag_list_id)";
				  $db->queryDB($select,$from,$where);
				  while($db->fetch())
				  {
				     $found = true;
					 $results = $db->result_array;
					 $name = $results["Diag_Name"];
					 $id = $results["diag_list_id"];
					 echo($name);
				}
					
			?>