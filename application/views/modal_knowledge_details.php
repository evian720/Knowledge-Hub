
    <!-- <div class="wizard-container"> -->   
    <form class="white-popup-block mfp-hide">
      <div class="card wizard-card ct-wizard-green" id="wizard1">

        <!--         "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"     -->

        <div class="wizard-header">
          <h3>
           <b>Knowledge</b> Detail <br>
           <small>Any fool can know. The point is to understand. -- Albert Einstein</small>
          </h3>
        </div>

        <ul>
          <li><a href="#basic_info1" data-toggle="tab">Basic Information</a></li>
          <li><a href="#category1" data-toggle="tab">Category</a></li>
          <li><a href="#item1" data-toggle="tab" id="new_knowledge_item_check">Knowledge Item</a></li>
          <?php
            if(!empty($attachments)){
              echo '<li><a href="#attachment1" data-toggle="tab">Attachment</a></li>';
            }
          ?>
        </ul>

        <!-- basic information section -->
        <div class="tab-content">
          <div class="tab-pane" id="basic_info1">
            <h4 class="info-text"> Grab the basic concept! </h4>

            <div class="col-md-10 col-md-offset-1">
              <!-- Success box -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Knowledge Title</h3>
                  <div class="box-tools pull-right">
                    <div class="btn btn-success btn-sm" onclick="modify_knowledge_title()"><i class="fa fa-wrench"></i></div>
                  </div>
                </div>
                <div class="box-body">
                  <p id="knowledge_title_field">
                    <?php echo $knowledge->knowledge_title; ?>
                  </p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
          <div class="col-md-10 col-md-offset-1">
              <!-- Success box -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Knowledge Description</h3>
                  <div class="box-tools pull-right">
                    <div class="btn btn-success btn-sm" onclick="modify_knowledge_description()"><i class="fa fa-wrench"></i></div>
                  </div>
                </div>
                <div class="box-body">
                  <p id="knowledge_description_field">
                    <?php echo $knowledge->knowledge_description; ?>
                  </p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div>

          <!-- category section -->
          <div class="tab-pane" id="category1">
            <h4 class="info-text"> Where are we now?</h4>

            <div> <!-- begin of row1 -->

              <!-- area -->
              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Area of knowledge here! e.g. Technology">
                  <input type="radio" name="type" value="House">
                  <div class="icon">
                    <i class="glyphicon glyphicon-cloud"></i>
                  </div>
                  <h6><?php echo $knowledge->level1_cat; ?></h6>
                </div>
              </div>


              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="The major that the knowledge belongs to. e.g System Engineering">
                  <input type="radio" name="type" value="House">
                  <div class="icon">
                    <i class="glyphicon glyphicon-th-large"></i>
                  </div>
                  <h6><?php echo $knowledge->level2_cat; ?></h6>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="The subject that the knowledge belongs to. e.g. Web Programming">
                  <input type="radio" name="type" value="House">
                  <div class="icon">
                    <i class="glyphicon glyphicon-th"></i>
                  </div>
                  <h6><?php echo $knowledge->level3_cat; ?></h6>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="The chapter that the knowledge belongs to. e.g. Server Side Script">
                  <input type="radio" name="type" value="House">
                  <div class="icon">
                    <i class="glyphicon glyphicon-book"></i>
                  </div>
                  <h6><?php echo $knowledge->level4_cat; ?></h6>
                </div>
              </div>


            </div> <!-- end of row1 -->
          </div>


          <!-- knowledge items section -->
          <div class="tab-pane" id="item1">
            <h4 class="info-text"> Even more details!!<div class="pull-right"><a href="" data-toggle="modal" data-target="#new_knowledge_item_modal" id=""><i class="fa fa-plus"></i></a></div></h4>
            

