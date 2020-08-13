<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>

<?php $currDateTime = date("Y-m-d"); ?>


<div class="books form content split left">
    <?= $this->Form->create($book) ?>
    <fieldset>
        <legend><?= __('Issue Book') ?></legend>
        <?php
            echo $this->Form->control('book_call_number', ['type' => 'text', 'readonly', 'value' => $bookCopy->book_call_number]);
            echo $this->Form->control('book_number', ['type' => 'text', 'readonly', 'value' => $bookCopy->book_number]);
            echo $this->Form->control('title', ['type' => 'text', 'readonly', 'value' => $bookCopy->book->title]);
            echo $this->Form->control('user_id', ['type' => 'text', 'label' => 'User ID', 'readonly', 'id' => 'borrower_id']);
            echo $this->Form->control('num_of_books_taken', ['id' => 'books_taken', 'type' => 'number', 'readonly']);
            echo $this->Form->control('maximum_allowed', ['type' => 'number', 'readonly', 'value' => 5]);
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <?= $this->Form->control('book_checkout_date', ['type' => 'text', 'label' => 'Issue Date', 'disabled', 'value' => $currDateTime, 'class' => 'form-control datepicker', 'id' => 'datepicker1']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <?= $this->Form->control('book_date_due', ['type' => 'text', 'class' => 'form-control datepicker', 'placeholder' => 'Enter the due date','id' => 'datepicker2', 'required']); ?>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('ISSUE BOOK'), ['class' => 'issue-btn']) ?>
    <?= $this->Form->end() ?>
</div>
<div class="split right">
    <form>
        <label for="search-borrower">Search:</label>
        <input id="search-borrower"type="text" placeholder="Enter Borrower ID" name="searchborrower" value="<?= isset($issue_books) ? $issue_books : '' ?>"/>
        <button class="issue-btn" type="submit">Search</button>
    </form>
    <ul>
        <?php foreach($borrowers as $borrower){ ?>
            <li><button class="borrowerlist" onclick="passBorrowerDetail(this.value)" value="<?= $borrower->user_id ?> <?= isset($borrower->num_of_books_taken) ? $borrower->num_of_books_taken : '0' ?>"><?= h($borrower->user_id) ?> - <?= h($borrower->first_name) ?> <?= h($borrower->last_name) ?></button></li>

        <?php } ?>
    </ul>
    
</div>

<?php $this->append('css') ?>
<style>
    .borrowerlist{
        background-color: transparent;
        color: #000000;
        font-size: 14px;
        padding: 0;
        text-align: left;
    }

    .borrowerlist:hover{
        background-color: transparent;
        color: #000000;
        padding: 0;
        -ms-transform:scale(1.0,1.0);
        transform:scale(1.0,1.0);
    }
    
    .right{
        margin-top: 70px;
    }

    .issue-btn{
        margin-bottom: 30px;
        margin-top: 15px;
    }

    .datepicker {
        width: 500px;
    }

    .heading{
        font-weight: bold !important;
    }
</style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
    function passBorrowerDetail(val){
        var borrowerId = document.getElementById('borrower_id');
        var booksTaken = document.getElementById('books_taken');

        var array = val.split(" ");
        
        borrowerId.value = array[0];
        booksTaken.value = array[1];
    }

    $(function(){
        $("#datepicker2").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            startDate: '+1d',
        });
    });

</script>
<?php $this->end('script') ?>