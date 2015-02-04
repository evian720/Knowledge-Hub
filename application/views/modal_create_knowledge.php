

    <link rel="stylesheet" href='<?=base_url().'assets/css/gsdk-base-new.css'?>' media="screen">
    <script src='<?=base_url().'bootstrap/js/bootstrapValidator.js'?>'></script>

    <script src='<?=base_url().'assets/js/jquery.bootstrap.wizard.js'?>'></script>
    <script src='<?=base_url().'assets/js/wizard.js'?>'></script>
    <script src='<?=base_url().'assets/js/bootbox.js'?>'></script>

    <link rel="stylesheet" href='<?=base_url().'assets/css/bootstrap3-wysihtml5.min.css'?>' media="screen">
    <script src='<?=base_url().'assets/js/bootstrap3-wysihtml5.all.min.js'?>'></script>



    <!-- <div class="wizard-container"> -->   
    <form action="<?php echo base_url() . 'index.php/main/submit_knowledge' ?>" id="knowledgeinputform" method="post" class="white-popup-block mfp-hide">
      <div class="card wizard-card ct-wizard-orange" id="wizard">

        <!--         "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"     -->

        <div class="wizard-header">
          <h3>
            <b>Create</b> Your Knowledge <br>
            <small>Knowledge is Power -- Francis Bacon</small>
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
            <h4 class="info-text"> Let's input the basic information of the knowledge first!</h4>
            <div class="row">
              <div class="col-sm-7 col-sm-offset-1">
                <div class="form-group">
                  <label >Knowledge Title</label>
                  <input type="text" class="form-control typeahead" name="knowledge_title" id="for_typeahead" autocomplete="off" required/>

                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Example</label>
                  <p class="description">"PHP Programming"</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-7 col-sm-offset-1">
                <div class="form-group">
                  <label for="exampleInputEmail1">Knowledge Description</label>
                  <textarea class="form-control" id="knowledge_desc" rows="3" name="knowledge_description" placeholder="Knowledge Description" required></textarea>

                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Example</label>
                  <p class="description">"In this piece of knowledge, I include lots of must-known stuff in PHP prgramming. For example, form usage, basic syntax, variables, database connect and etc."</p>
                </div>
              </div>
            </div>
          </div>

          <!-- category section -->
          <div class="tab-pane" id="category">
            <h4 class="info-text"> A proper category will help a lot on finding your knowledge and constructing the tree!</h4>

            <div> <!-- begin of row1 -->

              <!-- area -->
              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Selct the area of knowledge here! e.g. Technology">
                  <div class="icon">
                    <i class="glyphicon glyphicon-cloud"></i>
                  </div>
                  <h6>Area</h6>
                </div>
                <select class="form-control update" name="selected_area" id="selected_area" required>
                  <option disabled="disabled" selected="">- Area -</option>
                  <?php
                  foreach ($major_selection as $major) {
                    if($major->cat_name == $user_major){
                      $area_id = $major->parent_id;
                    }
                  }

                  foreach ($area_selection as $area) {
                    if($area->cat_id == $area_id){
                      echo "<option selected='selected'>" . $area->cat_name . "</option>";
                    }
                    else{
                      echo "<option>" . $area->cat_name . "</option>";
                    }          
                  }
                  ?>
                  <option>- Cannot find your area? -</option>
                </select>
              </div>


              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="The major isn't correct? You can change it! e.g System Engineering">
                  <div class="icon">
                    <i class="glyphicon glyphicon-th-large"></i>
                  </div>
                  <h6>Major</h6>
                </div>
                <select class="form-control update" name="selected_major" id="selected_major">
                  <option disabled="">- Major -</option>
                  <?php
                  foreach ($major_selection as $major) {
                    if($major->cat_name == $user_major){
                      echo "<option selected='selected'>" . $major->cat_name . "</option>";
                    }
                    else{
                      echo "<option>" . $major->cat_name . "</option>";
                    }

                  }
                  ?>
                  <option>- Cannot find your major? -</option>
                </select>
              </div>

              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="What is the subject of this piece of knowledge? e.g. Web Programming">
                  <div class="icon">
                    <i class="glyphicon glyphicon-th"></i>
                  </div>
                  <h6>Subject</h6>
                </div>
                <select class="form-control update" name="selected_subject" id="selected_subject">
                  <option disabled="" selected="">- Subject -</option>
                  <option>Web Programming</option>
                  <option>Computer Organizations</option>
                  <option>Database Management</option>
                  <option>Object-Oriented Programming</option>
                  <option>Computer Networking</option>
                  <option>AI</option>
                </select>
              </div>

              <div class="col-sm-3">
                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="What is the chapter of your knowledge? e.g. Server Side Script">
                  <div class="icon">
                    <i class="glyphicon glyphicon-book"></i>
                  </div>
                  <h6>Chapter</h6>
                </div>
                <select class="form-control update" name="selected_chapter" id="selected_chapter">
                  <option disabled="" selected="">- Chapter -</option>
                  <option>Server Side</option>
                  <option>Front End Design</option>
                  <option>MySQL Database</option>
                  <option>Node.js</option>
                  <option>Search Optimization Engine</option>
                  <option>Cloud Computing</option>
                </select>
              </div>


            </div> <!-- end of row1 -->


          </div>


          <!-- knowledge items section -->
          <div class="tab-pane" id="item">
            <h4 class="info-text"> We can add more sub item into this piece of knowledge!<br>You can add multiple sub items by pressing "+"</br></h4>

            <div class="row">
              <div class="col-sm-1">
                <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
              </div>
              <div class="col-sm-7">
                <div class="form-group">
                  <label >Knowledge Item</label>
                  <input type="text" class="form-control" name="knowledge_item_title[]" placeholder="Knowledge Item Title" />

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
                  <textarea class="form-control" id="knowledge_item_desc" rows="3" name="knowledge_item_content[]" placeholder="Knowledge Item Content"></textarea>
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


          <!-- Template by pressing + -->
          <div class="form-group hide" id="optionTemplate">
            <hr>
            <div class="row">
              <div class="col-sm-1">
                <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
              </div>
              <div class="col-sm-7">
                <div class="form-group">
                  <label >Knowledge Item</label>
                  <input type="text" class="form-control" name="knowledge_item_title[]" placeholder="Knowledge Item Title" />

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
              <div class="col-sm-1">
                <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
              </div>

              <div class="col-sm-7">
                <div class="form-group">
                  <label for="exampleInputEmail1">Knowledge Item Description</label>
                  <textarea class="form-control" id="knowledge_item_desc_tem" rows="3" name="knowledge_item_content[]" placeholder="Knowledge Item Content"></textarea>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Example</label>
                  <p class="description">"We can query a database for specific information and have a recordset returned. Look at the following query (using standard SQL): SELECT LastName FROM Employees"</p>
                </div>
              </div> 

            </div>



          </div><!-- end of template -->


        </div> <!-- end of table-centent-->


        <div class="wizard-footer">
          <div class="pull-right">
            <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
            <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />
          </div>
          <div class="pull-left">
            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
          </div>
          <div class="clearfix"></div>
        </div> <!-- end of the footer -->

      </div> <!-- end of card -->
    </form>
    <!--</div> wizard container -->



