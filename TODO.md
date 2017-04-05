# TODO
* ER Diagram Pre
* ER Diagram Post
* Organization/Use Writeup
* Admin Page
* Store Page (home) --> Admin
                    --> Transaction
                    --> Repair Ticket
* Insert/DDL
* Database Preliminary Do Not Use
    * Product = ProductID, Product Desc, ProductPic, Price, QuantityAval, AtCost
    * Login = UserID, SaltedPassword, isEmp
    * Transactions = TransID, Product, Total, Time, UserID
    * Users = UserID, DOB, Location, Address, fName, lName
    * Employee= empId, Locations, Address, fName, lName, title, department, status
    * EmployeeSensitive = empId, ssn, DOB, conpensation, writeup1, writeup2, writefinal
    * Department = depID, manager, depdescription
    * ----Shipping = Country, Carrier----
    * PurchaseInfo = userID, creditCardNum, ExpiryDate, SecurityCode
    * RequestedRepairs = userID, productID, transID, date/time, issueDesc

## Semi-Final Table/Field List
* Product
    * ProductID (PK)
    * ProductDesc
    * ProductPic
    * Price
    * QuantityAval
    * AtCost
* Order
    * OrderID (PK)
    * PayID (FK)
    * UserID (FK)
    * Date
* OrderLine
    * OrderLineID (PK)
    * OrderID (FK)
    * ProductID (FK)
    * Quantity
* Requested Repairs
    * RequestID (PK)
    * UserID (FK)
    * ProductID (FK)
    * OrderID (FK)
    * Date
* Department
    * DepartmentID (PK)
    * Location
    * DepartmentDesc
    * ManagerID (FK)
* Employee
    * EmployeeID (PK)
    * DepartmentID (FK)
    * Fname
    * Lname
    * Compensation
    * DOB
    * SSN
    * Status
    * SupID (FK (selfjoin))
* LoginEmployee
    * EmployeeID (PK/FK)
    * SaltedPassword
* Users
    * UserID (PK)
    * PayId (FK)
    * ShipStreetAddress
    * ShipCity
    * ShipState
    * ShipZipCode
    * ShipCountry
    * PhoneNumber
    * EmailAddress
* LoginUser
    * EmailAddress (PK)
    * UserID (FK)
    * SaltedPassword
* Payment
    * BillingName
    * BillingStreetAddress
    * BillingCity
    * BillingState
    * BillingZipCode
    * BillingCountry
    * CreditCardNum
    * CreditCardExpiryDate
    * CreditCardSecurityCode

