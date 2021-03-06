<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Knowledge Hub</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="stylesheet" href='<?=base_url().'bootstrap/css/bootstrap.min.css'?>' media="screen">
        <link rel="stylesheet" href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' media="screen">

        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />


        <!-- slider -->
        <!-- Ion Slider -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/ion.rangeSlider.css'?>' media="screen">
        <!-- ion slider Nice -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/ion.rangeSlider.skinNice.css'?>' media="screen">
        <!-- bootstrap slider -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/slider.css'?>' media="screen">

        <!-- Theme style -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/AdminLTE.css'?>' media="screen">


        <!-- jQuery 2.0.2 -->
        <script src='<?=base_url().'assets/js/jquery.min.js'?>'></script>

        <!-- Bootstrap -->
        <script src='<?=base_url().'bootstrap/js/bootstrap.min.js'?>'></script>

        <!-- AdminLTE App -->
        <script src='<?=base_url().'assets/js/adminLTEapp.js'?>'></script>

        <!-- notification -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/alertify.core.css'?>' media="screen">
        <link rel="stylesheet" href='<?=base_url().'assets/css/alertify.default.css'?>' media="screen">
        <script src='<?=base_url().'assets/js/alertify.js'?>'></script>

        <script src='<?=base_url().'assets/js/jquery.bootstrap-autohidingnavbar.js'?>'></script>

        <!-- data table -->
        <script src='<?=base_url().'assets/js/jquery.dataTables.min.js'?>'></script>
        <link rel="stylesheet" href='<?=base_url().'assets/css/jquery.dataTables.min.css'?>' media="screen">
        <script src='<?=base_url().'assets/datatable/dataTables.bootstrap.js'?>'></script>

        <!-- typeahead -->
        <script src='<?=base_url().'assets/js/typeahead.js'?>'></script>

        <!-- editable -->
        <link rel="stylesheet" href='<?=base_url().'assets/css/bootstrap-editable.css'?>' media="screen">
        <script src='<?=base_url().'assets/js/bootstrap-editable.min.js'?>'></script>

        <!-- dropzone -->
        <script src='<?=base_url().'assets/js/dropzone.js'?>'></script>
        <link rel="stylesheet" href='<?=base_url().'assets/css/dropzone.css'?>' media="screen">



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
                <div class="navbar-left">
                    <ul class="nav navbar-nav">
                        <li class="user user-menu"><a><i class="fa fa-users"></i><span>Student View</span></a></li>
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
                                <i class="fa fa-check-square-o"></i>
                                <span class="label label-warning" id="confirmation_count">0</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Confirmations</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu" id="confirmation_section">

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
                                        <small>Start Knowledge Hub @ <?php echo $this->session->userdata('register_date'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-flat" data-toggle="modal" data-target="#user_profile_modal">Profile</a>
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
                            <a><i class="fa fa-thumbs-up"></i> Start to learn some stuff!</a>
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
                                <i class="fa fa-tree"></i>
                                <span>View My Knowledge</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo base_url() . 'index.php/main/view_knowledge' ?>"><i class="fa fa-angle-double-right"></i> Time Line</a>
                                </li>
                                <li>
                                <a href="<?php echo base_url() . 'index.php/main/view_tree' ?>"><i class="fa fa-angle-double-right"></i> Knowledge Tree</a>
                                </li>

                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-search"></i>
                                <span>Search Knowledge</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?php echo base_url() . 'index.php/main/view_knowledge_others' ?>"><i class="fa fa-angle-double-right"></i> Check Peers</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . 'index.php/main/view_knowledge_directory' ?>"><i class="fa fa-angle-double-right"></i> Knowledge Directory</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'index.php/main/recommend' ?>"><i class="fa fa-thumbs-o-up"></i> Recommendation</a>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <button type="button" id="create_new_knowledge_button" class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#create_new_knowledge"></button>
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


            <!-- modal for view knowledge details -->
            <button type="button" id="view_knowledge_detail_button" class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#view_knowledge_detail"></button>
            <div class="modal fade" id="view_knowledge_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 95%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="details">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- just show the welcome once -->
            <input type="hidden" id="just_login" value="<?php echo $this->session->userdata('just_login'); ?>" />


            <!-- modal for user profile -->
            <div class="modal fade" id="user_profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>User Profile<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
                        </div>
                        <div class="modal-body" id="">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-xs-6">
                                    <div class="input-group">
                                        <b>User Name</b><br>
                                        <?php echo $this->session->userdata('email');?>
                                    </div>
                                    <hr>
                                    <div class="input-group">
                                        <b>First Name</b><br>
                                        <a href="#" class="edit_firstname" data-type="text" data-pk="<?php echo $this->session->userdata('email');?>" ><?php echo $this->session->userdata('firstname');?></a>
                                    </div>
                                    <hr>
                                    <div class="input-group">
                                        <b>Last Name</b><br>
                                        <a href="#" class="edit_lastname" data-type="text" data-pk="<?php echo $this->session->userdata('email');?>" ><?php echo $this->session->userdata('lastname');?></a>
                                    </div>
                                    <hr>
                                    <div class="input-group">
                                        <b>Major</b><br>
                                        <a href="#" class="edit_major" data-type="select" data-pk="<?php echo $this->session->userdata('email');?>" ><?php echo $this->session->userdata('major');?></a>
                                    </div>
                                </div>  

                                <div class="col-md-6 col-lg-6 col-xs-6">
                                    <form id="new_password_form">
                                        <div>
                                            <b>Original Password</b><br>
                                            <input type="password" class="form-control" id="orignal_password" name="orignal_password" placeholder="Password">
                                        </div>
                                        <br>
                                        <div>
                                            <b>New Password</b><br>
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                        </div>

                                        <br><b>New Password Again</b><br>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="new_password_again" name="new_password_again" placeholder="Input again" required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger btn-flat" id="submit_new_password_button" type="button" disabled="">Go!</button>
                                            </span>
                                        </div>

                                    </form>

                                </div>

                            </div>
                            
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
              
            //refresh for notification
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

            //refresh for confirmation 
            setInterval(function(){ 
              // ajax
              $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/refresh_confirm_count/", //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                  $("#confirmation_count").text(data);
                  if(data >= 0){
                    update_confirmation();
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

            function update_confirmation(){
              $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/refresh_confirm_details/", //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    $('#confirmation_section').html(data);
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

        function update_knowledge_detail(knowledge_id){
            $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/view_knowledge_detail/" + knowledge_id, //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    $('#details').html(data);
                    $('#view_knowledge_detail_button').click();
                }
        });
    }

                //editabke
            $.fn.editable.defaults.mode = 'inline';
            $(document).ready(function() {
                $('.edit_firstname').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_firstname/',
                    success: function(response, newValue) {
                    }
                });

            });

            $(document).ready(function() {
                $('.edit_lastname').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_lastname/',
                    success: function(response, newValue) {
                    }
                });

            });


            //update edit category list
            $(document).ready(function() {
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_available_majors/", //this is the submit URL
                    type: 'POST', //or POST
                    success: function(){
                        $.get('http://101.78.175.101:8580/fyp/knowledge_hub/json/available_majors.json', function(data){
                            $('.edit_major').editable({
                                source: data,
                                url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_major/',
                                success: function(response, newValue) {

                                }
                            });
                        });
                    }
                });
            });

            //update user password
            var old_pw_valid;
            $( "#new_password_again" ).keyup(function( event ) {
                var new_password = $('#new_password').val();
                var new_password_again = $('#new_password_again').val();

                
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/verify_password/", //this is the submit URL
                    type: 'POST', //or POST
                    data: $('#orignal_password').serialize(),
                    success: function(data){
                        old_pw_valid = data;
                    }
                });

                if(new_password == new_password_again && old_pw_valid == 1){
                    document.getElementById("submit_new_password_button").removeAttribute("disabled");
                    document.getElementById("submit_new_password_button").setAttribute("class", "btn btn-success btn-flat");
                }else{
                    document.getElementById("submit_new_password_button").setAttribute("disabled", "");
                    document.getElementById("submit_new_password_button").setAttribute("class", "btn btn-danger btn-flat");
                }
            });




               $('#submit_new_password_button').on('click', function(e){
                  $.ajax({
                        url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_user_password/", //this is the submit URL
                        type: 'POST', //or POST
                        data: $('#new_password_again').serialize(),
                        success: function(data){
                            alertify.success("Password Changed!");
                        }
                    });
                });


        </script>




    </body>
</html>
