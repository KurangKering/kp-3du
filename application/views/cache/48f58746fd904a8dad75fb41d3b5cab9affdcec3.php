
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $__env->yieldContent('super-title', 'Peminjaman Ruangan'); ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/modules/bootstrap/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/modules/fontawesome/css/all.min.css')); ?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo e(site_url('assets/plugins/izimodal/css/iziModal.min.css')); ?>">

  <?php echo $__env->yieldContent('css'); ?>

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/css/components.css')); ?>">

  <script>
    const SITE_URL = '<?php echo e(site_url()); ?>';
  </script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo e(site_url('assets/templates/backend/assets/img/avatar/avatar-1.png')); ?>" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo e(site_url('assets/templates/backend/assets/img/avatar/avatar-2.png')); ?>" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Dedik Sugiharto</b>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo e(site_url('assets/templates/backend/assets/img/avatar/avatar-3.png')); ?>" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Agung Ardiansyah</b>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo e(site_url('assets/templates/backend/assets/img/avatar/avatar-4.png')); ?>" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Ardian Rahardiansyah</b>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo e(site_url('assets/templates/backend/assets/img/avatar/avatar-5.png')); ?>" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Alfa Zulkarnain</b>
                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo e(site_url('assets/templates/backend/assets/img/avatar/avatar-1.png')); ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">

            <li class="menu-header">Menus</li>
            
            <li class="active"><a href="<?php echo e(site_url('private')); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

            <li><a class="nav-link" href="<?php echo e(site_url('private/user')); ?>"><i class="far fa-square"></i> <span>Users</span></a></li>
            <li><a class="nav-link" href="<?php echo e(site_url('private/ruangan')); ?>"><i class="far fa-square"></i> <span>Ruangan</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
                <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
                <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
                <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
                <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
                <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
                <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
                <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
                <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
                <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
                <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
                <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
                <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
                <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
                <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
                <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
              </ul>
            </li>



          </ul>

        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
        
      </div>


      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo e(site_url('assets/templates/backend/assets/modules/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/templates/backend/assets/modules/popper.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/templates/backend/assets/modules/tooltip.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/templates/backend/assets/modules/bootstrap/js/bootstrap.min.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/templates/backend/assets/modules/nicescroll/jquery.nicescroll.min.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/templates/backend/assets/modules/moment.min.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/templates/backend/assets/js/stisla.js')); ?>"></script>



  <script src="<?php echo e(site_url('assets/plugins/izimodal/js/iziModal.min.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/plugins/axios/dist/axios.min.js')); ?>"></script>

  <?php echo $__env->yieldContent('js'); ?>

  <!-- Template JS File -->
  <script src="<?php echo e(site_url('assets/templates/backend/assets/js/scripts.js')); ?>"></script>
  <script src="<?php echo e(site_url('assets/templates/backend/assets/js/custom.js')); ?>"></script>


</body>
</html><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kalender-edu\application\views/layouts/backend.blade.php ENDPATH**/ ?>