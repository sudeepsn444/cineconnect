<?php
global $user;
global $posts;
global $follow_suggestion;
?>
<div class="container-fluid" style="margin-top: 50px; margin-bottom: 50px;">
	<div class="main-body">
		<div class="row">
			
			<div class="col-lg-3 " style="margin-top: 10px;">
				<div class="hideme" style="display:none;">
						
        				<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="assets/images/profile/<?=$user['profile_pic']?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<a class="text-decoration-none text-dark" href="?u=<?=$user['username']?>">	
										<h4><?=$user['name']?>&nbsp;&nbsp;<?=verified($user['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></h4>
										<p class="text-secondary mb-1"><?=profession($user['profession'])?></p>
										<!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
									</a>
								</div>
							</div>
							<hr class="my-4">
							<div class="mt-3 align-items-center text-center">
								<h4>About Myself</h4>
								<p class="text-muted font-size-sm"><?=$user['about']?></p>
							</div>
						</div>
					
				</div>
			</div>
			<div class="col-lg-6" style="padding: 2px; margin-top: 20px; " >
				<div class="maincontent">
					<div class="row" style="margin: 10px;">
            		    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            		    	<h3 class="font-weight-bold">Welcome <?= $user['name']?></h3>
            		    			<h6 class="font-weight-normal mb-0 text-muted" > You have <span class="text-primary" id="notification_number"><?=getUnreadNotificationsCount()?> unread alerts!</span> & <span class="text-primary" ><?=newMsgCount()?> unread Messages!</span></h6>
            		    </div>
            		    <div class="col-12 col-xl-4">
            		    	<div class="justify-content-end d-flex">
            		      		<div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            		        		<button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            		         			<i class="mdi mdi-calendar"></i> SORT
            		        		</button>
            		        		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
            		          			<a class="dropdown-item" href="#">EVERYONE</a>
            		          			<a class="dropdown-item" href="#">ACTOR</a>
            		          			<a class="dropdown-item" href="#">DANCER</a>
            		         			<a class="dropdown-item" href="#">EDITOR</a>
										<a class="dropdown-item" href="#">SINGER</a>
										<a class="dropdown-item" href="#">WRITER</a>
									</div>
            		      		</div>
            		     	</div>
            		    </div>
            		</div>
					<hr>
					<?php
						showError('post_img');
						
  						if(isset($_GET['new_post_added']))
  						{
  						  ?>
  						    <div class="alert alert-success" style="border-radius: 1em;" role="alert">
  						      You have succesfully posted
  						    </div>
  						  <?php
  						}
					?>
					<?php
    				foreach($posts as $post)
    				{
						$comments=getComments($post['id']);
						$likes = getLikes($post['id']);
    				?>
					<div class="card shadow-sm" style="margin-bottom: 20px;border-radius:10px;">
						<div class="card-body" style="padding-right: 2px; padding-left: 2px; padding-top: 2px; padding-bottom: 2px;">
						<!--start of post-->
    						<div class="card-body" style=" padding:10px ;" >
    						    <div class="card-title d-flex justify-content-between  align-items-center m-0">
    						        <div class="d-flex align-items-center p-2">
    						            <img src="assets/images/profile/<?=$post['profile_pic']?>" alt="" height="30" class="rounded-circle border">&nbsp;&nbsp;
    						            <a href="?u=<?=$post['username']?>" class="text-decoration-none text-dark">
											<p class="text-dark mb-0"><?=$post['name']?> <?=verified($post['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></p>
    						            	<p class="mb-0 text-muted">@<?=$post['username']?></p>
										</a>
    						        </div>
    						        <!-- <div class="p-2">
    						            <i class="ti-more-alt"></i>
    						        </div> -->
    						    </div>
    						</div>
    						<div class="card-body p-0" >
    						    <div class="card">
    						        <!--post content-->
									<?php
    						        if(!$post['post_img']=="")
    						        {
										if($post['type']=="jpg"||$post['type']=="jpeg"||$post['type']=="png")
										{
    						        	?>
    						        	<img src="assets/images/posts/<?=$post['post_img']?>" loading=lazy class="d-flex " alt=" ...">
										<?php
										}
										elseif($post['type']=="mkv"||$post['type']=="mp4")
										{
										?>
										<div class="d-flex ">
    						        	<video auto id="myvideo<?=$post['id']?>" loading=lazy controls src="assets/images/posts/<?=$post['post_img']?>" width="100%" height="auto" alt="...">
										</div>
										
										<?php
										}
									}
									else
									{
    						        ?>
									<div class="post">
									    <div class="card-body" style="padding: 10px;">
									        <p class="h3 post-text" style="text-align: justify;">
									            <?= $post['post_text'] ?>
									        </p>
									        <a class="read-more text-primary">Read More</a>
									    </div>
									</div>
									<?php
									}
									?>
    						        <!--end of post content-->
									<span style="font-size: x-larger;" class="p-2">
										<?php
										if (checkLikeStatus($post['id'])) 
										{
											$display_like = 'none';
											$display_unlike = '';
										}
										else
										{
											$display_like = '';
											$display_unlike = 'none';
										}
										?>
										<i class="bi-heart-fill text-danger unlike_btn" style="display:<?=$display_unlike?>"  data-post-Id='<?=$post['id']?>'></i>
										<i class="bi-heart like_btn" style="display:<?=$display_like?>"  data-post-Id='<?=$post['id']?>'></i><span class="pl-2 text-small text-muted" data-bs-toggle="modal" data-bs-target="#likes<?=$post['id']?>"><span id="likecount<?=$post['id']?>"><?=count($likes)?></span> likes </span>
										&nbsp;&nbsp;&nbsp;<span data-bs-toggle="modal" data-bs-target="#comments<?=$post['id']?>"><i class="bi-chat-left text-dark " ></i>  <span  class="pl-2 text-small text-muted">&nbsp;<span id="commentcount<?=$post['id']?>"><?=count($comments)?></span> comments</span></span>
										<br><span style="font-size:small" class="text-muted">Posted</span> <?=show_time($post['created_at'])?> 
									
									</span>

										
									<?php
    						        if($post['post_text']&&$post['post_img'])
    						        {
    						        ?>
									
    						        <div class="card-body" style="padding-left: 5;padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;">
    						            <p class="font-weight-500"><span class="text-muted">@<?=$post['username']?>  </span><?=$post['post_text']?></p>
    						        </div>
    						        <?php
    						        }
    						        ?>
    						        <div class="input-group p-2 border-top">
    								    <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.."
    								        aria-label="Recipient's username" aria-describedby="button-addon2">
    								    <button class="btn btn-outline-primary rounded-2 border-0 add-comment" data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
    								        id="button-addon2">Post</button>
    								</div>
    						    </div>
    						</div>
    					<!--end of post-->
    					</div>

					</div>

								<!-- who commented popup-->
									<div class="modal fade" id="comments<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    									<div class="modal-dialog " style="margin-top:30px">
    								        <div class="modal-content">
												<div class="modal-header">
            									    <h5 class="modal-title">comments</h5>
            									    <a type="button" class="ti-close" data-bs-dismiss="modal" aria-label="Close"></a>
            									</div>
    								            <div class="modal-body  d-flex-fluid flex-row p-0">
													 <div class="col ">
    								                    <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?= $post['id'] ?>" style="height:500px">

														<?php
														$comments = getComments($post['id']);
														if (count($comments) < 1) {
															echo '<h3 class=" nce p-5 mt-2 bg-white border rounded text-center text-muted" >No Comments</h3>';
														}

														foreach ($comments as $comment) {
															$cuser = getUser($comment['user_id'])
																?>
    								                        
															<div class="d-flex align-items-center p-2">
    								                            <div><img src="assets/images/profile/<?= $cuser['profile_pic'] ?>" alt="" height="40" class="rounded-circle border">
    								                            </div>
    								                            <div>&nbsp;&nbsp;&nbsp;</div>
    								                            <div class="d-flex flex-column justify-content-start align-items-start">
																	<a href="?u=<?= $cuser['username'] ?>" class="text-decoration-none text-dark"><span class="text-muted align-items-left mb-0">@<?= $cuser['username'] ?> <?= verified($cuser['profession']) ? '<i class="bi-patch-check-fill text-primary"></i>' : '' ?></span> - <span style="margin:0px;" class="text-dark"><?= $comment['comment'] ?></span></a>
																	<p style="margin:0px;" class="text-muted">(<?=show_time($comment['created_at'])?>)</p>
    								                            </div>
    								                        </div>

														<?php
														}
														?>
    								                    </div>
    								                    <div class="input-group p-2 border-top">
    								                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.."
    								                            aria-label="Recipient's username" aria-describedby="button-addon2">
    								                        <button class="btn btn-primary rounded-2 border-0 add-comment" data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button"
    								                            id="button-addon2">Post</button>
    								                    </div>
    								                </div>



    								            </div>

    								        </div>
    								    </div>
    								</div>
									
					<!-- who liked popup -->
					<div class="modal fade" id="likes<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog "style="margin-top:30px">
							<div class="modal-content">
								<div class="modal-header">
            					    <h5 class="modal-title">likes</h5>
            					    <a type="button" class="ti-close" data-bs-dismiss="modal" aria-label="Close"></a>
            					</div>
								<div class="modal-body">
									<?php
									if(count($likes)<1)
									{
										echo '<h3 class=" p-5 bg-white border rounded text-center text-muted" >No likes</h3>';
									}
									foreach($likes as $f)
									{
										$fuser = getUser($f['user_id']);
										$fbtn = "";
										if(checkFollowStatus($f['user_id']))
										{
												$fbtn = '<button class="btn btn-sm btn-secondary text-white unfollowbtn" data-user-Id="' .$fuser['id'].'">disonnect</button>';
										}
										elseif($user['id']==$f['user_id'])
										{
											$fbtn = '<button class="btn btn-outline-white rounded-0 border-0" disabled"></button>';
										}
										else
										{
												$fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-Id="' .$fuser['id'].'">Connect</button>';
										}
									
									?>
        							<div class="preview-item-content" >
        							  <div class="d-flex flex-row justify-content-between align-items-center p-2">
        							        <div class="d-flex flex-row">
        							          	<img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
        							          	<div class="d-flex flex-column justify-content-center text-muted ml-3"     >
											  		<a href="?u=<?=$fuser['username']?>" class="text-decoration-none text-dark"><p class="text-dark align-items-left mb-0"><?=$fuser['name']?> <?=verified($fuser['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></p></a>
        							          		<p class="mb-0 text-muted">@<?=$fuser['username']?></p>    
												</div>
        							        </div>
        							        <div class="d-flex align-items-center">
												<?=$fbtn?>
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

					<?php
    				}
						if(count($posts)<1)
						{
							echo '<h3 class=" p-5 bg-white border rounded text-center text-muted" >Connect with some people to view post here</h3>';
						}
    				?>


            	</div>	
			</div>
			<div class="col-lg-3" id="hideMe" >
				<div class="leftbar">
					<div class="card-body" >
            	    	<!--start of you can also fallow-->
    					<p class="card-title text-secondary">People you can connect with</p>
						<hr>
                    	<?php
						foreach($follow_suggestion as $suser)
						{
						?>
						<div class="preview-item-content" >
        		  			<div class="d-flex flex-row justify-content-between align-items-center p-2">
        		        		<div class="d-flex flex-row">
        		          			<img src="assets/images/profile/<?=$suser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
        		          			<div class="d-flex flex-column justify-content-center text-muted ml-3"     >
						  				<a href="?u=<?=$suser['username']?>" class="text-decoration-none text-dark"><p class="text-dark align-items-left mb-0"><?=$suser['name']?> <?=verified($suser['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></p>
        		          				<p class="mb-0 text-muted">@<?=$suser['username']?></p></a>    
									</div>
        		        		</div>
        		        		<div class="d-flex align-items-center">
									<?php
									if (!checkBS($suser['id'])) {
									?>
										<button class="btn btn-sm btn-primary followbtn" data-user-Id='<?= $suser['id'] ?>'>Connect</button>
									<?php
									}
									else
									{
									?>
										<button class="btn btn-sm btn-danger text-white" disabled >Blocked</button>
									<?php
									}
									?>
        		        		</div>
        		  			</div>
						</div>
        				<?php
						}
						if(count($follow_suggestion)<1)
						{
							echo '<p class=" p-2 bg-white border rounded text-center">Currently no Suggestions for you</p>';
						}
						?>
						<!--end of you can also fallow-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>







		