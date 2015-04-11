<!DOCTYPE html>
<html lang="en">

<?php
require('view_admin_header.php');
?>

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
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Search to find category quicker...</h3>
                                <div class="box-tools pull-right">
                                    <div class="btn btn-flat btn-primary" id="add_category_button" data-toggle="modal" data-target="#add_category_modal"><i class="fa fa-plus"></i></div>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="category_list" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Area</th>
                                            <th>Major</th>
                                            <th>Subject</th>
                                            <th>Chapter</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($categories as $row) {
                                            echo '
                                            <tr>
                                                <td><a href="#" class="edit parent_level" data-type="text" data-pk="' . $row->level1_cat_id . '" >' . $row->level1_cat . '</a></td>
                                                <td><a href="#" class="edit parent_level" data-type="text" data-pk="' . $row->level2_cat_id . '" >' . $row->level2_cat . '</a></td>
                                                <td><a href="#" class="edit parent_level" data-type="text" data-pk="' . $row->level3_cat_id . '" >' . $row->level3_cat . '</a></td>
                                                <td><a href="#" class="edit" data-type="text" data-pk="' . $row->level4_cat_id . '" >' . $row->level4_cat . '</a></td>
                                                <td class="action-col">
                                                    <span class="btn-group">
                                                        <a href="delete_cat?cat_id=' . $row->level4_cat_id . "\"" . ' class="btn btn-small delete_cat" id="delete_cat_button" data-toggle="confirmation" data-placement="left" data-btn-ok-label="Yes!" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="Stop!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                                                        <a href="#" class="btn btn-small"><i class="fa fa-paint-brush"></i></a>
                                                        <a href="#" class="btn btn-small"><i class="fa fa-plus"></i></a>
                                                    </span>
                                                </td>
                                            </tr>
                                            ';
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Area</th>
                                            <th>Major</th>
                                            <th>Subject</th>
                                            <th>Chapter</th>
                                            <th>Action</th>
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



        <!-- modal for new category -->
        <div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 95%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Create New Category</h4>
                    <div class="modal-body">
                        <div id="update"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <script src='<?=base_url().'assets/js/bootstrap-confirmation.js'?>'></script>
        <script type="text/javascript">
        $(document).ready(function(){
              $.ajax({
                type: "POST",
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_category_for_creation/",
                success: function(data){
                    $('#update').html(data);
                }
            });
        });


            //column search
            $(document).ready(function() {
                // Setup - add a text input to each footer cell
                $('#category_list tfoot th').each( function () {
                    var title = $('#category_list thead th').eq( $(this).index() ).text();
                    $(this).html( '<input type="text" style="width:100px" placeholder="'+title+'" />' );
                } );

                // DataTable
                var table = $('#category_list').DataTable();

                // Apply the search
                table.columns().eq( 0 ).each( function ( colIdx ) {
                    $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                        table
                        .column( colIdx )
                        .search( this.value )
                        .draw();
                    } );
                } );
            } );


            //editabke
            $.fn.editable.defaults.mode = 'inline';

            $(document).ready(function() {
                $('.edit').editable({
                    url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_category/',
                    success: function(response, newValue) {
                        location.reload(true);
                    }
                });

            });

            $('.parent_level').on('click', function(){
                new PNotify({
                    title: 'Attention!',
                    text: 'Please note that this is a parent level category. If you modify this, it will affect all its underlying categories.',
                    type: 'error'
                });

            });

            $('.delete_cat').on('click', function(){
                new PNotify({
                    title: 'Attention!',
                    text: 'This will only delete the lowest level category.',
                    type: 'error'
                });


            });

            $('[data-toggle=confirmation]').confirmation();
            $('[data-toggle=confirmation-singleton]').confirmation({ singleton:true });
            $('[data-toggle=confirmation-popout]').confirmation({ popout: true });
            $('[data-toggle=confirmation]').on('confirmed.bs.confirmation', function () {
                document.getElementById("delete_cat_button").click();
            });


        </script>



</body>

</html>