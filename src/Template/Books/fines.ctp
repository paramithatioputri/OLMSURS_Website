<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); 
$currDate = date("Y-m-d");
?>
<h1>About Fines</h1>
<div class="row">
    <div class="col-md-7">
        <p id="fine-exp">The borrower can only pay the fine once the items borrowed have been returned or renewed.</p>
    </div>
    <div class="col-md-5">
        <p><b>Borrower ID: </b><?= h($borrower->user_id) ?></p>
        <p><b>Borrower Name: </b><?= h($borrower->first_name) ?> <?= h($borrower->last_name) ?></p>
        <p><b>Account Status: </b><?= h($borrower->account_status) ?></p>
    </div>
</div>

<div class="fine-table">
    <label id="fine-label">Fine Details:</label>
    <table class="table-bordered table-hover">
        <thead>
            <tr>
                <th>Bill Reason</th>
                <th>Item</th>
                <th>Status</th>
                <th>Date Billed</th>
                <th>Charge Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($borrower_book_statuses as $borrower_book_status){ 
            if(!empty($borrower_book_status->charge_amount)){ ?>
            <tr>
                <td></td>
                <td>
                    <p class="tb-cont"><b>Book Call Number: </b><?= h($borrower_book_status->book_call_number) ?></p>
                    <p class="tb-cont"><b>Book Number: </b><?= h($borrower_book_status->book_copy->book->book_number) ?></p>
                    <p class="tb-cont"><b>Book Title: </b><?= h($borrower_book_status->book_copy->book->title) ?></p>
                </td>
                <td class="overdue-status"><?= ($borrower_book_status->status == 'Checked Out' && date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate) ? 'Overdue' : $borrower_book_status->status ?></td>
                <td></td>
                <td class="charge-amount">RM<?= $borrower_book_status->status == 'Checked Out' && date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate ? isset($borrower_book_status->charge_amount) ? ($borrower_book_status->charge_amount + (date_diff(date_create($borrower_book_status->book_date_due),date_create($currDate))->format('%a') * 0.1)) : (date_diff(date_create($borrower_book_status->book_date_due),date_create($currDate))->format('%a') * 0.1)
                : $borrower_book_status->charge_amount
                ?></td>
            </tr>
        <?php } } ?>
        </tbody>
    </table>
</div>

<div id="pay-charge">
    <div>
        <p><b>Total charges payable now:</b> <label id="total-payable"></label></p>
    </div>
    <button id="pay-btn">Pay Now</button>
</div>


<?php $this->append('css') ?>
<style>
    #fine-exp{
        font-size: 20px;
    }

    #fine-label{
        font-size: 20px;
        font-weight: bold;
    }

    .fine-table{
        margin-top: 3%;
    }

    #pay-charge{
        text-align: right;
    }

    #pay-btn{
        padding: 8px;
        width: 110px;
        font-size: 14px;
    }
    .tb-cont{
        margin:0;
        font-size: 14px;
    }

</style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
    $(document).ready(function(){
        //Function to change the overdue status display
        var overdueStat = document.getElementsByClassName('overdue-status');
        for(var i = 0; i < overdueStat.length; i++){
            if(overdueStat[i].innerHTML == 'Overdue'){
                overdueStat[i].style.color = 'red';
                overdueStat[i].style.fontWeight = 'bold';
                overdueStat[i].style.fontStyle = 'italic';
            }
        }

        //Function to get the total payable fines
        var totalChargeClass = document.getElementsByClassName('charge-amount');
        var totalCharges = 0;

        for(var i = 0; i < totalChargeClass.length; i++){
            var chargeAmntCurr = totalChargeClass[i].innerHTML;
            //Remove letters from string
            var chargeAmnt = chargeAmntCurr.replace("RM", "");
            totalCharges = parseFloat(totalCharges) + parseFloat(chargeAmnt);
        }

        var totalPayable = document.getElementById('total-payable');
        totalPayable.innerHTML = "RM" + totalCharges;
        totalPayable.style.color = 'red';
        totalPayable.style.fontWeight = 'bold';

    });
</script>
<?php $this->end('script') ?>