<script type="text/javascript">
$('#knowledge_desc').wysihtml5();
$('#knowledge_item_desc').wysihtml5();

$(document).ready(function() {
// The maximum number of options
var MAX_OPTIONS = 10;

$('#knowledgeinputform')
.bootstrapValidator({
  feedbackIcons: {
    valid: 'glyphicon glyphicon-ok',
    invalid: 'glyphicon glyphicon-remove',
    validating: 'glyphicon glyphicon-refresh'
  },
  fields: {
    question: {
      validators: {
        notEmpty: {
          message: 'The question required and cannot be empty'
        }
      }
    },
    'option[]': {
      validators: {
        notEmpty: {
          message: 'The option required and cannot be empty'
        },
        stringLength: {
          max: 100,
          message: 'The option must be less than 100 characters long'
        }
      }
    }
  }
})

// Add button click handler
.on('click', '.addButton', function() {
  var $template = $('#optionTemplate'),
  $clone    = $template
  .clone()
  .removeClass('hide')
  .removeAttr('id')
  .insertBefore($template),
  $option   = $clone.find('[name="option[]"]');

// Add new field
$('#knowledgeinputform').bootstrapValidator('addField', $option);

})

// Remove button click handler
.on('click', '.removeButton', function() {
  var $row    = $(this).parents('.form-group'),
  $option = $row.find('[name="option[]"]');

// Remove element containing the option
$row.remove();

// Remove field
$('#knowledgeinputform').bootstrapValidator('removeField', $option);
})

// Called after adding new field
.on('added.field.bv', function(e, $data) {
//data.field
// data.element --> The new field element
// data.options --> The new field options
$('#knowledge_item_desc_tem').wysihtml5();

if (data.field === 'option[]') {
  if ($('#knowledgeinputform').find(':visible[name="option[]"]').length >= MAX_OPTIONS) {
    $('#knowledgeinputform').find('.addButton').attr('disabled', 'disabled');
  }
}
})

// Called after removing the field
.on('removed.field.bv', function(e, data) {
  if (data.field === 'option[]') {
    if ($('#knowledgeinputform').find(':visible[name="option[]"]').length < MAX_OPTIONS) {
      $('#knowledgeinputform').find('.addButton').removeAttr('disabled');
    }
  }
});
});

