<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>
<div class="books view content">
    <h3><?= h($book->title) ?></h3>   
    <div class="row">
        <div class="col-md-4">
            <div class="image">
                <?php if(empty($book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '300', 'alt' => 'no-book-cover-image']); ?>
                <?php }else{ ?>
                    <?= $this->Html->image(h($book->book_cover_image), ['width' => '300', 'alt' => 'book-cover-image']); ?>
                <?php } ?>
            </div>
            <div class="average-rating-class">
                <label>
                    <div name="average_rating">
                        <input value="<?= h($book->average_rating) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($book->book_number) ?>">
                        <div class="rateit" data-rateit-backingfld="#<?= h($book->book_number) ?>"></div>
                    </div>
                    <div class="recommended-text">
                        <?php if($book->average_rating >= 4){ ?>
                            <b style="color: #28A745;">Recommended!</b> <i class="fa fa-thumbs-up" style="color:#FCC200;" aria-hidden="true"></i>
                        <?php }else if(empty($book->average_rating)){ ?>
                            <b style="color: #90949C;">Not rated yet!</b>
                        <?php } ?>
                    </div>
                    <div>
                        <?php if(isset($totalBorrowersRateThisBook) && $totalBorrowersRateThisBook > 0 && $book->average_rating > 0){ ?>
                            <span class="numberBorrowersRate"><?= h($totalBorrowersRateThisBook) ?> borrowers rated this book.</span>
                        <?php } ?>
                    </div>
                </label>
            </div>
        </div>

        <div class="col-md-5">
            <div>
                <label><b>Status: </b></label>
                <label><?= isset($totalBookCopies) ? 'Available' : 'On Loan' ?></label>
            </div>
            <div>
                <label><b>Book Number: </b></label>
                <label><?= h($book->book_number) ?></label>
            </div>
            <div>
                <label><b>ISBN: </b></label>
                <label><?= h($book->isbn) ?></label>
            </div>
            <div>
                <label><b>Title: </b></label>
                <label><?= h($book->title) ?></label>
            </div>
            <div>
                <label><b>Author: </b></label>
                <label><?= h($book->author) ?></label>
            </div>
            <div>
                <label><b>Publisher: </b></label>
                <label><?= h($book->publisher) ?></label>
            </div>
            <div>
                <label><b>Subject: </b></label>
                <label><?= $book->has('subject') ? $book->subject->subject_name : '-' ?></label>
            </div>
            <div>
                <label><b>Language: </b></label>
                <label><?= $book->has('language') ? $book->language->language_name : '-' ?></label>
            </div>
            <div>
                <label><b>Number of Pages: </b></label>
                <label><?= $this->Number->format($book->num_of_pages) ?></label>
            </div>
        </div>
        <div class="col-md-3 num-of-copies">
            <label><b>Number of Copies: </b></label>
            <label><?= !empty($totalBookCopies) ? $totalBookCopies : '0' ?></label>
        </div>
    </div>
    <div>
        <h4><?= __('Synopsis') ?></h4>
        <?= $this->Text->autoParagraph(h($book->synopsis)); ?>
    </div>
</div>

<?php $this->append('css') ?>
<style>
    .average-rating-class{
        text-align:center;
    }

    .image{
        margin-bottom: 10px;
        border: 5px solid #000000;
    }

    .recommended-text{
        font-size: 20px;
        font-weight: bold;
    }

    .num-of-copies{
        text-align: right;
    }

    .numberBorrowersRate{
        font-weight: bold;
    }

</style>
<?php $this->end('css') ?>