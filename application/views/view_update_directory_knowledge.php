<?php
  foreach ($knowledges as $knowledge) {
    echo '
      <div class="col-md-10">
        <!-- Primary box -->
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">' . $knowledge->knowledge_title . '</h3>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-body">
            <p>
                ' . $knowledge->knowledge_description . '
            </p>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    ';
  }
?>

