<?php
global $user;
?>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
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
                <a class="nav-link text-dark count-indicator" href="?home" >
                  <i class="bi-house-door-fill"></i>
                </a>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link text-dark count-indicator" data-bs-toggle="modal" data-bs-target="#addpost" href="#" >
                  <i class="bi-plus-square-fill" ></i>
                </a>
            </li>
            
            
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

          <li class="nav-item nav-profile dropdown">
            
          <?php
              if(getUnreadNotificationsCount()>0)
              {
              ?>
              <a class="nav-link count-indicator " id="show_not" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
                  <i class="bi-bell-fill  mx-0"></i>
                  <span class="count"></span>
              </a>
              <?php
              }
              else
              {
              ?>
                <a class="nav-link count-indicator" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample"><i class="bi-bell text-dark mx-0"></i></a>
              <?php
              }
              ?>
          </li>
          
        </ul>
        
        
      </div>
    </nav>

    

    