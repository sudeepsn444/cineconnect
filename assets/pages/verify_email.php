<?php
global $user;
?>




    
 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 border rounded shadow-sm">
                <form action="assets/php/actions.php?verify_email" method="post">
                    <h1 class="h5 mb-3 fw-normal">Verify Your Email Id</h1>
                    <p>Enter 6 Digit Code Sended to ( <?=$user['email']?> )</p>
                    <div class="form-floating mt-1">
                        <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="_ _ _ _ _ _">
                    </div>
                    <?php
                        if(isset($_GET['resended']))
                        {
                    ?>
                        <p class="text-success"> Verification code Resended! <p>
                    <?php   
                        }
                    ?>
                    <?=showError('email_verify')?>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary" type="submit">Verify Email</button>
                        <a href="assets/php/actions.php?resend_code" class="text-decoration-none" type="submit">Resend Code</a>
                    </div>
                    <br>
                    <a href="assets/php/actions.php?logout" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i>
                        Logout</a>
                </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
   
  </div>
  