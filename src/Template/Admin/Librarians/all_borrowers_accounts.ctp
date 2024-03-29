<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<h3 class="heading">All Borrowers' Accounts: <?= h($totBorrowers) ?></h3>
<hr/>
<form>
    <label>Search: </label>
    <div class="search-container">
        <input id="search-allborrower" autofocus type="text" name="search_borrower" placeholder="Enter borrower ID" value="<?= isset($all_borrowers_accounts) ? $all_borrowers_accounts : '' ?>" />
        <button id="search-btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
    </div>
</form>


<table class="table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col" id="user_id"><?= $this->Paginator->sort('user_id') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($borrowers as $borrower): ?>
        <tr>
            <td class="wrapper">
                <div class="row">
                    <div class="col-md-5">
                        <div>
                        <?php if(empty($borrower->profile_image)){ 
                            if($borrower->gender == "Male"){?>
                                <?= $this->Html->image('../img/no-profile-male.png', ['width' => '200', 'alt' => 'no-profile-male', 'class' => "image"]); ?>
                            <?php } else if($borrower->gender == "Female"){ ?>
                                <?= $this->Html->image('../img/no-profile-female.jpg', ['width' => '200', 'alt' => 'no-profile-female', 'class' => "image"]); ?>
                            <?php
                            }}else{ ?>
                            <?= $this->Html->image(h($borrower->profile_image), ['width' => '200', 'alt' => 'profile-image', 'class' => "image"]); ?>
                        <?php } ?>
                        
                        </div>
                    </div>
                    <div class="borrower-content col-md-7">
                        <p class="about-borrower"><b>Borrower ID: </b><?= h($borrower->user_id) ?></p>
                        <p class="about-borrower"><b>Borrower Name: </b><?= h($borrower->first_name) ?> <?= h($borrower->last_name) ?></p>
                        <p class="about-borrower"><b>Gender: </b><?= h($borrower->gender) ?></p>
                    </div>
                </div>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view_borrower_account', $borrower->user_id],['class' => 'button btn btn-outline-warning']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>




<?php $this->append('css') ?>
<style>
    .image{
        float: left;
        margin-right: 10px;
    }

    .actions{
        text-align: center;
        vertical-align: middle;
    }

    .borrower-content{
        vertical-align: middle;
    }

    .table-bordered{
        margin-top: 30px;
    }

    .heading{
        font-weight: bold;
    }

    #search-allborrower, #search-btn{
        font-size: 20px;
        margin-bottom: 1em;
    }

    #search-allborrower{
        margin-top: 5px;
        width: 80%;
        height: 2.5em;
        margin-right: 20px;
    }

    .search-container{
        display: flex;
        flex-wrap: wrap;
    }
        
    #search-btn{
        margin-bottom: 20px;
        width: 10em;
    }

    .about-borrower{
        margin: 0;
    }

    .btn-outline-warning:hover{
        color: #FFFFFF;
    }
</style>
<?php $this->end('css') ?>