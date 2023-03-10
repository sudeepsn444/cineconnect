<?php

require_once 'config.php';
$db=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database is not connected");

function showPage($page,$data="")
{
    include("assets/pages/$page.php");
}

//function for show errors
function showError($field)
{
    if(isset($_SESSION['error']))
    {
        $error=$_SESSION['error'];
        if(isset($error['field']) && ($field==$error['field']))
        {
            ?>
            <div class="alert alert-danger my-2" style="border-radius: 1em;"  role="alert">
                <?=$error['msg']?>
            </div>
            <?php
        }
    }
}



//function for show previous form data
function showFormData($field)
{
    if(isset($_SESSION['formdata']))
    {
        $formdata=$_SESSION['formdata'];
        return $formdata[$field];
    }
}

//for checking duplicate email
function isEmailRegistered($email)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE email='$email'";
    $run = mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row']; 
}

//for checking duplicate username
function isUsernameRegistered($username)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE username='$username'";
    $run = mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row']; 
}
//for checking duplicate username for update form
function isUsernameRegisteredByOther($username)
{
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM users WHERE username='$username'&& id!=$user_id";
    $run = mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row']; 
}

//for checking duplicate phonenumber for update form
function isPhonenumberRegisteredByOther($phonenumber)
{
    global $db;
    $user_id = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM users WHERE phonenumber='$phonenumber'&& id!=$user_id";
    $run = mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row']; 
}

//for checking duplicate phonenumber
function isPhonenumberRegistered($phonenumber)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE phonenumber='$phonenumber'";
    $run = mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row']; 
}

//for validating the signup form
function validateSignupForm($form_data)
{
    $response=array();
    $response['status'] = true;
        if(!$form_data['password'])
        {
            $response['msg'] = 'password is not given';
            $response['status'] = false;
            $response['field'] = 'password';
        }
        if(!$form_data['about'])
        {
            $response['msg'] = 'about is not given';
            $response['status'] = false;
            $response['field'] = 'about';
        }
        if(!$form_data['experience'])
        {
            $response['msg'] = 'experience is not given';
            $response['status'] = false;
            $response['field'] = 'experience';
        }
        
        if($form_data['profession']==3)
        {
            $response['msg'] = 'profession is not given';
            $response['status'] = false;
            $response['field'] = 'profession';
        }
        if($form_data['gender']==4)
        {
            $response['msg'] = 'gender is not given';
            $response['status'] = false;
            $response['field'] = 'gender';
        }
        
        if(!$form_data['phonenumber'])
        {
            $response['msg'] = 'phonenumber is not given';
            $response['status'] = false;
            $response['field'] = 'phonenumber';
        }
        if(!$form_data['email'])
        {
            $response['msg'] = 'email is not given';
            $response['status'] = false;
            $response['field'] = 'email';
        }
        if(!$form_data['dateofbirth'])
        {
            $response['msg'] = 'dateofbirth is not given';
            $response['status'] = false;
            $response['field'] = 'dateofbirth';
        }
        if(!$form_data['username'])
        {
            $response['msg'] = 'username is not given';
            $response['status'] = false;
            $response['field'] = 'username';
        }
        if(!$form_data['name'])
        {
            $response['msg'] = 'name is not given';
            $response['status'] = false;
            $response['field'] = 'name';
        }
        if(isEmailRegistered($form_data['email']))
        {
            $response['msg'] = 'email is already registered';
            $response['status'] = false;
            $response['field'] = 'email';
        }
        if(isUsernameRegistered($form_data['username']))
        {
            $response['msg'] = 'username is already registered';
            $response['status'] = false;
            $response['field'] = 'username';
        }
        if(isPhonenumberRegistered($form_data['phonenumber']))
        {
            $response['msg'] = 'phonenumber is already registered';
            $response['status'] = false;
            $response['field'] = 'phonenumber';
        }
    return $response;
}

//for validating the login form
function validateLoginForm($form_data)
{
    $response=array();
    $response['status'] = true;
    $blank = false;
        if(!$form_data['password'])
        {
            $response['msg'] = 'password is not given';
            $response['status'] = false;
            $response['field'] = 'password';
            $blank = true;
        }
        if(!$form_data['username_email'])
        {
            $response['msg'] = 'Username / Email is not given';
            $response['status'] = false;
            $response['field'] = 'username_email';
            $blank = true;
        }
        if(!$blank && !checkUser($form_data)['status'])
        {
            $response['msg'] = 'Somthing is incorrect, We cannot find you';
            $response['status'] = false;
            $response['field'] = 'checkuser';
        }
        else
        {
            $response['user'] = checkUser($form_data)['user'];
        }
        
    return $response;
}

