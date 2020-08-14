<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header');
    $genders = ["Select Gender", "Male", "Female"];
?>

<div class="borrowers view content">
    <h3>Borrower ID: <?= h($borrower->user_id) ?></h3>
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
        echo $this->Form->create("UpdatePersonalAccount");
        echo $this->Form->control("user_id", ["disabled", "value" => $borrower->user_id, "type" => "text", "class" =>"form-update", "placeholder" => "Enter your borrower ID", "label" => "Borrower ID"]);
        echo $this->Form->control("first_name", ["required", "type" => "text", "value" => $borrower->first_name, "class" =>"form-update", "placeholder" => "Enter your first name"]);
        echo $this->Form->control("last_name", ["required", "type" => "text", "value" => $borrower->last_name, "class" =>"form-update", "placeholder" => "Enter your last name"]);
        echo $this->Form->control("email_address", ["required", "type" => "email", "value" => $borrower->email_address, "class" =>"form-update", "placeholder" => "Enter your email address"]); 
        echo $this->Form->control("mobile_no", ["required", "type" => "text", "value" => $borrower->mobile_no, "pattern" => "\d{10,13}", "title" => "Number format only with length 10 - 13", "placeholder" => "Enter your mobile number"]); ?>
        <div class="input-group date form-update">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
            <?= $this->Form->control('date_of_birth', ["required", 'type' => 'text', "value" => date("Y-m-d", strtotime($borrower->date_of_birth)), 'class' => 'form-control datepicker', "class" =>"form-update", 'placeholder' => 'Enter your date of birth','id' => 'datepickerDob']); ?>
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
    }

    .image{
        border: 5px solid #000000;
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