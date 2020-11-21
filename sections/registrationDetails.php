<div class="section">

    <h2>Register with us!</h2>

    <label for="email">Email</label>
    <input type="email" class="textField" name="email" id="email" placeholder="john@gmail.com">
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