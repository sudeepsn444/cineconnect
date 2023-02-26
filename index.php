<?php

require_once('assets/php/functions.php');



if(isset($_GET['newfp']))
{
  unset($_SESSION['auth_temp']);
  unset($_SESSION['forgot_email']);
  unset($_SESSION['forgot_code']);
}

if(isset($_SESSION['Auth']))
{
  $user = getUser($_SESSION['userdata']['id']);
  $posts = filterPost();
  $follow_suggestion = filterFollowSuggestion();
  
}

$pagecount = count($_GET);



// manage pages
if(isset($_SESSION['Auth'])&& $user['ac_status']==1 && !$pagecount)
{
  showPage('header',['page_title'=>'cineconnect - HOME']);
  showPage('navbar');
  showPage('wall');
} 
elseif(isset($_SESSION['Auth'])&& $user['ac_status']==0 && !$pagecount)
{
  showPage('header',['page_title'=>'cineconnect - verify']);
  showPage('verify_email');
}
elseif(isset($_SESSION['Auth'])&& $user['ac_status']==2 && !$pagecount)
{
  showPage('header',['page_title'=>'cineconnect - BLOCKED']);
  showPage('blocked');
}
elseif(isset($_SESSION['Auth'])&& isset($_GET['editprofile'])&& $user['ac_status']==1)
{
  showPage('header',['page_title'=>'cineconnect - Edit profile']);
  showPage('navbar');
  showPage('edit_profile');
}
elseif(isset($_SESSION['Auth'])&& isset($_GET['u'])&& $user['ac_status']==1)
{
  $profile = getUserByusername($_GET['u']);
  if(!$profile)
  {
    showPage('header',['page_title'=>'cineconnect - User not found']);
    showPage('navbar');
    showPage('user_not_found');
  }
  else
  {
    $profile_post = getPostById($profile['id']);
    $profile['followers'] = getfollowers($profile['id']);
    $profile['following'] = getfollowing($profile['id']);
    showPage('header',['page_title'=>'cineconnect - '.$profile['name']]);
    showPage('navbar');
    showPage('profile');
  }
  
}
elseif(isset($_GET['signup']))
{
  
  showPage('header',['page_title'=>'cineconnect - SignUp']);
  showPage('signup');
}
else if(isset($_GET['login']))
{
  showPage('header',['page_title'=>'cineconnect - login']);
  showPage('login');
}
else if(isset($_GET['forgotpassword']))
{
  showPage('header',['page_title'=>'cineconnect - Forgot password']);
  showPage('forgotpassword');
}
else if(isset($_GET['splsignup']))
{
  showPage('header',['page_title'=>'cineconnect - SignUp']);
  showPage('splsignup');
}
else
{
  if(isset($_SESSION['Auth'])&& $user['ac_status']==1)
  {
    showPage('header',['page_title'=>'cineconnect - HOME']);
    showPage('navbar');
    showPage('wall');
  }
  elseif(isset($_SESSION['Auth'])&& $user['ac_status']==0 )
  {
    showPage('header',['page_title'=>'cineconnect - verify']);
    showPage('verify_email');
  }
  elseif(isset($_SESSION['Auth'])&& $user['ac_status']==2 )
  {
    showPage('header',['page_title'=>'cineconnect - BLOCKED']);
    showPage('blocked');
  } elseif (isset($_SESSION['Auth']) && isset($_GET['editprofile']) && $user['ac_status'] == 1) {
    showPage('header', ['page_title' => 'cineconnect - Edit profile']);
    showPage('navbar');
    showPage('edit_profile');
  }
  else
  {
    showPage('header',['page_title'=>'cineconnect - login']);
    showPage('login');
  }
  
}




showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);
?>