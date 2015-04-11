<!DOCTYPE html>
<html lang="en">

<?php
require('view_admin_header.php');
?>


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
                                        foreach ($users as $row) {
                                            $user_rights = "";
                                            foreach ($user_access_rights as $right) {
                                                if($row->email == $right->email){
                                                    $user_rights .= "<br>" . $right->major;
                                                }
                                            }
                                            $user_rights= ltrim ($user_rights, '<br>');

                                            echo '
                                            <tr>
                                                <td>' . $row->email . '</td>
                                                <td><a href="#" class="edit_first_name" data-type="text" data-pk="' . $row->email . '" >' . $row->first_name . '</a></td>
                                                <td><a href="#" class="edit_last_name" data-type="text" data-pk="' . $row->email . '" >' . $row->last_name . '</a></td>
                                                <td><a href="#" class="edit_user_role" data-type="select" data-pk="' . $row->email . '" data-value="2" data-source="' . $select_data_source .'" >' . $row->user_role . '</a></td>
                                                <td>' . $user_rights . ' <a style="float: right" class="btn btn-danger btn-flat btn-xs" onclick="modify_cat_access(\''.$row->user_id.'\');"><i class="fa fa-pencil-square-o"></i></a></td>
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


        <!-- modal for modify the user access right -->
        <button type="button hidden" id="modify_user_access_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modify_user_access_modal"></button>
        <!-- modal for area selection -->
        <div class="modal fade" id="modify_user_access_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Access Rights</h4>
                    </div>
                    <div class="modal-body" id="modify_user_access_modal_body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modify_user_access_close" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="modify_user_access_submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div><!-- end of the modal -->

        


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

                $('.edit_first_name').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_user/first_name',
                    success: function(response, newValue) {
                        location.reload(true);
                    }
                });

                $('.edit_last_name').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_user/last_name',
                    success: function(response, newValue) {
                        location.reload(true);
                    }
                });

                $('.edit_user_role').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_user/user_role',
                    success: function(response, newValue) {
                        location.reload(true);
                    }
                });

            });//end of document ready

            function modify_cat_access(user_id){
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_user_access_rights_selection/" + user_id, //this is the submit URL
                    type: 'POST', //or POST
                    success: function(data){
                        $('#modify_user_access_modal_body').html(data);
                    }
                });
                $('#modify_user_access_button').click();
            }

            $('#modify_user_access_submit').on('click', function(e){
                var user_id = $('#modify_user_access_rights_target').val();
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/submit_user_access_rights/", //this is the submit URL
                    type: 'POST', //or POST
                    data: $('#user_access_form').serialize(),
                    success: function(data){
                        $('#modify_user_access_close').click();
                        location.reload(true); 
                    }
                });
            });


        </script>

</body>

</html>