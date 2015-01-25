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


    </head>
    <body class="skin-black fixed">
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
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
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
                                        <?php echo $this->session->userdata('firstname')?> - Student
                                        <small>Start Knowledge Hub @ </small>
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
                            <a><i class="fa fa-thumbs-up"></i> Start to lean some stuff!</a>
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
                            <a href="" data-toggle="modal" data-target="#create_new_knowledge" id="new_knowledge"><i class="glyphicon glyphicon-pencil"></i> New Knowledge</a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-search"></i>
                                <span>View Knowledge</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo base_url() . 'index.php/main/view_knowledge' ?>"><i class="fa fa-angle-double-right"></i> Time Line</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . 'index.php/main/view_knowledge_directory' ?>"><i class="fa fa-angle-double-right"></i> Knowledge Directory</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'index.php/main/view_tree' ?>" id="load"><i class="glyphicon glyphicon-tree-conifer"></i> View My Tree</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'index.php/main/view_knowledge_others' ?>"><i class="glyphicon glyphicon-user"></i> Check Peers</a>
                        </li>

                        <li>
                            <a href="javascript:;"><i class="fa fa-bar-chart-o"></i> Statistics</a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- modal for create knowledge -->
            <div class="modal fade" id="create_new_knowledge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 95%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="create_knowledge_modal">
                            <?php
                                require('modal_create_knowledge.php');
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        <script>
        $("#for_hidden_top").autoHidingNavbar();

        $(document).ready(function(){
            $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_create_knowledge_detail/", //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    $('#create_knowledge_modal').html(data);
                }
              });
        });

          $(document).ready(function() {
              $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/refresh_header_count/", //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                  $("#badge_count").text(data);
                  if(data >= 0){
                    update_notification();
                  }
                }
              });
              
            setInterval(function(){ 
              // ajax
              $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/refresh_header_count/", //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                  $("#badge_count").text(data);
                  if(data >= 0){
                    update_notification();
                  }
                }
              });
            }, 5000);
          });

          function update_notification(){
              $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/refresh_header_details/", //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    $('#notification_section').html(data);
                }
              });
          }
          
          function accept_request(knowledge_request_id){
                $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/accept_knowledge_request/" + knowledge_request_id, //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    alertify.success("Request Accepted");
                    update_notification();
                }
              });
          }
          
          function reject_request(knowledge_request_id){
            $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/reject_knowledge_request/" + knowledge_request_id, //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    alertify.error("Request Rejected!");
                    update_notification();
                }
              });
          }

        </script>




    </body>
</html>
