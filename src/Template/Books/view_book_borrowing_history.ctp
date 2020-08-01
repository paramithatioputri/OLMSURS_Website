<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); ?>

<h3 class="heading">Book Borrowing History</h3>
<hr/>

<div class="card-container">
<?php if(!empty($borrowerBookStatuses)){
foreach($borrowerBookStatuses as $borrowerBookStatus){ ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                <?php if(empty($borrowerBookStatus->book_copy->book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                <?php } else{?>
                    <?= $this->Html->image(h($borrowerBookStatus->book_copy->book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                <?php }?>
                </div>
                <div class="col-md-7 book-container">
                    <p><b>Book Call Number: </b><?= h($borrowerBookStatus->book_call_number) ?></p>
                    <p><b>Book Title: </b><?= h($borrowerBookStatus->book_copy->book->title) ?></p>
                    <p><b>Author: </b><?= h($borrowerBookStatus->book_copy->book->author) ?></p>
                    <p><b>Date Checked Out: </b><?= isset($borrowerBookStatus->book_checkout_date) ? $borrowerBookStatus->book_checkout_date : '-' ?></p>
                    <p><b>Date Returned: </b><?= isset($borrowerBookStatus->book_return_date) ? $borrowerBookStatus->book_return_date : '-' ?></p>
                </div>
            </div>
        </div>
    </div>
<?php
} } else{ ?>
    <div class="card-container">
        <div class="card" id="no-book-found">
            <div class="card-body">
                <h5 class="card-title">You have not borrowed any books from the library</h5>
            </div>
        </div>
    </div>
<?php } ?> 
</div>

<?php $this->append('css') ?>
<style>
    .rate-book-btn{
        padding: 10px;
        width: 150px;
        font-size: 15px;
        float: right;
    }

    #no-book-found{
        margin: 15% 0;
        background-color:#FFCD94;
        
    }
    
    .card{
        margin: 15px 0;
        text-align: center;
    }

    .book-container p {
        margin: 0;
    }

    .heading{
        font-weight: bold !important;
    }

</style>
<?php $this->end('css') ?>