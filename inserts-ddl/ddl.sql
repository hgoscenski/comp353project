create table department
(
	DepartmentID int not null auto_increment
		primary key,
	Location varchar(20) not null,
	DepartmentDesc varchar(20) not null,
	ManagerID int not null,
	constraint Department_DepartmentID_uindex
	unique (DepartmentID)
)
;

create index department_employee_EmployeeID_fk
	on department (ManagerID)
;

create table employee
(
	EmployeeID int not null auto_increment
		primary key,
	DepartmentID int not null,
	Fname varchar(12) not null,
	Lname varchar(12) not null,
	Compensation int not null,
	DOB date not null,
	SSN varchar(9) not null,
	EmployeeStatus varchar(3) not null,
	SupID int null,
	constraint Employee_EmployeeID_uindex
	unique (EmployeeID),
	constraint employee_department_DepartmentID_fk
	foreign key (DepartmentID) references department (DepartmentID),
	constraint employee__EmployeeID_fk
	foreign key (SupID) references employee (EmployeeID)
)
;

create index employee_department_DepartmentID_fk
	on employee (DepartmentID)
;

create index employee__EmployeeID_fk
	on employee (SupID)
;

alter table department
	add constraint department_employee_EmployeeID_fk
foreign key (ManagerID) references employee (EmployeeID)
;

create table loginemployee
(
	EmployeeID int not null
		primary key,
	SaltedPassword int null,
	constraint loginemployee_employee_EmployeeID_fk
	foreign key (EmployeeID) references employee (EmployeeID)
)
;

create table loginuser
(
	EmailAddress varchar(50) not null
		primary key,
	SaltedPassword varchar(100) not null,
	UserID int not null,
	constraint LoginUser_EmailAddress_uindex
	unique (EmailAddress),
	constraint LoginUser_SaltedPassword_uindex
	unique (SaltedPassword)
)
;

create index LoginUser_user_UserID_fk
	on loginuser (UserID)
;

create table fruityco.`order`
(
	OrderID int not null auto_increment
		primary key,
	PayID int not null,
	UserID int not null,
	Date date not null,
	constraint Order_OrderID_uindex
	unique (OrderID)
)
;

create index order_payment_PayID_fk
	on fruityco.`order` (PayID)
;

create index order_user_UserID_fk
	on fruityco.`order` (UserID)
;

create table orderline
(
	OrderLineId int not null auto_increment
		primary key,
	ProductID int not null,
	OrderID int not null,
	Quantity int not null,
	constraint OrderLine_OrderLineId_uindex
	unique (OrderLineId),
	constraint OrderID_fk
	foreign key (OrderID) references order (OrderID)
)
;

create index OrderID_fk
	on orderline (OrderID)
;

create index ProductID_fk
	on orderline (ProductID)
;

create table payment
(
	PayID int not null
		primary key,
	BillingName varchar(50) not null,
	BillingStreetAddress varchar(50) not null,
	BillingCity varchar(15) not null,
	BillingState varchar(15) not null,
	BillingZipCode int not null,
	BillingCountry varchar(15) not null,
	CreditCardNum varchar(16) not null,
	CreditCardExpiryDate varchar(5) not null,
	CreditCardSecurityCode varchar(3) not null,
	constraint Payment_PayID_uindex
	unique (PayID)
)
;

alter table fruityco.`order`
	add constraint order_payment_PayID_fk
foreign key (PayID) references payment (PayID)
;

create table product
(
	ProductID int not null auto_increment
		primary key,
	ProductDesc varchar(50) null,
	ProductPic blob null,
	Price float not null,
	QuantityAval int not null,
	AtCost float not null,
	constraint Product_ProductID_uindex
	unique (ProductID)
)
;

alter table orderline
	add constraint ProductID_fk
foreign key (ProductID) references product (ProductID)
;

create table requestedrepairs
(
	RequestID int not null auto_increment
		primary key,
	UserID int not null,
	ProductID int not null,
	OrderID int not null,
	RequestDate date not null,
	constraint RequestedRepairs_RequestID_uindex
	unique (RequestID),
	constraint requestedrepairs_product_ProductID_fk
	foreign key (ProductID) references product (ProductID),
	constraint requestedrepairs_order_OrderID_fk
	foreign key (OrderID) references order (OrderID)
)
;

create index requestedrepairs_order_OrderID_fk
	on requestedrepairs (OrderID)
;

create index requestedrepairs_product_ProductID_fk
	on requestedrepairs (ProductID)
;

create index requestedrepairs_user_UserID_fk
	on requestedrepairs (UserID)
;

create table user
(
	UserID int not null auto_increment
		primary key,
	PayID int null,
	ShipStreetAddress varchar(20) null,
	ShipCity varchar(15) null,
	ShipState varchar(15) null,
	ShipZipCode int null,
	ShipCountry varchar(15) null,
	PhoneNumber varchar(10) null,
	EmailAddress varchar(50) not null,
	fName varchar(15) null,
	LName varchar(15) null,
	constraint User_UserID_uindex
	unique (UserID),
	constraint user_payment_PayID_fk
	foreign key (PayID) references payment (PayID)
)
;

create index user_payment_PayID_fk
	on user (PayID)
;

alter table loginuser
	add constraint LoginUser_user_UserID_fk
foreign key (UserID) references user (UserID)
;

alter table fruityco.'order'
	add constraint order_user_UserID_fk
foreign key (UserID) references user (UserID)
;

alter table requestedrepairs
	add constraint requestedrepairs_user_UserID_fk
foreign key (UserID) references user (UserID)
;

