<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>
<?= $this->element('delete-book-copy-modal', [
    'bookCopies' => $bookCopies,
])?>

<h3 class="heading">Book Copies</h3>

<div class="bookCopies view content">
    <h3>Book Title: <?= h($book->title) ?></h3>
    <div>        
        <div class="split left">
            <div class="image">
                <?php if(empty($book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '300', 'alt' => 'no-book-cover-image']); ?>
                <?php }else{ ?>
                    <?= $this->Html->image(h($book->book_cover_image), ['width' => '300', 'alt' => 'book-cover-image']); ?>
                <?php } ?>
            </div>
            <div><label>Book Number : <?= h($book->book_number) ?></label></div>
            <div><label>ISBN: <?= h($book->isbn) ?></label></div>
            <div><label>Book Title: <?= h($book->title) ?></label></div>
            <div><label>Author: <?= h($book->author) ?></label></div>
            <div><label>Publisher: <?= h($book->publisher) ?></label></div>
            <div><label>Subject: <?= $book->has('subject') ? $book->subject->subject_name : "-" ?></label></div>
            <div><label>Language: <?= $book->has('language') ? $book->language->language_name : "-" ?></label></div>
            <div><label>Num Of Pages: <?= h($book->num_of_pages) ?></label></div>
        </div>
    </div>
    <div class= "split right">
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
    <div class="row">
        <h4><?= __('Synopsis') ?></h4>
        <?= $this->Text->autoParagraph(h($book->synopsis)); ?>
    </div>
</div>

<?php $this->append('css') ?>
<style>
    .image{
        text-align: center;
        margin-bottom: 15px;
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
</style>
<?php $this->end('css') ?>