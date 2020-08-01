<?= $this->Html->css('button-custom.css');?>
<div id="login-container">
    <div class="logo-container">
        <?= $this->Html->Image("../img/navigation/OLMSURS_Website_Logo.png", ['alt' => 'olmsurs logo', 'class' => 'home-logo']); ?>
    </div>
    <div class="login-form">
        <?= $this->Form->create($userEntity) ?>
            <p id="login-title">Login</p>

            <div class="form-group input-container">
                <label for="userId-textbox" class="login-input-label">User ID:</label>
                <!-- <?= $this->Form->input('user_id', ['autofocus', 'type' => 'text', 'id' => 'userId-textbox', 'class' => 'form-control', 'placeholder' => 'Enter user ID', 'label' => '']); ?> -->
                <input name="user_id" autofocus type="text" id="userId-textbox" class="form-control" placeholder="Enter user ID" />
            </div>
            <div class="form-group input-container">
                <div>
                    <label for="password-textbox" class="login-input-label">Password:</label>
                </div>
                <div id="password-input-container">
                    <div>
                        <input name="password" type="password" min="8" id="password-textbox" class="form-control" placeholder="Enter user password" />
                        <button id="showhide" onclick="toggle_password('password-textbox');" type="button"><i class= "fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
            <div class="btn-container">
                <button id="login-btn" type="submit">Login</button>
            </div>
        <?= $this->Form->end() ?>
        <div class="register-small-note">
            <small>Haven't had any account yet?</small>
            <small><?= $this->Html->link('Click here to register', '/home/self-register', ['class' => 'register-link', 'target' => '_self']); ?></small>
        </div>
    </div>
</div>


<?php $this->append('css') ?>
<style>
    body{
        margin: 0;
        padding: 0;
        background-image: url("http://localhost:2/olmsurs_website/webroot/img/navigation/library-bg-image.jpeg");
        background-size:cover;
    }

    .login-form{
        background-color: #FFFFFF;
        padding: 2em;
        border-radius: 25px;
        position: absolute;
        top: 17em;
    }

    #userId-textbox, #password-textbox {
        height: 2.5em;
        width: 30em;
        font-size: 20px;
        margin-bottom: 1em;
    }

    .register-small-note{
        text-align: center;
    }

    #login-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    #login-title{
        font-size: 30px;
        text-align: center;
        font-weight: bold;
    }

    #password-textbox{
        display: inline-block;
    }

    #showhide{
        padding-bottom: 0.25em;
        right: 4.45em;
        top: 0.3em;
        background-color: #FFA500;
        width: fit-content;
        -ms-transform: scale(1.0,1.0);
        transform: scale(1.0,1.0);
    }

    .login-input-label{
        font-size: 15px;
    }
   
    .home-logo{
        width: 13em !important;
        margin-top: 2em;
    }

    .btn-container{
        text-align: center;
    }

</style>
<?php $this->end('css') ?>

<?php $this->append('script') ?>
<script>
    function toggle_password(target){
        var d = document;
        var tag = d.getElementById(target);
        var tag2 = d.getElementById("showhide");

        if(tag2.getElementsByClassName('fa fa-eye')[0]){
            tag.setAttribute('type', 'text');
            tag2.innerHTML = "<i class= 'fa fa-eye-slash'></i>";
            tag2.style.backgroundColor = "grey";
        }
        else{
            tag.setAttribute('type', 'password');
            tag2.innerHTML = "<i class= 'fa fa-eye'></i>";
            tag2.style.backgroundColor = "#FFA500";
        }
    }
</script>
<?php $this->end('script') ?>