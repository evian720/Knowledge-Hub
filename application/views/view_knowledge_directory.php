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
                        Knowledge Directory
                        <small>Easy way to find knowledge!</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Knowledge Directory</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Search to find knowledge quicker...</h3>
                                <div class="box-tools pull-right">
                                    <div class="label bg-aqua">Updated</div>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="knowledge_directory_table" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Knowledge Title</th>
                                            <th>Area</th>
                                            <th>Major</th>
                                            <th>Subject</th>
                                            <th>Chapter</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($knowledge as $row) {
                                            echo '
                                            <tr>
                                                <td>' . $row->knowledge_title . '</td>
                                                <td>' . $row->level1_cat . '</td>
                                                <td>' . $row->level2_cat . '</td>
                                                <td>' . $row->level3_cat . '</td>
                                                <td>' . $row->level4_cat . '</td>
                                                <td class="action-col">
                                                    <span class="btn-group">
                                                        <a href="#" class="btn btn-small"><i class="fa fa-search"></i></a>
                                                        <a href="#" class="btn btn-small"><i class="fa fa-paint-brush"></i></a>
                                                    </span>
                                                </td>
                                            </tr>
                                            ';
                                        }

                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Title</th>
                                            <th>Area</th>
                                            <th>Major</th>
                                            <th>Subject</th>
                                            <th>Chapter</th>
                                            <th></th>
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


        <script type="text/javascript">

            //column search
            $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#knowledge_directory_table tfoot th').each( function () {
                var title = $('#knowledge_directory_table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" style="width:100px" placeholder="'+title+'" />' );
            } );

            // DataTable
            var table = $('#knowledge_directory_table').DataTable();

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

        </script>

</body>

</html>