<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<?php
    $role = ["Select Role", "Librarian", "Borrower"];
?>

<h3 class="heading">Register New Account</h3>
<hr/>

<?= $this->Form->create($user, ["enctype" => 'multipart/form-data','onsubmit' => "return confirm(\"Are you sure to perform this action? Once you confirm, the account will be created.\");"]);?>
<fieldset>
    <?php
        echo $this->Form->control("user_id", ["autofocus", "type" => "text", "pattern" => "\d*", "minlength" => 14, "maxlength" => 14, "title" => "Accept number format only, with length 14", "placeholder" => "Enter the user ID", "label" => "User ID"]);
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
        echo $this->Form->control("role", ["type" => "select", "options" => [
            "" => "Select Role",
            "1" => "Librarian",
            "2" => "Borrower"
        ]]);
        echo $this->Form->control("mobile_no", ["type" => "text", "pattern" => "\d*", "minlength" => 10, "maxlength" => 13, "title" => "Number format only with length 10 - 13", "placeholder" => "Enter the mobile number"]);
        ?>
        <div class="input-group date">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
            <?= $this->Form->control('date_of_birth', ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'Enter your date of birth','id' => 'datepickerDob']); ?>
        </div>
        <?php
        echo $this->Form->control("gender", ["type" => "select", "options" => [
            "" => "Select Gender",
            "1" => "Male",
            "2" => "Female"
        ]]);
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

    .datepicker {
        width: 500px;
    }

    .heading{
        font-weight: bold;
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

    $(function(){
        $("form").submit(function(e){
            if($("#password").val().length < 6){
              alert("The password entered must be at least 6 characters long");
                e.preventDefault(e);
            }
            else if($("#password").val() !== $("#confirmpassword").val()){
              alert("The password entered does not match!");
                e.preventDefault(e);
            }
        });
    });
        
    $(function(){
        $("#datepickerDob").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
<?php $this->end('script') ?>