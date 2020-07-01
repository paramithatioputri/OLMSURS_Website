<div id="librarian-navigation">

    <div id="header-top">
        <?= $this->Html->link($this->Html->image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'logo']),"#",  array('class' => 'logo-img-link', 'escape' => false)) ?>
        <div id="header-top-bg"></div>
    </div>
    
    <div id="header-bottom">
        <div class="header-bottom-child">
            <button class="nav-button">Home</button>
            <div class="dropdown" id="manage-account-dropdown">
                <button type="button" class="dropdown-toggle nav-button" data-toggle="dropdown">Manage Accounts</button>
                <ul class="dropdown-menu">
                        <li><a class="dropdown-item">View Borrowers' Account Details</a></li>
                        <li><a class="dropdown-item">Register New Accounts for Borrowers and Librarians</a></li>
                        <li><a class="dropdown-item">Approve Borrowers' Accounts</a></li>
                </ul>
            </div>
            <div class="dropdown" id="manage-book-dropdown">
                <button type="button" class="dropdown-toggle nav-button" data-toggle="dropdown">Manage Books</button>
                <ul class="dropdown-menu" id="manage-book-item">
                    <li><a class="dropdown-item">Add Books</a></li>
                    <li><a class="dropdown-item">View Books</a></li>
                    <li><a class="dropdown-item">Issue Books</a></li>
                    <li><a class="dropdown-item">Return Books</a></li>
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
            z-index: 1000;
            position: fixed;
            background-color: #FFFFFF;
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
