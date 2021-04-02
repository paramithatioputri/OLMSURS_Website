<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>

<h3 class="heading">List of Shared Books</h3>
<hr/>
<div class="card-container">
<?php if(!empty($listofBooksShared)){
foreach($listofBooksShared as $listofBookShared){
    foreach($senders as $sender){
        if($listofBookShared->sender_id === $sender->user_id){ ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-">
                <?php if(empty($sender->profile_image)){ 
                    if($sender->gender == "Male"){?>
                        <?= $this->Html->image('../img/no-profile-male.png', ['alt' => 'no-profile-male', 'class' => 'profile-image']); ?>
                    <?php } else if($sender->gender == "Female"){ ?>
                        <?= $this->Html->image('../img/no-profile-female.jpg', ['alt' => 'no-profile-female', 'class' => 'profile-image']); ?>
                    <?php
                    }}else{ ?>
                    <?= $this->Html->image(h($sender->profile_image), ['alt' => 'profile-image', 'class' => 'profile-image']); ?>
                <?php } ?>
                </div>
                <div class="col">
                    <p id="sender-name"><b><?= $sender->first_name ?> <?= $sender->last_name ?> shared this book to you</b></p>
                    <p id="shared-date"><i>Shared Date: <?= h($listofBookShared->date_shared) ?></i></p>
                </div>
                <div class="col-2"></div>
                <div class="col-2">
                    <?= $this->Html->link('View', ['controller' => 'books', 'action' => 'view' . '/' . $listofBookShared->book_number], ['class' => 'btn btn-outline-warning view-book-link']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                <?php if(empty($listofBookShared->book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                <?php } else{?>
                    <?= $this->Html->image(h($listofBookShared->book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                <?php }?>
                </div>
                <div class="col-md-7 book-container">
                    <p><b>Book Number: </b><?= h($listofBookShared->book_number) ?></p>
                    <p><b>Book Title: </b><?= h($listofBookShared->book->title) ?></p>
                    <p><b>Author: </b><?= h($listofBookShared->book->author) ?></p>
                    <p><b>Message:</b> <?= isset($listofBookShared->message) ? $listofBookShared->message : '-' ?></p>
                </div>
                
            </div>
        </div>
    </div>
<?php
}}} } else{ ?>
    <div class="card-container">
        <div class="card" id="no-book-found">
            <div class="card-body">
                <h5 class="card-title">There are no shared books sent from any borrowers</h5>
            </div>
        </div>
    </div>
<?php } ?> 
</div>

<?php $this->append('css') ?>
<style>
    #no-book-found{
        margin: 15% 0;
        background-color:#FFCD94;
        
    }
    
    .card{
        margin: 15px 0;
    }

    .book-container p {
        margin: 0;
    }

    .heading{
        font-weight: bold !important;
    }

    .profile-image{
        padding: 0;
        margin-right: 10px;
        width:2.5em;
        height:2.5em;
        border-radius: 50%;
    }

    .view-book-link{
        float: right;
    }

    .image{
        margin-left: 2em;
    }

    #sender-name, #shared-date{
        margin: 0;
    }

    #shared-date{
        margin-bottom: 1em;
        color: grey;
    }

    .heading{
        font-weight: bold;
    }

</style>
<?php $this->end('css') ?>