<!DOCTYPE html>
<html lang="en">

<?php
require('view_teacher_header.php');
?>

    <link rel="stylesheet" href='<?=base_url().'assets/edittree/jquery.jOrgChart.css'?>' media="screen">
    <link rel="stylesheet" href='<?=base_url().'assets/edittree/custom.css'?>' media="screen">
    <link rel="stylesheet" href='<?=base_url().'assets/edittree/prettify.css'?>' media="screen">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src='<?=base_url().'assets/edittree/prettify.js'?>'></script>
    <script src='<?=base_url().'assets/edittree/jquery.jOrgChart.js'?>'></script>


    <script>
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : true
        });
    });
    </script>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Blank page
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section onload="prettyPrint();">




                <!-- Main content -->
                <section class="content" onload="prettyPrint();">


                    <!-- Info box -->
                    <div class="box box-info">
                        <div class="box-header">
                        <h3 class="box-title">Drag and Drop to create Standard Knowledge Tree</h3>
                            <div class="box-tools pull-right">
                                <div class="btn btn-flat btn-primary" id="add_button" data-toggle="modal" data-target="#add_node_modal"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                        <div class="box-body">

                            <ul id="org" style="display:none">

                                <li>
                                    Food
                                    <ul>
                                        <li id="beer">Beer</li>
                                        <li>Vegetables
                                            <a href="http://wesnolte.com" target="_blank">Click me</a>
                                            <ul>
                                                <li>Pumpkin</li>
                                                <li>
                                                    <a href="http://tquila.com" target="_blank">Aubergine</a>
                                                    <p>A link and paragraph is all we need.</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="fruit">Fruit
                                            <ul>
                                                <li>Apple
                                                    <ul>
                                                        <li>Granny Smith</li>
                                                    </ul>
                                                </li>
                                                <li>Berries
                                                    <ul>
                                                        <li>Blueberry</li>
                                                        <li>Cucumber</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>Bread</li>
                                        <li class="collapsed">Chocolate
                                            <ul>
                                                <li>Topdeck</li>
                                                <li>Reese's Cups</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div id="chart" class="orgChart"></div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <code>.box-footer</code>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->




            <div class="modal fade" id="add_node_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Please input the node name</h4>
                        </div>
                        <div class="modal-body">
                        <form>
                            <input type="text" class="form-control" id="node_name">
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="new_node_submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>





                </section><!-- /.content -->

<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

    <script>
        $(document).ready(function() {
            
            /* Custom jQuery for the example */
            $("#show-list").click(function(e){
                e.preventDefault();
                
                $('#list-html').toggle('fast', function(){
                    if($(this).is(':visible')){
                        $('#show-list').text('Hide underlying list.');
                        $(".topbar").fadeTo('fast',0.9);
                    }else{
                        $('#show-list').text('Show underlying list.');
                        $(".topbar").fadeTo('fast',1);                  
                    }
                });
            });
            
            $('#list-html').text($('#org').html());
            
            $("#org").bind("DOMSubtreeModified", function() {
                $('#list-html').text('');
                
                $('#list-html').text($('#org').html());
                
                prettyPrint();                
            });
        });


        $('#new_node_submit').on('click', function(a){
            

        });


    </script>




</body>

</html>