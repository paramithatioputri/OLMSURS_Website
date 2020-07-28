<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); ?>

<?php $categories = ['All Categories', 'Title', 'Author', 'Subject', 'ISBN', 'Book Number']; ?>
    

<!-- <div id="books" class="m-t-1"> -->
    <!-- <div class="container-fluid container-lg"> -->
        <h3 class="heading"><?= __('Booklist') ?></h3>
        <div>
            <form>
                <label>Search:</label>
                <div class="search-container">
                    <input id="search-booklist" autofocus type="text" name="query1" placeholder="Insert any keyword" value="<?= isset($booklist) ? $booklist: '' ?>" />
                    <?php
                        echo $this->Form->control('categories', ['options' => $categories, 'name' => 'query2', 'id' =>'book-category-dropdown', 'label' => '']);
                    ?>
                </div>
                
                <button id="search-btn" type="submit" ><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </form>
        </div>
        
        <table class="table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" id="item">Item</th>
                    <?php if(!empty($auth_user) && $auth_user['role'] === 'librarian'){ ?>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td class="wrapper">
                    <a href= "view/<?= $book->book_number ?>">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div>
                                <?php if(empty($book->book_cover_image)){ ?>
                                    <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '200', 'class' => 'image']) ?>
                                <?php } else{?>
                                    <?= $this->Html->image(h($book->book_cover_image), ['width' => '200', 'class' => 'image']) ?>
                                <?php }?>
                                
                                </div>
                            </div>
                            <div class="book-content col-md-6 col-lg-9">
                                <div><b>Book Title: </b><?= h($book->title) ?></div>
                                <div><b>Author: </b><?= h($book->author) ?></div>
                                <div><b>Publisher: </b><?= h($book->publisher) ?></div>
                                <div><b>Availability: </b>
                                <i><?php 
                                $flag = 0;
                                foreach($bookCopies as $bookCopy){
                                    if($bookCopy->book_number == $book->book_number && $bookCopy->availability_status == "Available"){
                                        echo "Available for Loan";
                                        break;
                                    }
                                        $flag = 1;
                                }
                                    if($flag == 1){
                                        echo "Not available for loan";
                                    }
                                     ?></i>
                                </div>
                                <div name="average_rating">
                                    <input value="<?= h($book->average_rating) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($book->book_number) ?>">
                                    <div class="rateit" data-rateit-backingfld="#<?= h($book->book_number) ?>"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </td>
                    <?php if(!empty($auth_user) && $auth_user['role'] === 'librarian'){ ?>
                    <td class="actions">
                        <?= $this->Html->link(__('Add New Copy'), ['controller' => 'book_copies', 'action' => 'view_book_copies', $book->book_number], ['class' => 'button btn btn-primary']) ?>
                        <?= $this->Html->link(__('Update'), ['action' => 'update_books', $book->book_number], ['class' => 'button btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $book->book_number], ['confirm' => __('Are you sure you want to delete # {0}?', $book->book_number), 'class' => 'button btn btn-danger']) ?>
                    </td>
                    <?php } ?>
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

    #item{
        text-align: center;
    }

    a, a:hover{
        color: #000000;
        text-decoration: none;
    }

    .heading{
        font-weight: bold !important;
    }

    #book-category-dropdown{
        width:10em;
        background-color: #FFA500;
    }

    #search-booklist, #book-category-dropdown{
        height: 2.5em;
        font-size: 20px;
        margin-bottom: 1em;
    }

    #search-booklist{
        width: 80%;
    }

    .search-container{
        display: flex;
        flex-wrap: wrap;
    }
    
    #search-btn{
        margin-bottom: 20px;
        width: 12em;
    }

</style>
<?php $this->end('css'); ?>