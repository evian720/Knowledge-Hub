  <html>
  <head>

    <link rel="stylesheet" href='<?=base_url().'bootstrap/css/bootstrap.min.css'?>' media="screen">
    <link rel="stylesheet" href='<?=base_url().'assets/css/gsdk-base.css'?>' media="screen">

    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

    <script src='<?=base_url().'bootstrap/js/bootstrap.min.js'?>'></script>
    <script src='<?=base_url().'bootstrap/js/bootstrapValidator.js'?>'></script>

    <!--   plugins   -->
    <script src='<?=base_url().'assets/js/jquery.bootstrap.wizard.js'?>'></script>
    <script src='<?=base_url().'assets/js/wizard.js'?>'></script>
    <script src='<?=base_url().'assets/js/bootbox.js'?>'></script>
  </head>

  <body>
    <!-- <div class="wizard-container"> -->   
    <form class="white-popup-block mfp-hide">
      <div class="card wizard-card ct-wizard-green" id="wizard">

        <!--         "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"     -->

        <div class="wizard-header">
          <h3>
           <b>Knowledge</b> Detail <br>
           <small>Any fool can know. The point is to understand. -- Albert Einstein</small>
         </h3>
       </div>
       <ul>
        <li><a href="#basic_info" data-toggle="tab">Basic Information</a></li>
        <li><a href="#category" data-toggle="tab">Category</a></li>
        <li><a href="#item" data-toggle="tab">Knowledge Item</a></li>
      </ul>

      <!-- basic information section -->
      <div class="tab-content">
        <div class="tab-pane" id="basic_info">
          <h4 class="info-text"> Grab the basic concept! </h4>
          <hr>

          <div class="col-sm-10 col-sm-offset-1 form-group">
            <div class="panel panel-default">

              <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left"><b>Knowledge Title</b></h3>
                <div class="btn-group pull-right">
                  <a href="#" class="glyphicon glyphicon-wrench"></a>
                </div>
              </div>

              <div class="panel-body">
                <?php echo $knowledge->knowledge_title; ?>
              </div>

            </div>
          </div>

          <div class="col-sm-10 col-sm-offset-1 form-group">
            <div class="panel panel-default">

              <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left"><b>Knowledge Description</b></h3>
                <div class="btn-group pull-right">
                  <a href="#" class="glyphicon glyphicon-wrench"></a>
                </div>
              </div>

              <div class="panel-body">
                <?php echo $knowledge->knowledge_description; ?>
              </div>
            </div>
          </div>

        </div> <!-- end of basic_info section -->

        <!-- category section -->
        <div class="tab-pane" id="category">
          <h4 class="info-text"> Where are we now?</h4>
          
          <div> <!-- begin of row1 -->
            
            <!-- area -->
            <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Area of knowledge here! e.g. Technology">
                    <input type="radio" name="type" value="House">
                    <div class="icon">
                        <i class="glyphicon glyphicon-cloud"></i>
                    </div>
                    <h6><?php echo $user_knowledge->level1_cat; ?></h6>
                </div>
            </div>


            <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="The major that the knowledge belongs to. e.g System Engineering">
                    <input type="radio" name="type" value="House">
                    <div class="icon">
                        <i class="glyphicon glyphicon-th-large"></i>
                    </div>
                    <h6><?php echo $user_knowledge->level2_cat; ?></h6>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="The subject that the knowledge belongs to. e.g. Web Programming">
                    <input type="radio" name="type" value="House">
                    <div class="icon">
                        <i class="glyphicon glyphicon-th"></i>
                    </div>
                    <h6><?php echo $user_knowledge->level3_cat; ?></h6>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="The chapter that the knowledge belongs to. e.g. Server Side Script">
                    <input type="radio" name="type" value="House">
                    <div class="icon">
                        <i class="glyphicon glyphicon-book"></i>
                    </div>
                    <h6><?php echo $user_knowledge->level4_cat; ?></h6>
                </div>
            </div>


          </div> <!-- end of row1 -->


        </div>


        <!-- knowledge items section -->
        <div class="tab-pane" id="item">
          <h4 class="info-text"> Even more details!!</h4>

          <?php
          $count = 0;
          foreach ($knowledge_items as $knowledge_item) {
              
              if($count%2 == 0){
                echo '
                  <div class="row">
                    <div class="well col-md-5 col-md-offset-1">
                ';
              }
              else{
                echo '<div class="well col-md-5">';
              }

              echo '
                    <div class="panel panel-success">
                      <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><b>'. $knowledge_item->knowledge_item_content . '</b></h3>
                        <div class="btn-group pull-right">
                          <a href="#" class="glyphicon glyphicon-wrench"></a>
                        </div>
                      </div>

                      <div class="panel-body">
                        ' . $knowledge_item->knowledge_item_content . '
                      </div>
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
          <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd btn-sm' name='finish' value='Done' />
        </div>
        <div class="pull-left">
          <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
        </div>
        <div class="clearfix"></div>
      </div> <!-- end of the footer -->

    </div> <!-- end of card -->
  </form>
  <!--</div> wizard container -->


</body>

