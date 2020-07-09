<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); ?>

<?php $categories = ['All Categories', 'Title', 'Author', 'Subject', 'ISBN', 'Book Number']; ?>
    

<!-- <div id="books" class="m-t-1"> -->
    <!-- <div class="container-fluid container-lg"> -->
        <h3><?= __('Booklist') ?></h3>
        <div>
            <form>
                <input autofocus type="text" name="query1" placeholder="Insert any keyword" value="<?= isset($booklist) ? $booklist: '' ?>" />
                <?php
                    echo $this->Form->control('categories', ['options' => $categories, 'name' => 'query2']);
                ?>
                <button type="submit" ><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </form>
        </div>
        

        <table class="table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" id="title"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td class="wrapper">
                        <div>
                            <div>
                            <?php if(empty($book->book_cover_image)){ ?>
                                <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                            <?php } else{?>
                                <?= $this->Html->image(h($book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                            <?php }?>
                            </div>
                        </div>
                        <div class="book-content">
                            <div><b>Book Title: </b><?= h($book->title) ?></div>
                            <div><b>Author: </b><?= h($book->author) ?></div>
                            <div><b>Publisher: </b><?= h($book->publisher) ?></div>
                            <div><b>Availability: </b></div>
                            <div name="average_rating">
                                <input value="<?= h($book->average_rating) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($book->book_number) ?>">
                                <div class="rateit" data-rateit-backingfld="#<?= h($book->book_number) ?>"></div>
                            </div>
                        </div>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $book->book_number],['class' => 'button btn btn-primary']) ?>
                        <?= $this->Html->link(__('Update'), ['action' => 'update_books', $book->book_number], ['class' => 'button btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $book->book_number], ['confirm' => __('Are you sure you want to delete # {0}?', $book->book_number), 'class' => 'button btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    <!-- </div> -->
<!-- </div> -->

<?php $this->append('css');?>
<style>
    html{
        margin: 0;
    }

    .image{
        float:left;
        margin-right: 10px;
    }

    .actions{
        text-align: center;
        vertical-align: middle;
    }

    #title{
        text-align: center;
    }

</style>
<?php $this->end('css'); ?>