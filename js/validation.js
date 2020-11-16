//creating structure for province and cities in that particular province along with tax
var provinces = {
    BritishColumbia: {
        city: ["Vancouver","Surrey","Kelowna","Richmond"],
        tax: 5
    },
    Ontario: {
        city: ["Toronto","Ottawa","Hamilton","London","Kitchener"],
        tax: 7
    },
    Alberta: {
        city: ["Calgary","Edmonton","Banff","Conmore"],
        tax: 5
    },
    NovaScotia: {
        city: ["Sydney","New Glasgow","Kentville"],
        tax: 8
    },
    Quebec: {
        city: ["Montreal","Sherbrooke","Saguanay"],
        tax: 4
    }
}

//functon to populate city dropdown based on province selected
function populateCity(value){

    if(value.length == 0){
        document.getElementById("city").innerHTML = "<option>Select province</option>"
    }
    else{
        var cityOptions = ""
        for(var i = 0; i< provinces[value].city.length; i++){
            cityOptions += "<option>" + provinces[value].city[i] + "</option>";
        }
        document.getElementById("city").innerHTML = cityOptions;
    }
}

//function to validate the name
var nameError = false;
function validateNames(value){
    let namePattern = /^[A-Za-z ]+$/
    value = value.trim();
    if(!value.match(namePattern)){
        nameError = true;
        document.getElementById("nameError").innerHTML = "Enter only alphabets in name field ";
        document.getElementById("nameError").style.display = 'block';
    }
    else{
        nameError = false;
        document.getElementById("nameError").style.display = 'none';
    }
}

//function to validate phone number
var phoneError = false;
function validatePhone(value){
    let phonePattern = /^\d{10}$/;
    if(value != "" && !phonePattern.test(value)){
        phoneError = true;
        document.getElementById("phoneError").innerHTML = "Enter phone in numeric in format of 1234567890"
        document.getElementById("phoneError").style.display = 'block';
    }
    else{
        phoneError = false;
        document.getElementById("phoneError").style.display = 'none';
    }
}

