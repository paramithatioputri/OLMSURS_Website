<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<?php
    $gender = ["Select Gender", "Male", "Female"];
?>
<?= $this->Form->create($borrower, ["enctype" => 'multipart/form-data']);?>
<fieldset>
    <legend><?= __('Register New Account of Borrower') ?></legend>
    <?php
        echo $this->Form->control("user_id", ["autofocus", "type" => "text", "placeholder" => "Enter the user ID", "label" => "User ID"]);
        echo $this->Form->control("first_name", ["type" => "text", "placeholder" => "Enter the first name"]);
        echo $this->Form->control("last_name", ["type" => "text", "placeholder" => "Enter the last name"]);
        echo $this->Form->control("email_address", ["type" => "email", "placeholder" => "Enter the email address"]);
        echo $this->Form->control("password", ["type" => "password", "placeholder" => "Enter the password", "id" => "password", "oninput" => "checkPasswordMismatch(),checkPasswordLen()"]);?>
        <p class="checkPassword" id="checkPasswordLen"></p>
        <?php
        echo $this->Form->control("confirm_password", ["type" => "password", "placeholder" => "Re-enter the password", "id" => "confirmpassword", "oninput" => "checkPasswordMismatch()"]);
        ?>
        <p class="checkPassword" id="checkPasswordMismatch"></p>
        <?php
        echo $this->Form->control("mobile_no", ["type" => "text", "pattern" => "\d{10,13}", "title" => "Number format only with length 10 - 13", "placeholder" => "Enter the mobile number"]);
        echo $this->Form->control("date_of_birth", ["type" => "date", "placeholder" => "Enter the date of birth"]);
        echo $this->Form->control("gender", ["type" => "select", "options" => $gender]);
        echo $this->Form->control("profile_image", ["type" => "file", "accept" => "image/png, image/jpg, image/jpeg"]);
        echo $this->Form->button(__('Register'), ['id' => "register-btn"]);
    ?>
</fieldset>
<?= $this->Form->end();?>

<?php $this->append('css') ?>
<style>
    #register-btn {
        align: center;
        margin-bottom: 20px;
        margin-left: 30%;
    }

    .checkPassword{
        font-weight: bold;
        font-style: italic;
        font-size: 12px;
    }
</style>

<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
    function checkPasswordMismatch(){
        var password = document.getElementById("password").value;

        var confirmPassword = document.getElementById("confirmpassword").value;
        if(password == "" || confirmPassword == ""){
            document.getElementById("checkPasswordMismatch").innerHTML = "";
        }
        else if(password != confirmPassword){
            document.getElementById("checkPasswordMismatch").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>The password does not match!";
            document.getElementById("checkPasswordMismatch").style.color = "red";
        }
        else{
            document.getElementById("checkPasswordMismatch").innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>The password matches!";
            document.getElementById("checkPasswordMismatch").style.color = "#4CAF50";
        }
    }

    function checkPasswordLen(){
        var password = document.getElementById("password").value;
        var passwordLen = password.length;
        if(passwordLen < 6){
            document.getElementById("checkPasswordLen").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>The password must be at least 6 characters long";
            document.getElementById("checkPasswordLen").style.color = "red";
        }
        else{
            document.getElementById("checkPasswordLen").innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>The password can be used!";
            document.getElementById("checkPasswordLen").style.color = "#4CAF50";
        }

    }
</script>
<?php $this->end('script') ?>