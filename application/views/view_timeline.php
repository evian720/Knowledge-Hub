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
                        Time Line
                        <small>See your knowledge creation time line!</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Time Line</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">



                    <ul class="timeline">

                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">10 Feb. 2014</span>
                        </li>

                        <!-- timeline item -->

                        <?php
                        $counter = 0;
                        foreach ($my_knowledge as $row){
                            echo '
                            <li>
                                <!-- timeline icon -->';

                            if($counter%4==0){
                                echo '<i class="fa fa-envelope bg-blue"></i>';
                            }elseif ($counter%4==1) {
                                echo '<i class="fa fa-user bg-aqua"></i>';
                            }elseif ($counter%4==2) {
                                echo '<i class="fa fa-comments bg-yellow"></i>';
                            }elseif ($counter%4==3) {
                                echo '<i class="fa fa-camera bg-purple"></i>';
                            }

                            echo '
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> ' . $row->created_time . '</span>

                                    <h3 class="timeline-header"><a href="#">' . $row->knowledge_title . '</a></h3>

                                    <div class="timeline-body">
                                    ' . $row->knowledge_description . '
                                    </div>

                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs" onclick="update_knowledge_detail( ' . $row->knowledge_id . ' )">Details</a>
                                        <a href="delete_knowledge?knowledge_id=' . $row->knowledge_id . "\"" . ' class="btn btn-danger btn-xs" id="delete_button" data-toggle="confirmation" data-placement="right" data-btn-ok-label="Yes!" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="Stop!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger">Delete</a>

                                        <div class="btn-group btn-xs pull-right">
                                            <button type="button" class="btn btn-warning btn-xs btn-flat" id="category_button">Category</button>
                                            <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#"><span class="badge bg-success">1</span> ' . $row->level1_cat . ' </a></li>
                                                <li><a href="#"><span class="badge bg-success">2</span> ' . $row->level2_cat . ' </a></li>
                                                <li><a href="#"><span class="badge bg-success">3</span> ' . $row->level3_cat . ' </a></li>
                                                <li><a href="#"><span class="badge bg-success">4</span> ' . $row->level4_cat . ' </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->

                            ';
                            $counter++;
                        }
                        ?>
                        <li>
                            <i class="fa fa-clock-o"></i>
                        </li>
                    </ul>
                    <p><?php echo $links; ?></p>


  </section><!-- /.content -->




  <!-- hidden button for popup modal -->
  <button type="button" id="view_knowledge_detail_button" class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#view_knowledge_detail"></button>

  <!-- modal for create knowledge -->
  <div class="modal fade" id="view_knowledge_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="details">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<?php
require('footer.php');
?>
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


<script src='<?=base_url().'assets/js/bootstrap-confirmation.js'?>'></script>
<script>
  $('[data-toggle=confirmation]').confirmation();
  $('[data-toggle=confirmation-singleton]').confirmation({ singleton:true });
  $('[data-toggle=confirmation-popout]').confirmation({ popout: true });
  $('[data-toggle=confirmation]').on('confirmed.bs.confirmation', function () {
    document.getElementById("delete_button").click();
  });


  function update_knowledge_detail(knowledge_id){
        $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/view_knowledge_detail/" + knowledge_id, //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    $('#details').html(data);
                    $('#view_knowledge_detail_button').click();
                }
        });
    }
  


</script>

</body>

</html>