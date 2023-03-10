<?php
global $profile;
global $posts;
global $profile_post;
global $user;

?>
<div class="container" style="margin-top: 80px; margin-bottom: 200px;padding-left: 2px;padding-right: 2px;">
		<div class="main-body">
			
				<div class="col-lg-12 justify-content-center" style="padding-left:2px:padding-right:2px;">
						<?php
							if ($user['id'] == $profile['id'])
							{
							?>
							<div class="row " style="margin-right:1px;margin-left:1px:margin-top:1px;margin-bottom:1px">
								<div class="col-12 col-xl-8 mb-4 mb-xl-0 ">
            		    			<h3 class="font-weight-bold">Welcome <?= $user['name']?></h3>
            		    			<h6 class="font-weight-normal mb-0 text-muted" > You have <span class="text-primary" id="notification_number"><?=getUnreadNotificationsCount()?> unread alerts!</span> & <span class="text-primary"><?=newMsgCount()?> unread Messages!</span></h6>
            		    		</div>
            		    		<div class="col-12 col-xl-4">
            		    			<div class="justify-content-end d-flex">
            		      				<div class="dropdown flex-md-grow-1 flex-xl-grow-0">
											<a class="dropdown-item" href="?editprofile">
                								<i class="ti-settings text-primary"></i>
              								  	Edit profile
              								</a>
            		      				</div>
            		     			</div>
            		    		</div>
							</div>
							<?php
							}
							?>

							<div class="card shadow-sm "style="margin-top:20px;margin-bottom:5px;">
								<div class="card-body"> 
									<div class="d-flex flex-column align-items-center text-center">
										<img src="assets/images/profile/<?=$profile['profile_pic']?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="200">
										<div class="mt-3">
											<h4><?=$profile['name']?>&nbsp;&nbsp;<?=verified($profile['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></h4>
											<h4 class="text-muted">@<?=$profile['username']?></h4>
											<p class="text-secondary mb-1"><?=profession($profile['profession'])?></p>
											<?php
											if (!checkBS($profile['id'])) {
												?>
											<div class="d-flex flex-wrap justify-content-center">	
												<div class="mr-2">
                	    						  	<a class="text-decoration-none" >
														<h3 class="text-primary fs-30 text-center font-weight-medium"><?= count($profile_post) ?></h3>
														<button class="text-white text-center btn-primary" disabled style="border-radius:5px;">Posts</button>

                	    						  	</a>
												</div>
												<div class="mr-2 ">
													<a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#follower_list">
														<h3 class="text-primary fs-30 text-center font-weight-medium"><?= count($profile['followers']) ?></h3>
                	    							  	<button class="text-white text-center btn-primary" style="border-radius:5px;">Connecters</button>
                	    							</a>
												</div>
												<div class="mr-2">
													<a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#following_list">
														<h3 class="text-primary fs-30 text-center font-weight-medium"><?= count($profile['following']) ?></h3>
														<button class="text-white text-center btn-primary" style="border-radius:5px;">Connecting</button>

                	    							</a>
												</div>
											</div>
											<?php
											}
											?>
											<div style="margin-top:20px">
											<?php
											if ($user['id'] != $profile['id'] ) 
											{
												if(checkBlockStatus($user['id'],$profile['id']))
												{
												?> 
												<button class="btn btn-danger text-white unblockbtn" data-user-Id=<?=$profile['id']?>>Unblock</button>
												<?php
												}
												elseif(checkBlockStatus($profile['id'],$user['id']))
												{ 
												?>
												<div class="alert alert-danger" role="alert">
												    <i class="bi bi-x-octagon-fill"></i> @<?=$profile['username']?> blocked you !
												</div>
												<?php 
												}
												elseif(checkFollowStatus($profile['id']))
												{
													?>
													<button class="btn btn-secondary text-white unfollowbtn connect-reload" data-user-Id=<?=$profile['id']?>>disconnect</button>
													<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chatbox" onclick="popchat(<?=$profile['id']?>)">Message</button>
													<?php
												}
												elseif(!checkFollowStatus($profile['id']))
												{
													?>
													<button class="btn btn-primary followbtn connect-reload" data-user-Id=<?=$profile['id']?>>connect</button>
													<?php
												}
											?>
       										
											   <?php
												if($user['id']!=$profile['id'] && !checkBS($profile['id']))
												{
												?>
												<div class="dropdown">
												    <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1"
												        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
												    <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
												        <a class="dropdown-item " href="assets/php/actions.php?block=<?=$profile['id']?>&username=<?=$profile['username']?>"><i class="bi bi-x-circle-fill"></i> Block</a>
													</span>
												</div>
												<?php
												}
											}
											?>
											</div>	
										</div>
									</div>
									<hr class="my-4">
									<?php
									if(!checkBS($profile['id']))
									{
									?>
									<div class="mt-3 align-items-center text-center">
										<h4>About Myself</h4>
										<p class="text-muted font-size-sm"><?=$profile['about']?></p>
									</div>
									<?php
									}
									?>
								</div>
							</div>
							
									
								
							
							<?php
							if (verified($user['profession']) && !checkBS($profile['id']) && checkFollowStatus($profile['id'])) 
							{
							?>
							<div class="row" style="margin-top:0px">
								<div class="col">
								<div class="card shadow-sm" style="margin-top:20px ;margin-bottom:20px;">
									<div class="card-body text-center">
										<h5 class="text-primary">Contact Info</h5>
										<p><b>Phone Number :</b>&nbsp <?= $profile['phonenumber'] ?></p>
										<p><b>Email :</b>&nbsp<?= $profile['email'] ?></p>
									</div>
								</div>
								</div>
							</div>
							<?php
							}
							
							if (!verified($user['profession'])&&($user['id'] == $profile['id'])) 
							{
							?>
							<div class="row" style="margin-top:0px">
								<div class="col">
								<div class="card shadow-sm" style="margin-top:20px ;margin-bottom:20px;">
									<div class="card-body text-center">
										<h5 class="text-primary">Contact Info</h5>
										<p><b>Phone Number :</b>&nbsp <?= $profile['phonenumber'] ?></p>
										<p><b>Email :</b>&nbsp<?= $profile['email'] ?></p>
									</div>
								</div>
								</div>
							</div>
							<?php
							}
							?>

						
						</div>

					
					
					
						<div class="card shadow-sm " style="margin-top:20px;" >
						<div class="card-body mt-10 justify-content-end" >
						<?php
							if(checkBS($profile['id']))
							{
							    $profile_post = array();
						?>
							<div class="alert alert-secondary text-center" role="alert">
							    <i class="bi bi-x-octagon-fill"></i> You are not allowed to see posts !
							</div>
						<?php
							}
						?>
						<div class=" d-flex-fluid " >
							<div class=" d-flex flex-wrap justify-content-start " >
								<?php
								if (checkFollowStatus($profile['id'])||($user['id'] == $profile['id'])) {

									foreach ($profile_post as $post) 
									{
										$comments=getComments($post['id']);
										$likes = getLikes($post['id']);
								?>
									<div class="d-flex align-items-center border " style="margin:2px;height:361px;width:361px;overflow:hidden;">
									<?php
    						        if(!$post['post_img']=="")
    						        {
										if($post['type']=="jpg"||$post['type']=="jpeg"||$post['type']=="png")
										{
    						        	?>
    						        	<img src="assets/images/posts/<?= $post['post_img']?>" style="width:361px;"  data-bs-toggle="modal" data-bs-target="#postview<?= $post['id'] ?>"/>
										<?php
										}
										elseif($post['type']=="mkv"||$post['type']=="mp4")
										{
										?>
										<img src="assets/images/posts/video-thumbnail.jpg" style="width:361px;"  data-bs-toggle="modal" data-bs-target="#postview<?= $post['id'] ?>">
										<?php
										}
									}
									else
									{
    						        ?>
										<div class="card-body " style="text-align: justify; padding:5px;" data-bs-toggle="modal" data-bs-target="#postview<?= $post['id'] ?>">
    						        	    <p class="h5"><?=$post['post_text']?></p>
    						        	</div>
									<?php
									}
									?>
									</div>
									<!-- this is for postview-->
    								<div class="modal fade" id="postview<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    								    <div class="modal-dialog modal-dialog-centered " style="margin-top: 30px;">
    								        <div class="modal-content">

    								            <div class="modal-body  d-flex-fluid flex-row p-0">
													
    								                <div class="col p-0">
														<div class="d-flex  justify-content-between p-2 border-bottom">
    								                        <div class="d-flex flex-row align-items-center">
																<img src="assets/images/profile/<?= $profile['profile_pic'] ?>" alt="" height="50" class="rounded-circle border">
																<div class="d-flex flex-column justify-content-start ml-2">
    								                        	    <h6 style="margin: 0px;"><?= $profile['name'] ?>&nbsp;&nbsp;<?= verified($profile['profession']) ? '<i class="bi-patch-check-fill text-primary"></i>' : '' ?></h6>
    								                        	    <h7 style="margin:0px;" class="text-muted">@<?= $profile['username'] ?></h7>
																</div>
															</div>
    								                        
															<a type="button" class="ti-close justify-content-end m-3" data-bs-dismiss="modal" aria-label="Close"></a>

    								                    </div>
    								                    
															<?php
    						        						if(!$post['post_img']=="")
    						        						{
																if($post['type']=="jpg"||$post['type']=="jpeg"||$post['type']=="png")
																{
    						        							?>
    						        							<img src="assets/images/posts/<?= $post['post_img'] ?>"   class="w-100 rounded-start">
																<?php
																}
																elseif($post['type']=="mkv"||$post['type']=="mp4")
																{
																?>
																<video controls src="assets/images/posts/<?= $post['post_img'] ?>" class="w-100 rounded-start">
																<?php
																}
															}
															else
															{
    						        						?>
															<div class="card-body" style="padding: 20px;">
    						        						    <p class="h3" style="text-align: justify;" ><?=$post['post_text']?></p>
    						        						</div>
															<?php
															}
															?>
    								                	
    								                </div>
													<div class=" col p-2">
														<span style="font-size: x-larger;" class="p-2 d-flex flex-row justify-content-between">
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
																<div>
																<i class="bi-heart-fill text-danger unlike_btn" style="display:<?=$display_unlike?>"  data-post-Id='<?=$post['id']?>'></i>
																<i class="bi-heart like_btn" style="display:<?=$display_like?>"  data-post-Id='<?=$post['id']?>'></i><span class="pl-2 text-small text-dark" data-bs-toggle="modal" data-bs-target="#like<?=$post['id']?>"><span id="likecount<?=$post['id']?>"><?=count($likes)?></span> likes </span>
																&nbsp;&nbsp;&nbsp;<i class="bi-chat-left text-dark " ></i>  <span  class="pl-2 text-small text-dark">&nbsp;<span id="commentcount<?=$post['id']?>"><?=count($comments)?></span> comments</span>&nbsp;&nbsp;<span style="font-size:small" class="text-muted">( Posted <?=show_time($post['created_at'])?> )</span>
																</div>
																<?php
																	if($user['id'] == $profile['id'])
																	{
																?>
																	<span class="dropdown">
																		<i class="ti-more-alt" id="option<?=$post['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>
																		<ul class="dropdown-menu" aria-labelledby="option<?=$post['id']?>">
																	    	<li><a class="dropdown-item" href="assets/php/actions.php?deletepost=<?=$post['id']?>"><i class="bi bi-trash-fill"></i> Delete Post</a></li>
																	  	</ul>
																	</span>
																<?php
																	}
																?>
																
														</span>
														<?php
    						        					if($post['post_text']&&$post['post_img'])
    						        					{
    						        					?>
														<div class="card-body" style="padding-left: 5;padding-left: 5px;padding-right: 5px;padding-top: 5px;padding-bottom: 5px;">
    						        					    <p class="font-weight-500"><span class="text-muted">@<?=$profile['username']?>  </span><?=$post['post_text']?></p>
    						        					</div>
    						        					<?php
    						        					}
    						        					?>
														
													</div>
			
													

    								                <div class="col ">
													<div class="input-group p-2 border-top border-bottom">
    								                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.."
    								                            aria-label="Recipient's username" aria-describedby="button-addon2">
    								                        <button class="btn btn-primary rounded-2 border-0 add-comment" data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button"
    								                            id="button-addon2">Post</button>
    								                    </div>
    								                    <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?= $post['id'] ?>" style="height:200px;">

														<?php
														$comments = getComments($post['id']);
														if (count($comments) < 1) {
															echo '<h3 class=" nce p-5 bg-white border rounded text-center text-muted" >No Comments</h3>';
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
    								                    
    								                </div>
																		


    								            </div>

    								        </div>
    								    </div>
    								</div>
									<!-- who liked -->
									<div class="modal fade" id="like<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog "style="margin-top:30px">
											<div class="modal-content">
											<div class="modal-header">
            									    <h5 class="modal-title">likes</h5>
            									    <a type="button" class="ti-close" data-bs-dismiss="modal" aria-label="Close"></a>
            									</div>
												<div class="modal-body">
													<div class="table-responsive" style="height:500px;">
														<table class="table  table-striped table-borderless mb-2" >
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
																		$fbtn = '<td class="font-weight-medium"><button class="btn btn-sm btn-secondary text-white unfollowbtn" data-user-Id="' .$fuser['id'].'">disonnect</button></td>';
																}
																elseif($user['id']==$f['user_id'])
																{
																	$fbtn = '<td></td>';
																}
																else
																{
																		$fbtn = '<td class="font-weight-medium"><button class="btn btn-sm btn-primary followbtn" data-user-Id="' .$fuser['id'].'">Connect</button></td>';
																}
															
															?>
																<tbody>
																	<tr>
																		<td style="padding:2px; align-items: left;"><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="user"></td>
																		<td class="font-weight-medium " style="padding:2px; ">
																			<a href="?u=<?=$fuser['username']?>" class="text-decoration-none text-dark"><p class="text-info align-items-left mb-0"><?=$fuser['name']?> <?=verified($fuser['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></p>
																			<p class="mb-0 text-muted">@<?=$fuser['username']?></p>
																		</td>
																		<?=$fbtn?>
																	</tr>
																</tbody>
															<?php
															}
															?>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
													
								
								
								<?php
									}
								}
								if(count($profile_post)<1)
								{
									echo '<h3 class=" p-5 bg-white border rounded text-center text-muted" >No Posts </h3>';
								}
								?>
							</div>
							</div>
						</div>
					</div>
				</div>
                
				
			
		</div>
	</div>

	<!-- this is for follower list -->
<div class="modal fade" id="follower_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
    	<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Connecters</h5>
                <a type="button" class="ti-close" data-bs-dismiss="modal" aria-label="Close"></a>
				
            </div>
            <div class="modal-body">
				<?php
					foreach($profile['followers'] as $f)
					{
						$fuser = getUser($f['follower_id']);
						$fbtn = "";
						if(checkFollowStatus($f['follower_id']))
						{
								$fbtn = '<button class="btn btn-sm btn-secondary text-white unfollowbtn" data-user-Id="' .$fuser['id'].'">disonnect</button>';
						}
						elseif($user['id']==$f['follower_id'])
						{
							$fbtn = '<button class="btn btn-outline-white rounded-0 border-0" disabled"></button>';
						}
						elseif(checkBS($fuser['id']))
						{
							$fbtn = '<button class="btn btn-sm btn-danger text-white" disabled >Blocked</button>';
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



	<!-- this is for following list -->
	<div class="modal fade" id="following_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
    	<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">connecting</h5>
                <a type="button" class="ti-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
			<?php
					foreach($profile['following'] as $f)
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



  