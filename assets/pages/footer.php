<?php
if(isset($_SESSION['Auth']))
{ 
?>
  
  <div class="modal fade" id="addpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Post</h5>
                <a type="button" class="ti-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <img src="" style="display:none" id="post_img" class="w-100 rounded border">
                <form method="post" action="assets/php/actions.php?addpost" enctype="multipart/form-data">
                    <div class="my-3">
                        <input name="post_img" class="file-upload-default" type="file" id="select_post_img">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Say Something</label>
                        <textarea name="post_text" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-primary" value="Post">
                    </div>
                </form>
            </div>
            
        </div>
    </div>
  </div>
  
<!-- notification -->

<div class="modal fade" id="notification_sidebar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" style="margin-top: 10px; margin-bottom:0px:" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel">Notifications</h5>
        <a type="button" class="ti-close text-decoration-none" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <?php
          $notifications = getNotifications();
          foreach($notifications as $not)
          {
          $time = $not['created_at'];
          $fuser = getUser($not['from_user_id']);
          $post='';
          if($not['post_id']){
              $post='data-bs-toggle="modal" data-bs-target="#postview'.$not['post_id'].'"';
          }
          $fbtn='';
        ?>
        <div class="preview-item-content"  <?=$post?>>
          <div class="d-flex flex-row justify-content-between align-items-center p-2">
                <div class="d-flex flex-row">
                  <img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
                  <div class="d-flex flex-column justify-content-center text-muted ml-3"     >
                      <a href='?u=<?=$fuser['username']?>'style="margin:0px;font-size:small" class="text-decoration-none <?=($not['read_status']==0)?'text-primary':'text-muted';?>">@<?=$fuser['username']?><br><?=$not['message']?></a>
                      <time style="font-size:small" class="timeago <?=$not['read_status']?'text-muted':''?> text-small" datetime="<?=$time?>"></time>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                 <?php
                  if($not['read_status']==2)
                  {
                  ?>
                    <span class="badge bg-danger text-white">Post Deleted</span>
                  <?php
                  }
                  ?>
                </div>
          </div>
            
          </div>
          <?php
          }
          ?>
      </div>
    </div>
  </div>
</div>

<!-- notification -->

              



<!-- chat list -->
  
<div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" style="margin-top: 10px; margin-bottom:0px:" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel">Chats</h5>
        <a type="button" class="ti-close text-decoration-none" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body d-flex flex-column-reverse " id="chatlist">

      </div>
    </div>
  </div>
</div>

<!-- chat box  -->
<div class="modal fade" id="chatbox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" style="margin-top: 10px; margin-bottom:0px:" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel"><a href='' id="chatter_username_id" class="text-decorection-none text-dark"><img src="assets/images/profile/default_profile.jpg" id="chatter_pic" class="rounded-circle border" height="50" width="50"> <span id="chatter_name">loading...</span></span>(@<span id="chatter_username"></span>)</a></h5>
        <a type="button" class="ti-close text-decoration-none" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body d-flex flex-column-reverse " id="user_chat">
        loading...
      </div>
      <div class="modal-footer p-0">
        <p class="p-2 text-danger mx-auto" id="blerror" style="display:none"> 
        <i class="bi bi-x-octagon-fill"></i> you are not allowed to send msg to this user anymore
        <div class="input-group p-2 " id="msgsender">
    		    <input type="text" class="form-control rounded-0 border-0 " id="msginput" placeholder="say something.."
    		        aria-label="Recipient's username" aria-describedby="button-addon2">
    		    <button class="btn btn-outline-primary rounded-0 border-0 " id="sendmsg" data-user-id="0">Send</button>
    		</div>
      </div>
    </div>
  </div>
</div>
<!-- chat box ends -->
<!-- chatlist -->
















<?php
} 
?>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- plugins:js -->
  <script src="assets/bootstrap/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/bootstrap/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/bootstrap/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="assets/bootstrap/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="assets/bootstrap/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/bootstrap/js/off-canvas.js"></script>
  <script src="assets/bootstrap/js/hoverable-collapse.js"></script>
  <script src="assets/bootstrap/js/template.js"></script>
  <script src="assets/bootstrap/js/settings.js"></script>
  <script src="assets/bootstrap/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/jquery.timeago.js"></script>

  <script src="assets/js/custom.js?v=<?=time()?>"></script>
  <script src="assets/bootstrap/js/dashboard.js"></script>
  <script src="assets/bootstrap/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

