<!DOCTYPE html>
<html lang="en">

<?php
require('header.php');
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Recommendation
                        <small>These knowledge are ONLY FOR YOU!</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Recommendation</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- tab for recommendation -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li><a href="#teachers_choice_tab" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Teacher's Choice</a></li>
                                <?php
                                    if( count($blind_spot_knowledge) > 0 ){
                                        echo '
                                            <li><a href="#hottest_knowledge_tab" data-toggle="tab"><i class="fa fa-thumbs-up"></i> Hottest Knowledge</a></li>
                                            <li class="active"><a href="#blind_spot" data-toggle="tab"><i class="fa fa-eye-slash"></i> Blind Spot</a></li>
                                        ';
                                    }else{
                                        echo '<li class="active"><a href="#hottest_knowledge_tab" data-toggle="tab"><i class="fa fa-thumbs-up"></i> Hottest Knowledge</a></li>';
                                    }
                                    
                                ?>
                                <li class="pull-left header"><i class="fa fa-th"></i> Custom Tabs</li>
                            </ul>
                            <div class="tab-content">             
                                    <?php
                                        if( count($blind_spot_knowledge) > 0 ){
                                            echo '<div class="tab-pane active" id="blind_spot">';

                                            foreach ($blind_spot_knowledge as $knowledge) {
                                                if($recommendations[$knowledge->knowledge_title] * 10 >70){
                                                    $match_color = "success";
                                                }elseif($recommendations[$knowledge->knowledge_title] * 10 > 30){
                                                    $match_color = "warning";
                                                }else{
                                                    $match_color = "danger";
                                                }

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
                                                            <a class="btn btn-danger btn-flat btn-xs" id="request_knowledge" onclick="send_request(' . $knowledge->knowledge_id .')" data-toggle="confirmation" data-placement="right" data-btn-ok-label="Yes!" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="Stop!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger">Request</a>


                                                            <div class="btn-group btn-xs">
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
                                                                Rating: 7.8
                                                                <div class="progress sm progress-striped active" style="width: 100px;">
                                                                    <div class="progress-bar progress-bar-' . $match_color . '" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:' .$recommendations[$knowledge->knowledge_title] * 10 . '%">
                                                                        <span class="sr-only">20% Complete</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="pull-right">
                                                                Relativity: ' . round($recommendations[$knowledge->knowledge_title] * 10) . '% 
                                                                <div class="progress sm progress-striped active" style="width: 100px;">
                                                                    <div class="progress-bar progress-bar-' . $match_color . '" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:' .$recommendations[$knowledge->knowledge_title] * 10 . '%">
                                                                        <span class="sr-only">20% Complete</span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div><!-- /.box-footer-->
                                                    </div><!-- /.box -->
                                                ';
                                            }
                                            echo '</div><!-- /.tab-pane -->';
                                        }//end of if
                                    ?>
                                

                                <div class="tab-pane" id="hottest_knowledge_tab">

                                    <?php
                                       
                                        foreach ($hottest_knowledge as $knowledge) {
                                            if($knowledge->count > 10){
                                                $match_color = "success";
                                            }elseif($knowledge->count > 3){
                                                $match_color = "warning";
                                            }else{
                                                $match_color = "danger";
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
                                                        <a class="btn btn-danger btn-flat btn-xs" id="request_knowledge" onclick="send_request(' . $knowledge->knowledge_id .')" data-toggle="confirmation" data-placement="right" data-btn-ok-label="Yes!" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="Stop!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger">Request</a>




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


                                                            <div class="pull-right">
                                                                Sharing: ' . $knowledge->count . '
                                                                <div class="progress sm progress-striped active" style="width: 100px;">
                                                                    <div class="progress-bar progress-bar-' . $match_color . '" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:' .$knowledge->count * 10 . '%">
                                                                        <span class="sr-only">20% Complete</span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                    </div><!-- /.box-footer-->
                                                </div><!-- /.box -->
                                            ';
                                        }
                                    ?>
                                </div><!-- /.tab-pane -->

                                <div class="tab-pane" id="teachers_choice_tab">
                                    456
                                </div><!-- /.tab-pane -->


                            </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                    </div><!-- /.col -->


                </section><!-- /.content -->

<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <input type="hidden" id="slider_value"/>

        <!-- Ion Slider -->
        <script src='<?=base_url().'assets/js/ion.rangeSlider.min.js'?>'></script>
        <!-- Bootstrap slider -->
        <script src='<?=base_url().'assets/js/bootstrap-slider.js'?>'></script>
        <script type="text/javascript">
            $('.slider').slider({
                formatter: function(value) {
                    return  value;
                }
            });

            $(".slider").on("slide", function(slideEvt) {
                $("#slider_value").val(slideEvt.value);
            });

            function submit_rating(knowledge_id){

                rating_field = "rating_" + knowledge_id;
                rating = $('#slider_value').val();
                data = { 'knowledge_id': knowledge_id , 'rating': rating};

                rating_message_field = "rating_message_" + knowledge_id;

                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/submit_rating/", //this is the submit URL
                    type: 'POST', //or POST
                    data:data,
                    success: function(data){
                        alertify.success("Rating done!");
                        $('#slider_value').val();
                        document.getElementById(rating_message_field).innerHTML = "Your Rating: ";
                    }
                });
                
            }

        </script>


</body>

</html>