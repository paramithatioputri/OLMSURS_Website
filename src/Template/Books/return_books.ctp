<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?php echo $this->element('header'); 
$currDate = date("Y-m-d");?>

<h3 class="heading"><?= __('Returning Books') ?></h3>
<div>
    <form>
        <label>Search: </label>
        <div class="search-container">
            <input autofocus id="search-return-book" type="text" name="borrower_return_q" placeholder="Enter borrower ID" value="<?= isset($return_books) ? $return_books : '' ?>" />
            <button id="search-btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
        </div>
    </form>
</div>
<div>
    <p>Borrower ID: <?= h($borrower->user_id) ?></p>
    <p>Borrower Name: <?= h($borrower->first_name) ?> <?= h($borrower->last_name) ?></p>
    <p>Total Fines: <a href="fines/<?= $borrower->user_id ?>"><b>RM</b><label id="total-fines"><b><?= isset($borrower->total_fines) ? $borrower->total_fines : '0' ?></b></label></a></p>
    <p>Books Taken: <?= isset($borrower->num_of_books_taken) ? $borrower->num_of_books_taken : '0' ?></p>
</div>
<?php if(!empty($borrowerTransacts)){ ?>
<div>
    <table class="table-bordered table-hover">
        <thead>
            <th></th>
            <th>Item</th>
            <th>Actions</th>
        </thead>
        <tbody>
        <?php foreach($borrowerTransacts as $borrowerTransact){ 
            $overdueCharge = date_diff(date_create($borrowerTransact->book_date_due),date_create($currDate))->format('%a') * 0.1;
            ?>
            <tr class="hide-returned-books" id="<?= $borrowerTransact->status ?>">
                <td class="images">
                <?php if(empty($borrowerTransact->book_copy->book->book_cover_image)){ ?>
                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                <?php } else{?>
                    <?= $this->Html->image(h($borrowerTransact->book_copy->book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                <?php }?>
                </td>
                <td>
                    <p><b>Book Call Number: </b><?= h($borrowerTransact->book_call_number) ?></p>
                    <p><b>Book Number: </b><?= h($borrowerTransact->book_copy->book->book_number) ?></p>
                    <p><b>Issue Date: </b><?= h($borrowerTransact->book_checkout_date) ?></p>
                    <p><b>Due Date: </b><?= h($borrowerTransact->book_date_due) ?></p>
                    <p class="hide-charge-amount"><label><b>Charge Amount: </b>RM</label><label class="charge-amount"><?= $borrowerTransact->status == 'Checked Out' && date('Y-m-d', strtotime($borrowerTransact->book_date_due)) < $currDate ? isset($borrowerTransact->charge_amount) ? ($borrowerTransact->charge_amount + (date_diff(date_create($borrowerTransact->book_date_due),date_create($currDate))->format('%a') * 0.1)) : (date_diff(date_create($borrowerTransact->book_date_due),date_create($currDate))->format('%a') * 0.1)
                : $borrowerTransact->charge_amount
                ?></label></p>
                </td>
                <td class="actions">
                    <?=  $this->Form->create('return_book', ['id' => 'submit-form'])?>
                        <button name="borrower-transaction" class="return-book-btn" value="<?= $borrowerTransact->user_id?> <?= $borrowerTransact->book_call_number ?> <?= $overdueCharge ?>">Return Book</button>
                    <?= $this->Form->end() ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php }else{ ?>
    <div class="card-container">
        <div class="card" id="borrower-not-found">
            <div class="card-body">
                <h5 class="card-title">Please enter complete borrower ID</h5>
            </div>
        </div>
    </div>
<?php } ?>

<?php $this->append('css') ?>
<style>
    .return-book-btn{
        padding: 10px;
        width: 110px;
        font-size: 15px;
    }

    .actions{
        text-align: center;
        vertical-align: middle;
    }

    .images{
        text-align: center;
        vertical-align: middle;
    }

    .card-body{
        text-align: center;
    }

    #borrower-not-found{
        background-color:#FFCD94;
    } 

    .card-container{
        margin-top: 15%;
    }

    .heading{
        font-weight: bold !important;
    }

    #search-return-book, #search-btn{
        font-size: 20px;
        margin-bottom: 1em;
    }

    #search-return-book{
        margin-top: 5px;
        width: 80%;
        height: 2.5em;
        margin-right: 20px;
    }

    .search-container{
        display: flex;
        flex-wrap: wrap;
    }
        
    #search-btn{
        margin-bottom: 20px;
        width: 10em;
    }

    #total-fines{
        margin: 0;
        color: #000000;
    }

    .charge-amount{
        color: #000000;
    }


</style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
$(document).ready(function(){
        //Hide charge Amount
        $('.hide-charge-amount').hide();
        $('#Returned').hide();

        // Show the total fines
        var totalChargeClass = document.getElementsByClassName('charge-amount');
        var totalFines = 0;
        var totFinesLimitDec = 0;

        for(var i = 0; i < totalChargeClass.length; i++){
            
            var fineAmnt = totalChargeClass[i].innerHTML;

            totalFines = parseFloat(totalFines) + parseFloat(fineAmnt);
            totFinesLimitDec = totalFines.toFixed(2);

        }
        var finesDisplay = document.getElementById('total-fines');
        finesDisplay.innerHTML = totFinesLimitDec;
        finesDisplay.style.fontWeight = 'bold';

        
});
</script>
<?php $this->end('script') ?>