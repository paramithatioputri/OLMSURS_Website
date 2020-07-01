<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<form method="post" action="/home/self-register">
    <p id="register-title">MEMBERSHIP REGISTRATION FORM</p>
    <div class="form-group">
        <label>Borrower Id:</label>
        <input autofocus type="text" placeholder="Enter your borrower id"/>
    </div>
    <div class="form-group">
        <label>First Name:</label>
        <input type="text" placeholder="Enter your first name"/>
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
    <button id="register-btn" type="submit">Register</button>
</form>

<?php $this->append('css') ?>
<style>
    #register-btn {
        align: center;
        margin-bottom: 20px;
        margin-left: 30%;
    }
</style>

<?php $this->end('css') ?>
