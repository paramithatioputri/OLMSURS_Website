<div id="librarian-navigation">

    <div id="header-top">
        <?= $this->Html->link($this->Html->image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'logo']),"/",  array('class' => 'logo-img-link', 'escape' => false)) ?>
        <?php 
        if(!empty($auth_user)){
        if(empty($auth_user['profile_image'])){ 
                if($auth_user['gender'] == "Male"){?>
                    <?= $this->Html->link($this->Html->image("http://localhost:2/olmsurs_website/webroot/img/no-profile-male.png", ['alt' => 'male-profile-img', 'class' => 'profile-img']), "/admin/librarians/personal-account/", ['escape' => false]); ?>
                <?php } else if($auth_user['gender'] == "Female"){ ?>
                    <?= $this->Html->link($this->Html->image("http://localhost:2/olmsurs_website/webroot/img/no-profile-female.jpg", ['alt' => 'female-profile-img', 'class' => 'profile-img']), "/admin/librarians/personal-account/", ['escape' => false]); ?>
                <?php
                }}else{ ?>
                <?= $this->Html->link($this->Html->image(h($auth_user['profile_image']), ['alt' => 'profile-image', 'class' => 'profile-img']), "/admin/librarians/personal-account/", ['escape' => false]); ?>
            <?php  }?>
            <div id="greeting-text">
                <p id="greetings">Welcome, <?= h($auth_user['first_name']) ?> <?= h($auth_user['last_name']) ?>!</p>
                <p><?= $this->Html->link('Logout', ['controller' => 'home', 'action' => 'logout', 'prefix' => false], ['class' => 'btn btn-outline-warning']); ?></p>
            </div>
        <?php }else{ ?>
            <label class="login-register"><?= $this->Html->link('LOGIN',['controller' => 'home', 'action' => 'login'], ['class' => 'btn btn-outline-warning']); ?> | <?= $this->Html->link('REGISTER',['controller' => 'home', 'action' => 'self-register'], ['class' => 'btn btn-outline-warning']); ?></label>
        <?php } ?>
        <div id="header-top-bg"></div>
    </div>
    
    <div id="header-bottom">
        <div class="header-bottom-child">
        <?php if(!empty($auth_user)){ ?>
        <?= $this->Html->link('Home', ['controller' => '/home', 'action' => 'index','prefix' => false], ['class' => 'button nav-button']);?>
        <div class="dropdown" id="manage-account-dropdown">
            <button type="button" class="dropdown-toggle nav-button" data-toggle="dropdown">Manage Accounts</button>
            <ul class="dropdown-menu">
                    <li><?= $this->Html->link("View Borrowers' Account Details", "/admin/librarians/all_borrowers_accounts/", ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("View Librarians' Account Details", "/admin/librarians/all_librarians_accounts/", ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("Register New Accounts", "/admin/librarians/register-accounts/", ['class' => 'dropdown-item']); ?></li>
            </ul>
        </div>
        <div class="dropdown" id="manage-book-dropdown">
                <button type="button" class="dropdown-toggle nav-button" data-toggle="dropdown">Manage Books</button>
                <ul class="dropdown-menu" id="manage-book-item">
                
                    <li><?= $this->Html->link("Add Books", ['controller' => '/books', 'action' => '/add_books', 'prefix' => false], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("View Books", ['controller' => '/books', 'action' => '/booklist', 'prefix' => false], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("Issue Books", ['controller' => '/books', 'action' => '/issue_book_list', 'prefix' => false], ['class' => 'dropdown-item']); ?></li>
                    <li><?= $this->Html->link("Return Books", ['controller' => '/books', 'action' => '/return_books', 'prefix' => false], ['class' => 'dropdown-item']); ?></li>
                </ul>
            </div>
        </div>
        <?php }else{ ?>
        <?php 
            echo $this->Html->link('Home', ['controller' => '/home', 'action' => 'index'], ['class' => 'button nav-button']);
            echo $this->Html->link('View Books', ['controller' => '/books', 'action' => 'booklist'], ['class' => 'button nav-button']); 
            ?>
        <?php } ?>
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
            background-image: url('http://localhost:2/olmsurs_website/webroot/img/navigation/header-top.jpeg');
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
            -ms-transform: scale(1.0,1.0);
            transform: scale(1.0,1.0);
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

        .profile-img{
            padding: 0.5em;
            margin-right: 10px;
            width:7.5em;
            height:7.5em;
            z-index: 1;
            border-radius: 50%;
            position: fixed;
            right: 0;
            filter: drop-shadow(6px 6px 6px #FFA500);
            box-shadow: 3px 3px 3px #000000;
        }

        #greeting-text{
            position:absolute;
            z-index: 2;
            left: 8em;
        }

        #greetings{
            font-weight: bold;
            font-size: 20px;
            text-shadow: 2px 2px 8px #FFA500;
        }

        a, a:hover{
            color: #000000;
            text-decoration: none;
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
