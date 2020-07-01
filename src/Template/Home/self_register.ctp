<?= $this->element('header'); ?>
<form>
    <p id="register-title">MEMBERSHIP REGISTRATION FORM</p>
    <div class="form-group">
        <label>First Name:</label>
        <input autofocus type="text" placeholder="Enter your first name"/>
    </div>
    <div class="form-group">
        <label>Last Name:</label>
        <input type="text" placeholder="Enter your last name"/>
    </div>
    <div class="form-group">
        <label>Email Address:</label>
        <input type="email" placeholder="Enter your email address"/>
    </div>
    <div class="form-group">
        <label>Password:</label>
        <input type="password" placeholder="Enter your password"/>
    </div>
    <div class="form-group">
        <label>Confirm Password:</label>
        <input type="password" placeholder="Re-enter your password"/>
    </div>
    <div class="form-group">
        <label>Mobile Number:</label>
        <input type="number" max="13" min="10" placeholder="Enter your mobile number"/>
    </div>
    <div class="form-group">
        <label>Date of Birth:</label>
        <input type="date" placeholder="Enter your date of birth"/>
    </div>
    <div class="form-group">
        <label>Gender:</label>
        <select>
            <option>Select Gender</option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>
    <div class="form-group">
        <label>Profile Image:</label>
        <input type="file" name="uploadProfilePic" />
    </div>
    <button id="login-btn" type="submit">Register</button>
</form>