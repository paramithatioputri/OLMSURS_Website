<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); 
    $currDate = date("Y-m-d");
?>

<h3 class="heading">Checked out Books</h3>
<hr/>

<div class="row">
    <div class="col-md-9">
        <p>Total Items Checked Out: <?= isset($borrower->num_of_books_taken) ? $borrower->num_of_books_taken : '0' ?></p>
        <p><i class="fa fa-exclamation-circle"></i> Items Overdue: <?= isset($overdueBooks) ? $overdueBooks : '0' ?></p>
        <?php if(!empty($borrower_book_statuses)){ ?>
        <input id="select-all" type="checkbox" name="select-all" style="margin:0;" onchange="selectAll(this)">
        <label style="margin:0;" for="select-all"> Select All</label> <button id="renew-btn" onclick="submitRenew()">Renew</button>
        <?php } ?>
    </div>
    <div class="col-md-3" style="text-align:right;">
        <p id="total-fines"><b>Your Fines: RM0</b></p>
    </div>
</div>

<?php if(!empty($borrower_book_statuses)){?>
<div>
    <table class="table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col" id="checkbox-col"></th>
                <th scope="col" id="book-col">Book</th>
                <th scope="col">Times Renewed</th>
                <th scope="col">Date Due</th>
                <th scope="col">Status</th>
                <th scope="col">You Owe</th>
            </tr>
        </thead>
        <tbody>
        <?= $this->Form->create('renewBooks', ['id' => 'renew-book']) ?>
        <?= $this->Form->end() ?>
        <?php foreach($borrower_book_statuses as $borrower_book_status){
            if($borrower_book_status->status == 'Checked Out' && date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate){
                $overdueCharge = date_diff(date_create($borrower_book_status->book_date_due),date_create($currDate))->format('%a') * 0.1;
            }
            else{
                $overdueCharge = 0;
            }
            ?>
            <tr class="hide-returned-books <?= $borrower_book_status->status ?>">
                <td>
                    <?= $this->Form->control('id', ['class' => 'select-this', 'type' => 'checkbox', 'value' => $borrower_book_status->id . " " . $overdueCharge, 'label' => '']) ?>
                </td>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                        <?php if(empty($borrower_book_status->book_copy->book->book_cover_image)){ ?>
                            <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                        <?php } else{?>
                            <?= $this->Html->image(h($borrower_book_status->book_copy->book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                        <?php }?>
                        </div>
                        <div class="col-md-6">
                            <b>Book Call Number: </b><?= h($borrower_book_status->book_call_number) ?><br/>
                            <b>Book Number: </b><?= h($borrower_book_status->book_copy->book_number) ?><br/>
                            <b>Title: </b><?= h($borrower_book_status->book_copy->book->title) ?><br/>
                            <b>Author: </b><?= h($borrower_book_status->book_copy->book->author) ?>
                        </div>
                    </div>
                    
                </td>
                <td><?= isset($borrower_book_status->times_renewed) ? $borrower_book_status->times_renewed : '0' ?> / 2</td>
                <td><?= h($borrower_book_status->book_date_due) ?></td>
                <td class="overdue-status"><?= (date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate && $borrower_book_status->status != 'Returned') ? 'Overdue' : '-' ?></td>
                <td class="charge-amount" id="<?= $borrower_book_status->id ?>">RM<?= $borrower_book_status->status == 'Checked Out' && date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate ? isset($borrower_book_status->charge_amount) ? ($borrower_book_status->charge_amount + (date_diff(date_create($borrower_book_status->book_date_due),date_create($currDate))->format('%a') * 0.1)) : (date_diff(date_create($borrower_book_status->book_date_due),date_create($currDate))->format('%a') * 0.1)
                : $borrower_book_status->charge_amount
                ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php }else{ ?>
<div class="card-container">
    <div class="card" id="no-checkout">
        <div class="card-body">
            <h5 class="card-title">You have nothing checked out</h5>
        </div>
    </div>
</div>
    
<?php }?>


<?php $this->append('css') ?>
<style>

    html{
        margin: 0;
    }

    .fa-exclamation-circle{
        color: red;
    }

    #renew-btn{
        padding: 0;
        width: 60px;
        font-size: 15px;
    }

    #renew-btn:hover{
        font-weight: normal;
        -ms-transform:scale(1.0,1.0);
        transform:scale(1.0,1.0);
    }

    .row{
        margin-bottom: 30px;
    }

    .image{
        float:left;
        margin-right: 20px;
    }

    #checkbox-col{
        width: 5%;
    }

    #book-col{
        width: 45%;
    }

    #no-checkout{
        background-color:#FFCD94;
        text-align: center;
        float: center;
    }

    .card-container{
        margin-top: 10%;
    }

    .heading{
        font-weight: bold !important;
    }

</style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
    function selectAll(elem) {
        var items = document.getElementsByClassName('select-this');
        if(elem.checked){
            for (var i = 0; i < items.length; i++) {
            if (items[i].type == 'checkbox')
                items[i].checked = true;
            }
        }
        else{
            for (var i = 0; i < items.length; i++) {
            if (items[i].type == 'checkbox')
                items[i].checked = false;
            }
        }
    }

    function submitRenew(){
        var checkbox = document.getElementsByClassName('select-this');
        var form = document.getElementById('renew-book');
        var selectedBooks = document.createElement('input');
        var bookArr = [];
        
        for(var i = 0; i < checkbox.length; i++){
            if(checkbox[i].checked){
                bookArr.push(checkbox[i].value);
            }
        }
        selectedBooks.setAttribute('name', 'id');
        selectedBooks.setAttribute('value', bookArr);
        form.appendChild(selectedBooks);

        form.submit();
    }

    $(document).ready(function(){

        $(".Returned").hide();
        $(".overdue-status").css({"color": "red", "font-weight": "bold", "font-style": "italic"});

        // Show the total fines
        var totalChargeClass = document.getElementsByClassName('charge-amount');
        var totalFines = 0;
        var totFinesLimitDec = 0;

        for(var i = 0; i < totalChargeClass.length; i++){
            var fineCurr = totalChargeClass[i].innerHTML;

            var fineAmnt = fineCurr.replace("RM", "");
            totalFines = parseFloat(totalFines) + parseFloat(fineAmnt);
            totFinesLimitDec = totalFines.toFixed(2);
        }
        var finesDisplay = document.getElementById('total-fines');
        finesDisplay.innerHTML = "Your Fines: RM" + totFinesLimitDec;
        finesDisplay.style.fontWeight = 'bold';
    });
</script>
<?php $this->end('script') ?>