//for checking the user 
function checkUser($login_data)
{
    global $db;
    $username_email = $login_data['username_email'];
    $password = md5($login_data['password']);

    $query = "SELECT * FROM users WHERE (email='$username_email' || username='$username_email') && password='$password'";
    $run = mysqli_query($db, $query);
    $data['user'] = mysqli_fetch_assoc($run) ?? array();
    if(count($data['user'])>0)
    {
        $data['status'] = true;
    }
    else
    {
        $data['status'] = false;
    }
    return $data;
}

//for getting user data by id
function getUser($user_id)
{
    global $db;
    $query = "SELECT * FROM users WHERE id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);
}

//for getting user data by username
function getUserByusername($username)
{
    global $db;
    $query = "SELECT * FROM users WHERE username='$username'";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);
}

//for getting post by id
function getPost()
{
    global $db;
    $query = "SELECT posts.id,posts.user_id,posts.post_img,posts.type,posts.post_text,posts.created_at,users.name,users.profession,users.username,users.profile_pic FROM posts JOIN users ON users.id=posts.user_id ORDER by id DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run,true);
}

//for getting post by based on following

function filterPost()
{
    $list = getPost();
    $filter_list = array();
    foreach($list as $post)
    {
        if (checkFollowStatus($post['user_id'])/*|| $post['user_id']==$_SESSION['userdata']['id']*/)
        {
            $filter_list[] = $post;
        }
    }
    return $filter_list;
}

//for filtering follow suggestion
function filterFollowSuggestion()
{
    $list = getFollowSuggestion();
    $filter_list = array();
    foreach($list as $user)
    {
        if (!checkFollowStatus($user['id'])&&count($filter_list)<5)
        {
            $filter_list[] = $user;
        }
    }
    return $filter_list;
}

//for checking the user is followed by current user or not
function checkFollowStatus($user_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}

//for getting users for fallow suggestions
function getFollowSuggestion()
    {   
        global $db;
        $current_user = $_SESSION['userdata']['id'];
        $query = "SELECT * FROM users WHERE id!=$current_user";
        $run = mysqli_query($db, $query);
        return mysqli_fetch_all($run,true);
    }


//function for follow the user
function followUser($user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO follow_list(follower_id,user_id) VALUES($current_user,$user_id)";
  
    createNotification($cu['id'],$user_id,"started following you !");
    return mysqli_query($db,$query);
    
}

//function check like status
function checkLikeStatus($post_id)
{
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query = "SELECT count(*) as row FROM likes WHERE user_id=$current_user && post_id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row'];
}

//function to unlike

function unlike($post_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM likes WHERE user_id=$current_user && post_id=$post_id";
    
    $poster_id = getPosterId($post_id);
    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"unliked your post !",$post_id);
    }
  
    return mysqli_query($db,$query);
}

//function for getting likes count
function getLikes($post_id)
{
    global $db;
    $query = "SELECT * FROM likes WHERE post_id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run,true);
}

//function to like
function like($post_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO likes(post_id,user_id) VALUES($post_id,$current_user)";
   $poster_id = getPosterId($post_id);
   
   if($poster_id!=$current_user){
    createNotification($current_user,$poster_id,"liked your post !",$post_id);
   }
   

    return mysqli_query($db,$query);
    
}

function getPosterId($post_id){
    global $db;
 $query = "SELECT user_id FROM posts WHERE id=$post_id";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run)['user_id'];

}

//function id of chat users
function getActiveChatUserIds()
{
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT from_user_id,to_user_id FROM messages WHERE to_user_id=$current_user_id || from_user_id=$current_user_id ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    $data= mysqli_fetch_all($run, true);
    $ids = array();
    foreach($data as $ch)
    {
        if($ch['from_user_id']!=$current_user_id && !in_array($ch['from_user_id'],$ids))
        {
            $ids[]=$ch['from_user_id'];
        }
        
        if($ch['to_user_id']!=$current_user_id && !in_array($ch['to_user_id'],$ids))
        {
            $ids[]=$ch['to_user_id'];
        }
        
    }
    return $ids;

}

function getMessages($user_id)
{
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT * FROM messages WHERE (to_user_id=$current_user_id && from_user_id=$user_id)||(from_user_id=$current_user_id && to_user_id=$user_id) ORDER BY id DESC";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run, true);

}

function sendMessage($user_id,$msg)
{
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "INSERT INTO messages(from_user_id,to_user_id,message)VALUES($current_user_id,$user_id,'$msg')";
    updateMessageReadStatus($user_id);
    return mysqli_query($db,$query);
}


