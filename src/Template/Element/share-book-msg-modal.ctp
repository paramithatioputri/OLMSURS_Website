<!-- Modal -->
<?php foreach($borrowerLists as $borrowerList){ ?>
    <div class="modal fade" id="shareBookMsgModalCenter<?= $borrowerLists->user_id ?>" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="shareBookMsgModalLongTitle">Share This Book?</h5>
            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <?php if(empty($book->book_cover_image)){ ?>
                <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image-rt']) ?>
            <?php } else{?>
                <?= $this->Html->image(h($book->book_cover_image), ['width' => '200', 'class' => 'image-rt']) ?>
            <?php }?>
            <h3 class="book-content"><b><?= h($book->title) ?></b></h3>
            <p class="book-content"><b>Book Number: </b><?= h($book->book_number) ?></p>
            <p class="book-content"><b>Author: </b><?= h($book->author) ?></p>
            <?= $this->Form->create($shareThisBook, ['controller' => 'books', 'action' => 'share_this_book/' . $book->book_number ]) ?>
            <div class="modal-body">
                <label for="borrower-message"><b>Message:</b></label>
                <textarea class="form-control borrower-comment" name="message" required></textarea>
            </div>
            <div class="modal-footer" id="btn-container">
                <button name="receiver_id" value="<?= $borrowerList->user_id ?>" type="submit" class="btn btn-primary btn-modal">Share</button>
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

    #borrower-message{
        margin-bottom: 1em;
    }

</style>
<?php $this->end('css') ?>