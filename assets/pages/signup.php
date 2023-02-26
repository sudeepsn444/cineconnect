
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 border rounded shadow-sm ">
              <div class="brand-logo">
                <img src="assets\images\cineconnect.png" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" method="post" action="assets/php/actions.php?signup" >

                <div class="form-group">
                  <input type="text" name="name" class="form-control  form-control-lg" value="<?=showFormData('name')?>" id="exampleInputUsername1" placeholder="name">
                  <?=showError('name')?>
                </div>
                
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" value="<?=showFormData('username')?>" id="exampleInputUsername1" placeholder="username">
                  <?=showError('username')?>
                </div>
                <div class="form-group">
                  <input type="text" name="dateofbirth" class="form-control form-control-lg text-muted" value="<?=showFormData('dateofbirth')?>" id="exampleInputUsername1" placeholder="date of birth">
                  <?=showError('dateofbirth')?>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" value="<?=showFormData('email')?>" placeholder="Email">
                  <?=showError('email')?>
                </div>
                <div class="form-group">
                  <input type="phone" name="phonenumber" class="form-control form-control-lg" value="<?=showFormData('phonenumber')?>" id="exampleInputEmail1" placeholder="phone Number">
                  <?=showError('phonenumber')?>
                </div>
                <div class="form-group">
                        <select class="form-control" name="gender" id="exampleSelectGender" required>
                          <option value="4" <?=isset($_SESSION['formdata'])?'':'selected'?>>GENDER</option>
                          <option value="1" <?=showFormData('gender')==1?'selected':''?>>MALE</option>
                          <option value="2" <?=showFormData('gender')==2?'selected':''?>>FEMALE</option>
                          <option value="3" <?=showFormData('gender')==3?'selected':''?>>OTHERS</option>
                        </select>
                        <?=showError('gender')?>
                      </div>
                <div class="form-group">
                  <select name="profession" class="form-control form-control-lg"  id="exampleFormControlSelect2">
                    <option value="3" <?=isset($_SESSION['formdata'])?'':'selected'?> >PROFESSION</option>
                    <option value="4" <?=showFormData('profession')==4?'selected':''?>>ACTOR</option>
                    <option value="5" <?=showFormData('profession')==5?'selected':''?>>DANCER</option>
                    <option value="6" <?=showFormData('profession')==6?'selected':''?>>EDITOR</option>
                    <option value="7" <?=showFormData('profession')==7?'selected':''?>>SINGER</option>
                    <option value="8" <?=showFormData('profession')==8?'selected':''?>>WRITER</option>
                  </select>
                  <?=showError('profession')?>
                </div>
                <div class="form-group">
                  <input type="number" name="experience" class="form-control form-control-lg" value="<?=showFormData('experience')?>"id="exampleInputPassword1" placeholder="experience (years)">
                  <?=showError('experience')?>
                </div>
                <div class="form-group">
                  <textarea type="text" name="about" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="About Yourself"><?=showFormData('about')?></textarea>
                  <?=showError('about')?>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg"   id="exampleInputPassword1" placeholder="Password">
                  <?=showError('password')?>
                </div>
                
                <div class="mt-3">
                  <input type="submit" name='' class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN UP">
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="?login" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  