<!DOCTYPE html>
<html lang="en">

<?php
require('view_admin_header.php');
?>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<?php
    $select_data_source = "{1: 'student', 2: 'teacher', 3: 'admin'}";
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Teacher Access Right
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Teacher Access Right</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Search to find teacher quicker...</h3>
                                <div class="box-tools pull-right">
                                    <div class="btn btn-flat btn-primary" id="" data-toggle="modal" data-target="#add_category_modal"><i class="fa fa-plus"></i></div>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="teacher_list" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Role</th>
                                            <th>Category Access</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($teachers as $row) {
                                            echo '
                                            <tr>
                                                <td>' . $row->email . '</td>
                                                <td><a href="#" id="edit_first_name" data-type="text" data-pk="' . $row->email . '" >' . $row->first_name . '</a></td>
                                                <td><a href="#" id="edit_last_name" data-type="text" data-pk="' . $row->email . '" >' . $row->last_name . '</a></td>
                                                <td><a href="#" id="edit_user_role" data-type="select" data-pk="' . $row->email . '" data-value="2" data-source="' . $select_data_source .'" >' . $row->user_role . '</a></td>
                                                <td> </td>
                                            </tr>
                                            ';
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>User Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Role</th>
                                            <th>Category Access</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>





                </section><!-- /.content -->

<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <script src='<?=base_url().'assets/js/bootstrap-confirmation.js'?>'></script>

        <script type="text/javascript">

            $(document).ready(function(){
                // Setup - add a text input to each footer cell
                $('#teacher_list tfoot th').each( function () {
                    var title = $('#teacher_list thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" style="width:100px" placeholder="'+title+'" />' );
                });

                // DataTable
                var table = $('#teacher_list').DataTable();

                table.columns().eq(0).each(function ( colIdx ) {
                    $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                        table
                        .column( colIdx )
                        .search( this.value )
                        .draw();
                    });
                });

                //editabke
                $.fn.editable.defaults.mode = 'inline';

                $('#edit_first_name').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_user/first_name',
                    success: function(response, newValue) {
                        location.reload(true);
                    }
                });

                $('#edit_last_name').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_user/last_name',
                    success: function(response, newValue) {
                        location.reload(true);
                    }
                });

                $('#edit_user_role').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_user/user_role',
                    success: function(response, newValue) {
                        location.reload(true);
                    }
                });

            });//end of document ready



        </script>




</body>

</html>