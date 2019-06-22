				  
select * from List_Diagnosis as D, Diagnosis_Tree as T where T.Parent_Proc = '1' and T.Child_Proc = D.diag_list_id;
select * from List_Procedure as P, Procedure_Tree as T where T.Parent_Proc = '1' and T.Child_Proc = P.proc_list_id				  
select * from List_Complication C, Complication_Tree as T where T.Parent_Proc = '1' and T.Child_Proc = C.comp_list_id				  				  