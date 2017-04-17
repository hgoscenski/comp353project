<html>
<head>

    <title>
        New User!
    </title>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: hgoscenski
 * Date: 4/5/17
 * Time: 17:45
 */
?>

<body>
<h1>If you already have an account, login:</h1>
<form action="accountInfo.php" method="post">
    <div>
        <label for="username">Username <input type="text" name="username" id="username"></label>
    </div>
    <div>
        <label for="password">Password <input type="password" name="password" id="password"</label>
    </div>
    <div><input type="submit" value="Submit"></div>
</form>

<form action="addUser.php" method="get" id="form">
    <div><label for="fname">First Name:
            <input type="text" name="fname" id="fname"></label>
    </div>
    <div><label for="lname">Last Name:
            <input type="text" name="lname" id="lname"></label>
    </div>
    <div><label for="streetaddress">Street Address:
            <input type="text" name="streetaddress" id="streetaddress"></label>
    </div>
    <div><label for="city">City:
        <input type="text" name="city" id="city"</label>
    </div>

    <div><label for="state">State
            <select name="state">
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
    </select>
        </label>
    </div>

    <div><label for="zipcode">Zip Code:
            <input type="text" name="zipcode" id="zipcode"</label>
    </div>
    <div><label for="country">Country:
            <input type="text" name="country" id="country"</label>
    </div>
    <div><label for="phone">Phone Number:
            <input type="text" name="phone" id="phone"</label>
    </div>
    <div><label for="email">Email:
            <input type="text" name="email" id="email"</label>
    </div>

    <div><input type="submit" value="Submit" id="submit"></div>
</form>
</body>

<script>
    document.getElementById("submit").onclick = inputValidation;

    function inputValidation() {
        var valid = true;
        if (!checkEmail(document.getElementById("email").value)) {
            alert("Invalid Email");
            valid = false;        }
        if (!checkStreetAddress(document.getElementById("streetaddress").value)){
            alert("Invalid Street Address");
            valid = false;
        }
        if (!checkZipCode(document.getElementById("zipcode").value)){
            alert("Invalid Zip Code");
            valid = false;
        }
        if (!checkPhoneNumber(document.getElementById("phone").value)){
            alert("Invalid Phone Number");
            valid = false;
        }
        if (!valid){
            document.getElementById("form").removeAttribute("action");
        }
        else if(valid && !document.getElementById("form").hasAttribute("action")) {
            document.getElementById("form").setAttribute("action", "addUser.php");
        }

    }

    function checkEmail(email) {
        var reg = /^([A-Za-z0-9_\-\.]{3,20})+\@([A-Za-z0-9_\-\.]{2,15})+\.([A-Za-z]{2,4})$/;
        if (!reg.test(email)) {
            return false;
        }
        return true;
    }
    function checkPhoneNumber(phone){
        var reg = /^[0-9]{10}$/;
        if (!reg.test(phone)) {
            return false;
        }
        return true;
    }
    function checkZipCode(zipcode) {
        var reg = /^\d{5}$/;
        if (!reg.test(zipcode)) {
            return false;
        }
        return true;
    }
    function checkStreetAddress(streetaddress){
        var reg = /^[a-zA-Z0-9]+$/;
        if (!reg.test(streetaddress)){
            return false;
        }
        return true;

    }
</script>

</html>