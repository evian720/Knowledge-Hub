<div class="box box-info">

</div>
    
<form action="<?php echo base_url() . 'index.php/main/submit_category'?>" method="post">
  <div class="row">
    <div class="col-sm-3">
      <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Selct the area of knowledge here! e.g. Technology">
        <div class="icon">
          <i class="glyphicon glyphicon-cloud"></i>
        </div>
        <h6>Area</h6>
      </div>
      <select class="form-control update" name="create_area" id="selected_area1" required>
        <option disabled="disabled" selected="">- Area -</option>
        <?php
        foreach ($area_selection as $area) {
          echo "<option>" . $area->cat_name . "</option>";
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
      <select class="form-control update" name="create_major" id="selected_major1">
        <option disabled="" selected="">- Major -</option>
        <?php
        foreach ($major_selection as $major) {
          echo "<option>" . $major->cat_name . "</option>";
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
      <select class="form-control update" name="create_subject" id="selected_subject1">
        <option disabled="" selected="">- Subject -</option>
        <?php
        foreach ($subject_selection as $subject) {
          echo "<option>" . $subject->cat_name . "</option>";
        }
        ?>
        <option>- Cannot find your subject? -</option>
      </select>
    </div>

    <div class="col-sm-3">
      <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="What is the chapter of your knowledge? e.g. Server Side Script">
        <div class="icon">
          <i class="glyphicon glyphicon-book"></i>
        </div>
        <h6>Chapter</h6>
      </div>
      <select class="form-control update" name="create_chapter" id="selected_chapter1">
        <option disabled="" selected="">- Chapter -</option>
        <?php
        foreach ($chapter_selection as $chapter) {
          echo "<option>" . $chapter->cat_name . "</option>";
        }
        ?>
        <option>- Cannot find your chapter? -</option>
      </div>
    </div>


    <div class="row"><input type="submit" class="btn btn-primary pull-right" value="Submit"></div>
  </form>




<script type="text/javascript">

$('#selected_area1').change(function(){
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
    $("#selected_major1 > option").remove();
    var area_name = $('#selected_area1').val();
    $.ajax({
      type: "POST",
      url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_major_dropdown_list/"+area_name,
      success: function(majors){
        $('#selected_major1').show();
        var opt1 = $('<option />');
        opt1.text('- Major -');
        $('#selected_major1').append(opt1);
        $.each(majors, function(cat_id, cat_name){
          var opt = $('<option />');
          opt.val(cat_name);
          opt.text(cat_name);
          $('#selected_major1').append(opt);
    //cannot find
    });
        var opt2 = $('<option />');
        opt2.text('- Cannot find your major? -');
        $('#selected_major1').append(opt2);
      },

      error: function(){
        var opt1 = $('<option />');
        opt1.text('- Major -');
        $('#selected_major1').append(opt1);
        var opt2 = $('<option />');
        opt2.text('- Cannot find your major? -');
        $('#selected_major1').append(opt2);
      }
    });


}); //end of selected_area1 on change

$('#selected_major1').change(function(){
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
    $("#selected_subject1 > option").remove();
    var major_name = $('#selected_major1').val();
    $.ajax({
      type: "POST",
      url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_subject_dropdown_list/"+major_name,
      success: function(subjects){
        $('#selected_subject1').show();
        var opt1 = $('<option />');
        opt1.text('- Subject -');
        $('#selected_subject1').append(opt1);
        $.each(subjects, function(cat_id, cat_name){
          var opt = $('<option />');
          opt.val(cat_name);
          opt.text(cat_name);
          $('#selected_subject1').append(opt);
    //cannot find
    });
        var opt2 = $('<option />');
        opt2.text('- Cannot find your subject? -');
        $('#selected_subject').append(opt2);
      },
      error: function(){
        var opt1 = $('<option />');
        opt1.text('- Subject -');
        $('#selected_subject1').append(opt1);
        var opt2 = $('<option />');
        opt2.text('- Cannot find your subject? -');
        $('#selected_subject1').append(opt2);
      }

    });


});

$('#selected_subject1').change(function(){
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
    $("#selected_chapter1 > option").remove();
    var subject_name = $('#selected_subject1').val();
    $.ajax({
      type: "POST",
      url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/get_chapter_dropdown_list/"+subject_name,
      success: function(chapters){
        $('#selected_chapter1').show();
        var opt1 = $('<option />');
        opt1.text('- Chapter -');
        $('#selected_chapter1').append(opt1);
        $.each(chapters, function(cat_id, cat_name){
          var opt = $('<option />');
          opt.val(cat_name);
          opt.text(cat_name);
          $('#selected_chapter1').append(opt);
    //cannot find
    });
        var opt2 = $('<option />');
        opt2.text('- Cannot find your chapter? -');
        $('#selected_chapter1').append(opt2);
      },
      error: function(){
        var opt1 = $('<option />');
        opt1.text('- Chapter -');
        $('#selected_chapter1').append(opt1);
        var opt2 = $('<option />');
        opt2.text('- Cannot find your chapter? -');
        $('#selected_chapter1').append(opt2);
      }

    });

});


$('#selected_chapter1').change(function(){
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




</script>




