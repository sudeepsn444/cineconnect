
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
        
        <?php
        if (isset($_SESSION['forgot_code'])&& !isset($_SESSION['auth_temp']))
        {
            $action = "verifycode";
        }
        elseif (isset($_SESSION['forgot_code'])&& isset($_SESSION['auth_temp']))
        {
            $action = "changepassword";
        }
        else
        {
            $action = "forgotpassword";
        }

        ?>
        
        <form method="post" action="assets/php/actions.php?<?=$action?>">
                <div class="d-flex justify-content-center">
                </div>
                <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>

                <?php
                    if($action=='forgotpassword')
                    {
                ?>
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control rounded-0" placeholder="Enter your email">
                        </div>
                        <?=showError('email')?>
                        <br>
                        <button class="btn btn-primary" type="submit">Send Verification Code</button>
                <?php
                    }
                ?>

                <?php
                    if($action=='verifycode')
                    {
                ?>
                        <p>Enter 6 digit code sended to ( <?=$_SESSION['forgot_email']?> )</p>
                        <div class="form-floating mt-1">
                            <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="_ _ _ _ _ _">
                        </div>
                        <?=showError('code')?>
                        <br>
                        <button class="btn btn-primary" type="submit">Verify Code</button>
                <?php
                    }
                ?>

                <?php
                    if($action=='changepassword')
                    {
                ?>
                        <p>Enter New password</p>
                        <div class="form-floating mt-1">
                            <input type="password" name="password"class="form-control rounded-0" id="floatingPassword" placeholder="New Password">
                        </div>
                        <?=showError('password')?>
                        <br>
                        <button class="btn btn-primary" type="submit">Change Password</button>
                <?php
                    }
                ?>

                <br>
                <br>
                <br>
                <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
                    To
                    Login</a>
            </form>
        </div>
    </div>


   