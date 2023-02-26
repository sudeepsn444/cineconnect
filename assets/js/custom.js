//for preview the post image
var input=document.querySelector("#select_post_img");
input.addEventListener("change",preview);

function preview()
{
    var filobject=this.files[0];
    var filereader=new FileReader();

    filereader.readAsDataURL(filobject);

    filereader.onload=function()
    {
        var image_src= filereader.result;
        var image=document.querySelector("#post_img");
        image.setAttribute('src',image_src)
        image.setAttribute('style','display:')
    }
}






//for following the user
$(".followbtn").click(function(){
  var user_id_v=$(this).data('userId');
  var button=this;
  $(button).attr('disable',true);

  $.ajax({
    url:'assets/php/ajax.php?follow',
    method:'post',
    dataType:'json',
    data:{user_id:user_id_v},
    success:function (response){
      
      if(response.status){
        $(button).data('userId',0)
        $(button).html('<i class="bi-link-45deg"></i>connected')
        
      }
      else
      {
        $(button).attr('disable',false);
        alert('Somthing is wrong try again after some time')
      }
    }
  })
});


//reload page 
$(".connect-reload").click(function(){
  location.reload(); 
})


//for unfollowing the user
$(".unfollowbtn").click(function(){
  var user_id_v=$(this).data('userId');
  var button=this;
  $(button).attr('disable',true);

  $.ajax({
    url:'assets/php/ajax.php?unfollow',
    method:'post',
    dataType:'json',
    data:{user_id:user_id_v},
    success:function (response){
      
      if(response.status){
        $(button).data('userId',0)
        $(button).html('<i class="bi-link-45deg"></i>disconnected')
        
      }
      else
      {
        $(button).attr('disable',false);
        alert('Somthing is wrong try again after some time')
      }
    }
  })
});


//for post like
$(".like_btn").click(function(){
  
  var post_id_v=$(this).data('postId');
  var button=this;
  $(button).attr('disable',true);

  $.ajax({
    url:'assets/php/ajax.php?like',
    method:'post',
    dataType:'json',
    data:{post_id:post_id_v},
    success:function (response){
      if(response.status){

          $(button).data('userId',0)
          $(button).hide();
          $(button).siblings('.unlike_btn').show();
          $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - (-1));
          location.reload(); 
      }
      else
      {
        $(button).attr('disable',false);
        alert('Somthing is wrong try again after some time')
      }
    }
  })
});


//for post unlike
$(".unlike_btn").click(function(){
  
  var post_id_v=$(this).data('postId');
  var button=this;
  $(button).attr('disable',true);

  $.ajax({
    url:'assets/php/ajax.php?unlike',
    method:'post',
    dataType:'json',
    data:{post_id:post_id_v},
    success:function (response){
      if(response.status){

          $(button).data('userId',0)
          $(button).hide();
          $(button).siblings('.like_btn').show();
          $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - 1);
          location.reload();
      }
      else
      {
        $(button).attr('disable',false);
        alert('Somthing is wrong try again after some time')
      }
    }
  })
});



//forsearching
var sr = false;

$("#search").focus(function () {
    $("#search_result").show();
});

$("#close_search").click(function () {
    $("#search_result").hide();
});

$("#search").keyup(function () {
  var keyword_v = $(this).val();

  $.ajax({
      url: 'assets/php/ajax.php?search',
      method: 'post',
      dataType: 'json',
      data: { keyword: keyword_v },
      success: function (response) 
      {
          console.log(response);
          if (response.status) 
          {
              $("#sra").html(response.users);
          } 
          else 
          {
            $("#sra").html('<p class="text-center text-muted">no user found !</p>');
          }
      }
  });

});

//forsearching_web
var sr = false;

$("#search_web").focus(function () {
    $("#search_result_web").show();
});

$("#close_search_web").click(function () {
    $("#search_result_web").hide();
});

$("#search_web").keyup(function () {
  var keyword_v = $(this).val();

  $.ajax({
      url: 'assets/php/ajax.php?search',
      method: 'post',
      dataType: 'json',
      data: { keyword: keyword_v },
      success: function (response) 
      {
          console.log(response);
          if (response.status) 
          {
              $("#sra_web").html(response.users);
          } 
          else 
          {
            $("#sra_web").html('<p class="text-center text-muted">no user found !</p>');
          }
      }
  });

});


