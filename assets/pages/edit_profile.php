<?php
global $user;
?>


         
<div class="content-wrapper"  style="margin-top: 50px; margin-bottom: 50px;">
  <?php
  if(isset($_GET['success']))
  {
    ?>
      <div class="alert alert-success" style="border-radius: 1em;" role="alert">
        Profile has been updated!!
      </div>
    <?php
  }
  ?>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-center">
                    <img src="assets/images/profile/<?=$user['profile_pic']?>" class="rounded-circle p-1 bg-primary "  style="height:250px;" alt="...">
                </div>
                
                <form  method="post" action="assets/php/actions.php?updateprofile" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-group col-xs-12 d-flex justify-content-center">
                      <label>Profile picture</label>
                    </div>
                      <div class="input-group col-xs-12 d-flex justify-content-center">
                        <span class="input-group" style="width: 270px;">
                          <input type="file" name="profile_pic" class="file-upload-browse btn btn-outline-primary" >
                        </span>
                      </div>
                      <?=showError('profile_pic')?>
                    </div>
                </div>
          </div>
                
           

                
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
        <div class="card-body">
           <h4 class="card-title text-primary">Edit profile</h4>
          
          
            <div class="form-group row">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" name="name" class="form-control" value="<?= $user['name']?>" id="exampleInputUsername2" placeholder="Name">
              <?=showError('name')?>
              </div>
            </div>

            <div class="form-group row">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input type="text" name="username" class="form-control" value="<?= $user['username']?>" id="exampleInputUsername2" placeholder="Username">
              <?=showError('username')?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Date of Birth</label>
              <div class="col-sm-9">
                <input type="text" name="dateofbirth" value="<?= $user['dateofbirth']?>" class="form-control text-muted" placeholder="dd/mm/yyyy"/>
              <?=showError('dateofbirth')?>
              </div>
             </div>

            <div class="form-group row">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Gender</label>
              <div class="col-sm-9">
              <select name="gender"  class="form-control form-control-lg text"  id="exampleFormControlSelect2">
                  <option value="1" <?=$user['gender']==1?'selected':''?>>MALE</option>
                  <option value="2" <?=$user['gender']==2?'selected':''?>>FEMALE</option>
                  <option value="3" <?=$user['gender']==3?'selected':''?>>OTHERS</option>
              </select>
              <?=showError('gender')?>
              </div>
            </div>

            <div class="form-group row">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" name="email" value="<?= $user['email']?>" class="form-control" id="exampleInputEmail2" placeholder="Email" disabled>
              </div>

            </div>
            
            
              
            <div class="form-group row">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone</label>
              <div class="col-sm-9">
                <input type="text" name="phonenumber" value="<?= $user['phonenumber']?>" class="form-control" id="exampleInputMobile" placeholder="Phone number">
              <?=showError('phonenumber')?>
              </div>
              
            </div>

            <?php
            if($user['profession']==1 || $user['profession']==2)
            {
            ?>
            <div class="form-group row">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Profession</label>
              <div class="col-sm-9">
                <select name="profession" class="form-control form-control-lg"  id="exampleFormControlSelect2">
                  <option value="0" <?=$user['profession']==0?'selected':''?>>PROFESSION</option>
                  <option value="1" <?=$user['profession']==1?'selected':''?>>DIRECTOR</option>
                  <option value="2" <?=$user['profession']==2?'selected':''?>>PRODUCER</option>
                </select>
              <?=showError('profession')?>
            </div>
            <?php
            }
            ?>

            <?php
            if($user['profession']==3 || $user['profession']==4|| $user['profession']==5 || $user['profession']==6|| $user['profession']==7)
            {
            ?>
            <div class="form-group row">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Profession</label>
              <div class="col-sm-9">
              <select name="profession"  class="form-control form-control-lg text"  id="exampleFormControlSelect2">
                  <option value="3" <?=$user['profession']==3?'selected':''?>>PROFESSION</option>
                  <option value="4" <?=$user['profession']==4?'selected':''?>>ACTOR</option>
                  <option value="5" <?=$user['profession']==5?'selected':''?>>DANCER</option>
                  <option value="6" <?=$user['profession']==6?'selected':''?>>EDITOR</option>
                  <option value="7" <?=$user['profession']==7?'selected':''?>>SINGER</option>
                  <option value="8" <?=$user['profession']==8?'selected':''?>>WRITER</option>
              </select>
              <?=showError('profession')?>
            </div>
            <?php
            }
            ?>

            
              
            </div>

            <div class="form-group row">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Experience</label>
              <div class="col-sm-9">
                <input type="number" name="experience" value="<?=$user['experience']?>" class="form-control" id="exampleInputPassword2" placeholder="Experience(Years)">
              <?=showError('experience')?>
              </div>
              
            </div>

            <div class="form-group">
              <label for="exampleTextarea1">About Yourself</label>
              <textarea name="about" class="form-control"  id="exampleTextarea1" rows="4"><?= $user['about']?></textarea>
              <?=showError('about')?>
            </div>

            <div class="form-group row">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">New Password</label>
              <div class="col-sm-9">
                <input type="password" name="password"  class="form-control" id="exampleInputPassword2" placeholder="Password">
              </div>
            </div>
            
            
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            
          </form>
        </div>
      </div>
    </div>
</div>
</div>
