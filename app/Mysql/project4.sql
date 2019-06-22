Drop Table Surgical_Images_Tree;
Drop Table Surgical_Images;
Drop Table Workswith;
Drop Table Outcomes;
Drop Table Scale;
Drop Table Tests;
Drop Table Reports;
Drop Table Complication_Tree;
Drop Table Complications;
Drop Table List_Complication;
Drop Table Procedure_Tree;
Drop Table Patient_Procedure;
Drop Table Procedures;
Drop Table List_Procedure;
Drop Table Diagnosis_Tree;
Drop Table Patient_Diagnosis;
Drop Table Diagnosis;
Drop Table List_Diagnosis;
Drop Table Patients;
Drop Table Auth_Personnel;
Drop Table Surgeons;
Drop Table Admin;
Drop Table Users;
Drop Table Hospitals;

Create Table Hospitals
(
	Hospid varchar(20) Primary Key,
	Hos_Name varchar(40),
	Record_Format varchar(15),
	Street_Address varchar(50),
	City varchar(25),
	State varchar(25),
	Zip integer(9)
);

Create Table Users
(
	Userid varchar(15) Primary Key,
	Last_Name varchar(30),
	First_Name varchar(30),
	Address1 varchar(50),
	City varchar(25),
	State varchar(25),
	Zip integer(9),
	Passwd1 varchar(15),
	Passwd2 varchar(15),
	Reg_Date Date,
	Hospid varchar(20),
	Authorizedby varchar(15),
	Position integer(10)
);


Create Table Admin
(
	Userid varchar(15),
	Foreign Key (Userid) References Users (Userid)
);



Create Table Surgeons
(
	Surgid varchar(15) Primary Key,
	Type varchar(20),
	Foreign Key (Surgid) References Users (Userid)
);



Create Table Auth_Personnel
(
	Userid varchar(15) Primary Key,
	Job_Title varchar(20),
	Hospid varchar(20),
	Foreign Key (Userid) References Users (Userid),
	Foreign Key (Hospid) References Hospitals (Hospid)
);


Create Table Patients
(
	Patid varchar(20) Primary Key,
	Med_Record_Num varchar(20),
	Hospid varchar(20),
	Lastname varchar(30),
	Firstname varchar(30),
	Address1 varchar(50),
	City varchar(25),
	State varchar(25),
	Zip integer(9),
	Birthdate Date,
	Curdate Date,
	Surgid varchar(15),
	Creators_Id varchar(15),
	Foreign Key(Hospid) References Hospitals(Hospid),
	Foreign Key(Surgid) References Surgeons(Surgid),
	Foreign Key (Creators_Id) References Users(Userid)
);

Create Table List_Diagnosis
(
	diag_list_id integer(10) Primary Key,
	Diag_Name varchar(60)
);

Create Table Diagnosis_Tree
(
	Parent_Proc integer(10),
	Child_Proc integer(10),
	Primary Key (Parent_Proc,Child_Proc),
	Foreign Key (Parent_Proc) References List_Diagnosis(diag_list_id),
	Foreign Key (Child_Proc)  References List_Diagnosis(diag_list_id)
);


Create Table Diagnosis
(
	Diagid integer(10) Primary Key,
	Surgid varchar(15),
	Entered_By varchar(15),
	Date_Entered Date,
	diag_cat_id integer(10),
	Foreign Key (Surgid) References Surgeons (Surgid),
	Foreign Key (diag_cat_id)  References List_Diagnosis(diag_list_id)
);

Create Table Patient_Diagnosis
(
	Diagid integer(10),
	Patid varchar(20),
	Primary Key(Diagid,Patid),
	Foreign Key(Diagid) References Diagnosis(Diagid),
	Foreign Key(Patid)  References Patients(Patid)
);

Create Table List_Procedure
(
	proc_list_id integer(10) Primary Key,
	Proc_Name varchar(60)
);