$(document).ready(function() {

  $("#selected_subject > option").remove();
  var major_name = $('#selected_major').val();
  $.ajax({
    type: "POST",
    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_subject_dropdown_list/"+major_name,
    success: function(subjects){
      $('#selected_subject').show();
      var opt1 = $('<option />');
      opt1.text('- Subject -');
      $('#selected_subject').append(opt1);
      $.each(subjects, function(cat_id, cat_name){
        var opt = $('<option />');
        opt.val(cat_name);
        opt.text(cat_name);
        $('#selected_subject').append(opt);
//cannot find
});
      var opt2 = $('<option />');
      opt2.text('- Cannot find your subject? -');
      $('#selected_subject').append(opt2);
    },
    error: function(){
      var opt1 = $('<option />');
      opt1.text('- Subject -');
      $('#selected_subject').append(opt1);
      var opt2 = $('<option />');
      opt2.text('- Cannot find your subject? -');
      $('#selected_subject').append(opt2);
    }
  });


  $('#selected_area').change( function() {
    var value = $(this).val();

    if (!value || value == '- Cannot find your area? -') {

      var other = prompt( "Please input your area:" );

      if (!other) return false;
      $(this).append('<option value="'
        + other
        + '" selected="selected">'
        + other
        + '</option>');
    }

//update subject
$("#selected_major > option").remove();
var area_name = $('#selected_area').val();
$.ajax({
  type: "POST",
  url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_major_dropdown_list/"+area_name,
  success: function(majors){
    $('#selected_major').show();
    var opt1 = $('<option />');
    opt1.text('- Major -');
    $('#selected_major').append(opt1);
    $.each(majors, function(cat_id, cat_name){
      var opt = $('<option />');
      opt.val(cat_name);
      opt.text(cat_name);
      $('#selected_major').append(opt);
//cannot find
});
    var opt2 = $('<option />');
    opt2.text('- Cannot find your major? -');
    $('#selected_major').append(opt2);
  },

  error: function(){
    var opt1 = $('<option />');
    opt1.text('- Major -');
    $('#selected_major').append(opt1);
    var opt2 = $('<option />');
    opt2.text('- Cannot find your major? -');
    $('#selected_major').append(opt2);
  }
});

});//end of selected_area.change


$('#selected_major').change( function() {
  var value = $(this).val();

  if (!value || value == '- Cannot find your major? -') {

    var other = prompt( "Please input your major:" );

    if (!other) return false;
    $(this).append('<option value="'
      + other
      + '" selected="selected">'
      + other
      + '</option>');
  }


//update subject
$("#selected_subject > option").remove();
var major_name = $('#selected_major').val();
$.ajax({
  type: "POST",
  url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_subject_dropdown_list/"+major_name,
  success: function(subjects){
    $('#selected_subject').show();
    var opt1 = $('<option />');
    opt1.text('- Subject -');
    $('#selected_subject').append(opt1);
    $.each(subjects, function(cat_id, cat_name){
      var opt = $('<option />');
      opt.val(cat_name);
      opt.text(cat_name);
      $('#selected_subject').append(opt);
//cannot find
});
    var opt2 = $('<option />');
    opt2.text('- Cannot find your subject? -');
    $('#selected_subject').append(opt2);
  },
  error: function(){
    var opt1 = $('<option />');
    opt1.text('- Subject -');
    $('#selected_subject').append(opt1);
    var opt2 = $('<option />');
    opt2.text('- Cannot find your subject? -');
    $('#selected_subject').append(opt2);
  }

});
}); //end of selected_major.change

$('#selected_subject').change( function() {
  var value = $(this).val();

  if (!value || value == '- Cannot find your subject? -') {

    var other = prompt( "Please input your subject:" );

    if (!other) return false;
    $(this).append('<option value="'
      + other
      + '" selected="selected">'
      + other
      + '</option>');
  }


//update subject
$("#selected_chapter > option").remove();
var subject_name = $('#selected_subject').val();
  $.ajax({
    type: "POST",
    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_chapter_dropdown_list/"+subject_name,
    success: function(chapters){
      $('#selected_chapter').show();
      var opt1 = $('<option />');
      opt1.text('- Chapter -');
      $('#selected_chapter').append(opt1);
      $.each(chapters, function(cat_id, cat_name){
        var opt = $('<option />');
        opt.val(cat_name);
        opt.text(cat_name);
        $('#selected_chapter').append(opt);
        //cannot find
        });
        var opt2 = $('<option />');
        opt2.text('- Cannot find your chapter? -');
        $('#selected_chapter').append(opt2);
      },
      error: function(){
        var opt1 = $('<option />');
        opt1.text('- Chapter -');
        $('#selected_chapter').append(opt1);
        var opt2 = $('<option />');
        opt2.text('- Cannot find your chapter? -');
        $('#selected_chapter').append(opt2);
      }

  });
}); //end of selected_subject.change

$('#selected_chapter').change( function() {
  var value = $(this).val();

  if (!value || value == '- Cannot find your chapter? -') {

    var other = prompt( "Please input your chapter:" );

    if (!other) return false;
    $(this).append('<option value="'
      + other
      + '" selected="selected">'
      + other
      + '</option>');

  }



});


});


//start of typeahead


$(document).ready(function(){

  $.ajax({
    type: "POST",
    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_knowledge_title/",
    success: function(knowledge_title){

  $.get('http://101.78.175.101:8580/fyp/knowledge_hub/json/knowledge_title.json', function(data){
    $("#for_typeahead").typeahead({ source: unique(data) });
      },'json');
    }
  });

});

//function to remove duplicates
function unique(obj){
    var uniques=[];
    var stringify={};
    for(var i=0;i<obj.length;i++){
       var keys=Object.keys(obj[i]);
       keys.sort(function(a,b) {return a-b});
       var str='';
        for(var j=0;j<keys.length;j++){
           str+= JSON.stringify(keys[j]);
           str+= JSON.stringify(obj[i][keys[j]]);
        }
        if(!stringify.hasOwnProperty(str)){
            uniques.push(obj[i]);
            stringify[str]=true;
        }
    }
    return uniques;
}


</script>




