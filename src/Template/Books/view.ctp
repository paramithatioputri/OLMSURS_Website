<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>
<div class="books view content">
    <h3><?= h($book->title) ?></h3>   
    <div class="row">
        <div class="col-md-4">
            <div class="image">
                <?php if(empty($book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '300', 'alt' => 'no-book-cover-image', 'class' => 'img']); ?>
                <?php }else{ ?>
                    <?= $this->Html->image(h($book->book_cover_image), ['width' => '300', 'alt' => 'book-cover-image', 'class' => 'img']); ?>
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
                <label><?= isset($totalBookCopies) && $totalBookCopies > 0 ? 'Available' : 'Not Available' ?></label>
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
            <?php if(!empty($rateThisBook->rating_given)){ ?>
            <label id="book-is-rated"><i class="fa fa-star" aria-hidden="true"></i> <span>You have rated this book!</span></label>
            <?php } ?>
            <label><b>Number of Copies: </b></label>
            <label><?= !empty($totalBookCopies) ? $totalBookCopies : '0' ?></label>
            <?php if(isset($auth_user['role']) && $auth_user['role'] === 'borrower'){ ?>
            <?= $this->Html->link('Share this book', ['controller' => 'books', 'action' => 'share_book_to/' . $book->book_number], ['class' => 'btn btn-outline-warning share-this-book-btn']) ?>
            <?php } ?>
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
    <h4 id="comments">Reviews</h4>
    
    <?php if(!empty($borrowerRatings)){
    foreach($borrowerRatings as $borrowerRating){ ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-">
                <?php if(empty($borrowerRating->user->profile_image)){ 
                    if($borrowerRating->user->gender == "Male"){?>
                        <?= $this->Html->image('../img/no-profile-male.png', ['alt' => 'no-profile-male', 'class' => 'profile-image']); ?>
                    <?php } else if($borrowerRating->user->gender == "Female"){ ?>
                        <?= $this->Html->image('../img/no-profile-female.jpg', ['alt' => 'no-profile-female', 'class' => 'profile-image']); ?>
                    <?php
                    }}else{ ?>
                    <?= $this->Html->image(h($borrowerRating->user->profile_image), ['alt' => 'profile-image', 'class' => 'profile-image']); ?>
                <?php } ?>
                </div>
                <?php if($borrowerRating->user_id === $auth_user['user_id'] && $auth_user['role'] == "borrower"){ ?>
                <div class="col" id="update-review">
                    <?= $this->Form->create('updateBookRating');?>
                    <div>
                        <div>
                            <p class="borrower-name"><?= h($auth_user['first_name']) ?> <?= h($auth_user['last_name']) ?></p>
                            <input required value="<?= h($borrowerRating->rating_given) ?>" name="rating_given" min="0" max="5" step="0.1" id="rating-from-borrower">
                            <div class="rateit" data-rateit-backingfld="#rating-from-borrower"></div>
                            <label id="rating-required"></label>
                        </div>
                        <label for="auth-comment"><b>Review:</b></label>
                        <textarea class="form-control borrower-comment" id="auth-comment" name="comment" placeholder="Enter your comment here. . ."><?= h($borrowerRating->comment) ?></textarea>
                    </div>
                    <button name="book_number" value="<?= $book->book_number ?>" type="submit" class="btn btn-outline-warning save-rating-btn">Save the Rating</button>
                    <?= $this->Form->end() ?>
                </div>
                <?php } ?>

                <?php if($borrowerRating->user_id === $auth_user['user_id'] && $auth_user['role'] == "borrower"){ ?>
                <div class="col <?= h($auth_user['user_id']) ?>">
                    <p class="borrower-name"><?= h($borrowerRating->user->first_name) ?> <?= h($borrowerRating->user->last_name) ?></p>
                    <input value="<?= h($borrowerRating->rating_given) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($borrowerRating->user_id) ?>">
                    <div class="rateit" data-rateit-backingfld="#<?= h($borrowerRating->user_id) ?>"></div>
                    <div>
                        <?php if($borrowerRating->user_id === $auth_user['user_id'] && $auth_user['role'] == "borrower"){ ?>
                        <?php if(!empty($borrowerRating->comment)){ ?>
                            <p class="comment-exist <?= h($auth_user['user_id']) ?>"><i class="fa fa-quote-left" aria-hidden="true"></i> <?= h($borrowerRating->comment) ?> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                        <?php } else{ ?>
                            <p class="no-comment <?= h($auth_user['user_id']) ?>">No reviews available</p>
                        <?php } ?>
                        <?php }else{ ?>
                        <?php if(!empty($borrowerRating->comment)){ ?>
                            <p class="comment-exist current-review"><i class="fa fa-quote-left" aria-hidden="true"></i> <?= h($borrowerRating->comment) ?> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                        <?php } else{ ?>
                            <p class="no-comment current-review">No reviews available</p>
                        <?php }} ?>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="col current-review">
                    <p class="borrower-name"><?= h($borrowerRating->user->first_name) ?> <?= h($borrowerRating->user->last_name) ?></p>
                    <input value="<?= h($borrowerRating->rating_given) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($borrowerRating->user_id) ?>">
                    <div class="rateit" data-rateit-backingfld="#<?= h($borrowerRating->user_id) ?>"></div>
                    <div>
                        <?php if($borrowerRating->user_id === $auth_user['user_id'] && $auth_user['role'] == "borrower"){ ?>
                        <?php if(!empty($borrowerRating->comment)){ ?>
                            <p class="comment-exist <?= h($auth_user['user_id']) ?>"><i class="fa fa-quote-left" aria-hidden="true"></i> <?= h($borrowerRating->comment) ?> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                        <?php } else{ ?>
                            <p class="no-comment <?= h($auth_user['user_id']) ?>">No reviews available</p>
                        <?php } ?>
                        <?php }else{ ?>
                        <?php if(!empty($borrowerRating->comment)){ ?>
                            <p class="comment-exist current-review"><i class="fa fa-quote-left" aria-hidden="true"></i> <?= h($borrowerRating->comment) ?> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                        <?php } else{ ?>
                            <p class="no-comment current-review">No reviews available</p>
                        <?php }} ?>
                    </div>
                </div>
                <?php } ?>
                
                <div class="col-2">
                    <?php if($borrowerRating->user_id === $auth_user['user_id'] && $auth_user['role'] === 'borrower'){ ?>
                    <?= $this->Form->create('delete-rating', ['controller' => 'books', 'action' => 'delete_borrower_rating']); ?>
                        <button name="rating-id-deleted" value="<?= $borrowerRating->rating_id ?>" class="delete-icon float-right"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <?= $this->Form->end(); ?>
                    <button id="update-icon-id" class="update-icon float-right"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php }}else{ ?>
    <div class="text-center">
        <p class="no-comment">No reviews available</p>
    </div>
    <hr/>
    <?php } ?>
    <?php if(isset($auth_user['role']) && $auth_user['role'] === 'borrower' && (empty($rateThisBook) || empty($rateThisBook->rating_given) || $rateThisBook->rating_given == 0)){ ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-">
                    <?php if(empty($auth_user['profile_image'])){ 
                        if(isset($auth_user['gender']) && $auth_user['gender'] == "Male"){?>
                            <?= $this->Html->image('../img/no-profile-male.png', ['alt' => 'no-profile-male', 'class' => 'profile-image']); ?>
                        <?php } else if(isset($auth_user['gender']) && $auth_user['gender'] == "Female"){ ?>
                            <?= $this->Html->image('../img/no-profile-female.jpg', ['alt' => 'no-profile-female', 'class' => 'profile-image']); ?>
                        <?php
                        }}else{ ?>
                        <?= $this->Html->image(h($auth_user['profile_image']), ['alt' => 'profile-image', 'class' => 'profile-image']); ?>
                    <?php } ?>
                </div>
                <div class="col">
                <p class="borrower-name"><?= h($auth_user['first_name']) ?> <?= h($auth_user['last_name']) ?></p>
                <?= $this->Form->create('rateBook');?>
                <div>
                    <div>
                        <input required name="rating_given" min="0" max="5" value="0" step="0.1" id="rating-from-borrower">
                        <div class="rateit" data-rateit-backingfld="#rating-from-borrower"></div>
                        <label id="rating-required"></label>
                    </div>
                    <label for="auth-comment"><b>Review:</b></label>
                    <textarea autofocus class="form-control borrower-comment" id="auth-comment" name="comment" placeholder="Enter your comment here. . ."></textarea>
                </div>
                <button name="book_number" value="<?= $book->book_number ?>" type="submit" class="btn btn-outline-warning save-rating-btn">Save the Rating</button>
                <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
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
    }

    .img{
        margin: 0;
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
        margin-bottom: 3em;
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

    #rating-required{
        margin: 0;
        padding-left: 1em;
        color: red;
        font-style: italic;
        font-weight: bold;
    }

    .save-rating-btn{
        width: auto;
        float: right;
    }

    .btn-outline-warning:hover{
        -ms-transform: scale(1.0,1.0);
        transform: scale(1.0,1.0);
        color: #FFFFFF;
        font-weight: normal;
    }

    .borrower-comment{
        margin-bottom: 1em;
    }

    .fa-star{
        color: #F9C70C;
        font-size: 1.5em;
    }

    #book-is-rated span{
        font-weight: bold;
        font-size: 1.4em;
        text-shadow: 2px 2px 5px #FFA500;
    }

    .update-icon, .delete-icon{
        padding: 0;
        width: 2.5em;
        margin-top: 10px;
        float: right;
    }

    .update-icon{
        background-color: #45B6FE;
    }

    .delete-icon{
        background-color: #FF2300;
    }

    .update-icon:hover{
        background-color: #037EFA;
    }

    .delete-icon:hover{
        background-color: #BF0000;
    }

    .update-icon:hover, .delete-icon:hover{
        font-weight: normal;
        -ms-transform:scale(1.0,1.0);
        transform:scale(1.0,1.0);
    }

    #update-review{
        display:none;
    }

    textarea{
        width: 100%;
    }

    .share-this-book-btn{
        margin: 1em auto;
    }

</style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
    $(document).ready(function(){
        var ratingFromBorrower = document.getElementById('rating-from-borrower');
        var ratingRequiredMsg = document.getElementById('rating-required');

        $("form").submit(function(e){
            if(ratingFromBorrower.value == 0){
                ratingRequiredMsg.innerHTML = "* Please give the rating";
                e.preventDefault(e);
            }
        });

        $("#update-icon-id").click(function(){
            $(".<?= $auth_user['user_id'] ?>").toggle();
            $("#update-review").toggle();
        });
    });
</script>
<?php $this->end('script') ?>