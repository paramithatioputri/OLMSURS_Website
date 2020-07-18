<?php foreach($bookCopies as $bookCopy){ ?>
<!-- Modal -->
<div class="modal fade" id="deleteCopyModalCenter<?= $bookCopy->book_call_number ?>" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCopyModalLongTitle">Delete Book Copy - <?= h($bookCopy->book_call_number) ?></h5>
        <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= $this->Form->create($deleteBookCopy, ['controller' => 'book_copies', 'action' => 'delete_book_copies/' . $bookCopy->book_call_number]) ?>
        <div class="modal-body">
          Are you sure want to delete this book copy record?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger btn-modal">Delete</button>
        </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>
<?php } ?>

<?php $this->append('css')?>
<style>
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



</style>
<?php $this->end('css') ?>