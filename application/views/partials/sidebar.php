<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button> 
        <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>"><img width="120" height="35" src="<?php echo base_url('assets/img/logo.png') ?>"/></a>
        <!-- <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>">Surat Izin</a> -->
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
        <a href="<?php echo base_url() ?>index.php/login" type="submit"> <i class="glyphicon glyphicon-user"> Masuk </i></a>
<!--             
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            </a> -->
            <!-- <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="glyphicon glyphicon-user"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Settings</a>
                </li>
                <li class="divider"></li> 
                <li><a href="< ?php echo base_url() ?>index.php/dashboard/logout" type="submit"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                </li>
            </ul> -->
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">

        
            <ul class="nav" id="side-menu">
                <!-- <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                    </div>
                </li> -->

                <!--ACCESS MENUS FOR ADMIN-->
                <?php if($this->session->userdata('level')==='1'):?>
                  <li>
                        <a href="<?php echo site_url('dashboard') ?>"
                        ><i class="glyphicon glyphicon-home"></i> Home </a>
                  </li>
                  <li>
                    <a href="#"><i class="glyphicon glyphicon-edit"></i> Forms <span class="fa arrow fa-fw"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                        <a href="<?php echo site_url('suratizin/izin/add') ?>"> Input Surat Izin</a>
                        </li>
                        <li>
                        <a href="<?php echo site_url('suratizin/izin/') ?>"> View Surat Izin </a>
                        </li>
                        <li>
                        <a href="<?php echo site_url('asuratizin/izin/acc') ?>"> Acc Surat Izin </a>
                        </li>
                        <!-- <li>
                        <a href="< ?php echo site_url('#') ?>"> View Data Pegawai </a>
                        </li> -->
                    </ul>
                    <!-- /.nav-second-level -->
                  </li>
                <!--ACCESS MENUS FOR ATASAN-->
                <?php elseif($this->session->userdata('level')==='2'):?>
                  <li>
                        <a href="<?php echo site_url('dashboard') ?>"
                        ><i class="glyphicon glyphicon-home"></i> Home </a>
                  </li>
                  <li>
                    <a href="#"><i class="glyphicon glyphicon-edit"></i> Forms <span class="fa arrow fa-fw"></span></a>
                    <ul class="nav nav-second-level">
                        <!-- <li>
                        <a href="< ?php echo site_url('admin/products/add') ?>"> Input Surat Izin</a>
                        </li> -->
                        <li>
                        <a href="<?php echo site_url('suratizin/izin/') ?>"> View Surat Izin </a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                  </li>
                <!--ACCESS MENUS FOR AUTHOR-->
                <?php else:?>
                  <li>
                        <a href="<?php echo site_url('User') ?>">
                        <i class="glyphicon glyphicon-edit"></i> Pengajuan </a>
                  </li>
                  <li>
                        <a href="<?php echo site_url('User/track') ?>">
                        <i class="glyphicon glyphicon-eye-open"></i> Tracking </a>
                  </li>
                <?php endif;?>
               
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>