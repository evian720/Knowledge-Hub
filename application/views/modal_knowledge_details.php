
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
          <li><a href="#item1" data-toggle="tab">Knowledge Item</a></li>
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
                    <div class="btn btn-success btn-sm"></div>
                  </div>
                </div>
                <div class="box-body">
                  <p>
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
            <h4 class="info-text"> Even more details!!</h4>

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


        </div> <!-- end of table-centent-->


        <div class="wizard-footer">
          <div class="pull-right">
            <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next' value='Next' />
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

</script>