<?php
$count = 0;
foreach ($knowledge_items as $knowledge_item) {

  if($count%2 == 0){
    echo '
    <div class="row">
      <div class="col-md-5 col-md-offset-1">
        ';
      }
      else{
        echo '<div class="col-md-5">';
      }

      echo '
      <div class="box box-solid box-success">
        <div class="box-header">
          <h3 class="box-title">'. $knowledge_item->knowledge_item_title . '</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          <p>
            ' . $knowledge_item->knowledge_item_content . '
          </p>
        </div><!-- /.box-body -->
      </div>
    </div>
    ';

    if($count%2 == 1){
      echo "</div>";
    }

    $count++;
  }

  if( count($knowledge_items)%2 == 1){
    echo "</div>";
  }

  ?>
          

          </div>



          <div class="tab-pane" id="attachment1">
            <h4 class="info-text"> Check your references here!</h4>
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1">
                <table id="attachment_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Attachments</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($attachments as $row) {
                        echo '
                        <tr>
                          <td> ' . $row->file_name . ' </td>
                          <td>
                          <div class="col-sm-3"><i class="fa fa-download" onclick="download_attachment(\''.$row->id.'\')"></i></div>
                          <div class="col-sm-3"><i class="fa fa-times"></i></div>

                          </td>
                        </tr>
                        ';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>


        </div> <!-- end of table-centent-->


        <div class="wizard-footer">
          <div class="pull-right">
            <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next' id="next_buttom" value='Next' />
          </div>
          <div class="pull-left">
            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
          </div>
          <div class="clearfix"></div>
        </div> <!-- end of the footer -->

      </div> <!-- end of card -->
    </form>
    <!--</div> wizard container -->



    <!-- for store knowledge information -->
    <input type="hidden" id="store_knowledge_id" value="<?php echo $knowledge->knowledge_id; ?>" />


    <div class="modal fade" id="new_knowledge_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 95%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Create Knowledge Item</h4>
                <div class="modal-body">
                  <form action="" method="post" id="new_knowledge_item_form">
                    <div id="update">
                      <div class="row">
                        <div class="col-sm-7 col-sm-offset-1">
                          <div class="form-group">
                            <label >Knowledge Item</label>
                            <input type="text" class="form-control" name="new_knowledge_item_title" placeholder="Knowledge Item Title" />

                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Example</label>
                            <p class="description">"PHP Database Connect"</p>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-7 col-sm-offset-1">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Knowledge Item Description</label>
                            <textarea class="form-control" id="new_knowledge_item_desc" rows="3" name="new_knowledge_item_content" placeholder="Knowledge Item Content"></textarea>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Example</label>
                            <p class="description">"We can query a database for specific information and have a recordset returned. Look at the following query (using standard SQL): SELECT LastName FROM Employees"</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="knowledge_id_for_new_item" name="knowledge_id_for_new_item" value="<?php echo $knowledge->knowledge_id; ?>" />
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type='button' class='btn btn-warning' onclick="submit_new_knowledge_item();">Finish</button>
                </div>
            </div>
        </div>
    </div>



<script type="text/javascript">
  $('#wizard1').bootstrapWizard({

    'tabClass': 'nav nav-pills',

    'nextSelector': '.btn-next',

    'previousSelector': '.btn-previous',

     onInit : function(tab, navigation,index){

     

       //check number of tabs and fill the entire row

       var $total = navigation.find('li').length;

       $width = 100/$total;

       navigation.find('li').css('width',$width + '%');

    },

     onTabClick : function(tab, navigation, index){

        // Disable the posibility to click on tabs

        return false;

    }, 

    onTabShow: function(tab, navigation, index) {

        var $total = navigation.find('li').length;

        var $current = index+1;

      
        var wizard = navigation.closest('.wizard-card');

        

        // If it's the last tab then hide the last button and show the finish instead

        if($current >= $total) {

            $(wizard).find('.btn-next').hide();

            $(wizard).find('.btn-finish').show();

        } else {

            $(wizard).find('.btn-next').show();

            $(wizard).find('.btn-finish').hide();

        }

    }

  }); 

  //modeify knowledge
  $.fn.editable.defaults.mode = 'inline';

  function modify_knowledge_title(){
    html_content = '<a href="#" id="knowledge_title_text" data-type="text" data-pk=" ' + $('#store_knowledge_id').val() + ' " ><?php echo $knowledge->knowledge_title; ?></a>';
    $('#knowledge_title_field').html(html_content);
    $('#knowledge_title_text').editable({

      url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_knowledge/knowledge_title',
      success: function(response, newValue) {
      
          //location.reload(true);
      }
    });

  }

  function modify_knowledge_description(){
    html_content = '<a href="#" id="knowledge_description_text" data-type="text" data-pk=" ' + $('#store_knowledge_id').val() + ' " ><?php echo $knowledge->knowledge_description; ?></a>';
    $('#knowledge_description_field').html(html_content);
    $('#knowledge_description_text').editable({

      url: 'http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/edit_knowledge/knowledge_description',
      success: function(response, newValue) {
      
          //location.reload(true);
      }
    });

  }

  $('#attachment_table').dataTable();

  function download_attachment(id){
      window.location.href = "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/download_file/" + id;
      alertify.success("Start to Download!");
    }

    $('#new_knowledge_item_desc').wysihtml5();

    function submit_new_knowledge_item(){
        $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/submit_new_knowledge_item/", //his is the submit URL
            type: 'POST', //or POST
            data: $('#new_knowledge_item_form').serialize(),
            success: function(data){
              //$('#new_knowledge_item_modal').modal('hide');
              $('#view_knowledge_detail_button').click();
              $.ajax({
                url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/view_knowledge_detail/" + $('#knowledge_id_for_new_item').val(), //this is the submit URL
                type: 'POST', //or POST
                success: function(data){
                    $('#details').html(data);
                    $('#view_knowledge_detail_button').click();
                    $('#next_buttom').click();
                    $('#next_buttom').click();
                }
                });         
            }
        });
    }


</script>