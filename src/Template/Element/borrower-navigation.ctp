<div id="borrower-navigation">

    <div id="header-top">
        <?= $this->Html->link($this->Html->image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'logo']),"/",  array('class' => 'logo-img-link', 'escape' => false)) ?>
        <div id="header-top-bg" class="header-top-bg"></div>
    </div>
    
    <div id="header-bottom">
        <div class="header-bottom-child">
        <?php
            echo $this->Html->link('Home', ['controller' => '/home', 'action' => 'index'], ['class' => 'button nav-button']);
            echo $this->Html->link('View Books', ['controller' => '/books', 'action' => 'booklist'], ['class' => 'button nav-button']);
            echo $this->Html->link('Checked-out Books', ['controller' => '/books', 'action' => 'checkout'], ['class' => 'button nav-button']);
            echo $this->Html->link('View Book Borrowing History', ['controller' => '/books', 'action' => 'view-book-borrowing-history'], ['class' => 'button nav-button']);
            echo $this->Html->link('Rate Books', ['controller' => '/books', 'action' => 'rate_books'], ['class' => 'button nav-button']);
        ?>
        </div>
    </div>
</div>

<?php $this->append('css')?>
    <style>
        body{
            margin: 0;
            padding: 0;
        }

        #borrower-navigation{
            top: 0;
            right:0;
            left: 0;
            z-index: 1000;
            position: fixed;
            background-color: #FFFFFF;
            transition:top 0.3s;
        }

        #borrower-navigation #header-top #header-top-bg{
            height: 130px;
            background-image: url('http://localhost:2/olmsurs_website/webroot/img/navigation/header-top.jpeg');
            opacity: 0.7;
            background-repeat: no-repeat;
            background-size: cover;
            filter:blur(3px);
        }

        #borrower-navigation #header-bottom{
            background-color: #FFA500;
            outline-style: solid;
        }

        .header-bottom-child{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .logo{
            padding: 0.5em;
            width:7.5em;
            z-index: 1;
            position:fixed;
        }
        
        .nav-button{
            background-color: transparent;
            font-size: 20px;
            height: 80px;
            width: 300px;
            margin: 0;
        }

        .nav-button:hover{
            background-color: #000000;
            font-weight: bold;
            text-decoration: none;
            margin: 0;
        }

        .dropdown:hover{
            margin-top: 0;
            display: block;
        }
        
        .dropdown:hover button{
            background-color: #000000;
            color: #FFFFFF;
        }
        
    </style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
    <!-- Hide/show navbar when scrolling -->
    <script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("borrower-navigation").style.top = "0";
        } else {
            document.getElementById("borrower-navigation").style.top = "-130px";
        }
        prevScrollpos = currentScrollPos;
        }
    </script>
<?php $this->end('script') ?>
