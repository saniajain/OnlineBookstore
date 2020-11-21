<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshop</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/validation.js"></script>
</head>
<body>
    
    <div>
        <div class=""> <h1 class="heading">Online Book Store</h1></div>
        <form name="onlineBookStore" action="" method="POST" onsubmit="return validate(this);">

            <?php
                include('sections/personalInfo.php');
            ?>
            <?php
                include('sections/registrationDetails.php');
            ?>
            <?php
                include('sections/products.php');
            ?>
            <?php
                include('sections/paymentInfo.php');
            ?>
        
            <div class="section">
                <input type="submit" class="button" name="checkout" value="checkout" id="checkout">

            </div>
            
            <div class="section" id="errorSec">
                <p id="errors">
                    <?php
                        if(isset($_POST['checkout'])){
                            $errors = '';
                            //validating first name
                            $name = $_POST['firstName'];
                            if($name == ''){
                                $errors = 1;
                                echo 'Please enter name <br>';
                            }
                            //validating phone
                            $phone = $_POST['phone'];
                            $phonePattern = "/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/";
                            if(!preg_match($phonePattern, $phone))
                            {
                                $errors = 1;
                                echo 'Please enter valid phone number </br>';
                            }
                            //validating address
                            $address = $_POST['address'];
                            $addressPattern = "/^[A-z0-9]*((#|-|,|\s)*[A-z0-9])*$/";
                            if($address == '' || !preg_match($addressPattern, $address))
                            {
                                $errors = 1;
                                echo 'Please enter a valid address </br>';
                            }
                            //validating postcode
                            $postcode = $_POST['postcode'];
                            $postcodePattern = "/^[A-Za-z][0-9][A-Za-z][\s]?[0-9][A-Za-z][0-9]$/";
                            if($postcode == '' || !preg_match($postcodePattern, $postcode))
                            {
                                $errors = 1;
                                echo 'Please enter a valid postcode </br>';
                            }
                            //validating email
                            if (empty($_POST["email"])) {
                                echo "Email is required <br>";
                              } else {
                                $email = $_POST["email"];
                                // check if e-mail is valid
                                //return filtered data or false if filter fails
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                  echo "Invalid email format<br>";
                                }
                              }
                            //password validation
                            function matchPassword($password, $confirmPassword){
                                //check if password matches confirm password

                                if($password != $confirmPassword){
                                    echo 'Your password do not match with confirm password <br>';
                                }
                            }
                            $password = $_POST['password'];
                            $passwordPattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,10}$/";
                            if(!preg_match($passwordPattern, $password))
                            {
                                $errors = 1;
                                echo 'Please enter a valid password </br>';
                            }
                            else{
                                $confirmPassword = $_POST['confirmPassword'];
                                matchPassword($password,$confirmPassword);
                            }
                            //validating province
                            $province = $_POST['province'];
                            if($province == ""){
                                $error = 1;
                                echo 'Please select a province</br>';
                            }
                            //validating products in the cart
                            $notebookBought = $_POST['notebook'] ? $_POST['notebook'] : 0;
                            $bookBought = $_POST['booksAvailable'];
                            if($bookBought == '' && $notebookBought == ''){
                                $errors = 1;
                                echo 'Select some products before checkout </br>';
                            }
                            else{
                                $btype = $_POST['bookType'];
                                include('sections/price.php');
                                if($bookBought == ''){
                                    $bookPrice = 0;
                                }
                                else{
                                    $bookPrice = $price[$bookBought][$btype];
                                }
                                $notebookPrice = $notebookBought * 5;
                                $totalCost = $bookPrice + $notebookPrice;
                                //check if cart total is more than $10
                                if($totalCost < 10){
                                    $errors = 1;
                                    echo "</br>Add products for minimum $10 to checkout </br>";
                                }
                                else{
                                    //validating payment
                                    $card = $_POST['cardNumber'];
                                    $expiryMonth = $_POST['expiryMonth'];
                                    $expiryYear = $_POST['expiryYear'];
                                    if($card == '' || $expiryMonth == '' || $expiryYear == ''){
                                        $errors = 1;
                                        echo "</br>Add payment details</br>";
                                    }
                                    else{
                                        //validating card format
                                        $cardPattern = "/^[0-9]{4}(?:-[0-9]{4})(?:-[0-9]{4})(?:-[0-9]{4})?$/";
                                        if(!preg_match($cardPattern, $card))
                                        {
                                            $errors = 1;
                                            echo 'Please enter a valid card number </br>';
                                        }
                                        //validating month format
                                        $monthPattern = "/^(?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|June?|July?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)$/i";
                                        if(!preg_match($monthPattern, $expiryMonth))
                                        {
                                            $errors = 1;
                                            echo 'Please enter a valid expiry month </br>';
                                        }
                                        //validating expiry year
                                        $yearPattern = "/^[0-9]{4}$/";
                                        if(!preg_match($yearPattern, $expiryYear))
                                        {
                                            $errors = 1;
                                            echo 'Please enter a valid expiry year </br>';
                                        }
                                        else{
                                            // if the format of year is correct, check it with current year to know if the card is expired
                                            $currentYear = date("Y");
                                            if($expiryYear < $currentYear){
                                                echo "The card you entered has expired!</br>";
                                            }
                                            else if($expiryYear > $currentYear + 20){
                                                echo "The year you entered is invalid </br>";
                            
                                            }
                                            else{
                                                $taxArray = array(
                                                    "BritishColumbia" => 5,
                                                    "Ontario" => 7,
                                                    "Alberta" => 5,
                                                    "NovaScotia" => 8,
                                                    "Quebec" => 4
                                                );
                                                //add taxes to the cart depending on the province selected
                                                $tax = 0;
                                                if(array_key_exists($province,$taxArray)){
                                                    $provinceTax = $taxArray[$province];
                                                    $taxedCost = $totalCost + $provinceTax;
                                                }   
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                </p>
            </div>         
        </form>
        <div id="receipt" class="">
            <h2 class="receiptHeading"> Receipt for your shopping</h2>
            <p id="receiptDisplay">
                <?php
                    // server-side output in PHP
                    if(isset($_POST['checkout']))//if the form was submitted
                    {
                        if($errors == '') // if no errors exist
                        { 
                            //calculating price
                            //data structure to store product information for store
                            include('sections/price.php');
                            $bookSelected = $_POST['booksAvailable'];
                            $bookType = $_POST['bookType'];
                            $fname = $_POST['firstName'];
                            $phone = $_POST['phone'];
                            $address = $_POST['address'];
                            $postcode = $_POST['postcode'];
                            $province = $_POST['province'];
                            $city = $_POST['city'];
                            $email = $_POST['email'];
                            echo "Thankyou for shopping with us! <br>";
                            echo "<b>Name:</b> $fname <br>";
                            echo "<b>Contact:</b> $phone <br>";
                            echo "<b>Address:</b> $address <br>";
                            echo "<b>Postcode: </b> $postcode <br>";
                            echo "<b>Province: </b> $province <br>";
                            echo "<b>City: </b> $city <br>";
                            echo "<b>Email: </b> $email <br>";
                            if($bookPrice > 0){
                                echo "<b>Book bought:</b>",$price[$bookSelected]['name']; 
                                echo "<br><b>Book type:</b> $bookType <br>";
                                echo "<b>Book Price:$</b>", $price[$bookSelected][$btype];
                            }
                            if($notebookPrice > 0){
                                echo "<b></br> Notebook Quantity:</b>",$notebookBought;
                                echo "<b> </br> Notebook Price:$</b>",$notebookPrice;
                            }
                            echo "<b> </br> Total Cost:$</b>",$totalCost;
                            echo "<b> </br> Province Tax:$ </b>",$provinceTax;
                            echo "<b> </br> Total cost Inclusive of tax: $ </b>",$taxedCost;
                            echo "</br>Payment done with card ending in:", substr($card,-4);
                        }
                    } // isset POST if statement ends here
                ?>
            </p>
        </div>
    </div>
</body>
</html>