Create Table Procedure_Tree
(
	Parent_Proc integer(10),
	Child_Proc integer(10),
	Primary Key (Parent_Proc,Child_Proc),
	Foreign Key (Parent_Proc) References List_Procedure(proc_list_id),
	Foreign Key (Child_Proc)  References List_Procedure(proc_list_id)
);

Create Table Procedures
(
	Proc_Id integer(10),
	Status varchar(10),
	Surgid varchar(15),
	Assist1_Surgid varchar(15),
	Assist2_Surgid varchar(15),
	Curr_Date Date,
	Proccat_Id integer(10),
	Primary Key(Proc_Id),
	Foreign Key(Surgid)         References Surgeons(Surgid),
	Foreign Key(Assist2_Surgid) References Surgeons(Surgid),
	Foreign Key(Assist1_Surgid) References Surgeons(Surgid),
	Foreign Key(Proccat_Id)     References List_Procedure(proc_list_id)
);

Create Table Patient_Procedure
(
	Proc_Id integer(10),
	Patid varchar(20),
	Primary Key(Proc_Id,Patid),
	Foreign Key(Proc_Id) References Procedures(Proc_Id),
	Foreign Key(Patid) References Patients(Patid)
);

Create Table List_Complication
(
	comp_list_id integer(10) Primary Key,
	Com_Name varchar(60)
);

Create Table Complications
(
	Comp_Id integer(10) Primary Key,
	User_Id varchar(15),
	Proc_Id integer(10),
	Foreign Key(User_Id) References Users(Userid),
	Foreign Key(Comp_Id) References List_Complication(comp_list_id),
	Foreign Key(Proc_Id) References Procedures(Proc_Id)
);

Create Table Complication_Tree
(
	Parent_Proc integer(10),
	Child_Proc integer(10),
	Primary Key (Parent_Proc,Child_Proc),
	Foreign Key (Parent_Proc) References List_Complication(comp_list_id),
	Foreign Key (Child_Proc)  References List_Complication(comp_list_id)
);

Create Table Reports
(
	Primary Key(Date_Started,Date_Finished,Type_Of),
	Info varchar(40),
	Medical_Record varchar(15),
	Date_Started Date,
	Date_Finished Date,
	Type_Of varchar(30)
);

Create Table Tests
(
	Test_Id integer(10) Primary Key,
	Name varchar(35)
);

Create Table Scale
(
	Value varchar(15),
	Test_Id integer(10),
	Description varchar(40),
	Primary Key (Value,Test_Id),
	Foreign Key(Test_Id) References Tests(Test_Id)
);

Create Table Outcomes
(
	Outcome_Id integer(10) Primary Key,
	Proc_Id integer(10),
	Pre_Date Date,
	Post_Date Date,
	Pretest integer(10),
	Posttest integer(10),
	Prescale integer(10),
	Postscale integer(10),
	Foreign Key(Pretest) 	References Tests(Test_Id),
	Foreign Key(Posttest) 	References Tests(Test_Id),
	Foreign Key(Proc_Id) 	References Procedures(Proc_Id)
);


Create Table Workswith
(
	Authpersid varchar(15),
	Surgid varchar(15),
	Primary Key(Authpersid,Surgid),
	Foreign Key (Authpersid) References Users(Userid),
	Foreign Key (Surgid) 	 References Users(Userid)
);

Create Table Surgical_Images
(
	Pictid integer(10) Primary Key,
	Pictures Blob,
	filename varchar(50),
	filesize integer(10),
	filetype varchar(50),
	Proc_Id integer(10),
	Foreign Key(Proc_Id) References Procedures(Proc_Id)
);

Create Table Surgical_Images_Tree
(
	Parent_Image integer(10),
	Child_Image integer(10),
	Primary Key(Parent_Image,Child_Image),
	Foreign Key(Parent_Image) References Surgical_Images(Pictid),
	Foreign Key(Child_Image)  References Surgical_Images(Pictid)
); 