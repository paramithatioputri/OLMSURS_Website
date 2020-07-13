<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>
<div class="librarians view content">
    <h3>Librarian ID: <?= h($librarian->user_id) ?></h3>
    <div class="image">
        <?php if(empty($librarian->profile_image)){ 
            if($librarian->gender == "Male"){?>
                <?= $this->Html->image('../img/no-profile-male.jpg', ['width' => '300', 'alt' => 'no-profile-male']); ?>
            <?php } else if($librarian->gender == "Female"){ ?>
                <?= $this->Html->image('../img/no-profile-female.jpg', ['width' => '300', 'alt' => 'no-profile-female']); ?>
            <?php
            }}else{ ?>
            <?= $this->Html->image(h($librarian->profile_image), ['width' => '300', 'alt' => 'profile-image']); ?>
        <?php } ?>
    </div>
    <div>
        <label>First Name: </label>
        <label><?= h($librarian->first_name) ?></label>
    </div>
    <div>
        <label>Last Name: </label>
        <label><?= h($librarian->last_name) ?></label>
    </div>
    <div>
        <label>Email Address: </label>
        <label><?= h($librarian->email_address) ?></label>
    </div>
    <div>
        <label>Mobile Number: </label>
        <label><?= h($librarian->mobile_no) ?></label>
    </div>
    <div>
        <label>Date of Birth: </label>
        <label><?= h($librarian->date_of_birth) ?></label>
    </div>
    <div>
        <label>Gender: </label>
        <label><?= h($librarian->gender) ?></label>
    </div>
    <div>
        <label>Account Status: </label>
        <label><?= h($librarian->account_status) ?></label>
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