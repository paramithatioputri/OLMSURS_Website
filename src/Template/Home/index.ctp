<?= $this->Html->css('library-background');?>

<div id="search-container">
    <?= $this->Html->Image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'home-logo']); ?>
    <div id="search-container1">
        <label>Search:</label>
        <div id="search-input-container">
            <input autofocus id="search-textbox" type="text" placeholder="Please insert any keywords to search"/>
            <select id="search-category-dropdown">
                <option>All Categories</option>
                <option>Keyword</option>
                <option>Title</option>
                <option>Author</option>
                <option>Subject</option>
                <option>ISBN</option>
                <option>Book Number</option>
            </select>
        </div>
        <div class="search-btn-container">
            <div>
                <button type="submit" id="search-btn" value="search">Search</button>
            </div>
        </div>
    </div>
</div>

<?php $this->append('css')?>
<style>
    body{
        margin: 0;
        padding: 0;
    }

    #search-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    #search-container1{
        background-color: #FFFFFF;
        padding: 2em;
        border-radius: 25px;
        top: 35em;
        position: absolute;
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

    #search-input-container{
        display: flex;
        flex-wrap: wrap;
    }

    label,button{
        font-size: 20px;
    }

    #search-btn{
        width: 20em;
        background-color: #FFA500;
        left: 250px;
    }

    #search-container .home-logo{
        width: 15em;
        position: absolute;
        top: 17em;
    }
    

</style>
<?php $this->end('css') ?>