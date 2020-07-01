<div id="borrower-navigation">

    <div id="header-top">
        <?= $this->Html->link($this->Html->image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'logo']),"#",  array('class' => 'logo-img-link', 'escape' => false)) ?>
        <div id="header-top-bg"></div>
    </div>
    
    <div id="header-bottom">
        <div class="header-bottom-child">
            <button class="nav-button">Home</button>
            <button class="nav-button">View Books</button>
            <button class="nav-button">Reserved Books</button>
            <button class="nav-button">View Book Borrowing History</button>
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
        }

        #borrower-navigation #header-top #header-top-bg{
            height: 130px;
            background-image: url('../img/navigation/header-top.jpeg');
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
            height: 70px;
            width: 300px;
        }

        .nav-button:hover{
            background-color: #000000;
            font-weight: bold;
        }

        .dropdown:hover .dropdown-menu{
            margin-top: 0;
            display: block;
        }

        .dropdown-menu{
            background-color: #FFA500;
            width: 300px;
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
            font-weight: bold;
        }
        
    </style>
<?php $this->end('css') ?>
