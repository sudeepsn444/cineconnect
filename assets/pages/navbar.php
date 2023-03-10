<?php
global $user;
?>


<div class="mobile-nav" style="display:none;">
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" >
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-5" href="?home"><img src="assets/images/cineconnect.png" class="mr-2" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="?home"><img src="assets/images/cineconnectmini.png" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-right">
      <ul class="navbar-nav mr-lg-1">
        <li class="nav-item nav-search d-lg-block ml-0 ">
          <div class="input-group pr-0">
            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
              <form class="d-flex" id="searchform">
                <span class="input-group-text text-decoration-none">
                  <i class="icon-search"></i>
                </span>
                <input class="form-control" type="search" id="search" placeholder="looking for someone.." aria-label="Search" autocomplete="off"  >
                <div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99;" id="search_result" data-bs-auto-close="true">
                  <a type="button" class="ti-close text-decoration-none" aria-label="Close" id="close_search"></a>
                  <div id="sra" class="text-start">
                    <p class="text-center text-muted">enter name or username</p>
                  </div> 
                </div>
              </form>
            </div>
          </div>
        </li>
      </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <img src="assets/images/profile/<?=$user['profile_pic']?>" alt="profile"/>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="?u=<?=$user['username']?>">
              <i class="bi-person text-primary"></i>
              Profile
            </a>
            <a class="dropdown-item" href="assets/php/actions.php?logout">
              <i class="ti-power-off text-primary"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>  


    <nav class="navbar col-lg-12 col-12 p-0 fixed-bottom d-flex flex-col">
      <div class="navbar-menu-wrapper d-flex justify-content-around" style="width:100%;">
        
        <div class="nav-item navbar-nav nav-profile dropdown justify-content-start ">
            <a class="nav-link text-dark count-indicator " href="?home" >
              <i class="bi-house-door-fill " style="font-size:22px;"></i>
            </a>
        </div>
        <div class="nav-item navbar-nav nav-profile dropdown justify-content-start ">
            <a class="nav-link text-dark count-indicator " href="?movies" >
              <i class="bi-film " style="font-size:22px;"></i>
            </a>
        </div>
        <div class="nav-item navbar-nav nav-profile dropdown">
            <a class="nav-link text-dark count-indicator" data-bs-toggle="modal" data-bs-target="#addpost" href="#" >
              <i class="bi-plus-square-fill" style="font-size:22px;"></i>
            </a>
        </div>
        <div class="nav-item navbar-nav nav-profile dropdown">
            <a class="nav-link text-dark count-indicator" data-bs-toggle="modal" data-bs-target="#message" href="#" >
              <i class="bi-chat-left-fill" style="font-size:22px;"></i>
            </a>
        </div>
        <div class="nav-item navbar-nav nav-profile dropdown">
        <?php
            if(getUnreadNotificationsCount()>0)
            {
            ?>
            <a class="nav-link count-indicator " id="show_not" data-bs-toggle="modal" data-bs-target="#notification_sidebar" href="#" >
                <i class="bi-bell-fill  text-primary mx-0" id="bell" style="font-size:22px;"></i>
             </a>
            <?php
            }
            else
            {
            ?>
              <a class="nav-link count-indicator"  data-bs-toggle="modal" data-bs-target="#notification_sidebar" href="#" >
                <i class="bi-bell text-dark mx-0" style="font-size:22px;"></i>
              </a>
            <?php
            }
            ?>
        </div>
      </div>
    </nav>
</div>



    

    






  <div class="website-nav" style="display:none;">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" >
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="?home"><img src="assets/images/cineconnect.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="?home"><img src="assets/images/cineconnectmini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-right">
        <ul class="navbar-nav mr-lg-1">
          <li class="nav-item nav-search d-lg-block ml-0 ">
            <div class="input-group pr-0">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <form class="d-flex" id="searchform">
                  <span class="input-group-text text-decoration-none">
                    <i class="icon-search"></i>
                  </span>
                  <input class="form-control" type="search" id="search_web" placeholder="looking for someone.." aria-label="Search" autocomplete="off"  style="width:800px;">
                  <div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99;" id="search_result_web" data-bs-auto-close="true">
                    <a type="button" class="ti-close text-decoration-none" aria-label="Close" id="close_search_web"></a>
                    <div id="sra_web" class="text-start">
                      <p class="text-center text-muted">enter name or username</p>
                    </div> 
                  </div>
                </form>
              </div>
            </div>
          </li>
        </ul>

        <div class="navbar-menu-wrapper d-flex justify-content-around" style="width:100%;">
          
          <div class="nav-item navbar-nav nav-profile dropdown ">
              <a class="nav-link text-dark count-indicator " href="?home" >
                <i class="bi-house-door-fill " style="font-size:22px;"></i>
              </a>
          </div>
          <div class="nav-item navbar-nav nav-profile dropdown justify-content-start ">
            <a class="nav-link text-dark count-indicator " href="?movies" >
              <i class="bi-film " style="font-size:22px;"></i>
            </a>
          </div>
          <div class="nav-item navbar-nav nav-profile dropdown">
              <a class="nav-link text-dark count-indicator" data-bs-toggle="modal" data-bs-target="#addpost" href="#" >
                <i class="bi-plus-square-fill" style="font-size:22px;"></i>
              </a>
          </div>
          <div class="nav-item navbar-nav nav-profile dropdown">
              <a class="nav-link text-dark count-indicator" data-bs-toggle="modal" data-bs-target="#message" href="#" >
                <i class="bi-chat-left-fill" style="font-size:22px;"></i>
              </a>
          </div>
          <div class="nav-item navbar-nav nav-profile dropdown">
          <?php
              if(getUnreadNotificationsCount()>0)
              {
              ?>
              <a class="nav-link count-indicator " id="show_not_web" data-bs-toggle="modal" data-bs-target="#notification_sidebar" href="#" >
                  <i class="bi-bell-fill  mx-0 text-primary" id="bell-web" style="font-size:22px;"></i>
              </a>
              <?php
              }
              else
              {
              ?>
                <a class="nav-link count-indicator" data-bs-toggle="modal" data-bs-target="#notification_sidebar" href="#" >
                  <i class="bi-bell text-dark mx-0" style="font-size:22px;"></i>
                </a>
              <?php
              }
              ?>
          </div>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="assets/images/profile/<?=$user['profile_pic']?>" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="?u=<?=$user['username']?>">
                <i class="bi-person text-primary"></i>
                Profile
              </a>
              <a class="dropdown-item" href="assets/php/actions.php?logout">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>

    

    