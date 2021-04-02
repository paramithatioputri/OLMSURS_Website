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
      <?php if(isset($auth_user['role']) && $auth_user['role'] == 'librarian'){ ?>
      <?= $this->Form->create('changePassword', ['controller' => 'librarians', 'action' => 'change_password', 'id' => 'changePasswordForm']) ?>
      <?php }else{ ?>
      <?= $this->Form->create('changePassword', ['controller' => 'users', 'action' => 'change_password', 'id' => 'changePasswordForm']) ?>
      <?php } ?>
        <div class="modal-body">
        <?= $this->Form->control("Old Password", ['type' => 'password', 'required', 'placeholder' => 'Enter the old password', 'id' => 'old-password']) ?>
        <?php echo $this->Form->control("password", ["type" => "password", "placeholder" => "Enter the new password", "id" => "new-password", "oninput" => "checkPasswordMismatch(),checkPasswordLen()", 'required', 'label' => 'New Password']);?>
        <p class="checkPassword" id="checkPasswordLen"></p>
        <?php
        echo $this->Form->control("confirm_password", ["type" => "password", "placeholder" => "Re-enter the new password", "id" => "confirm-new-password", "oninput" => "checkPasswordMismatch()", 'required', 'label' => 'Confirm New Password']);
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
    $(document).ready(function(){

        $("#changePasswordForm").submit(function(e){
            if($("#old-password").val() == $("#new-password").val()){
                alert("The old and new password should not be homogeneous");
                e.preventDefault(e);
            }
            else if($("#new-password").val().length < 6){
                alert("The password entered must be at least 6 characters long");
                e.preventDefault(e);
            }
            else if($("#new-password").val() !== $("#confirm-new-password").val()){
                alert("The password entered does not match!");
                e.preventDefault(e);
            }
        });
    });

    function checkPasswordMismatch(){
        var password = document.getElementById("new-password").value;

        var confirmPassword = document.getElementById("confirm-new-password").value;
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
        var oldPassword = document.getElementById('old-password').value;
        var newPassword = document.getElementById("new-password").value;
        var passwordLen = newPassword.length;
        if(oldPassword == newPassword){
            document.getElementById("checkPasswordLen").innerHTML = "<i class='fa fa-times' aria-hidden='true'></i>The old and new password should not be homogeneous";
            document.getElementById("checkPasswordLen").style.color = "red";
        }
        else if(passwordLen < 6){
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