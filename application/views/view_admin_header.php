<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Knowledge Hub</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' media="screen">
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/AdminLTE.css'?>' media="screen">


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src='<?=base_url().'assets/js/adminLTEapp.js'?>'></script>

        <!-- notification -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/alertify.core.css'?>' media="screen">
        <link rel="stylesheet" href='<?=base_url().'assets/css/alertify.default.css'?>' media="screen">
        <script src='<?=base_url().'assets/js/alertify.js'?>'></script>

        <script src='<?=base_url().'assets/js/jquery.bootstrap-autohidingnavbar.js'?>'></script>

        <!-- data table -->
        <script src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css" media="screen">
        <script src='<?=base_url().'assets/datatable/dataTables.bootstrap.js'?>'></script>

        <!-- PNotify -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/pnotify.custom.min.css'?>' media="screen">
        <script src='<?=base_url().'assets/js/pnotify.js'?>'></script>


    </head>
    <body class="skin-blue fixed">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?=base_url()?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Knowledge Hub
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar" role="navigation" id="for_hidden_top">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-left">
                    <ul class="nav navbar-nav">
                        <li class="user user-menu"><a><i class="fa fa-cogs"></i></i><span>Admin View</span></a></li>
                    </ul>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-bell"></i>
                                <span class="label label-success" id="badge_count">0</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Notifications</li>

                                <ul class="menu">
                                    <div id="notification_section"></div>
                                </ul>

                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>


                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->session->userdata('firstname')?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue" style="height: 100px;">
                                    <p>
                                        <?php echo $this->session->userdata('firstname')?> - Admin
                                        <small>Start Knowledge Hub @ <?php echo $this->session->userdata('register_date'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url() . 'index.php/main/logout' ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left info">
                            <p>Hello, <?php echo $this->session->userdata('firstname')?></p>
                            <a><i class="fa fa-thumbs-up"></i> Thanks for all your effort!</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?=base_url()?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'index.php/main/access_rights_management' ?>"><i class="fa fa-users"></i> User Access Rights</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'index.php/main/admin_category_management' ?>"><i class="fa fa-book"></i> Category Management</a>
                        </li>

                        <li>
                            <a href="javascript:;"><i class="fa fa-bar-chart-o"></i> Statistics</a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>



            <!-- just show the welcome once -->
            <input type="hidden" id="just_login" value="<?php echo $this->session->userdata('just_login'); ?>" />

        <script>
        $("#for_hidden_top").autoHidingNavbar();

        if($('#just_login').val() == 1 ){
            setTimeout(function(){ 
                                      alertify.set({ delay: 2500 });
                                      alertify.success("welcome to Knowledge Hub!");
            }, 500);

            $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_just_login/", //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                }
              });
        }

        </script>




    </body>
</html>
