Drop Table Complications;
Drop Table Patients;
Drop Table Diagonsis;
Drop Table Admin;
Drop Table Auth_Personnel;
Drop Table Sub_Procedures;
Drop Table Major_Procedures;
Drop Table Scale;
Drop Table Tests;
Drop Table Reports;
Drop Table Hospitals;
Drop Table Surgeons;
Drop Table Users;

Create Table Users
(
	userid VarChar(15) Primary Key,
	passwd1 VarChar(15),
	passwd2 VarChar(15),
	last_name Varchar(30),
	first_name Varchar(30),
	address1 VarChar(50),
	city Varchar(25),
	state Varchar(25),
	zip int(9),
	reg_date DATE,
	hospID VarChar(20),
	authorizedBy VarChar(15),
	position Int
);

Create Table Admin
(
	userid VarChar(15),
	Foreign Key (userid) references Users (userid)
);


Create Table Surgeons
(
	surgid VarChar(15) Primary Key,
	type VarChar(20),
	Foreign Key (surgid) references users (userid)
);

Create Table Hospitals
(
	hospid VarChar(20) Primary Key,
	hos_name VarChar(40),
	record_format VarChar(15),
	street_address VarChar(50),
	city VarChar(25),
	state VarChar(25),
	zip Int
);

Create Table Auth_Personnel
(
	userid VarChar(15),
	job_title VarChar(20),
	hospID VarChar(20),
	Foreign Key (userid) references users (userid),
	Foreign Key (hospid) references hospitals (hospid)
);

Create Table Patients
(
	patid VarChar(20) Primary Key,
	med_record_num VarChar(20),
	hospid VarChar(20),
	lastname VarChar(30),
	firstname VarChar(30),
	address1 VarChar(50),
	city char(25),
	state char(25),
	zip number(9),
	birthdate DATE,
	curdate DATE,
	surgid VarChar(15),
	creators_id VarChar(15),
	Foreign Key(hospid) references hospitals(hospid),
	Foreign Key(surgid) references surgeons(surgid),
	Foreign Key (creators_id) references Users(userid)
);




Create Table Diagnosis
(
	Diag_Patient_ID VarChar(15) Primary Key,
	DiagID VarChar(15),
	surgid VarChar(15),
	Entered_by VarChar(15),
	Date_entered DATE,
	CatID VarChar(15),
	Foreign Key (surgid) references Surgeons (surgID)
);

Create Table Tests
(
	Test_id Int Primary Key,
	Name VarChar(35)
);

Create Table Scale
(
	value Int,
	test_id Int,
	Description VarChar(40),
	Primary Key (test_id, value),
	Foreign Key(test_id) references Tests(test_id)
);

Create Table Complications
(
	comp_id Int Primary Key,
	Comp_name VarChar(25),
	User_id VarChar(15),
	Medical_record VarChar(20),
	Value Int,
	Foreign Key(User_id) references Users (userid),
	Foreign Key(Medical_record) references patients(med_record_num)
);

Create Table CompToPatient
(
	comp_id Int,
	pat_id Int,
	Primary Key(comp_id,pat_id)
	Foreign Key
	(comp_id) references Procedures
	(comp_id),
	Foreign Key
	(pat_id) references Patients
	(pat_id)
);

	Create Table List_Complication
	(
		CompCat_ID Int Primary Key,
		Proc_name VarChar(60),
		branch Int
	);

	Create Table Complication_Tree
	(
		Parent_Proc Int,
		Child_Proc Int,
		Primary Key (Parent_Proc,Child_Proc),
		Foreign Key (Parent_Proc) references List_Complications(CompCat_ID),
		Foreign Key (Child_Proc) references List_Complications(CompCat_ID)
	);

	Create Table Procedures
	(
		proc_name VarChar(30),
		proc_id Int,
		status VarChar(10),
		med_record_num VarChar(15),
		hospid VarChar(20),
		surgid VarChar(15),
		assist1_surgid VarChar(15),
		assist2_surgid VarChar(15),
		curr_date DATE,
		Primary Key(proc_id,surgid,med_record_num),
		Foreign Key(med_record_num) references patients(med_record_num),
		Foreign Key(hospid) references hospitals(hospid),
		Foreign Key(surgid) references Surgeons(surgid),
		Foreign Key(assist2_surgid) references Surgeons(surgid),
		Foreign Key(assist1_surgid) references Surgeons(surgid)
	);


	Create Table ProcedureToPatient
	(
		proc_id Int,
		pat_id Int,
		Primary Key(proc_id,pat_id)
		Foreign Key
		(proc_id) references Procedures
		(proc_id),
	Foreign Key
		(pat_id) references Patients
		(pat_id)
);




		Create Table List_Procedure
		(
			ProcCat_ID Int Primary Key,
			Proc_name VarChar(60),
			branch Int
		);

		Create Table Procedure_Tree
		(
			Parent_Proc Int,
			Child_Proc Int,
			Primary Key (Parent_Proc,Child_Proc),
			Foreign Key (Parent_Proc) references List_Procedure(ProcCat_ID),
			Foreign Key (Child_Proc) references List_Procedure(ProcCat_ID)
		);

		Create Table List_Diagnosis
		(
			DiagCat_ID Int Primary Key,
			Diag_name VarChar(60),
			branch VarChar(30)
		);

		Create Table DiagnosisToPatient
		(
			DiagCat_ID Int,
			pat_id Int,
			Primary Key(DiagCat_ID,pat_id)
			Foreign Key
			(DiagCat_ID) references Procedures
			(DiagCat_ID),
	Foreign Key
			(pat_id) references Patients
			(pat_id)
);

			Create Table Diagnosis_Tree
			(
				Parent_Proc Int,
				Child_Proc Int,
				Primary Key (Parent_Proc,Child_Proc),
				Foreign Key (Parent_Proc) references List_Diagnosis(DiagCat_ID),
				Foreign Key (Child_Proc) references List_Diagnosis(DiagCat_ID)
			);


			Create Table Reports
			(
				Primary Key(date_started,date_finished,type_of),
				Info VarChar(40),
				Medical_record Int,
				Date_started date,
				Date_finished date,
				Type_of VarChar(30)
			);

