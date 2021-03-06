<!DOCTYPE html>
<html lang="en">

<?php
require('view_teacher_header.php');
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        View & Recommend Knowledge
                        <small>Find good knowledge</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">View & Recommend Knowledge</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                    <div class="col-md-12"> <!-- starts of the tab -->
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#major_tab" data-toggle="tab"><i class="glyphicon glyphicon-th-large"></i> By Major</a></li>
                                <li><a href="#subject_tab" data-toggle="tab"><i class="glyphicon glyphicon-th"></i> By Subect</a></li>
                                <li><a href="#chapter_tab" data-toggle="tab"><i class="glyphicon glyphicon-book"></i> By Chapter</a></li>

                                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">


                                <div class="tab-pane active" id="major_tab">
                                    <div class="">
                                        <b>Current Major: </b>
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
                                                                <div>
                                                                    <label><input type="radio" name="optradio" value="' . $row->major . '"> '. $row->major . '</label>
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

                                        <hr>
                                    </div> <!-- end of the current selection -->

                                    <div>
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-green">
                                                    <div class="inner">
                                                        <h3>121</h3>
                                                        <p>Users</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-user-plus"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        More info <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-4 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-yellow">
                                                    <div class="inner">
                                                        <h3>21</h3>
                                                        <p>New Knowledge/Day</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        More info <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-4 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-red">
                                                    <div class="inner">
                                                        <h3>421</h3>
                                                        <p>Total Knowledge</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-book"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">
                                                        More info <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div><!-- ./col -->
                                        </div><!-- /.row -->
                                        <hr>
                                    </div>

                                    <div id="major_knowledge_zone">
                                    <!-- starts of the major content -->
                                    <?php
                                        foreach ($major_knowledge as $knowledge) {
                                            if($knowledge->count > 10){
                                                $match_color_relativity = "success";
                                            }elseif($knowledge->count > 3){
                                                $match_color_relativity = "warning";
                                            }else{
                                                $match_color_relativity = "danger";
                                            }

                                            //the color of rating bar
                                            if($knowledge->rating > 7 ){
                                                $match_color_rating = "success";
                                            }elseif($knowledge->rating > 4){
                                                $match_color_rating = "warning";
                                            }else{
                                                $match_color_rating = "danger";
                                            }

                                            //"Your rating" message
                                            if( count($user_ratings)>0 ){
                                                foreach ($user_ratings as $rating) {
                                                    if( $knowledge->knowledge_id == $rating->knowledge_id){
                                                        $rating_for_knowledge = $rating->rating;
                                                        $rating_message = " ";
                                                        break;
                                                    }else{
                                                        $rating_for_knowledge = 0;
                                                        $rating_message = "You havn't rated it yet! ";
                                                    }
                                                }
                                            }else{
                                                $rating_for_knowledge = 0;
                                                $rating_message = "You havn't rated it yet! ";
                                            }
                                            echo '
                                                <div class="box box-primary">
                                                    <div class="box-header" data-toggle="tooltip" title="Knowledge Title">
                                                        <h3 class="box-title">' . $knowledge->knowledge_title . '</h3>
                                                        <div class="box-tools pull-right">
                                                            <button class="btn btn-primary btn-flat btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                            <button class="btn btn-primary btn-flat btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <p>' . $knowledge->knowledge_description . ' </p>
                                                    </div><!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <a class="btn btn-success btn-flat btn-xs" onclick="update_knowledge_detail( ' . $knowledge->knowledge_id . ' )">Details</a>
                                                        <a class="btn btn-danger btn-flat btn-xs" id="request_knowledge" onclick="send_recommendation(' . $knowledge->knowledge_id .')">Recommend</a>

                                                        <div class="btn-group btn-xs ">
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


                                                        <div class="btn btn-flat btn-xs" id="rating_message_'. $knowledge->knowledge_id . '">
                                                            Your Rating: ' . $rating_message . '
                                                        </div>
                                                        <div class="btn btn-flat btn-xs" style="width: 150px;">   
                                                            <input type="text" value="" id="rating_'. $knowledge->knowledge_id . ' " class="slider" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="'. $rating_for_knowledge .'" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-id="blue">
                                                        </div>
                                                        <div class="btn btn-primary btn-flat btn-xs" onclick="submit_rating('. $knowledge->knowledge_id .' )">
                                                            <i class="fa fa-check"></i>
                                                        </div>


                                                        <div class="pull-right">
                                                            Rating: ' . $knowledge->rating . '
                                                            <div class="progress sm progress-striped active" style="width: 100px;">
                                                                <div class="progress-bar progress-bar-' . $match_color_rating . '" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:' .$knowledge->rating * 10 . '%">
                                                                    <span class="sr-only">20% Complete</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pull-right">
                                                            Sharing: ' . $knowledge->count . '
                                                            <div class="progress sm progress-striped active" style="width: 100px;">
                                                                <div class="progress-bar progress-bar-' . $match_color_relativity . '" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:' .$knowledge->count * 10 . '%">
                                                                    <span class="sr-only">20% Complete</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.box-footer-->
                                                </div><!-- /.box -->
                                            ';
                                        }
                                    ?>
                                    <!-- ends of the area content -->
                                    </div> <!-- end of id major_knowledge_zone -->

                                    <p><?php echo $link2; ?></p>

                                </div><!-- /.tab-pane -->


                                <div class="tab-pane" id="subject_tab">
                                    <div class="">
                                        <b>Current Subject: </b>
                                        <button type="button" id="current_subject_selection" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#selectSubject">
                                            Select
                                        </button>
                                        <hr>
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
                                        </div> <!-- end of modal -->
                                    </div> <!-- end of the current selection -->

                                    <div id="subject_knowledge_zone">

                                    </div><!-- end of id major_knowledge_zone -->
                                </div><!-- /.tab-pane -->

                                <div class="tab-pane" id="chapter_tab">
                                    <div class="">
                                        <b>Current Subject: </b>
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

                                        <hr>
                                    </div> <!-- end of the current selection -->


                                    <div id="chapter_knowledge_zone">

                                    </div><!-- end of id major_knowledge_zone -->

                                </div><!-- /.tab-pane -->

                            </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                    </div> <!-- ends of the tab -->
            


                </section><!-- /.content -->

