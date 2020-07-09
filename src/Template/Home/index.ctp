<?= $this->Html->css('button-custom.css');?>
<?php //echo $this->element('header'); ?>

<?php $categories = ['All Categories', 'Title', 'Author', 'Subject', 'ISBN', 'Book Number']; ?>

<div class="split" id="search-container">
    <div class="logo-container">
        <?= $this->Html->Image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'home-logo']); ?>
    </div>
    <div id="search-container1">
        <form>
            <label>Search:</label>
            <div id="search-input-container">
                <input autofocus id="search-textbox" type="text" placeholder="Please insert any keywords to search" name="query1" value="<?= isset($index) ? $index : '' ?>"/>
                <select id="search-category-dropdown">
                    <?php
                        foreach($categories as $category){ ?>
                            <option name="query2" value="<?= $category ?>"><?= $category; ?></option>
                    <?php
                         }
                    ?>
                </select>
            </div>
            <div class="search-btn-container">
                <div id="btn-container">
                    <button type="submit" id="search-btn" value="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                </div>
            </div>
        </form>
        
    </div>
</div>

<div class="split" id="cards-container">
    <h1 style="text-align: left; font-weight: bold;">Recommended</h1>
    <?php
    foreach($books as $book){ ?>
            <a href="<?= h('books/view/' . $book->book_number)?>">
                <div class="card" style="width:300px">
                <img class="card-img-top" src="<?= $book->book_cover_image ?>" style="height:298px" alt="Book image">
                    <div class="card-body">
                        <div name="average_rating" style="text-align:center">
                            <input value="<?= h($book->average_rating) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($book->book_number) ?>">
                            <div class="rateit" data-rateit-backingfld="#<?= h($book->book_number) ?>"></div>
                        </div>
                        <h4 class="card-title"><?= $book->title ?></h4>
                        <p class="card-text"><b>Author: </b><?= $book->author ?></p>
                        <p class="card-text"><b>Subject: </b><?= $book->subject->subject_name ?></p>
                        <p class="card-text"><b>ISBN: </b><?= $book->isbn ?></p>
                    </div>
                </div>
            </a>
        <?php
        }
    ?>
</div>


<?php $this->append('css')?>
<style>
    body{
        margin: 0;
        padding: 0;
        background-image: url("img/navigation/library-bg-image.jpeg");
        background-size:cover;
    }

    #search-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
   
    .split{
        width: 100%;
    }

    #search-container1{
        background-color: #FFFFFF;
        padding: 2em;
        border-radius: 25px;
        margin-bottom: 20px;
    }

    #search-textbox, #search-category-dropdown {
        height: 2.5em;
        font-size: 20px;
        margin-bottom: 1em;
    }

    #search-textbox{
        width: 35em;
    }

    #search-category-dropdown{
        width:10em;
        background-color: #FFA500;
    }
    

    #search-category-dropdown:hover{
        background-color: #FF7900;
    }
    

    #search-input-container{
        display: flex;
        flex-wrap: wrap;
    }

    label,button{
        font-size: 20px;
    }
    
    #search-btn{
        width: 20em;
    }

    #btn-container{
        text-align: center;
    }

    #search-container .home-logo{
        width: 15em;
        top: 17em;
    }

    .logo-container{
        text-align: center;
        margin: 20px 0;
    }

    #cards-container{
        text-align: center;
    }

    .card{
        margin: 10px;
        display: inline-block;
    }

    .card-body{
        text-align:left;
    }

    .card-text{
        font-size: 15px;
        color:#000000;
    }

    .card:hover{
        border: 2px solid #FFA500;
        -ms-transform:scale(1.1,1.1);
        transform:scale(1.1,1.1);
        transition: 0.25s;
        color: #000000;
    }
    #cards-container{
        background-color: #FFFFFF;
        background: rgba(255, 255, 255, 0.5);
        padding: 15px;
        border-radius: 25px;
    }
    

</style>
<?php $this->end('css') ?>