# TODO
* ER Diagram Pre
* ER Diagram Post
* Organization/Use Writeup
* Admin Page
* Store Page (home) --> Admin
                    --> Transaction
                    --> Repair Ticket
* Insert/DDL
* Database
    * Product = ProductID, Product Desc, ProductPic, Price, QuantityAval, AtCost
    * Login = UserID, SaltedPassword, isEmp
    * Transactions = TransID, Product, Total, Time, UserID
    * Users = UserID, DOB, Location, Address, fName, lName
    * Employee= empId, Locations, Address, fName, lName, title, department, status
    * EmployeeSensitive = empId, ssn, DOB, conpensation, writeup1, writeup2, writefinal
    * Department = depID, manager, depdescription
    * Shipping = Country, Carrier
    * PurchaseInfo = userID, creditCardNum, ExpiryDate, SecurityCode
    * RequestedRepairs = userID, productID, transID, date/time, issueDesc

