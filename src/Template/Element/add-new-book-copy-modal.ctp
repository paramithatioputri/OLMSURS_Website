<!-- Modal -->

<div class="modal fade" id="addNewCopyModalCenter" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewCopyModalLongTitle">Add New Book Copy</h5>
        <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= $this->Form->create($addBookCopy, ['controller' => 'book_copies', 'action' => 'add_book_copies/' . $book->book_number]) ?>
        <div class="modal-body">
        <?= $this->Form->input("book_call_number", ['type' => 'text', 'required', 'id' => 'book-copy-input']) ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-modal">Create a Copy</button>
        </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>

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

<?php $this->append('script') ?>
<script>
    //Validate user input to ensure only input letter and numeric characters
    $(function(){
      $('#book-copy-input').keyup(function(){
        var element = document.getElementById('book-copy-input');
        element.value = element.value.replace(/[^a-zA-Z0-9@]+/, '');
      });
    })
</script>
<?php $this->end('script') ?>