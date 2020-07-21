<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>

<h3><?= __('Returning Books') ?></h3>
<div>
    <form>
        <label>Search: </label>
        <div id="search-input-container">
            <input autofocus type="text" name="borrower_return_q" placeholder="Enter borrower ID" value="<?= isset($return_books) ? $return_books : '' ?>" />
        </div>
        <div class="search-btn-container">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
        </div>
    </form>
</div>
<?php if(!empty($borrowerTransacts)){ ?>
<div>
    <p>Borrower ID: <?= h($borrower->user_id) ?></p>
    <p>Borrower Name: <?= h($borrower->first_name) ?> <?= h($borrower->last_name) ?></p>
    <p>Total Fines: <a href="fines/<?= $borrower->user_id ?>"><b>RM<?= isset($borrower->total_fines) ? $borrower->total_fines : '0' ?></b></a></p>
    <p>Books Taken: <?= isset($borrower->num_of_books_taken) ? $borrower->num_of_books_taken : '0' ?></p>
</div>
<div>
    <table class="table-bordered table-hover">
        <thead>
            <th></th>
            <th>Item</th>
            <th>Actions</th>
        </thead>
        <tbody>
        <?php foreach($borrowerTransacts as $borrowerTransact){ ?>
            <tr>
                <td class="images">
                <?php if(empty($borrowerTransact->book_copy->book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                <?php } else{?>
                    <?= $this->Html->image(h($borrowerTransact->book_copy->book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                <?php }?>
                </td>
                <td>
                    <p><b>Book Call Number: </b><?= h($borrowerTransact->book_call_number) ?></p>
                    <p><b>Book Number: </b><?= h($borrowerTransact->book_copy->book->book_number) ?></p>
                    <p><b>Issue Date: </b><?= h($borrowerTransact->book_checkout_date) ?></p>
                    <p><b>Due Date: </b><?= h($borrowerTransact->book_date_due) ?></p>
                </td>
                <td class="actions">
                    <?=  $this->Form->create('return_book', ['id' => 'submit-form'])?>
                        <button name="borrower-transaction" class="return-book-btn" value="<?= $borrowerTransact->user_id?> <?= $borrowerTransact->book_call_number ?>">Return Book</button>
                    <?= $this->Form->end() ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php }else{ ?>
    <div class="card-container">
        <div class="card" id="borrower-not-found">
            <div class="card-body">
                <h5 class="card-title">Please enter complete borrower ID</h5>
            </div>
        </div>
    </div>
<?php } ?>

<?php $this->append('css') ?>
<style>
    .return-book-btn{
        padding: 10px;
        width: 110px;
        font-size: 15px;
    }

    .actions{
        text-align: center;
        vertical-align: middle;
    }

    .images{
        text-align: center;
        vertical-align: middle;
    }

    .card-body{
        text-align: center;
    }

    #borrower-not-found{
        background-color:#FFCD94;
    } 

    .card-container{
        margin-top: 15%;
    }
</style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
    // function returnThisBook(val){
    //     var returnBookForm = document.getElementById('submit-form');
    //     console.log(returnBookForm);
    // }
</script>
<?php $this->end('script') ?>