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
    return true;
}

