

Create Table Hospitals(
	Hospid 		varchar(20),
	Hos_Name 	varchar(40), 
	Record_Format 	varchar(15),
	Street_Address 	varchar(50),
	City 		varchar(25),
	State 		varchar(25),
	Zip 		int(9),
	Primary Key (Hospid)
);

Create Table Users (
	Userid 		varchar(15),
	Last_Name 	varchar(30),
	First_Name 	varchar(30),
	Address1 	varchar(50),
	City 		varchar(25),
	State 		varchar(25),
	Zip 		int(9),
	Passwd1 	varchar(255),
	Passwd2 	varchar(255),
	Reg_Date 	Date,
	Email		varchar(20),
	Hospid 		varchar(20), 
	Authorizedby 	varchar(15),
	Position        int(10),
	Primary Key    (Userid)
);


Create Table Admin(
	Userid 		varchar(15), 
Foreign Key (Userid) References Users (Userid)
);



Create Table Surgeons(
	Surgid	 varchar(15),
	Type 	 varchar(20),
Primary key (Surgid),
Foreign Key (Surgid) References Users (Userid)
);



Create Table Auth_Personnel(
	Userid 		varchar(15), 
	Job_Title 	varchar(20), 
	Hospid 		varchar(20),
Primary key (Userid), 
Foreign Key (Userid) References Users (Userid),
Foreign Key (Hospid) References Hospitals (Hospid)
);


Create Table Patients(
	Patid			varchar(20),
	Med_Record_Num		varchar(20),
	Hospid 			varchar(20),
	Lastname 		varchar(30),
	Firstname		varchar(30),
	Address1		varchar(50),
	City			varchar(25),
	State			varchar(25),
	Zip			int(9),
	Birthdate 		Date,
	Curdate 		Date,
	Surgid			varchar(15),
	Creators_Id		varchar(15),
Primary Key (Patid),
Foreign Key(Hospid) References Hospitals(Hospid),
Foreign Key(Surgid) References Surgeons(Surgid),
Foreign Key (Creators_Id) References Users(Userid)
);

Create Table List_Diagnosis(
	diag_list_id   int(10),
	Diag_Name     varchar(60),
 	Primary key (diag_list_id)
);

Create Table Diagnosis_Tree(
	Parent_Proc  int(10),
	Child_Proc   int(10),
Primary Key (Parent_Proc,Child_Proc),
Foreign Key (Parent_Proc) References List_Diagnosis(diag_list_id), 
Foreign Key (Child_Proc)  References List_Diagnosis(diag_list_id)
);


Create Table Diagnosis(
	Diagid 	   	int(10), 
	Surgid 	  	varchar(15),
	Entered_By 	varchar(15),
	Date_Entered 	Date,
	diag_cat_id	int(10),
Primary key   (Diagid),
Foreign Key (Surgid) References Surgeons (Surgid),
Foreign Key (diag_cat_id)  References List_Diagnosis(diag_list_id)
);

Create Table Patient_Diagnosis(
	Diagid		int(10),
	Patid		varchar(20),
	Primary Key(Diagid,Patid),
Foreign Key(Diagid) References Diagnosis(Diagid),
Foreign Key(Patid)  References Patients(Patid)
);

Create Table List_Procedure(
	proc_list_id 	int(10),
	Proc_Name 	varchar(60),
Primary key (proc_list_id)
);

Create Table Procedure_Tree(
	Parent_Proc	 int(10),
	Child_Proc  	int(10),
Primary Key (Parent_Proc,Child_Proc),
Foreign Key (Parent_Proc) References List_Procedure(proc_list_id), 
Foreign Key (Child_Proc)  References List_Procedure(proc_list_id)
);

Create Table Procedures(
	Proc_Id		int(10),
	Status		varchar(10),
	Surgid		varchar(15),
	Assist1_Surgid	varchar(15),
	Assist2_Surgid	varchar(15),
	Curr_Date	Date,
	Proccat_Id	int(10),
	Primary Key(Proc_Id),
Foreign Key(Surgid)         References Surgeons(Surgid),
Foreign Key(Assist2_Surgid) References Surgeons(Surgid),
Foreign Key(Assist1_Surgid) References Surgeons(Surgid),
Foreign Key(Proccat_Id)     References List_Procedure(proc_list_id)
);

Create Table Patient_Procedure(
	Proc_Id		int(10),
	Patid		varchar(20),
Primary Key(Proc_Id,Patid),
Foreign Key(Proc_Id) References Procedures(Proc_Id),
Foreign Key(Patid) References Patients(Patid)
);

Create Table List_Complication(
	comp_list_id 	int(10),
	Com_Name 	varchar(60),
	primary key (comp_list_id)
);

Create Table Complications(
	Comp_Id		int(10),
	User_Id 	varchar(15),
	Proc_Id		int(10),
primary key (Comp_ID),
Foreign Key(User_Id) References Users(Userid),
Foreign Key(Comp_Id) References List_Complication(comp_list_id),
Foreign Key(Proc_Id) References Procedures(Proc_Id)
);

Create Table Complication_Tree(
	Parent_Proc	int(10),
	Child_Proc	int(10),
Primary Key (Parent_Proc,Child_Proc),
Foreign Key (Parent_Proc) References List_Complication(comp_list_id), 
Foreign Key (Child_Proc)  References List_Complication(comp_list_id)
);

Create Table Reports(
	Primary Key(Date_Started,Date_Finished,Type_Of),
	Info varchar(40),
	Medical_Record varchar(15),
	Date_Started Date,
	Date_Finished Date,
	Type_Of varchar(30)
);

Create Table Tests(
	Test_Id 	int(10),
	Name 		varchar(35),
	Primary key (Test_id)
);

Create Table Scale(
	Value 		varchar(15), 
	Test_Id 	int(10),
	Description	varchar(40),
Primary Key (Value,Test_Id),
Foreign Key(Test_Id) References Tests(Test_Id)
);

Create Table Outcomes(
	Outcome_Id	int(10),
	Proc_Id		int(10),
	Pre_Date	Date,
	Post_Date	Date,
	Pretest		int(10),
	Posttest	int(10),
	Prescale	int(10),
	Postscale	int(10),
primary key (outcome_id),
Foreign Key(Pretest) 	References Tests(Test_Id),
Foreign Key(Posttest) 	References Tests(Test_Id),
Foreign Key(Proc_Id) 	References Procedures(Proc_Id)
);


Create Table Workswith( 
	Authpersid 	 varchar(15), 
	Surgid   	 varchar(15), 
Primary Key(Authpersid,Surgid), 
Foreign Key (Authpersid) References Users(Userid), 
Foreign Key (Surgid) 	 References Users(Userid) 
);
 
Create Table Surgical_Images( 
	Pictid  	int(10), 
	Pictures 	Blob,	
	filename 	varchar(50),
  	filesize 	int(10),
   	filetype 	varchar(50),
	Proc_Id 	int(10),
Primary key (Pictid),  
Foreign Key(Proc_Id) References Procedures(Proc_Id)
);

Create Table Surgical_Images_Tree(
	Parent_Image 	int(10), 
	Child_Image  	int(10),
Primary Key(Parent_Image,Child_Image),
Foreign Key(Parent_Image) References Surgical_Images(Pictid),
Foreign Key(Child_Image)  References Surgical_Images(Pictid)
); 