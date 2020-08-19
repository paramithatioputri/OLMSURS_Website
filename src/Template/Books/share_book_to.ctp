<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?php echo $this->element('header'); 
echo $this->element('share-book-msg-modal', [
    'borrowerLists' => $borrowerLists,
    'book' => $book,
]);
?>

<h3 class="heading">Share This Book To: </h3>
<hr/>
<form>
    <label>Search: </label>
    <div class="search-container">
        <input id="search-allborrower" autofocus type="text" name="search_borrower" placeholder="Enter borrower name" value="<?= isset($all_borrowers_accounts) ? $all_borrowers_accounts : '' ?>" />
        <button id="search-btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
    </div>
</form>

<div class="borrower-list">
    <?php foreach($borrowerLists as $borrowerList){ ?>
    <div class="row">
        <div class="col-">
        <?php if(empty($borrowerList->profile_image)){ 
            if($borrowerRating->gender == "Male"){?>
                <?= $this->Html->image('../img/no-profile-male.png', ['alt' => 'no-profile-male', 'class' => 'profile-image']); ?>
            <?php } else if($borrowerList->gender == "Female"){ ?>
                <?= $this->Html->image('../img/no-profile-female.jpg', ['alt' => 'no-profile-female', 'class' => 'profile-image']); ?>
            <?php
            }}else{ ?>
            <?= $this->Html->image(h($borrowerList->profile_image), ['alt' => 'profile-image', 'class' => 'profile-image']); ?>
        <?php } ?>
        </div>
        <div class="col">
            <label><?= $borrowerList->first_name ?> <?= $borrowerList->last_name ?></label>
            <button class="btn btn-outline-warning share-btn" data-toggle="modal" data-target="#shareBookMsgModalCenter<?= $borrowerLists->user_id ?>">Share</button>
            <hr/>
        </div>
    </div>
    <?php } ?>
</div>

<?php $this->append('css') ?>
<style>
    div.borrower-list{
        overflow: scroll;
        height: 40em;
        margin: 2em auto;
        padding: 1em 2em;
        border: 1px solid;
    }

    .share-btn{
        float: right;
        width: 5em;
    }

    .share-btn:hover{
        font-weight: normal;
        -ms-transform:scale(1.0,1.0);
        transform:scale(1.0,1.0);
        color: #FFFFFF;
    }

    .profile-image{
        padding: 0;
        margin-right: 10px;
        width:2.5em;
        height:2.5em;
        border-radius: 50%;
    }

</style>
<?php $this->end('css') ?>