<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->



        <!-- modal for selection recommendation target -->
        <button type="button hidden" id="recommendation_target_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#recommendation_target_modal"></button>
        <!-- modal for area selection -->
        <div class="modal fade" id="recommendation_target_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Please select the recommendation target</h4>
                    </div>
                    <div class="modal-body">
                        <form id="recommendation_target_form">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Major</strong><br><br>     
                                    <?php
                                        foreach ($major as $key => $row) {
                                            echo '
                                                <div class="form-group"><input type="checkbox" name="recommendation_target_major[]" value="' . $row->major . '">' . $row->major . '</div>
                                            '; 
                                        }
                                    ?>
                                    
                                </div>

                                <div class="col-md-4 col-md-offset-2">
                                    <strong>Subject</strong><br><br>
                                    <?php
                                        foreach ($subject as $key => $row) {
                                            echo '
                                                <div class="form-group"><input type="checkbox" name="recommendation_target_subject[]" value="' . $row->cat_name . '">' . $row->cat_name . '</div>
                                            '; 
                                        }
                                    ?>
                                </div>
                                <input type="hidden" id="recommended_knowledge_id" name="recommend_knowledge_id" value="" />
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="recommendation_target_submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div><!-- end of the modal -->

        
<input type="hidden" id="requested_knowledge_id"  value="" />
<input type="hidden" id="slider_value"/>

<script src='<?=base_url().'assets/js/bootstrap-confirmation.js'?>'></script>
<!-- Ion Slider -->
<script src='<?=base_url().'assets/js/ion.rangeSlider.min.js'?>'></script>
<!-- Bootstrap slider -->
<script src='<?=base_url().'assets/js/bootstrap-slider.js'?>'></script>

<script src='<?=base_url().'assets/js/my_functions/knowledge_management.js'?>'></script>

<script type="text/javascript">
    // update major knowledge
    $('#major_modal_submit').on('click', function(e){
        $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_major_selection_teacher_recommendation/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#selection_major_form').serialize(),
            success: function(data){
                $('#selectMajor').modal('toggle');
                $('#major_knowledge_zone').html(data);
                document.getElementById("current_major_selection").innerHTML= document.getElementById("selected_value_major").value;
            }
        });
    });


    // update subject knowledge
   $('#subject_modal_submit').on('click', function(e){

      $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_subject_selection_teacher_recommendation/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#selection_subject_form').serialize(),
            success: function(data){
                  $('#selectSubject').modal('toggle');
                  $('#subject_knowledge_zone').html(data);
                  document.getElementById("current_subject_selection").innerHTML= document.getElementById("selected_value_subject").value;
            }
        });
    });

    // update chapter knowledge
   $('#chapter_modal_submit').on('click', function(e){

      $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_chapter_selection_teacher_recommendation/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#selection_chapter_form').serialize(),
            success: function(data){
                  $('#selectChapter').modal('toggle');
                  $('#chapter_knowledge_zone').html(data);
                  document.getElementById("current_chapter_selection").innerHTML= document.getElementById("selected_value_chapter").value;
            }
        });
    });



    //fuction to recommend knowledge
    function send_recommendation(knowledge_id){
        $('#recommended_knowledge_id').val(knowledge_id);
        $('#recommendation_target_button').click();
    }

    // submit the recommendation modal 
    $('#recommendation_target_submit').on('click', function(e){
        $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/submit_teacher_recommendation/", //this is the submit URL
            type: 'POST', //or POST
            data: $('#recommendation_target_form').serialize(),
            success: function(data){
                $('#recommendation_target_modal').modal('toggle');
                alertify.success("Request Accepted");
            }
        });
    });


</script>


</body>

</html>