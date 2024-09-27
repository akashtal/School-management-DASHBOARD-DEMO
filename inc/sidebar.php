  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SCHOOL DASHBOARD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $my_name?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>  
           </li>  
           <?php

           if ($my_roll == 'admin') {
              
              ?>
                <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-address-book"></i>
              <p>
                Configuration
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">5</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="class.php" class="nav-link">
                  <i class="fa fa-id-card nav-icon"></i>
                  <p>Classes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="session.php" class="nav-link">
                  <i class="fa-solid fa-calendar-days nav-icon"></i>
                  <p>Session</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="teachers.php" class="nav-link">
                  <i class="fa-solid fa-chalkboard-user  nav-icon"></i>
                  <p> Teachers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="students.php" class="nav-link">
                  <i class="fa-solid fa-user-graduate  nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="department.php" class="nav-link">
                 <i class="fa-solid fa-scroll nav-icon"></i>
                  <p>Department</p>
                </a>
              </li>
            </ul>
          </li>  
              <?php
           }elseif ($my_roll == 'student') {
              
              ?>
                 <li class="nav-header">EXAMPLES</li>
              <li class="nav-item">
             <a href="st_form_fill.php" class="nav-link">
            <i class="fa-solid fa-newspaper nav-icon"></i>
              <p>Form Fillup</p>
            </a>
            <li class="nav-item">
             <a href="admission.php" class="nav-link">
             <i class="fa-solid fa-person-chalkboard nav-icon"></i>
              <p>Admission</p>
            </a>
          </li>
              <?php
              }
           ?>

          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="pages/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>assignment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>assignment Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>assignment Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>assignment Detail</p>
                </a>
              </li>              
            </ul>
          </li>
  
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="pages/search/enhanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enhanced</p>
                </a>
              </li>
            </ul>
          </li>
         
          <li class="nav-header">LABELS</li>
           <li class="nav-item">
            <a href="contact.php" class="nav-link">
              <i class="fa fa-phone-square nav-icon"></i>
              <p>Contact us</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fa fa-sign-out nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