//for adding a comment
$(".add-comment").click(function(){
  var button=this;
  var comment_v=$(button).siblings('.comment-input').val();
  
  if(comment_v=='')
  {
    return 0;
  }
  var post_id_v=$(this).data('postId');
  var cs=$(this).data('cs');
  var page=$(this).data('page');
  
  $(button).attr('disable',true);
  $(button).siblings('.comment-input').attr('disable',true);

  $.ajax({
    url:'assets/php/ajax.php?addcomment',
    method:'post',
    dataType:'json',
    data:{post_id:post_id_v,comment:comment_v},
    success:function (response){
      console.log(response)
      if(response.status){

          $(button).data('userId',0)
          $(button).siblings('.comment-input').attr('disable',false);
          $(button).siblings('.comment-input').val('');
          $("#"+cs).append(response.comment);
          $('.nce').hide();
          if(page='wall')
          {
            location.reload();
          }
         
      }
      else
      {
        $(button).attr('disable',false);
        $(button).siblings('.comment-input').attr('disable',false);
        alert('Somthing is wrong try again after some time')
      }
    }
  })
});

jQuery(document).ready(function () {
  jQuery("time.timeago").timeago();
});


$("#show_not").click(function () {

  $.ajax({
      url: 'assets/php/ajax.php?notread',
      method: 'post',
      dataType: 'json',
      success: function (response) {
        console.log(response);
          if (response.status) {
            $("#bell").attr('class','bi-bell text-dark mx-0');
            $("#notification_number").html('0 unread alerts!');
          }
      }
  });

});

$("#show_not_web").click(function () {

  $.ajax({
      url: 'assets/php/ajax.php?notread',
      method: 'post',
      dataType: 'json',
      success: function (response) {
        console.log(response);
          if (response.status) {
            $("#bell-web").attr('class','bi-bell text-dark mx-0');
            $("#notification_number").html('0 unread alerts!');
          }
      }
  });

});

var chatting_user_id=0;

$(".chatlist_item").click()

function popchat(user_id){
  $("#chatter_name").text('Loading...');
  $("#user_chat").html('<div class="spinner-border text-primary" role="status"></div>');
  $("#chatter_pic").attr('src','assets/images/profile/default_profile.jpg');
  chatting_user_id=user_id;
  $("#sendmsg").attr('data-user-id',user_id)
}




$('#sendmsg').click(function(){
  var user_id=chatting_user_id;
  var msg=$("#msginput").val();
  if(!msg)return;

  $("sendmsg").attr("disabled",true)
  $("#msginput").attr("disabled",true)
  $.ajax({
    url: 'assets/php/ajax.php?sendmessage',
    method: 'post',
    dataType: 'json',
    data:{user_id: user_id,msg:msg},
    success: function (response){
      if(response.status)
      {
        $("sendmsg").attr("disabled",false)
        $("#msginput").attr("disabled",false)
        $("#msginput").val('')
      }
      else
      {
        alert("something is wrong");
      }
    }
    
  })
  // console.log(msg);
  // console.log(user_id);

})


function synmsg(){
  $.ajax({
    url: 'assets/php/ajax.php?getmessages',
    method: 'post',
    dataType: 'json',
    data:{chatter_id: chatting_user_id},
    success: function (json){
      console.log(json);
      $("#chatlist").html(json.chatlist);
      if (json.blocked) {
        $("#msgsender").hide();
        $("#blerror").show();
        
      } 
      else 
      {
          $("#msgsender").show();
          $("#blerror").hide();
      }
      if(chatting_user_id!=0)
      {
        $("#chatter_name").text(json.chat.userdata.name);
        $("#user_chat").html(json.chat.msgs);
        $("#chatter_username").text(json.chat.userdata.username);
        $("#chatter_pic").attr('src','assets/images/profile/'+json.chat.userdata.profile_pic);
      }

    }
    
  })
}




$(".unblockbtn").click(function () {
  var user_id_v = $(this).data('userId');
  var button = this;
  $(button).attr('disabled', true);
  console.log('clicked');
  $.ajax({
      url: 'assets/php/ajax.php?unblock',
      method: 'post',
      dataType: 'json',
      data: { user_id: user_id_v },
      success: function (response) {
          console.log(response);
          if (response.status) {
              location.reload();
          } else {
              $(button).attr('disabled', false);

              alert('something is wrong,try again after some time');
          }
      }
  });
});





synmsg();

setInterval(() => {
synmsg();
  
}, 1000);

// Check the screen width
function screenWidth() {
  return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
}

// If the screen width is less than 768 pixels, hide the website-nav and show the mobile-nav
if (screenWidth() < 768) {
  document.querySelector('.website-nav').style.display = 'none';
  document.querySelector('.mobile-nav').style.display = 'block';
  document.querySelector('.hideme').style.display = 'none';
}
// If the screen width is 768 pixels or more, hide the mobile-nav and show the website-nav
else {
  document.querySelector('.website-nav').style.display = 'block';
  document.querySelector('.mobile-nav').style.display = 'none';
  document.querySelector('.hideme').style.display = 'block';
}


