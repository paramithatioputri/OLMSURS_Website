<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<form>
    <label>Search: </label>
    <div id="search-input-container">
        <input autofocus type="text" name="search_borrower" placeholder="Enter borrower ID" value="<?= isset($all_borrowers_accounts) ? $all_borrowers_accounts : '' ?>" />
    </div>
    <div class="search-btn-container">
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
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
                <div>
                    <div>
                    <?php if(empty($borrower->profile_image)){ 
                        if($borrower->gender == "Male"){?>
                            <?= $this->Html->image('../img/no-profile-male.jpg', ['width' => '100', 'alt' => 'no-profile-male', 'class' => "image"]); ?>
                        <?php } else if($borrower->gender == "Female"){ ?>
                            <?= $this->Html->image('../img/no-profile-female.jpg', ['width' => '100', 'alt' => 'no-profile-female', 'class' => "image"]); ?>
                        <?php
                        }}else{ ?>
                        <?= $this->Html->image(h($borrower->profile_image), ['width' => '100', 'alt' => 'profile-image', 'class' => "image"]); ?>
                    <?php } ?>
                    
                    </div>
                </div>
                <div class="borrower-content">
                    <p><b>Borrower ID: </b><?= h($borrower->user_id) ?></p>
                    <p><b>Borrower Name: </b><?= h($borrower->first_name) ?> <?= h($borrower->last_name) ?></p>
                    <!-- <p><b>Email Address: </b><?= h($borrower->email_address) ?></p>
                    <p><b>Date of Birth: </b><?= h($borrower->date_of_birth) ?></p>
                    <p><b>Account Status: </b><?= h($borrower->account_status) ?></p>
                    <p><b>Mobile Number: </b><?= h($borrower->mobile_no) ?></p> -->
                    <p><b>Gender: </b><?= h($borrower->gender) ?></p>
                </div>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view_borrower_account', $borrower->user_id],['class' => 'button btn btn-primary']) ?>
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
    #search-input-container{
        display: flex;
        flex-wrap: wrap;
    }

    .search-btn-container{
        text-align:center;
    }

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
</style>
<?php $this->end('css') ?>