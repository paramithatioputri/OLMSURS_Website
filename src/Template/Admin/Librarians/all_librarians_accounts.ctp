<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>
<h3 class="heading">All Librarians' Accounts: <?= h($totLibrarians) ?></h3>
<hr/>

<form>
    <label>Search: </label>
    <div class="search-container">
        <input id="search-allLibrarian" autofocus type="text" name="search_librarian" placeholder="Enter librarian ID" value="<?= isset($all_librarians_accounts) ? $all_librarians_accounts : '' ?>" />
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
        <?php foreach ($librarians as $librarian): ?>
        <tr>
            <td class="wrapper">
                <div class="row">
                    <div class="col-md-5">
                        <div>
                        <?php if(empty($librarian->profile_image)){ 
                            if($librarian->gender == "Male"){?>
                                <?= $this->Html->image('../img/no-profile-male.png', ['width' => '200', 'alt' => 'no-profile-male', 'class' => "image"]); ?>
                            <?php } else if($librarian->gender == "Female"){ ?>
                                <?= $this->Html->image('../img/no-profile-female.jpg', ['width' => '200', 'alt' => 'no-profile-female', 'class' => "image"]); ?>
                            <?php
                            }}else{ ?>
                            <?= $this->Html->image(h($librarian->profile_image), ['width' => '200', 'alt' => 'profile-image', 'class' => "image"]); ?>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="librarian-content col-md-7">
                        <p class="about-librarian"><b>Librarian ID: </b><?= h($librarian->user_id) ?></p>
                        <p class="about-librarian"><b>Librarian Name: </b><?= h($librarian->first_name) ?> <?= h($librarian->last_name) ?></p>
                        <p class="about-librarian"><b>Gender: </b><?= h($librarian->gender) ?></p>
                    </div>
                </div>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view_librarian_account', $librarian->user_id],['class' => 'button btn btn-outline-warning']) ?>
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

    .librarian-content{
        vertical-align: middle;
    }

    .table-bordered{
        margin-top: 30px;
    }

    .heading{
        font-weight: bold;
    }

    #search-allLibrarian, #search-btn{
        font-size: 20px;
        margin-bottom: 1em;
    }

    #search-allLibrarian{
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

    .about-librarian{
        margin: 0;
    }

    .btn-outline-warning:hover{
        color: #FFFFFF;
    }
</style>
<?php $this->end('css') ?>