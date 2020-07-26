<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>
<div class="borrowers view content">
    <h3>Borrower ID:<?= h($borrower->user_id) ?></h3>
    <div class="image">
        <?php if(empty($borrower->profile_image)){ 
            if($borrower->gender == "Male"){?>
                <?= $this->Html->image('../img/no-profile-male.jpg', ['width' => '300', 'alt' => 'no-profile-male']); ?>
            <?php } else if($borrower->gender == "Female"){ ?>
                <?= $this->Html->image('../img/no-profile-female.jpg', ['width' => '300', 'alt' => 'no-profile-female']); ?>
            <?php
            }}else{ ?>
            <?= $this->Html->image(h($borrower->profile_image), ['width' => '300', 'alt' => 'profile-image']); ?>
        <?php } ?>
    </div>
    <div>
        <label>First Name: </label>
        <label><?= h($borrower->first_name) ?></label>
    </div>
    <div>
        <label>Last Name: </label>
        <label><?= h($borrower->last_name) ?></label>
    </div>
    <div>
        <label>Email Address: </label>
        <label><?= h($borrower->email_address) ?></label>
    </div>
    <div>
        <label>Mobile Number: </label>
        <label><?= h($borrower->mobile_no) ?></label>
    </div>
    <div>
        <label>Date of Birth: </label>
        <label><?= h($borrower->date_of_birth) ?></label>
    </div>
    <div>
        <label>Gender: </label>
        <label><?= h($borrower->gender) ?></label>
    </div>
    <div>
        <label>Account Status: </label>
        <label><?= h($borrower->account_status) ?></label>
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

    .image{
        text-align: center;
    }
</style>
<?php $this->end('css')?>