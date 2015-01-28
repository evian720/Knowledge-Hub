<!DOCTYPE html>
<html lang="en">

<?php
require('header.php');
?>

<link rel="stylesheet" href='<?=base_url().'assets/css/fonts/icomoon/style.css'?>' media="screen">
<link rel="stylesheet" href='<?=base_url().'assets/css/main-style.css'?>' media="screen">





<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Check Peers
      <small>Let's see what others are learning!</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Check Peers</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">




    <!-- start of the panel -->
    <div id="dashboard-demo" class="tabbable analytics-tab paper-stack">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#" data-target="#area" data-toggle="tab"><i class="icon-history"></i> By Area</a></li>
        <li><a href="#" data-target="#major" data-toggle="tab"><i class="icon-graph"></i> By Major</a></li>
        <li><a href="#" data-target="#subject" data-toggle="tab"><i class="icon-facebook"></i> By Subject</a></li>
        <li><a href="#" data-target="#chapter" data-toggle="tab"><i class="icon-bars"></i> By Chapter</a></li>
      </ul>

      <div class="tab-content">

        <!-- area panel -->
        <div id="area" class="tab-pane active">
          <div class="analytics-tab-header clearfix">
            <div class="pull-left form-inline">
              <label>Current Area: </label>
              <button type="button" id="current_area_selection" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectArea">
                Technology
              </button>
              <!-- modal for area selection -->
              <div class="modal fade" id="selectArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Please select an area</h4>
                    </div>
                    <div class="modal-body">
                      <form id="selection_area_form">
                        <?php 
                        foreach ($area as $row) {
                          echo '
                          <div class="radio">
                            <label><input type="radio" name="optradio" value="' . $row->cat_name . '"> '. $row->cat_name . '</label>
                          </div>
                          <br>
                          <br>
                          ';}
                          ?>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="area_modal_submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>



              </div>
              <div class="btn-toolbar pull-right">

                <div class="btn-group">
                  <a class="btn dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cog-2"></i> <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="#"><i class="icol-tag"></i> About Insights</a></li>
                    <li><a href="#"><i class="icol-help"></i> Help</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="analytics-tab-content">

              <div>  <!-- start of the statistice -->
                <ul class="stats-container">
                  <li>
                    <a href="#" class="stat summary">
                      <span class="icon icon-circle bg-green">
                        <i class="icon-stats"></i>
                      </span>
                      <span class="digit">
                        <span class="text">Number of Users</span>
                        130
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="stat summary">
                      <span class="icon icon-circle bg-red">
                        <i class="icon-fire"></i>
                      </span>
                      <span class="digit">
                        <span class="text">Streams</span>
                        12
                      </span>
                    </a>
                  </li>

                  <li>
                    <a href="#" class="stat summary">
                      <span class="icon icon-circle bg-blue">
                        <i class="icon-hdd"></i>
                      </span>
                      <span class="digit">
                        <span class="text">Knowledge Avaiblable</span>
                        846
                      </span>
                    </a>
                  </li>
                </ul> 
                <hr>
              </div> <!-- end of the statistice -->

              <div id="area_knowledge_zone" style="height_back: 381px;"> <!-- start of showing the knowledge -->

                <?php 
                foreach ($area_knowledge as $knowledge) {  
                  echo '
                  <div class="widget">
                    <div class="widget-header light">
                      <span class="title">' . $knowledge->knowledge_title . '</span>
                      <div class="toolbar">
                        <div class="btn-group">
                          <span class="btn" id="request_knowledge" onclick="send_request(' . $knowledge->knowledge_id .')"><i class="icon-plus"></i></a></span>
                          <span class="btn"><i class="icon-minus"></i></span>
                          <span class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                          </span>
                          <ul class="dropdown-menu pull-right">
                            <li><a class="popupform" href="' . base_url() . "index.php/main/view_knowledge_detail/" . $knowledge->knowledge_id . '">View Detail</a>
                              <script>
                                jQuery("a.popupform").colorbox({opacity: 0.5, width: "90%", height: "90%"});
                              </script>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="widget-content">
                      <div class="form-group"> <!-- description -->
                        ' . $knowledge->knowledge_description . '
                      </div>
                      <hr>
                          <div class="btn-group btn-xs pull-right">
                              <button type="button" class="btn btn-warning btn-xs btn-flat" id="category_button">Category</button>
                              <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="#"><span class="badge bg-success">1</span> ' . $knowledge->level1_cat . ' </a></li>
                                  <li><a href="#"><span class="badge bg-success">2</span> ' . $knowledge->level2_cat . ' </a></li>
                                  <li><a href="#"><span class="badge bg-success">3</span> ' . $knowledge->level3_cat . ' </a></li>
                                  <li><a href="#"><span class="badge bg-success">4</span> ' . $knowledge->level4_cat . ' </a></li>
                              </ul>
                          </div>
                    </div>
                  </div> '; } ?>
                  <p><?php echo $link1; ?></p>
                </div>  <!-- end of showing the knowledge -->
              </div>
            </div>


            <!-- major panel -->
            <div id="major" class="tab-pane">
              <div class="analytics-tab-header clearfix">
                <div class="pull-left form-inline">
                  <label>Current Major: </label>
                  <button type="button" id="current_major_selection" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectMajor">
                    <?php echo $this->session->userdata('major'); ?>
                  </button>
                  <!-- modal for area selection -->
                  <div class="modal fade" id="selectMajor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Please select a Major</h4>
                        </div>
                        <div class="modal-body">
                          <form id="selection_major_form">
                            <?php 
                            foreach ($major as $row) {
                              echo '
                              <div class="radio">
                                <label><input type="radio" name="optradio" value="' . $row->cat_name . '"> '. $row->cat_name . '</label>
                              </div>
                              <br>
                              <br>
                              ';}
                              ?>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="major_modal_submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </div>
                    </div><!-- end of the modal -->
                  </div>
                  <div class="btn-toolbar pull-right">

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog-2"></i> <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu pull-right">
                        <li><a href="#"><i class="icol-tag"></i> About Insights</a></li>
                        <li><a href="#"><i class="icol-help"></i> Help</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="analytics-tab-content">

                  <div>  <!-- start of the statistice -->
                    <ul class="stats-container">
                      <li>
                        <a href="#" class="stat summary">
                          <span class="icon icon-circle bg-green">
                            <i class="icon-stats"></i>
                          </span>
                          <span class="digit">
                            <span class="text">Number of Users</span>
                            98
                          </span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="stat summary">
                          <span class="icon icon-circle bg-red">
                            <i class="icon-fire"></i>
                          </span>
                          <span class="digit">
                            <span class="text">Streams</span>
                            5
                          </span>
                        </a>
                      </li>

                      <li>
                        <a href="#" class="stat summary">
                          <span class="icon icon-circle bg-blue">
                            <i class="icon-hdd"></i>
                          </span>
                          <span class="digit">
                            <span class="text">Knowledge Avaiblable</span>
                            430
                          </span>
                        </a>
                      </li>
                    </ul> 
                    <hr>
                  </div> <!-- end of the statistice -->

                  <div id="major_knowledge_zone" style="height_back: 381px;"> <!-- start of showing the knowledge -->

                    <?php 
                    foreach ($major_knowledge as $knowledge) {  
                      echo '
                      <div class="widget">
                        <div class="widget-header light">
                          <span class="title">' . $knowledge->knowledge_title . '</span>
                          <div class="toolbar">
                            <div class="btn-group">
                              <span class="btn" id="request_knowledge" onclick="send_request(' . $knowledge->knowledge_id .')"><i class="icon-plus"></i></a></span>
                              <span class="btn"><i class="icon-minus"></i></span>
                              <span class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                              </span>
                              <ul class="dropdown-menu pull-right">
                                <li><a class="popupform" href="' . base_url() . "index.php/main/view_knowledge_detail/" . $knowledge->knowledge_id . '">View Detail</a>
                                  <script>
                                    jQuery("a.popupform").colorbox({opacity: 0.5, width: "90%", height: "90%"});
                                  </script>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="widget-content">
                          <div class="form-group"> <!-- description -->
                            ' . $knowledge->knowledge_description . '
                          </div>
                          <hr>
                          <div class="form-group pull-right">
                            <div class="label label-info">' . $knowledge->level4_cat  . '</div>
                          </div>
                          <div class="form-group pull-right">
                            <div class="label label-default">' . $knowledge->level3_cat  . '</div>
                          </div>
                        </div>
                      </div> '; } ?>
                      <p><?php echo $link1; ?></p>
                    </div>  <!-- end of showing the knowledge -->
                  </div>
                </div>

                <!-- subject panel -->
                <div id="subject" class="tab-pane">
                  <div class="analytics-tab-header clearfix">
                    <div class="pull-left form-inline">
                      <label>Current Subject: </label>
                      <button type="button" id="current_subject_selection" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectSubject">
                        Select
                      </button>

                      <!-- modal for Subject selection -->
                      <div class="modal fade" id="selectSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Please select a Subject</h4>
                            </div>
                            <div class="modal-body">
                              <form id="selection_subject_form">
                                <div class="widget-content table-responsive">
                                  <table id="subject_table" class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th>Subject</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      foreach ($subject as $row) {
                                        echo '
                                        <tr>
                                          <td><input type="radio" name="optradio" value="' . $row->cat_name . '">  ' . $row->cat_name . '</td>
                                        </tr>
                                        ';
                                      }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" id="subject_modal_submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="btn-toolbar pull-right">
                      <a class="btn btn-primary"><i class="icon-download-to-computer"></i> Export Data</a>
                      <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-cog-2"></i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="#"><i class="icol-tag"></i> About Insights</a></li>
                          <li><a href="#"><i class="icol-help"></i> Help</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="analytics-tab-content">
                    <div id="subject_knowledge_zone" style="height: 381px;">

                    </div>
                  </div>
                </div>

                <!-- chapter panel -->
                <div id="chapter" class="tab-pane">
                  <div class="analytics-tab-header clearfix">
                    <div class="pull-left form-inline">

                      <label>Current Chapter: </label>
                      <button type="button" id="current_chapter_selection" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectChapter">
                        Select
                      </button>

                      <!-- modal for chapter selection -->
                      <div class="modal fade" id="selectChapter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-bg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Please select a Chapter</h4>
                            </div>
                            <div class="modal-body">
                              <form id="selection_chapter_form">
                                <div class="widget-content table-responsive">
                                  <table id="chapter_table" class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th>Chapter</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      foreach ($chapter as $row) {
                                        echo '
                                        <tr>
                                          <td><input type="radio" name="optradio" value="' . $row->cat_name . '">  ' . $row->cat_name . '</td>
                                        </tr>
                                        ';
                                      }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" id="chapter_modal_submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="btn-toolbar pull-right">
                      <a class="btn btn-primary"><i class="icon-download-to-computer"></i> Export Data</a>
                      <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-cog-2"></i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="#"><i class="icol-tag"></i> About Insights</a></li>
                          <li><a href="#"><i class="icol-help"></i> Help</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="analytics-tab-content">
                    <div id="chapter_knowledge_zone" style="height: 381px;">

                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- end of the panel -->



            <?php
            require('footer.php');
            ?>


          </section><!-- /.content -->
        </aside><!-- /.right-side -->
      </div><!-- ./wrapper -->


<script type="text/javascript">
    // update area knowledge
   $('#area_modal_submit').on('click', function(e){
    
      $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_area_selection/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#selection_area_form').serialize(),
            success: function(data){
                  $('#selectArea').modal('toggle');
                  $('#area_knowledge_zone').html(data);
                  document.getElementById("current_area_selection").innerHTML= document.getElementById("selected_value").value;
            }
        });
    });

    // update major knowledge
   $('#major_modal_submit').on('click', function(e){
    
      $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_major_selection/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#selection_major_form').serialize(),
            success: function(data){
                  $('#selectMajor').modal('toggle');
                  $('#major_knowledge_zone').html(data);
                  document.getElementById("current_major_selection").innerHTML= document.getElementById("selected_value").value;
            }
        });
    });

    // update subject knowledge
   $('#subject_modal_submit').on('click', function(e){

      $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_subject_selection/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#selection_subject_form').serialize(),
            success: function(data){
                  $('#selectSubject').modal('toggle');
                  $('#subject_knowledge_zone').html(data);
                  document.getElementById("current_subject_selection").innerHTML= document.getElementById("selected_value").value;
            }
        });
    });

    // update chapter knowledge
   $('#chapter_modal_submit').on('click', function(e){

      $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_chapter_selection/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#selection_chapter_form').serialize(),
            success: function(data){
                  $('#selectChapter').modal('toggle');
                  $('#chapter_knowledge_zone').html(data);
                  document.getElementById("current_chapter_selection").innerHTML= document.getElementById("selected_value").value;
            }
        });
    });

    // request knowledge
    function send_request(knowledge_id){
      $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/request_knowledge/" + knowledge_id, //this is the submit URL
            type: 'POST', //or POST
            success: function(){
              alertify.success("Request Sent!");
            }
        });

    }

    alertify.set({ delay: 2500 });


  $(function() {
    $('#subject_table').dataTable();
    $('#chapter_table').dataTable();
  });

</script>


</body>

</html>