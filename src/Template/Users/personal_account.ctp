<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('change-password-modal')?>

<?php echo $this->element('header');
    $genders = ["Select Gender", "Male", "Female"];
?>

<h3 class="heading">Personal Account</h3>
<hr/>

<div class="borrowers view content">
    <div class="image-container">
        <?php if(empty($borrower->profile_image)){ 
            if($borrower->gender == "Male"){?>
                <?= $this->Html->image('../img/no-profile-male.png', ['width' => '300', 'alt' => 'no-profile-male', 'class' => 'image']); ?>
            <?php } else if($borrower->gender == "Female"){ ?>
                <?= $this->Html->image('../img/no-profile-female.jpg', ['width' => '300', 'alt' => 'no-profile-female', 'class' => 'image']); ?>
            <?php
            }}else{ ?>
            <?= $this->Html->image(h($borrower->profile_image), ['width' => '300', 'alt' => 'profile-image', 'class' => 'image']); ?>
        <?php } ?>
    </div>
    <div class="text-center">
        <label><b>Account Status: </b></label>
        <label><i class="fa fa-check" style="color: green;" aria-hidden="true"></i> <?= h($borrower->account_status) ?></label>
    </div>
    <?php
        echo $this->Form->create("UpdatePersonalAccount", ['onsubmit' => "return confirm(\"Are you sure to perform this action? Once you confirm, the personal info will be updated.\");"]);
        echo $this->Form->control("user_id", ["disabled", "value" => $borrower->user_id, "type" => "text", "class" =>"form-update", "placeholder" => "Enter your borrower ID", "label" => "Borrower ID"]);
        echo $this->Form->control("first_name", ["type" => "text", "value" => $borrower->first_name, "class" =>"form-update", "placeholder" => "Enter your first name", "required"]);
        echo $this->Form->control("last_name", ["type" => "text", "value" => $borrower->last_name, "class" =>"form-update", "placeholder" => "Enter your last name", "required"]);
        echo $this->Form->control("email_address", ["type" => "email", "value" => $borrower->email_address, "class" =>"form-update", "placeholder" => "Enter your email address", "required"]); 
        echo $this->Form->control("mobile_no", ["type" => "text", "value" => $borrower->mobile_no, "pattern" => "\d*", "minlength" => 10, "maxlength" => 13, "title" => "Number format only with length 10 - 13", "placeholder" => "Enter your mobile number", "required"]); ?>
        <div class="input-group date form-update">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
            <?= $this->Form->control('date_of_birth', ['type' => 'text', "value" => date("Y-m-d", strtotime($borrower->date_of_birth)), 'class' => 'form-control datepicker', "class" =>"form-update", 'placeholder' => 'Enter your date of birth','id' => 'datepickerDob', "required"]); ?>
        </div>
        <div class="form-group form-update">
            <label>Gender</label>
            <select name ="gender" required>
                <?php foreach($genders as $gender){ ?>
                <option <?php 
                    if($gender == 'Select Gender'){
                        echo "disabled";
                    }
                    if($borrower->gender === $gender){ echo "selected='selected'";} ?> value="<?= $gender ?>">
                <?= $gender ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="text-center">
        <?php
        echo $this->Form->button(__("UPDATE PROFILE"), ['id' => "update-profile-btn"]);
        ?>
        </div>
        <?php
        echo $this->Form->end(); 
        ?>

        <div id="changePassword-container">
            <button id="changePasswordBtn" data-toggle="modal" data-target="#changePasswordModalCenter"><i class="fa fa-lock"></i> Change Password</button>
        </div>

</div>

<?php $this->append('css')?>
<style>
    body{
        margin: 0;
        padding: 0;
    }

    label{
        font-size: 18px;
    }

    .image-container{
        text-align: center;
        margin-bottom: 2em;
    }

    .heading{
        font-weight: bold;
    }

    .image{
        border: 5px solid #000000;
    }

    .datepicker {
        width: 500px;
    }

    #changePasswordBtn, .fa-lock{
        color: #0000EE;
    }

    #changePassword-container{
        margin: 1.5em auto;
        text-align: right;
    }

    #changePasswordBtn{
        width: 10em;
        text-align: right;
        background-color: transparent;
        font-size: 1em;
        padding: 0;
    }

    #changePasswordBtn:hover{
        text-decoration: underline;
        font-weight: normal;
        -ms-transform:scale(1.0,1.0);
        transform:scale(1.0,1.0);
        transition: 0;
    }
</style>
<?php $this->end('css')?>

<?php $this->append('script') ?>
<script>
$(function(){
    
    $("#datepickerDob").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
});
</script>
<?php $this->end('script') ?>