function newMsgCount()
{
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "SELECT COUNT(*) as row_count FROM messages WHERE to_user_id = $current_user_id AND read_status = 0";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run)['row_count'];

}

function updateMessageReadStatus($user_id)
{
    $cu_user_id = $_SESSION['userdata']['id'];
    global $db;
    $query="UPDATE messages SET read_status=1 WHERE to_user_id=$cu_user_id && from_user_id=$user_id";
    return mysqli_query($db,$query);
  
}
//function get all messages

function getAllMessages()
{
    $active_chat_ids = getActiveChatUserIds();
    $conversation=array();
    foreach($active_chat_ids as $index=>$id)
    {
        $conversation[$index]['user_id'] = $id;
        $conversation[$index]['messages'] = getMessages($id);
    }
    return $conversation;
}

//function to comment
function addComment($post_id,$comment){
    global $db;
 $comment = mysqli_real_escape_string($db,$comment);

    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO comments(user_id,post_id,comment) VALUES($current_user,$post_id,'$comment')";
    $poster_id = getPosterId($post_id);

    if($poster_id!=$current_user){
        createNotification($current_user,$poster_id,"commented on your post",$post_id);
    }
   

    return mysqli_query($db,$query);
    
}


//function for getting comments
function getComments($post_id)
{
    global $db;
    $query = "SELECT * FROM comments WHERE post_id=$post_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run,true);
}

//for searching the users
function search($keyword){
    global $db;
 $query = "SELECT * FROM users WHERE name LIKE '%".$keyword."%'  || username LIKE '%".$keyword."%'LIMIT 5";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_all($run,true);

}



//function to unfallow a user
function unfollowing($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$user_id";

    createNotification($current_user,$user_id,"Unfollowed you !");
    return mysqli_query($db,$query);
 
    
}

//get followers count
function getfollowers($user_id)
{
    global $db;
    $query = "SELECT * FROM follow_list WHERE user_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run,true);
}

//get following count
function getfollowing($user_id)
{
    global $db;
    $query = "SELECT * FROM follow_list WHERE follower_id=$user_id";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run,true);
}

//for getting post by id for profile
function getPostById($user_id)
{
    global $db;
    $query = "SELECT * FROM posts WHERE user_id=$user_id ORDER BY id DESC";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run,true);
}

//for creating new user
function createUser($data)
{
    global $db;
    $name=mysqli_real_escape_string($db,$data['name']);
    $gender=$data['gender'];
    $email=mysqli_real_escape_string($db,$data['email']);
    $username=mysqli_real_escape_string($db,$data['username']);
    $password=mysqli_real_escape_string($db,$data['password']);
    $profession=$data['profession'];
    $phonenumber=mysqli_real_escape_string($db,$data['phonenumber']);
    // $dateofbirth=mysqli_real_escape_string($db,$data['dateofbirth']);
    $dateofbirth=date('y-m-d',strtotime($_POST['dateofbirth']));
    $password = md5($password);
    $about=mysqli_real_escape_string($db,$data['about']);
    $experience=mysqli_real_escape_string($db,$data['experience']);

    $query = "INSERT INTO users(name,gender,email,username,password,profession,phonenumber,dateofbirth,about,experience) VALUES ('$name',$gender,'$email','$username','$password',$profession,$phonenumber,'$dateofbirth','$about','$experience');";
   
    return mysqli_query($db,$query);
}

//function to verify email
function verifyEmail($email)
{
    global $db;
    $query = "UPDATE users SET ac_status=1 WHERE email='$email' ";
    return mysqli_query($db, $query);
}

function resetpassword($email,$password)
{
    global $db;
    $password = md5($password);
    $query = "UPDATE users SET password='$password' WHERE email='$email' ";
    return mysqli_query($db, $query);
}

