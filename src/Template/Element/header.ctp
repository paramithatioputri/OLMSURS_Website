<?php if ($this->request->prefix == 'admin'){ ?>
        <?= $this->element('librarian-navigation');?>
    <?php }
    else{ ?>
        <?= $this->element('borrower-navigation');?>
    <?php }
?>


