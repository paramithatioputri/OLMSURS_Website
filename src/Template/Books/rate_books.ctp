<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); 
echo $this->element('rate-book-modal', [
    'borrowerBookRatings' => $borrowerBookRatings,
]); ?>

<h3 class="heading">List of Books to be Rated</h3>
<hr/>

<div class="card-container">
<?php if(!empty($borrowerBookRatings)){
foreach($borrowerBookRatings as $borrowerBookRating){ ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                <?php if(empty($borrowerBookRating->book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                <?php } else{?>
                    <?= $this->Html->image(h($borrowerBookRating->book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                <?php }?>
                </div>
                <div class="col-md-7 book-container">
                    <p><b>Book Number: </b><?= h($borrowerBookRating->book_number) ?></p>
                    <p><b>Book Title: </b><?= h($borrowerBookRating->book->title) ?></p>
                    <p><b>Author: </b><?= h($borrowerBookRating->book->author) ?></p>
                    <div>
                        <input readonly="readonly" value="<?= isset($borrowerBookRating->rating_given) ? $borrowerBookRating->rating_given : '0' ?>" min="0" max="5" step="0.1" id="rated<?= h($borrowerBookRating->rating_id) ?>">
                        <div class="rateit" data-rateit-backingfld="#rated<?= h($borrowerBookRating->rating_id) ?>"></div>
                    </div>
                </div>
                <div class="col-md-2 book-btn">
                <?php if(!empty($borrowerBookRating->rating_given)){ ?>
                    <button class="rate-book-btn no-transform" disabled><i class="fa fa-check"></i> Rated</button>
                <?php } else{ ?>
                    <button class="rate-book-btn" data-toggle="modal" data-target="#rateBookModalCenter<?= $borrowerBookRating->rating_id ?>">Rate Book</button>
                <?php  }?>
                </div>
            </div>
        </div>
    </div>
<?php 
}} else{ ?>
    <div class="card-container">
        <div class="card" id="no-book-found">
            <div class="card-body">
                <h5 class="card-title">You have not borrowed any books from the library</h5>
            </div>
        </div>
    </div>
<?php }?> 
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
        text-align: center;
    }

    .book-container p {
        margin: 0;
    }

    .no-transform:hover{
        -ms-transform: scale(1.0,1.0);
        transform: scale(1.0,1.0);
        font-weight: normal;
    }

    .heading{
        font-weight: bold !important;
    }

    .card{
        margin: 15px 0;
        text-align: center;
    }


</style>
<?php $this->end('css') ?>