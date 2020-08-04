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
    <div id="synopsis">
        <h4><?= __('Synopsis') ?></h4>
        <?php
            if(!empty($book->synopsis)){ ?>
                <?= $this->Text->autoParagraph(h($book->synopsis)); ?>
            <?php }else{ ?>
            <div>
                <p class="text-center no-synopsis">The synopsis of this book is not available</p>
            </div>
         <?php   }
        ?>
        
    </div>
    <h4 id="comments">Comments</h4>
    
    <?php if(!empty($borrowerRatings)){
    foreach($borrowerRatings as $borrowerRating){ ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-">
                <?php if(empty($borrowerRating->user->profile_image)){ 
                    if($borrowerRating->user->gender == "Male"){?>
                        <?= $this->Html->image('../img/no-profile-male.jpg', ['alt' => 'no-profile-male', 'class' => 'profile-image']); ?>
                    <?php } else if($borrowerRating->user->gender == "Female"){ ?>
                        <?= $this->Html->image('../img/no-profile-female.jpg', ['alt' => 'no-profile-female', 'class' => 'profile-image']); ?>
                    <?php
                    }}else{ ?>
                    <?= $this->Html->image(h($borrowerRating->user->profile_image), ['alt' => 'profile-image', 'class' => 'profile-image']); ?>
                <?php } ?>
                </div>
                <div class="col-">
                    <p class="borrower-name"><?= h($borrowerRating->user->first_name) ?> <?= h($borrowerRating->user->last_name) ?></p>
                    <input value="<?= h($borrowerRating->rating_given) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($borrowerRating->user_id) ?>">
                    <div class="rateit" data-rateit-backingfld="#<?= h($borrowerRating->user_id) ?>"></div>
                </div>
            </div>
            <?php if(!empty($borrowerRating->comment)){ ?>
                <p class="comment-exist"><i class="fa fa-quote-left" aria-hidden="true"></i> <?= h($borrowerRating->comment) ?> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
            <?php } else{ ?>
                <p class="no-comment">No comments available</p>
            <?php } ?>
        </div>
    </div>
    <?php }}else{ ?>
        <div class="text-center">
            <p class="no-comment">No comments available</p>
        </div>
        
    <?php } ?>
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

    #synopsis{
        margin-bottom: 8em;
    }

    .borrower-name {
        margin-bottom: 0;
        font-weight: bold;
    }

    .card{
        margin-bottom: 1em;
    }

    .no-comment, .no-synopsis{
        color: grey;
        font-style: italic;
    }

    .profile-image{
        padding: 0;
        margin-right: 10px;
        width:2.5em;
        height:2.5em;
        border-radius: 50%;
    }

    .fa-quote-left, .fa-quote-right{
        color: #FFA500;
    }
</style>
<?php $this->end('css') ?>