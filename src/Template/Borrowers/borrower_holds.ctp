<?php echo $this->element('header'); ?>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Placed on</th>
                <th>Expires on</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <ul class="list-unstyled td-child">
                        <li>Book 1</li>
                        <li>Author 1</li>
                    </ul>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php $this->append('css') ?>
<style>
    th,td, .td-child{
        font-size: 15px !important;
    }
</style>
<?php $this->end('css') ?>