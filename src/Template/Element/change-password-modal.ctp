<!-- Modal -->

<div class="modal fade" id="changePasswordModalCenter" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLongTitle">Change Password</h5>
        <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= $this->Form->create('changePassword', ['controller' => 'librarian', 'action' => 'change_password']) ?>
        <div class="modal-body">
        <?= $this->Form->control("Old Password", ['type' => 'password', 'required', 'placeholder' => 'Enter the old password']) ?>
        <?php echo $this->Form->control("password", ["type" => "password", "placeholder" => "Enter the new password", "id" => "password", "oninput" => "checkPasswordMismatch(),checkPasswordLen()", 'required', 'label' => 'New Password']);?>
        <p class="checkPassword" id="checkPasswordLen"></p>
        <?php
        echo $this->Form->control("confirm_password", ["type" => "password", "placeholder" => "Re-enter the new password", "id" => "confirmpassword", "oninput" => "checkPasswordMismatch()", 'required', 'label' => 'Confirm New Password']);
        ?>
        <p class="checkPassword" id="checkPasswordMismatch"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-modal">Change Password</button>
        </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>

<?php $this->append('css')?>
<style>
    #close{
      width: 50px;
      padding: 0;
      margin:0;
    }

    #close:hover{
      background-color: transparent;
      color: red;
    }

    .btn-modal:hover{
      font-weight: normal;
      -ms-transform:scale(1.0,1.0);
      transform:scale(1.0,1.0);
      transition: 0;
    }

</style>
<?php $this->end('css') ?>


<?php $this->append('script') ?>
<script>
    function checkPasswordMismatch(){
        var password = document.getElementById("password").value;

        var confirmPassword = document.getElementById("confirmpassword").value;
        if(password == "" || confirmPassword == ""){
            document.getElementById("checkPasswordMismatch").innerHTML = "";
        }
        else if(password != confirmPassword){
            document.getElementById("checkPasswordMismatch").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>The password does not match!";
            document.getElementById("checkPasswordMismatch").style.color = "red";
        }
        else{
            document.getElementById("checkPasswordMismatch").innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>The password matches!";
            document.getElementById("checkPasswordMismatch").style.color = "#4CAF50";
        }
    }

    function checkPasswordLen(){
        var password = document.getElementById("password").value;
        var passwordLen = password.length;
        if(passwordLen < 6){
            document.getElementById("checkPasswordLen").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>The password must be at least 6 characters long";
            document.getElementById("checkPasswordLen").style.color = "red";
        }
        else{
            document.getElementById("checkPasswordLen").innerHTML = "<i class='fa fa-check' aria-hidden='true'></i>The password can be used!";
            document.getElementById("checkPasswordLen").style.color = "#4CAF50";
        }

    }
</script>
<?php $this->end('script') ?>