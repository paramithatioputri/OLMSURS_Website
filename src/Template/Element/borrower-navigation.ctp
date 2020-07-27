<div id="borrower-navigation">

    <div id="header-top">
        <?= $this->Html->link($this->Html->image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'logo']),"/",  array('class' => 'logo-img-link', 'escape' => false)) ?>
        <?php 
        if(!empty($auth_user)){
        if(empty($auth_user['profile_image'])){ 
                if($auth_user['gender'] == "Male"){?>
                    <?= $this->Html->link($this->Html->image("http://localhost:2/olmsurs_website/webroot/img/no-profile-male.png", ['alt' => 'male-profile-img', 'class' => 'profile-img']), "/users/personal-account/", ['escape' => false]); ?>
                <?php } else if($auth_user['gender'] == "Female"){ ?>
                    <?= $this->Html->link($this->Html->image("http://localhost:2/olmsurs_website/webroot/img/no-profile-female.jpg", ['alt' => 'female-profile-img', 'class' => 'profile-img']), "/users/personal-account/", ['escape' => false]); ?>
                <?php
                }}else{ ?>
                <?= $this->Html->link($this->Html->image(h($auth_user['profile_image']), ['alt' => 'profile-image', 'class' => 'profile-img']), ['controller' => '/users', 'action' => 'personal-account'], ['escape' => false]); ?>
            <?php  }?>
            <div id="greeting-text">
                <p id="greetings">Welcome, <?= h($auth_user['first_name']) ?> <?= h($auth_user['last_name']) ?>!</p>
                <p><?= $this->Html->link('Logout', ['controller' => 'home', 'action' => 'logout','prefix' => false]); ?></p>
            </div>
        <?php }else{ ?>
            <label class="login-register"><?= $this->Html->link('LOGIN',['controller' => 'home', 'action' => 'login']); ?> | <?= $this->Html->link('REGISTER',['controller' => 'home', 'action' => 'self-register']); ?></label>
        <?php } ?>
        <div id="header-top-bg"></div>
    </div>
    
    <div id="header-bottom">
        <div class="header-bottom-child">
        <?php if(!empty($auth_user)){ ?>
        <?php
            echo $this->Html->link('Home', ['controller' => '/home', 'action' => 'index'], ['class' => 'button nav-button']);
            echo $this->Html->link('View Books', ['controller' => '/books', 'action' => 'booklist'], ['class' => 'button nav-button']);
            echo $this->Html->link('Checked-out Books', ['controller' => '/books', 'action' => 'checkout'], ['class' => 'button nav-button']);
            echo $this->Html->link('View Book Borrowing History', ['controller' => '/books', 'action' => 'view-book-borrowing-history'], ['class' => 'button nav-button']);
            echo $this->Html->link('Rate Books', ['controller' => '/books', 'action' => 'rate_books'], ['class' => 'button nav-button']);
        ?>
        <?php }else{ ?>
        <?php 
            echo $this->Html->link('Home', ['controller' => '/home', 'action' => 'index'], ['class' => 'button nav-button']);
            echo $this->Html->link('View Books', ['controller' => '/books', 'action' => 'booklist'], ['class' => 'button nav-button']); 
            ?>
        <?php } ?>
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
        }

        .login-register{
            position: fixed;
            right: 0;
            z-index:2;
            margin: 50px;
            font-size: 20px;
            font-weight: bold;
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
            document.getElementById("borrower-navigation").style.top = "0";
        } else {
            document.getElementById("borrower-navigation").style.top = "-130px";
        }
        prevScrollpos = currentScrollPos;
        }
    </script>
<?php $this->end('script') ?>
