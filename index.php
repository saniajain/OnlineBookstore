<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshop</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <div>
        <div class=""> <h1 class="heading">Online Book Store</h1></div>
        <form name="onlineBookStore" action="" method="POST" onsubmit="return validate(this);">

            <div class="section">
                <h2>Personal Information</h2>
                <label for="firstName">Name</label>
                <input type="text" class="textField" name="firstName" id="firstName" maxlength="20" placeholder="John" onchange="validateNames(this.value);">
                <div class="hidden" id="nameError"></div>
                <br>
                <label for="phone">Phone number</label>
                <input type="text" class="textField" name="phone" id="phone" maxlength="10" placeholder="1234567890" pattern="[1-9]{1}[0-9]{9}" onchange="validatePhone(this.value);">
                <div class="hidden" id="phoneError"></div>
                <br>
                <label for="address">Address</label>
                <input type="text" class="textField" name="address" id="address" maxlength="25" placeholder="# no, street, area" onchange="validateAddress(this.value);">
                <div class="hidden" id="addressError"></div>
                <br>
                <label for="province">Province</label>
                <select name="province" id="province" onchange="populateCity(this.value);">
                    <option value="">--- Select ---</option>
                    <option value="BritishColumbia">BritishColumbia</option>
                    <option value="Ontario">Ontario</option>
                    <option value="Alberta">Alberta</option>
                    <option value="NovaScotia">NovaScotia</option>
                    <option value="Quebec">Quebec</option>
                </select>
                <br>
                <label for="city">City</label>
                <select name="city" id="city">
                    <option value="">Select Province</option>
                </select>
                <br>
                <label for="postcode">Postcode</label>
                <input type="text" name="postcode" class="textField" id="postcode" placeholder="X9X 9X9" maxlength="7" onchange="validatePostcode(this.value);">
                <div class="hidden" id="postCodeError"></div>
                <br>
            </div>
            <div class="section">

                <h2>Register with us!</h2>

                <label for="email">Email</label>
                <input type="email" class="textField" name="email" id="email" placeholder="john@gmail.com" onchange="validateEmail(this.value);">
                <div class="hidden" id="emailError"></div>
                <br>
                <label for="password">Password</label>
                <input type="password" class="textField" name="password" id="password" onchange="validatePassword(this.value);" maxlength="10">
                <br>
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="textField" name="confirmPassword" id="confirmPassword" disabled onchange="checkPasswordMatch(this.value);" maxlength="10">
                <div class="hidden" id="passwordError"></div>
                <br>
            </div>
            <div class="section">

                <h2>Products</h2>
                <label for="booksAvailable">Books Available</label>
                <select name="booksAvailable" id="booksAvailable" class="dropDown">
                    <option value="">--- Select ---</option>
                    <option value="book1">The Hobbit</option>
                    <option value="book2">Lord of the rings</option>
                    <option value="book3">The Heir</option>
                    <option value="book4">A darker shade of magic</option>
                    <option value="book5">Neverwhere</option>
                </select>
                <br>
                <label for="">Book Type</label>
                <div id="radioButtons">
                    <input type="radio" name="bookType" id="paperback" value="paperback" checked><label for="paperback" class="radioLabel">Paperback</label>
                    <input type="radio" name="bookType" id="hardcover" value="hardcover"><label for="hardcover" class="radioLabel">Hardcover</label>
                    <input type="radio" name="bookType" id="kindle" value="kindle"><label for="kindle" class="radioLabel">Kindle</label>
                </div>
                <br>
                <input type="button" class="button" value="Add to Cart" onclick="addToCart(this)">
                <br>
            </div>
            <div>
                <p id="showCart"></p>
            </div>
            <div class="section">
                <h2>Payment Information</h2>
                <label for="cardNumber">Credit card</label>
                <input type="text" class="textField" name="cardNumber" id="cardNumber" value="" placeholder="xxxx-xxxx-xxxx-xxxx" maxlength="19">
                <br>
                <label for="expiryMonth">Expiry month</label>
                <input type="text" class="textField" name="expiryMonth" id="expiryMonth" minlength="3" maxlength="3" placeholder="MMM">
                <br>
                <label for="expiryYear">Expiry Year</label>
                <input type="text" class="textField" name="expiryYear" id="expiryYear" placeholder="YYYY" maxlength="4">
            </div>
            <div class="section">
                <input type="submit" class="button" name="checkout" value="checkout" id="checkout">

            </div>
            <?php
                if(isset($_POST['checkout'])){
                    $errors = '';
                    $name = $_POST['firstName'];
                    if($name == ''){
                        $errors = 1;
                        echo 'Please enter name <br>';
                    }
                    //regex validations
                    $phone = $_POST['phone'];
                    $phonePattern = "/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/";
                    if(!preg_match($phonePattern, $phone))
                    {
                        $errors = 1;
                        echo 'Please enter valid phone number </br>';
                    }
                }
            ?>
            <div class="section" id="errorSec">
                <p id="errors"></p>
            </div>         
        </form>
        <div id="receipt" class="hidden">
            <h2 class="receiptHeading"> Receipt for your shopping</h2>
            <p id="receiptDisplay"></p>

        </div>
    </div>


</body>
</html>