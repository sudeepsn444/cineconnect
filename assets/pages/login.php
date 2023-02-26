
 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 border rounded shadow-sm">
              <div class="brand-logo">
                <img src="assets\images\cineconnect.png" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post" action="assets/php/actions.php?login" >
                <div class="form-group">
                  <input type="text" name="username_email" class="form-control form-control-lg" value="<?=showFormData('username_email')?>" id="exampleInputEmail1" placeholder="Username / Email">
                  <?=showError('username_email')?>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg"  id="exampleInputPassword1" placeholder="Password">
                  <?=showError('password')?>
                  <?=showError('checkuser')?>
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="LOG IN">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="?forgotpassword&newfp" class="auth-link text-black">Forgot password?</a>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="?signup" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>
   
  </div>
  