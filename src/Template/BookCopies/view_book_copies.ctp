<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>
<?= $this->element('delete-book-copy-modal', [
    'bookCopies' => $bookCopies,
])?>

<h3 class="heading">Book Copies</h3>
<hr/>

<div class="bookCopies view content">
    <h3>Book Title: <?= h($book->title) ?></h3>
    <div class="row">        
        <div class="col-md-9">
            <div class="image-container">
                <?php if(empty($book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '300', 'alt' => 'no-book-cover-image', 'class' => 'image']); ?>
                <?php }else{ ?>
                    <?= $this->Html->image(h($book->book_cover_image), ['width' => '300', 'alt' => 'book-cover-image', 'class' => 'image']); ?>
                <?php } ?>
            </div>
            <div><label><b>Book Number : </b><?= h($book->book_number) ?></label></div>
            <div><label><b>ISBN: </b><?= h($book->isbn) ?></label></div>
            <div><label><b>Book Title: </b><?= h($book->title) ?></label></div>
            <div><label><b>Author: </b><?= h($book->author) ?></label></div>
            <div><label><b>Publisher: </b><?= h($book->publisher) ?></label></div>
            <div><label><b>Subject: </b><?= $book->has('subject') ? $book->subject->subject_name : "-" ?></label></div>
            <div><label><b>Language: </b><?= $book->has('language') ? $book->language->language_name : "-" ?></label></div>
            <div><label><b>Num Of Pages: </b><?= h($book->num_of_pages) ?></label></div>
        </div>
        <div class= "col-md-3">
            <div>
                <label><b>Number of Copies: (<?= h($totalBookCopies) ?>)</b></label>
            </div>
            <div>
                <ul>
                <?php foreach($bookCopies as $bookCopy){?>
                    <li>
                        <div>
                            <?=h($bookCopy->book_call_number)?>
                            <button class="copyLstBtn" data-toggle="modal" data-target="#deleteCopyModalCenter<?= $bookCopy->book_call_number ?>"><i class="fa fa-times"></i></button>
                        </div>
                    </li>
                    
                <?php  } ?>  
                </ul>
            </div>
            <button id="add-new-copy-btn" data-toggle="modal" data-target="#addNewCopyModalCenter"><i class="fa fa-plus"></i> Add New Copy</button>
            <?= $this->element('add-new-book-copy-modal')?>
        </div>
    </div>
    <div>
        <h4><?= __('Synopsis') ?></h4>
        <?= $this->Text->autoParagraph(h($book->synopsis)); ?>
    </div>
</div>

<?php $this->append('css') ?>
<style>
    .image-container{
        margin-bottom: 15px;
    }

    .image{
        border: 2px solid #000000;
    }

    #add-new-copy-btn{
        font-size: 11px;
        width: 157px;
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

    .btn-modal:hover{
      font-weight: normal;
      -ms-transform:scale(1.0,1.0);
      transform:scale(1.0,1.0);
      transition: 0;
    }

    .copyLstBtn{
        width: 50px;
        padding: 0;
        background-color: red;
        
    }

    .copyLstBtn:hover{
        background-color: red;
    }

    .heading{
        font-weight: bold;
    }

    .row{
        margin-bottom: 10px;
    }
</style>
<?php $this->end('css') ?>