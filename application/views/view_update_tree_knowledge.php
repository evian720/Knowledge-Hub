<?php
  foreach ($knowledges as $knowledge) {
    echo '

        <div class="col-md-4">
            <!-- Primary box -->
            <div class="box box-primary">
                <div class="box-header" data-toggle="tooltip" title="Header tooltip">
                    <h3 class="box-title">' . $knowledge->knowledge_title . '</h3>
                </div>
                <div class="box-body">
                    <p>
                        ' . $knowledge->knowledge_description . '
                    </p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div clss="pull-right">
                        <a class="btn btn-primary btn-xs" onclick="update_knowledge_detail( ' . $knowledge->knowledge_id . ' )">Details</a>
                    </div>   
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

    ';
  }
?>
