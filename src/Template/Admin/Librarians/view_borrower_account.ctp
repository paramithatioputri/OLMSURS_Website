<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<div class="borrowers view content">
    <h3>Borrower ID: <?= h($borrower->user_id) ?></h3>
    <div class="image-container">
        <?php if(empty($borrower->profile_image)){ 
            if($borrower->gender == "Male"){?>
                <?= $this->Html->image('../img/no-profile-male.jpg', ['width' => '300', 'alt' => 'no-profile-male', 'class' => 'image']); ?>
            <?php } else if($borrower->gender == "Female"){ ?>
                <?= $this->Html->image('../img/no-profile-female.jpg', ['width' => '300', 'alt' => 'no-profile-female', 'class' => 'image']); ?>
            <?php
            }}else{ ?>
            <?= $this->Html->image(h($borrower->profile_image), ['width' => '300', 'alt' => 'profile-image', 'class' => 'image']); ?>
        <?php } ?>
    </div>
    <div>
        <label><b>First Name: </b></label>
        <label><?= h($borrower->first_name) ?></label>
    </div>
    <div>
        <label><b>Last Name: </b></label>
        <label><?= h($borrower->last_name) ?></label>
    </div>
    <div>
        <label><b>Email Address: </b></label>
        <label><?= h($borrower->email_address) ?></label>
    </div>
    <div>
        <label><b>Mobile Number: </b></label>
        <label><?= h($borrower->mobile_no) ?></label>
    </div>
    <div>
        <label><b>Date of Birth: </b></label>
        <label><?= h($borrower->date_of_birth) ?></label>
    </div>
    <div>
        <label><b>Gender: </b></label>
        <label><?= h($borrower->gender) ?></label>
    </div>
    <div>
        <label><b>Account Status: </b></label>
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

    .image-container{
        text-align: center;
    }

    .image{
        border: 5px solid #000000;
    }
</style>
<?php $this->end('css')?>