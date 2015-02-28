<!DOCTYPE html>
<html lang="en">

<?php
require('header.php');
?>
<!-- Morris chart -->
<link rel="stylesheet" href='<?=base_url().'assets/css/morris.css'?>' media="screen">
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
                        <li class="active">Blank page</li>
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
                                    150
                                </h3>
                                <p>My Knowledge</p>
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
                                <h3>3</h3>
                                <p>Focus Area</p>
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
                                <h3>44<sup style="font-size: 20px">Days</sup></h3>
                                <p>Keep Learning</p>
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
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Ranking</p>
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
                        <!-- LINE CHART -->
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">New Knowledge Stat</h3>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="line-chart" style="height: 300px;"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <!-- start of calenda -->
                        <div class="box box-solid bg-green-gradient collapsed-box">
                            <div class="box-header">
                                <i class="fa fa-calendar"></i>
                                <h3 class="box-title">Calendar</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="#">Add new event</a></li>
                                            <li><a href="#">Clear events</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">View calendar</a></li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body no-padding" style="display: none;">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div><!-- /.box-body -->
                            <div class="box-footer text-black" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Progress bars -->
                                        <div class="clearfix">
                                            <span class="pull-left">Task #1</span>
                                            <small class="pull-right">90%</small>
                                        </div>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                                        </div>

                                        <div class="clearfix">
                                            <span class="pull-left">Task #2</span>
                                            <small class="pull-right">70%</small>
                                        </div>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                                        </div>
                                    </div><!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="clearfix">
                                            <span class="pull-left">Task #3</span>
                                            <small class="pull-right">60%</small>
                                        </div>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                                        </div>

                                        <div class="clearfix">
                                            <span class="pull-left">Task #4</span>
                                            <small class="pull-right">40%</small>
                                        </div>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div>
                        </div><!-- /.box -->
                        <!-- end of calenda -->



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









<!-- Morris.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src='<?=base_url().'assets/js/morris.js'?>'></script>
<!-- jqeury ui -->
<script src='https://code.jquery.com/ui/1.11.2/jquery-ui.js'></script>

<script src='<?=base_url().'assets/js/bootstrap-datepicker.js'?>'></script>
<script src='<?=base_url().'assets/js/icheck.js'?>'></script>



<script type="text/javascript">
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
        {y: '2014 Q3', item1: 12},
        {y: '2014 Q4', item1: 67},
        {y: '2015 Q1', item1: 30},
        {y: '2015 Q2', item1: 70},
        {y: '2015 Q3', item1: 40},
        {y: '2015 Q4', item1: 13}
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Item 1'],
        lineColors: ['#3c8dbc'],
        hideHover: 'auto'
    });


    function initial_to_do_list(){
         //to do list
        $(".todo-list").sortable({
            placeholder: "sort-highlight",
            handle: ".handle",
            forcePlaceholderSize: true,
            zIndex: 999999
        }).disableSelection();
        ;

        //The todo list plugin
        $(".todo-list").todolist({
            onCheck: function(ele) {
                //console.log("The element has been checked")
                var to_do_id = $('input', this).parents("li").attr("name");
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_to_do_list_status/" + to_do_id, //this is the submit URL
                    type: 'POST', //or POST
                    success: function(data){
                        
                    }
                });
 
            },
            onUncheck: function(ele) {
                //console.log("The element has been unchecked")
                var to_do_id = $('input', this).parents("li").attr("name");
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_to_do_list_status/" + to_do_id, //this is the submit URL
                    type: 'POST', //or POST
                    success: function(data){
                        
                    }
                });
            }
        });   
    }


    $(document).ready(function(){
        initial_to_do_list();
    });

    //The Calender
    $("#calendar").datepicker();


    //callback handler for form submit
    $("#to_do_creation_form").submit(function(e)
    {
        var postData = $(this).serializeArray();
        var formURL = "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/create_to_do_list/";
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data){
                $('#close_create_to_do_form').click();
                update_to_do_list();
            }
        });
        e.preventDefault(); //STOP default action
    });

    function update_to_do_list(){
        $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_to_do_list/", //this is the submit URL
            type: 'POST', //or POST
            success: function(data){
                $('#to_do_list_area').html(data);
                initial_to_do_list();
            }
        });
    }

    function delete_to_do(to_do_list_id){
        $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/delete_to_do_list/" + to_do_list_id, //this is the submit URL
            type: 'POST', //or POST
            success: function(data){
                update_to_do_list();
                initial_to_do_list();
            }
        });
    }

    function update_status(){
        alert("hahaha");
    }
     
    

</script>


</body>

</html>