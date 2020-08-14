<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<?= $this->Form->create($user, ["enctype" => 'multipart/form-data', "id" => "form"]);?>
<fieldset>
    <legend><?= __('LIBRARY MEMBERSHIP REGISTRATION FORM') ?></legend>
    <?php
        echo $this->Form->control("user_id", ["autofocus", "type" => "text", "pattern" => "\d*", "minlength" => 14, "maxlength" => 14, "title" => "Accept number format only, with length 14", "placeholder" => "Enter your borrower ID", "label" => "Borrower ID"]);
        echo $this->Form->control("first_name", ["type" => "text", "placeholder" => "Enter your first name"]);
        echo $this->Form->control("last_name", ["type" => "text", "placeholder" => "Enter your last name"]);
        echo $this->Form->control("email_address", ["type" => "email", "placeholder" => "Enter your email address"]);
        echo $this->Form->control("password", ["type" => "password", "placeholder" => "Enter your password", "id" => "password", "oninput" => "checkPasswordMismatch(),checkPasswordLen()"]);?>
        <p class="checkPassword" id="checkPasswordLen"></p>
        <?php
        echo $this->Form->control("confirm_password", ["type" => "password", "placeholder" => "Re-enter your password", "id" => "confirmpassword", "oninput" => "checkPasswordMismatch()"]);
        ?>
        <p class="checkPassword" id="checkPasswordMismatch"></p>
        <?php
        echo $this->Form->control("mobile_no", ["type" => "text", "pattern" => "\d{10,13}", "title" => "Accept number format only with length 10 - 13", "placeholder" => "Enter your mobile number"]);
        ?>
        <div class="input-group date">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
            <?= $this->Form->control('date_of_birth', ['type' => 'text', 'class' => 'datepicker', 'placeholder' => 'Enter your date of birth','id' => 'datepickerDob']); ?>
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
            document.getElementById("checkPasswordLen").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>Your password must be at least 6 characters long";
            document.getElementById("checkPasswordLen").style.color = "red";
        }
        else{
            document.getElementById("checkPasswordLen").innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>The password can be used!";
            document.getElementById("checkPasswordLen").style.color = "#4CAF50";
        }

    }

    $(function(){
        $("#datepickerDob").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

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

</script>
<?php $this->end('script') ?>