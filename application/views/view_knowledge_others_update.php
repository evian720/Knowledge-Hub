<!DOCTYPE html>
<html lang="en">

<div id="" style="height_back: 381px;"> <!-- start of showing the knowledge -->

  <?php 
  foreach ($knowledges as $knowledge) {  
    echo '
    <div class="widget">
      <div class="widget-header light">
        <span class="title">' . $knowledge->knowledge_title . '</span>
        <div class="toolbar">
          <div class="btn-group">
			<span class="btn" id="request_knowledge" onclick="send_request(' . $knowledge->knowledge_id .')"><i class="icon-plus"></i></a></span>
			<span class="btn"><i class="icon-minus"></i></span>
            <span class="btn dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </span>
            <ul class="dropdown-menu pull-right">
              <li><a class="popupform" href="' . base_url() . "index.php/main/view_knowledge_detail/" . $knowledge->knowledge_id . '">View Detail</a>
                  <script>
                    jQuery("a.popupform").colorbox({opacity: 0.5, width: "90%", height: "90%"});
                  </script>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="widget-content">
        <div class="form-group"> <!-- description -->
          ' . $knowledge->knowledge_description . '
        </div>
        <hr>
                          <div class="btn-group btn-xs pull-right">
                              <button type="button" class="btn btn-warning btn-xs btn-flat" id="category_button">Category</button>
                              <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                  <li><a href="#"><span class="badge bg-success">1</span> ' . $knowledge->level1_cat . ' </a></li>
                                  <li><a href="#"><span class="badge bg-success">2</span> ' . $knowledge->level2_cat . ' </a></li>
                                  <li><a href="#"><span class="badge bg-success">3</span> ' . $knowledge->level3_cat . ' </a></li>
                                  <li><a href="#"><span class="badge bg-success">4</span> ' . $knowledge->level4_cat . ' </a></li>
                              </ul>
                          </div>
      </div>
    </div> '; } ?>
    <p><?php echo $link1; ?></p>
  </div>  <!-- end of showing the knowledge -->

          <!-- for update use -->
          <input type="hidden" id="selected_value" value="<?php echo $selected; ?>" />

<script type="text/javascript">


</script>


</body>

</html>