//for validating the profile update form
function validateUpdateForm($form_data,$image_data)
{
    $response=array();
    $response['status'] = true;
        
        if(!$form_data['about'])
        {
            $response['msg'] = 'about is not given';
            $response['status'] = false;
            $response['field'] = 'about';
        }
        if(!$form_data['experience'])
        {
            $response['msg'] = 'experience is not given';
            $response['status'] = false;
            $response['field'] = 'experience';
        }
        
        if($form_data['profession']==3||$form_data['profession']==0)
        {
            $response['msg'] = 'profession is not given';
            $response['status'] = false;
            $response['field'] = 'profession';
        }
        if($form_data['gender']==4)
        {
            $response['msg'] = 'gender is not given';
            $response['status'] = false;
            $response['field'] = 'gender';
        }
        
        if(!$form_data['phonenumber'])
        {
            $response['msg'] = 'phonenumber is not given';
            $response['status'] = false;
            $response['field'] = 'phonenumber';
        }
        
        if(!$form_data['dateofbirth'])
        {
            $response['msg'] = 'dateofbirth is not given';
            $response['status'] = false;
            $response['field'] = 'dateofbirth';
        }
        if(!$form_data['username'])
        {
            $response['msg'] = 'username is not given';
            $response['status'] = false;
            $response['field'] = 'username';
        }
        if(!$form_data['name'])
        {
            $response['msg'] = 'name is not given';
            $response['status'] = false;
            $response['field'] = 'name';
        }
        
        if(isUsernameRegisteredByOther($form_data['username']))
        {
            $response['msg'] = $form_data['username']. 'is already registered';
            $response['status'] = false;
            $response['field'] = 'username';
        }
        if(isPhonenumberRegisteredByOther($form_data['phonenumber']))
        {
            $response['msg'] = 'phonenumber is already registered';
            $response['status'] = false;
            $response['field'] = 'phonenumber';
        }
        if($image_data['name'])
        {
            $image = basename($image_data['name']);
            $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            $size=$image_data['size']/1000;
            // $len=$image_data['image_height'];
            // $wid=$image_data['image_width'];
            if($type!='jpg'&& $type!='jpeg'&& $type!='png')
            {
                $response['msg'] = 'Only images with File Type ( jpg,jpeg,png ) are allowed!!';
                $response['status'] = false;
                $response['field'] = 'profile_pic';
            }
            if($size>3000)
            {
                $response['msg'] = 'Image size should be less than 3 MB';
                $response['status'] = false;
                $response['field'] = 'profile_pic';
            }
            
        }
    return $response;
}

//function for updating profile
function updateProfile($data,$imagedata)
{
    global $db;
    
    $name=mysqli_real_escape_string($db,$data['name']);
    $gender=$data['gender'];
    $username=mysqli_real_escape_string($db,$data['username']);
    $password=mysqli_real_escape_string($db,$data['password'])??'';
    $profession=$data['profession'];
    $phonenumber=mysqli_real_escape_string($db,$data['phonenumber']);
    $dateofbirth=mysqli_real_escape_string($db,$data['dateofbirth']);
    $about=mysqli_real_escape_string($db,$data['about']);
    $experience=mysqli_real_escape_string($db,$data['experience']);

    if(!$data['password'])
    {
        $password = $_SESSION['userdata']['password'];
    }
    else
    {
        $password=md5($password);
        $_SESSION['userdata']['password'] = $password;
    }
    $profile_pic="";
    if($imagedata['name'])
    {
        $image_name = time().basename($imagedata['name']);
        $image_dir = "../images/profile/$image_name";
        move_uploaded_file($imagedata['tmp_name'], $image_dir);
        $profile_pic = ",profile_pic='$image_name'";
    }

    $query = "UPDATE users SET name='$name',gender=$gender,username='$username',profession=$profession,phonenumber=$phonenumber,dateofbirth='$dateofbirth', about='$about',experience=$experience $profile_pic, password='$password'WHERE id=".$_SESSION['userdata']['id']."";
    return mysqli_query($db,$query);
}

//for validating add post
function validatePost($text,$image_data) 
{
    $response=array();
    $response['status'] = true;
        
        if(!$image_data['name'] && !$text)
        {
            $response['msg'] = 'Please Write somethige OR add a Post';
            $response['status'] = false;
            $response['field'] = 'post_img';
        }

        if($image_data['name'])
        {
            $image = basename($image_data['name']);
            $type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            // $size=$image_data['size']/1000;
            if($type!='jpg'&& $type!='jpeg'&& $type!='png' && $type!='mp4'&& $type!='mkv')
            {
                $response['msg'] = 'Only images with File Type ( jpg,jpeg,png,mp4,mkv ) are allowed!!';
                $response['status'] = false;
                $response['field'] = 'post_img';
            }
            
            

        //use this if limit is required for the post size
            // if($size>3000)
            // {
            //     $response['msg'] = 'Image size should be less than 1 MB';
            //     $response['status'] = false;
            //     $response['field'] = 'post_img';
            // }
        }
    return $response;
}

//for creating a post
function createPost($text,$image)
{
    global $db;
    $post_text=mysqli_real_escape_string($db,$text['post_text']);
    $user_id=$_SESSION['userdata']['id'];
    if($image['name'])
    {
        $image_type = basename($image['name']);
        $type = strtolower(pathinfo($image_type, PATHINFO_EXTENSION));
        $image_name = time().basename($image['name']);
        $image_dir = "../images/posts/$image_name";
        move_uploaded_file($image['tmp_name'], $image_dir);
        $query = "INSERT INTO posts(user_id,post_text,post_img,type) VALUES ($user_id,'$post_text','$image_name','$type');";
    }
    else
    {
        $query = "INSERT INTO posts(user_id,post_text) VALUES ($user_id,'$post_text');";
    }
    return mysqli_query($db,$query);
}

