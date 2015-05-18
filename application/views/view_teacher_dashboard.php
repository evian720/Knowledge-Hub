<!DOCTYPE html>
<html lang="en">

<?php
require('view_teacher_header.php');
?>

<!-- Date Picker -->
<link rel="stylesheet" href='<?=base_url().'assets/css/datepicker3.css'?>' media="screen">

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- start of the gird data section -->
                    
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>
                                    <?php print_r($students_no); ?>
                                </h3>
                                <p>Your Students</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>
                                    <?php echo $knowledge_this_week; ?><sup style="font-size: 16px">Knowledge</sup></h3>
                                </h3>
                                <p>This Month</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-cloud"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?php echo $sharing_times; ?><sup style="font-size: 16px">Times</sup></h3>
                                <p>Sharing</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo $no_of_subjects?></h3>
                                <p>Subjects</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    
                    <!-- start of the gird data section -->

                    <div class="col-md-6">


                        <div class="box box-solid bg-green-gradient">
                            <div class="box-header">
                                <i class="fa fa-calendar"></i>
                                <h3 class="box-title">Calendar</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="<?php echo base_url() . 'index.php/main/view_knowledge' ?>">Time Line</a></li>
                                            <li><a href="<?php echo base_url() . 'index.php/main/view_tree' ?>">Knowledge Tree</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo base_url() . 'index.php/main/view_knowledge_others' ?>">Check Peers'</a></li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body no-padding">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div><!-- /.box-body -->
                            <div class="box-footer text-black">
                                <div class="row">

                                </div><!-- /.row -->
                            </div>
                        </div><!-- /.box -->



                    </div><!-- /.col (LEFT) -->

                    <!-- start of col right -->
                    <div class="col-md-6">
                        <!-- to do list -->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">To Do List</h3>
                                <div class="box-tools pull-right">
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body" id="to_do_list_area">
                                <ul class="todo-list">
                                    <?php

                                    foreach ($to_do_list as $row) {
                                        switch ($row->label) {
                                            case 'info':
                                            $label_text = 'Appoitment';
                                            break;

                                            case 'danger':
                                            $label_text = 'Deadline';
                                            break;

                                            case 'warning':
                                            $label_text = 'Meeting';
                                            break;

                                            case 'success':
                                            $label_text = 'Learning';
                                            break;

                                            case 'primary':
                                            $label_text = 'Personal';
                                            break;

                                            case 'default':
                                            $label_text = 'Others';
                                            break;

                                            default:
                                            $label_text = 'Others';
                                            break;
                                        }
                                        if ($row->status==1) {
                                            $class_done = ' class="done"';
                                        }else{
                                            $class_done = "";
                                        }

                                        echo '
                                        <li name="' . $row->to_do_list_id . '" ' . $class_done . ' >
                                            <!-- drag handle -->
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <!-- checkbox -->
                                            <input type="checkbox" value="" name=""/>
                                            <!-- todo text -->
                                            <span class="text">' . $row->content . '</span>
                                            <!-- Emphasis label -->
                                            <small class="label label-' . $row->label .  '"><i class="fa fa-clock-o"></i> ' . $label_text . '</small>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <i class="fa fa-edit" ></i>
                                                <i class="fa fa-trash-o" onclick="delete_to_do(' . $row->to_do_list_id . ' )"></i>
                                            </div>
                                        </li>
                                        ';                                       
                                    }
                                    ?>
                                </ul>
                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix no-border">
                                <button class="btn btn-default pull-right" data-toggle="modal" data-target="#new_to_do"><i class="fa fa-plus"></i> Add item</button>
                            </div>
                        </div><!-- /.box -->
                        <!-- end of to-do list -->


                    </div> <!-- end of col RIGHT -->


                </section><!-- /.content -->

<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->



<!-- Modal for creating new to-do -->
<div class="modal fade" id="new_to_do" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create New To-Do</h4>
            </div>
            <div class="modal-body">
                <form id="to_do_creation_form">
                    <div class="form-group">
                        <label class="control-label">What's your new to-do?</label>
                        <input type="text" class="form-control" name="to_do_content">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Choose a label!</label><br>
                        <div class="row">
                            <div class="col-xs-2">
                                <input type="radio" name="lable_selection" value="info" checked><small class="label label-info"><i class="fa fa-clock-o"></i> Appoitment</small>
                            </div>
                            <div class="col-xs-2">
                                <input type="radio" name="lable_selection" value="danger"><small class="label label-danger"><i class="fa fa-clock-o"></i> Deadline</small>
                            </div>
                            <div class="col-xs-2">
                                <input type="radio" name="lable_selection" value="warning"><small class="label label-warning"><i class="fa fa-clock-o"></i> Meeting</small>
                            </div>
                            <div class="col-xs-2">
                                <input type="radio" name="lable_selection" value="success"><small class="label label-success"><i class="fa fa-clock-o"></i> Learning</small>
                            </div>
                            <div class="col-xs-2">
                                <input type="radio" name="lable_selection" value="primary"><small class="label label-primary"><i class="fa fa-clock-o"></i> Personal</small>
                            </div>
                            <div class="col-xs-2">
                                <input type="radio" name="lable_selection" value="default"><small class="label label-default"><i class="fa fa-clock-o"></i> Others</small>
                            </div>
                        </div> 
                    </div>
                    <input type="submit" id="submit_to_do_list_form" class="hidden" />
                </form>
            </div>
            <div class="modal-footer">
                <label class="btn btm-sm btn-default" id="close_create_to_do_form" data-dismiss="modal">Close</label>
                <label class="btn btn-sm btn-primary" for="submit_to_do_list_form">Submit</label>
            </div>
        </div>
    </div>
</div>






<!-- jqeury ui -->
<script src='https://code.jquery.com/ui/1.11.2/jquery-ui.js'></script>

<script src='<?=base_url().'assets/js/bootstrap-datepicker.js'?>'></script>
<script src='<?=base_url().'assets/js/icheck.js'?>'></script>
<script src='<?=base_url().'assets/js/my_functions/dashboard.js'?>'></script>

</body>

</html>