<div>
    <div id="checkout-info">
        <div>
            <label class="checkout-label">Total Items Checked Out: </label>
            <label class="checkout-label"></label>
        </div>
        
        <div>
            <label class="checkout-label"><i class="fa fa-exclamation" style="color: red;"> </i></label>
            <label class="checkout-label">Items Overdue: </label>
            <label class="checkout-label"></label>
        </div>
        
        <div>
            <label class="checkout-label">Your Fines: </label>
            <label class="checkout-label">RM</label>
        </div>

        <div>
            <input type="checkbox" id="select-all-checkbox"/>
            <label id="select-all-label" for="select-all-checkbox">Select All</label>
            <button>Renew</button>
        </div>
        
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Title / Author</th>
                    <th scope="col">Times Renewed</th>
                    <th scope="col">Date Due</th>
                    <th scope="col">You Owe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div>
                            <input type="checkbox" id="book-checkbox"/>
                        </div>
                    </td>
                    <td>
                        <ul class="list-unstyled td-child">
                            <li>Book1</li>
                            <li>Author1</li>
                        </ul>
                    </td>
                    <td>
                        <div class="td-child">
                            /2
                        </div>
                    </td>
                    <td>3</td>
                    <td>4</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="no-checkout-info">You have nothing checked out</div>
</div>

<?php $this->append('css')?>
<style>
    body{
        margin: 0;
        padding: 0;
    }

    .checkout-label{
        font-size: 18px;
    }

    #select-all-label{
        font-size: 15px;
    }

    button{
        background-color: #FFA500;
        font-size: 18px;
    }

    #checkout-info{
        margin-bottom: 3em;
    }

    th, td, .td-child{
        font-size: 15px !important;
    }

    #no-checkout-info{
        border: solid;
        text-align: center;
        padding: 2em;
        background-color: #FFA500;
        font-weight: bold;
    }
</style>
<?php $this->end('css') ?>
