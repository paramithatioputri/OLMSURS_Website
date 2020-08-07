<!-- Modal -->
<?php foreach($borrowerBookRatings as $borrowerBookRating){ ?>
    <div class="modal fade" id="rateBookModalCenter<?= $borrowerBookRating->rating_id ?>" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="rateBookModalLongTitle">Rate This Book?</h5>
            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <?php if(empty($borrowerBookRating->book->book_cover_image)){ ?>
                <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image-rt']) ?>
            <?php } else{?>
                <?= $this->Html->image(h($borrowerBookRating->book->book_cover_image), ['width' => '200', 'class' => 'image-rt']) ?>
            <?php }?>
            <h3 class="book-content"><b><?= h($borrowerBookRating->book->title) ?></b></h3>
            <p class="book-content"><b>Book Number: </b><?= h($borrowerBookRating->book_number) ?></p>
            <p class="book-content"><b>Author: </b><?= h($borrowerBookRating->book->author) ?></p>
            <?= $this->Form->create($rateBook, ['controller' => 'books', 'action' => 'rate_books/' . $borrowerBookRating->user_id]) ?>
            <div class="modal-body">
                <div style="text-align:center">
                    <input required name="rating_given" value="<?= h($borrowerBookRating->rating_given) ?>" min="0" max="5" value="0" step="0.1" id="<?= h($borrowerBookRating->rating_id) ?>">
                    <div class="rateit" data-rateit-backingfld="#<?= h($borrowerBookRating->rating_id) ?>"></div>
                </div>
                <label for="borrower-comment"><b>Review:</b></label>
                <textarea class="form-control borrower-comment" name="comment"><?= h($borrowerBookRating->comment) ?></textarea>
                <p>Your honest rating will be very helpful for future borrowers in searching the right books</p>
            </div>
            <div class="modal-footer" id="btn-container">
                <button name="book_number" value="<?= $borrowerBookRating->book_number ?>" type="submit" class="btn btn-primary btn-modal">Save the Rating</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    </div>
<?php  } ?>

<?php $this->append('css') ?>
<style>
    .modal-body p {
        font-style: italic;
        text-align: center;
    }

    #close{
      width: 50px;
      padding: 0;
      margin:0;
    }

    #close:hover{
      background-color: transparent;
      color: red;
    }

    .book-content{
        margin: 0;
        text-align: center;
    }

    .btn-primary{
        width: 200px;
    }

    .image-rt{
        margin: 20px auto;
    }

    #rateBookModalLongTitle{
        margin: auto;
    }

    #borrower-comment{
        margin-bottom: 1em;
    }

</style>
<?php $this->end('css') ?>