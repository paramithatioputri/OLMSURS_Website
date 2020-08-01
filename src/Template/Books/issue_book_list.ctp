<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>

<h3 class="heading"><?= __('Issue Books') ?></h3>
<hr/>

<div>
    <label for="search-issue-book">Search:</label>
    <form>
        <div class="search-container">
            <input id="search-issue-book" autofocus type="text" name="searchq" placeholder="Insert book number" value="<?= isset($issue_book_list) ? $issue_book_list: '' ?>" />
            <button id="search-btn" type="submit" ><i class="fa fa-search" aria-hidden="true"></i> Search</button>
        </div>
    </form>
</div>

<table class="table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col" id="book_call_number">Book Call Number</th>
            <th scope="col" id="book_number">Book Number</th>
            <th scope="col" id="book_title">Book Title</th>
            <th scope="col" id="author">Author</th>
            <th scope="col" id="status">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookCopies as $bookCopy): ?>
        <tr>
            <td>
                <p><?= $this->Html->link($bookCopy->book_call_number, ['controller' => 'Books', 'action' => 'issue_books', $bookCopy->book_call_number]) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->book_number) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->book->title) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->book->author) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->availability_status) ?></p>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->append('css') ?>
<style>
.heading{
    font-weight: bold !important;
}

#search-issue-book, #search-btn{
    font-size: 20px;
    margin-bottom: 1em;
}

#search-issue-book{
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

</style>
<?php $this->end('css') ?>