//function for address validation
var addressError = false;
function validateAddress(value){
    let addressPattern = /^[A-z0-9]*((#|-|,|\s)*[A-z0-9])*$/
    if(value != "" && !addressPattern.test(value)){
        addressError = true;
        document.getElementById("addressError").innerHTML = "Enter correct format for address</br> example- # no, street no-7, Kingston";
        document.getElementById("addressError").style.display = "block";
    }
    else{
        addressError = false;
        document.getElementById("addressError").style.display = "none";
    }
}

//function to validate postcode
var postCodeError = false;
function validatePostcode(value){
    //check postcode is in correct format
    let postcodePattern = /^[A-Za-z][0-9][A-Za-z][\s]?[0-9][A-Za-z][0-9]$/;
    if(value != "" && !postcodePattern.test(value)){
        postCodeError = true;
        document.getElementById("postCodeError").innerHTML = "Enter postcode in proper format of x2x 2x2"
        document.getElementById("postCodeError").style.display = 'block';
    }
    else{
        postCodeError = false;
        document.getElementById("postCodeError").style.display = 'none';
    }
}

//function to validate email
var emailError = false;
function validateEmail(value){
    //check email is correct format
    let emailPattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(value != "" && !emailPattern.test(value)){
        emailError = true;
        document.getElementById("emailError").innerHTML = "Enter valid email in format of x@y.z"
        document.getElementById("emailError").style.display = "block";
    }
    else{
        emailError = false;
        document.getElementById("emailError").style.display = "none";
    }
}

//function to check password and enable confirm password field if password is non empty
var passwordError = false;
function validatePassword(value){
    //check if password is empty, disable confirm password field
    if(value == ''){
        passwordError = true;
        document.getElementById("confirmPassword").value = "";
        document.getElementById("passwordError").innerHTML = "Enter password first!"
        document.getElementById("passwordError").style.display = 'block';
        document.getElementById("confirmPassword").disabled = true;
    }
    else{
        //check password is having one uppercase, one lowercase, one numeric and one special character
        //length of password must be from 6-10
        let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,10}$/
        if(!passwordPattern.test(value)){
            passwordError = true;
            document.getElementById("passwordError").innerHTML = "Password must have atleast one uppercase,one lowercase,one numeric and one special character<br> Length of password must be 6-10 characters long";
            document.getElementById("passwordError").style.display = 'block';
            document.getElementById("confirmPassword").disabled = true;
        }
        //if password is in correct format, enable confirm password field
        else{
            passwordError = false;
            document.getElementById("confirmPassword").disabled = false;
            document.getElementById("passwordError").style.display = 'none';
        }
    }
}

//function to check password and confirm password fields match
function checkPasswordMatch(value){
    let pwd = document.getElementById("password").value;
    if(pwd == ''){
        passwordError = true;
        document.getElementById("passwordError").innerHTML = "Enter password first!"
        document.getElementById("passwordError").style.display = 'block';
    }
    else if(pwd != '' && value != pwd){
        passwordError = true;
        document.getElementById("passwordError").innerHTML = "Password mismatch with confirm password"
        document.getElementById("passwordError").style.display = 'block';
    }
    else{
        document.getElementById("passwordError").style.display = 'none';
        passwordError = false;
    }
}

//function to validate that all fields are correctly filled before checkout
var totalCost = 0;
function validate(form){
    var error = "";
    let fname = form.firstName.value.trim();
    let phone = form.phone.value.trim();
    let address = form.address.value.trim();
    let province = form.province.value;
    let city = form.city.value;
    let creditCard = form.cardNumber.value;
    let expiryMonth = form.expiryMonth.value;
    let expiryYear = form.expiryYear.value;
    let postcode = form.postcode.value;
    let email = form.email.value;

    //check if province is empty
    if(province == ""){
        error += "Select a province</br>";
    }
    //check if above validated fields has some unresolved error
    if(nameError == true || phoneError == true || postCodeError == true || emailError == true
        || passwordError == true){
            error += "Please check the form for highlighted errors</br>"
        }
    if(totalCost >= 10){
        //check the payment details are not empty
        var paymentError = false;
        if(creditCard == "" || expiryMonth == "" || expiryYear == ""){
            error += "Enter payment details! </br>"
        }
        else{
            // check credit card has correct format
            let cardPattern = /^[0-9]{4}(?:-[0-9]{4})(?:-[0-9]{4})(?:-[0-9]{4})?$/;
            if(creditCard != "" && !cardPattern.test(creditCard)){
                paymentError = true;
                error += "Enter a valid card number</br>";
            }
            //check expiry month has correct format of MMM
            let monthPattern = /^(?:Jan(?:uary)?|Feb(?:ruary)?|Mar(?:ch)?|Apr(?:il)?|May|June?|July?|Aug(?:ust)?|Sep(?:tember)?|Oct(?:ober)?|Nov(?:ember)?|Dec(?:ember)?)$/i
            if(expiryMonth != "" && !monthPattern.test(expiryMonth)){
                paymentError = true;
                error += "Enter a valid expiry month</br>";
            }
            // check expiry year has correct format YYYY
            let yearPattern = /^[0-9]{4}$/;
            if(!yearPattern.test(expiryYear)){
                paymentError = true;
                error += "Enter a valid expiry year</br>"
            }
            else{
                // if the format of year is correct, check it with current year to know if the card is expired
                let d = new Date();
                var currentYear = d.getFullYear();
                if(expiryYear < currentYear){
                    paymentError = true;
                    error += "The card you entered has expired!</br>";
                }
                else if(expiryYear > currentYear+20){
                    error += "The year you entered is invalid </br>"

                }
                else{
                    paymentError = false;
                    //add taxes to the cart depending on the province selected
                    var tax = 0;
                    for(var prov in provinces){
                        if(prov == province){
                            tax = provinces[prov].tax;
                            break;
                        }
                    }
                    var taxCost = totalCost + tax;
                }
            }
        }
    }
    else{
        error += "Add products worth of $10 or more to checkout</br>";
    }

    //if errors then show them on the page
    if(error != ''){
        document.getElementById('errors').innerHTML = error;
    }
    //else display the receipt with all information
    else{
        let card = creditCard.substring(creditCard.length - 4);
        document.getElementById('errors').innerHTML = error;
        var receipt =`
            <b>Name:</b> ${fname}<br>
            <b>Phone:</b> ${phone}<br>
            <b>Address:</b> ${address}<br>
            <b>Province:</b> ${province}<br>
            <b>Postcode:</b> ${postcode}<br>
            <b>City:</b> ${city}<br>
            <b>Email:</b> ${email}</br>
            <b>Books Bought:</b> ${books}<br>
            <b>Cost:</b>$ ${totalCost}<br>
            <b>Province tax:</b> ${tax}<br>
            <b>Total cost inclusive of province tax:</b>$ ${taxCost} <br>
            <b>Payment done with card ending in</b> ${card} <br>
            <b>Thankyou for shopping with us!<b>
        `;
        document.getElementById('receiptDisplay').innerHTML = receipt;
        document.getElementById("receipt").style.display = 'block';
        document.getElementById("errors").innerHTML = "Order placed!</br> Scroll to top to see receipt!"
        document.getElementById("errors").style.color = "green";
    }
    return false;
}

//data structure to store product information for store
var prices = {
    book1:{
        name: "The Hobbit",
        paperback: 8,
        hardcover: 9,
        kindle: 5
    },
    book2:{
        name: "Lord of the rings",
        paperback: 10,
        hardcover: 12,
        kindle: 5
    },
    book3:{
        name: "The Heir",
        paperback: 7,
        hardcover: 10,
        kindle: 5
    },
    book4:{
        name: "Darker shade of magic",
        paperback: 10,
        hardcover: 12,
        kindle: 9
    },
    book5:{
        name: "Neverwhere",
        paperback: 12,
        hardcover: 15,
        kindle: 5
    }
};
var cart = {
    product: [],
    price: []
}
var products = [];
    var price = [];
var books = "";

// add to cart functionality    
function addToCart(value){
    var bookBought = document.getElementById("booksAvailable").value;
    var bookType = document.getElementsByName('bookType');
    var bType = '';
    //check which book type is selected
    for(var i = 0; i< bookType.length; i++){
        if(bookType[i].checked){
            bType = bookType[i].value;
            break;
        }
    }
    //traverse through array to get the book selected by user
    for(var book in prices){
        if(book == bookBought){
            var prod = prices[book].name + " " + bType + " edition";
            cart.product.push(prod);
            
            cart.price.push(prices[book][bType]);
        }
    }
    //check if cart is empty
    if(cart.product.length == 0){
        document.getElementById("showCart").innerHTML = "Select books before adding to the cart";
        document.getElementById("showCart").style.color = "red";
    }
    //if cart has products,display the cart items
    else{
        var display = [];
        document.getElementById('showCart').innerHTML = '';
        document.getElementById("showCart").style.color = "black";
        books = "";
        totalCost = 0;
        for(var i = 0; i< cart.product.length; i++){
            var displayCart = `
                    <b>Product ${i+1}</b><br>
                    Books: ${cart.product[i]}<br>
                    Cost:$ ${cart.price[i]}<br>
            `;
            display.push(displayCart);
            totalCost = totalCost + cart.price[i];
            books = books + " </br>" + cart.product[i];
        }
        document.getElementById('showCart').innerHTML = display;
    }
}