<div id="librarian-navigation">

    <div id="header-top">
        <?= $this->Html->link($this->Html->image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'logo']),"#",  array('class' => 'logo-img-link', 'escape' => false)) ?>
        <div id="header-top-bg"></div>
    </div>
    
    <div id="header-bottom">
        <div class="header-bottom-child">
        <?= $this->Html->link('Home', ['controller' => '/home', 'action' => 'index'], ['class' => 'button nav-button']);?>
        <div class="dropdown" id="manage-account-dropdown">
            <button type="button" class="dropdown-toggle nav-button" data-toggle="dropdown">Manage Accounts</button>
            <ul class="dropdown-menu">
                    <li><?= $this->Html->link("View Borrowers' Account Details", ['controller' => '', 'action' => ''], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("Register New Accounts for Borrowers and Librarians", ['controller' => '', 'action' => ''], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("Approve Borrowers' Accounts", ['controller' => '', 'action' => ''], ['class' => 'dropdown-item']); ?></li>
            </ul>
        </div>
        <div class="dropdown" id="manage-book-dropdown">
                <button type="button" class="dropdown-toggle nav-button" data-toggle="dropdown">Manage Books</button>
                <ul class="dropdown-menu" id="manage-book-item">
                    <li><?= $this->Html->link("Add Books", ['controller' => '', 'action' => ''], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("View Books", ['controller' => '/books', 'action' => '/booklist'], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("Issue Books", ['controller' => '', 'action' => ''], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("Return Books", ['controller' => '', 'action' => ''], ['class' => 'dropdown-item']); ?></li>
                </ul>
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

        #librarian-navigation{
            top: 0;
            right:0;
            left: 0;
            width:100%;
            z-index: 1000;
            display:block;
            position: fixed;
            background-color: #FFFFFF;
            transition:top 0.3s;
        }

        #librarian-navigation #header-top #header-top-bg{
            height: 130px;
            background-image: url('../../img/navigation/header-top.jpeg');
            opacity: 0.7;
            background-repeat: no-repeat;
            background-size: cover;
            filter:blur(3px);
        }

        #librarian-navigation #header-bottom{
            background-color: #FFA500;
            outline-style: solid;
        }

        .header-bottom-child{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #header-top .logo{
            padding: 0.5em;
            width:7.5em;
            z-index: 1;
            position:fixed;
        }
        
        .nav-button{
            background-color: transparent;
            font-size: 20px;
            height: 70px;
            width: 300px;
            margin:0;
        }

        .nav-button:hover{
            background-color: #000000;
            font-weight: bold;
            margin: 0;
            text-decoration: none;
        }

        .dropdown:hover .dropdown-menu{
            margin-top: 0;
            display: block;
        }

        .dropdown-menu{
            background-color: #FFA500;
            width: 300px;
            padding: 0;
        }

        .dropdown-menu>li>a{
            word-wrap: break-word;
            white-space:normal;
        }

        .dropdown-menu .dropdown-item:hover{
            background-color: #000000;
            color: #FFFFFF !important;
            font-weight: bold;
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
            document.getElementById("librarian-navigation").style.top = "0";
        } else {
            document.getElementById("librarian-navigation").style.top = "-130px";
        }
        prevScrollpos = currentScrollPos;
        }
    </script>
<?php $this->end('script') ?>
