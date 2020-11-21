<div class="section">
                <h2>Personal Information</h2>
                <label for="firstName">Name</label>
                <input type="text" class="textField" name="firstName" id="firstName" maxlength="20" placeholder="John">
                <?php /*if(isset($_POST['checkout'])){
                    $errors = '';
                    //validating first name
                    $name = $_POST['firstName'];
                    if($name == ''){
                        $errors = 1;
                        echo "<div id='nameError'>
                        Please enter name <br>
                        </div>";
                    }
                }*/ ?>
                <div class="hidden" id="nameError"></div>
                <br>
                <label for="phone">Phone number</label>
                <input type="text" class="textField" name="phone" id="phone" maxlength="12" placeholder="123-123-1234" >
                <div class="hidden" id="phoneError"></div>
                <br>
                <label for="address">Address</label>
                <input type="text" class="textField" name="address" id="address" maxlength="25" placeholder="# no, street, area">
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
                <input type="text" name="postcode" class="textField" id="postcode" placeholder="X9X 9X9" maxlength="7">
                <div class="hidden" id="postCodeError"></div>
                <br>
            </div>