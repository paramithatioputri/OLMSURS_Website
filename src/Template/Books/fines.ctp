<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); 
$currDate = date("Y-m-d");
$billReason = ['Late return of book'];
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
        <p id="total-fines"><b>Total Fines: RM0</b></p>
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
            if(!empty($borrower_book_status->charge_amount) || date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate){ 
                if($borrower_book_status->charge_amount == 0 && $borrower_book_status->status == "Returned"){
                    continue;
                }?>
            <tr>
                <td><?= h($billReason[0]) ?></td>
                <td>
                    <p class="tb-cont"><b>Book Call Number: </b><?= h($borrower_book_status->book_call_number) ?></p>
                    <p class="tb-cont"><b>Book Number: </b><?= h($borrower_book_status->book_copy->book->book_number) ?></p>
                    <p class="tb-cont"><b>Book Title: </b><?= h($borrower_book_status->book_copy->book->title) ?></p>
                </td>
                <td class="overdue-status"><?= ($borrower_book_status->status == 'Checked Out' && date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate) ? 'Overdue' : $borrower_book_status->status ?></td>
                <td><?= isset($borrower_book_status->billing_date) ? $borrower_book_status->billing_date : '-' ?></td>
                <td class="charge-amount" id="<?= $borrower_book_status->id ?>">RM<?= $borrower_book_status->status == 'Checked Out' && date('Y-m-d', strtotime($borrower_book_status->book_date_due)) < $currDate ? isset($borrower_book_status->charge_amount) ? ($borrower_book_status->charge_amount + (date_diff(date_create($borrower_book_status->book_date_due),date_create($currDate))->format('%a') * 0.1)) : (date_diff(date_create($borrower_book_status->book_date_due),date_create($currDate))->format('%a') * 0.1)
                : $borrower_book_status->charge_amount
                ?></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>
</div>

<div class="pay-charge">
    <div>
        <p><b>Total charges payable now:</b> <label id="total-payable"></label></p>
    </div>
    <div id="pay-charge">
        <?= $this->Form->create('paynowform', ['id' => 'paynowform']) ?>
            <button name="charge_amount" id="pay-btn" type="submit">Pay Now</button>
        <?= $this->Form->end() ?>
    </div>
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

    .pay-charge{
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
        var payNowBtn = document.getElementById('pay-btn');
        var totalCharges = 0;
        var totalFines = 0;
        var totChargesLimitDec = 0;
        var totFinesLimitDec = 0;
        var chargeArr = [];

        
        for(var i = 0; i < totalChargeClass.length; i++){
            if(overdueStat[i].innerHTML != 'Overdue'){

                var chargeAmntCurr = totalChargeClass[i].innerHTML;
                
                //Input payable charge amount inside Pay Now Button
                chargeArr.push((totalChargeClass[i].innerHTML).replace("RM", "") + " " + totalChargeClass[i].id);

                //Remove letters from string
                var chargeAmnt = chargeAmntCurr.replace("RM", "");
                
                //to get the total charge amount
                totalCharges = parseFloat(totalCharges) + parseFloat(chargeAmnt);
                totChargesLimitDec = totalCharges.toFixed(2);
            }
            
        }

        //Show total fines
        for(var i = 0; i < totalChargeClass.length; i++){
            var fineCurr = totalChargeClass[i].innerHTML;

            var fineAmnt = fineCurr.replace("RM", "");
            totalFines = parseFloat(totalFines) + parseFloat(fineAmnt);
            totFinesLimitDec = totalFines.toFixed(2);
        }
        var finesDisplay = document.getElementById('total-fines');
        finesDisplay.innerHTML = "Your Fines: RM" + totFinesLimitDec;
        finesDisplay.style.fontWeight = 'bold';

        //Set the fines value to Pay Now Button
        payNowBtn.value = chargeArr;
        console.log(payNowBtn.value);

        //Set the color of total charge payable
        var totalPayable = document.getElementById('total-payable');
        totalPayable.innerHTML = "RM" + totChargesLimitDec;
        totalPayable.style.color = 'red';
        totalPayable.style.fontWeight = 'bold';

        //Show or Hide Total payment and button visibility
        if(payNowBtn.value == ""){
            var payChargeDiv = document.getElementById('pay-charge');
            payChargeDiv.style.visibility = 'hidden';
        }
        
    });
</script>
<?php $this->end('script') ?>