//for deleting a post
function deletePost($post_id){
    global $db;
$user_id=$_SESSION['userdata']['id'];
    $dellike = "DELETE FROM likes WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db,$dellike);
    $delcom = "DELETE FROM comments WHERE post_id=$post_id && user_id=$user_id";
    mysqli_query($db,$delcom);
    $not = "UPDATE notifications SET read_status=2 WHERE post_id=$post_id && to_user_id=$user_id";
mysqli_query($db,$not);


    $query = "DELETE FROM posts WHERE id=$post_id";
    return mysqli_query($db,$query);
}

//function for creating comments
function createNotification($from_user_id,$to_user_id,$msg,$post_id=0){
    global $db;
    $query="INSERT INTO notifications(from_user_id,to_user_id,message,post_id) VALUES($from_user_id,$to_user_id,'$msg',$post_id)";
    mysqli_query($db,$query);    
}

function gettime($date){
    return date('H:i - (F jS, Y )', strtotime($date));
}

//get notifications

function getNotifications(){
    $cu_user_id = $_SESSION['userdata']['id'];
  
      global $db;
      $query="SELECT * FROM notifications WHERE to_user_id=$cu_user_id ORDER BY id DESC";
      $run = mysqli_query($db,$query);
      return mysqli_fetch_all($run,true);
  }
  
function getUnreadNotificationsCount(){
    $cu_user_id = $_SESSION['userdata']['id'];
  
      global $db;
      $query="SELECT count(*) as row FROM notifications WHERE to_user_id=$cu_user_id && read_status=0 ORDER BY id DESC";
      $run = mysqli_query($db,$query);
      return mysqli_fetch_assoc($run)['row'];
  }

  function show_time($time){
    return '<time style="font-size:small" class="timeago text-muted text-small" datetime="'.$time.'"></time>';
  }

  function setNotificationStatusAsRead(){
        $cu_user_id = $_SESSION['userdata']['id'];
      global $db;
      $query="UPDATE notifications SET read_status=1 WHERE to_user_id=$cu_user_id";
      return mysqli_query($db,$query);
  }


function profession($profession)
{
    if($profession==1)
    {
        $display = 'DIRECTOR';
    }
    elseif($profession==2)
    {
        $display = 'PRODUCER';
    }
    elseif($profession==4)
    {
        $display = 'ACTOR';
    }
    elseif($profession==5)
    {
        $display = 'DANCER';
    }
    elseif($profession==6)
    {
        $display = 'EDITOR';
    }
    elseif($profession==7)
    {
        $display = 'SINGER';
    }
    elseif($profession==8)
    {
        $display = 'WRITER';
    }
    return $display;
}

function verified($profession)
{
    if($profession==1 || $profession==2)
    {
        return true;
    }
    else
    {
        return false;
    }
}





//function for blocking the user
function blockUser($blocked_user_id){
    global $db;
    $cu = getUser($_SESSION['userdata']['id']);
    $current_user=$_SESSION['userdata']['id'];
    $query="INSERT INTO block_list(user_id,blocked_user_id) VALUES($current_user,$blocked_user_id)";
  
    createNotification($cu['id'],$blocked_user_id,"blocked you");
    $query2="DELETE FROM follow_list WHERE follower_id=$current_user && user_id=$blocked_user_id";
    mysqli_query($db,$query2);
    $query3="DELETE FROM follow_list WHERE follower_id=$blocked_user_id && user_id=$current_user";
    mysqli_query($db,$query3);

   
    return mysqli_query($db,$query);
    
}

//for unblocking the user
function unblockUser($user_id){
    global $db;
    $current_user=$_SESSION['userdata']['id'];
    $query="DELETE FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id";
    createNotification($current_user,$user_id,"Unblocked you !");
    return mysqli_query($db,$query);   
}

//for checking the user is followed by current user or not
function checkBlockStatus($current_user,$user_id){
    global $db;
    
    $query="SELECT count(*) as row FROM block_list WHERE user_id=$current_user && blocked_user_id=$user_id";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}


function checkBS($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['id'];
    $query="SELECT count(*) as row FROM block_list WHERE (user_id=$current_user && blocked_user_id=$user_id) || (user_id=$user_id && blocked_user_id=$current_user)";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];
}