<?php
global $user;
global $posts;
global $follow_suggestion;
?>
<div class="container-fluid" style="margin-top: 50px; margin-bottom: 50px;">
	<div class="main-body">
		<div class="row">
			
			<div class="col-lg-3 " style="margin-top: 10px; position: -webkit-sticky;position: sticky; top: 0;" id="" >
				<div class="hideme" style="display:none;">
						<?php
							showError('post_img');
						?>
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
    						        <div class="p-2">
    						            <i class="ti-more-alt"></i>
    						        </div>
    						    </div>
    						</div>
    						<div class="card-body p-0" >
    						    <div class="card">
    						        <!--post content-->
    						        <img src="assets/images/posts/<?=$post['post_img']?>"  class="d-flex " alt="...">
    						        <!--<video autoplay loop src="assets/images/posts/video.mp4">-->
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
											<i class="bi-heart like_btn" style="display:<?=$display_like?>"  data-post-Id='<?=$post['id']?>'></i>
											&nbsp;&nbsp;&nbsp;<span data-bs-toggle="modal" data-bs-target="#comments<?=$post['id']?>"><i class="bi-chat-left text-dark " ></i>  <span  class="pl-2 text-small text-muted">&nbsp;<?=count($comments)?> comments</span></span>
									</span>
										<span class="pl-2 text-small text-muted" data-bs-toggle="modal" data-bs-target="#likes<?=$post['id']?>"><?=count($likes)?> likes </span>
										
									<?php
    						        if($post['post_text'])
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
    								    <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
    								        id="button-addon2">Post</button>
    								</div>
    						    </div>
    						</div>
    					<!--end of post-->
    					</div>
					</div>

					<!-- who commented popup-->
									<div class="modal fade" id="comments<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    								    <div class="modal-dialog modal-xl">
    								        <div class="modal-content">

    								            <div class="modal-body d-flex p-0">
    								                <div class="col-8">
    								                    <img src="assets/images/posts/<?=$post['post_img']?>" class="w-100 rounded-start">
    								                </div>



    								                <div class="col-4 d-flex flex-column">
    								                    <div class="d-flex align-items-center p-2 border-bottom">
    								                        <div><img src="assets/images/profile/<?=$post['profile_pic']?>" alt="" height="50" class="rounded-circle border">
    								                        </div>
    								                        <div>&nbsp;&nbsp;&nbsp;</div>
    								                        <div class="d-flex flex-column justify-content-start align-items-center">
    								                            <h6 style="margin: 0px;"><?=$post['name']?>&nbsp;&nbsp;<?=verified($post['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></h6>
    								                            <h7 style="margin:0px;" class="text-muted">@<?=$post['username']?></h7>
    								                        </div>
    								                    </div>
    								                    <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?=$post['id']?>" style="height: 100px;">

														<?php
														$comments=getComments($post['id']);
														if(count($comments)<1)
														{
															echo '<h3 class=" nce p-5 bg-white border rounded text-center text-muted" >No Comments</h3>';
														}
														
														foreach ($comments as $comment) 
														{
															$cuser=getUser($comment['user_id'])
														?>
    								                        
															<div class="d-flex align-items-center p-2">
    								                            <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" height="40" class="rounded-circle border">
    								                            </div>
    								                            <div>&nbsp;&nbsp;&nbsp;</div>
    								                            <div class="d-flex flex-column justify-content-start align-items-start">
																	<a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-dark"><p class="text-muted align-items-left mb-0">@<?=$cuser['username']?> <?=verified($cuser['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></p></a>
																	<p style="margin:0px;" class="text-muted"><?=$comment['comment']?></p>
    								                            </div>
    								                        </div>

														<?php
														}
														?>
    								                    </div>
    								                    <div class="input-group p-2 border-top">
    								                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.."
    								                            aria-label="Recipient's username" aria-describedby="button-addon2">
    								                        <button class="btn btn-outline-primary rounded-0 border-0 add-comment" dat-page='wall' data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
    								                            id="button-addon2">Post</button>
    								                    </div>
    								                </div>



    								            </div>

    								        </div>
    								    </div>
    								</div>

					<!-- who liked popup -->
					<div class="modal fade" id="likes<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog ">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Likes</h5>
									<a type="button" class="ti-close" data-bs-dismiss="modal" aria-label="Close"></a>
									<hr>
								</div>
								<div class="modal-body">
									<div class="table-responsive">
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
    						
							<div class="table-responsive">
							<p class="card-title text-secondary">People you can connect with</p>
							<hr>
                    			<table class="table table-striped table-borderless mb-2" >
									<?php
									foreach($follow_suggestion as $suser)
									{
									?>
									<tbody>
                    					<tr>
                    					  	<td style="padding:2px"><img src="assets/images/profile/<?=$suser['profile_pic']?>" alt="user"></td>
											<td class="font-weight-medium" style="padding:2px">
												<a href="?u=<?=$suser['username']?>" class="text-decoration-none text-dark"><p class="text-info align-items-left mb-0"><?=$suser['name']?> <?=verified($suser['profession'])?'<i class="bi-patch-check-fill text-primary"></i>':''?></p>
												<p class="mb-0 text-muted">@<?=$suser['username']?></p>
											</td>
											<?php
											if (!checkBS($suser['id'])) {
											?>
											<td class="font-weight-medium"><button class="btn btn-sm btn-primary followbtn" data-user-Id='<?= $suser['id'] ?>'>Connect</button></td>
											<?php
											}
											else
											{
											?>
											<td class="font-weight-medium"><button class="btn btn-sm btn-danger text-white" disabled >Blocked</button></td>
											<?php
											}
											?>
										</tr>
									</tbody>
									<?php
									}

									if(count($follow_suggestion)<1)
									{
										echo '<p class=" p-2 bg-white border rounded text-center">Currently no Suggestions for you</p>';
									}
									?>
								</table>
							</div>
							<!--end of you can also fallow-->
						</div>
					
				</div>
			</div>
        </div>
	</div>
</div>