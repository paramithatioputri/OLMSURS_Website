<?php
if ($auth_user['role'] == 'librarian'){ ?>
        <?= $this->element('librarian-navigation');?>
    <?php }
    else{ ?>
        <?= $this->element('borrower-navigation');?>
    <?php }
?>


