<div>
	<?php
	foreach ($knowledges as $knowledge) {
    if($knowledge->count > 10){
        $match_color_relativity = "success";
    }elseif($knowledge->count > 3){
        $match_color_relativity = "warning";
    }else{
        $match_color_relativity = "danger";
    }

    //the color of rating bar
    if($knowledge->rating > 7 ){
        $match_color_rating = "success";
    }elseif($knowledge->rating > 4){
        $match_color_rating = "warning";
    }else{
        $match_color_rating = "danger";
    }

    //"Your rating" message
    if( count($user_ratings)>0 ){
        foreach ($user_ratings as $rating) {
            if( $knowledge->knowledge_id == $rating->knowledge_id){
                $rating_for_knowledge = $rating->rating;
                $rating_message = " ";
                break;
            }else{
                $rating_for_knowledge = 0;
                $rating_message = "You havn't rated it yet! ";
            }
        }
    }else{
        $rating_for_knowledge = 0;
        $rating_message = "You havn't rated it yet! ";
    }
		echo '
		<div class="box box-primary">
			<div class="box-header" data-toggle="tooltip" title="Knowledge Title">
				<h3 class="box-title">' . $knowledge->knowledge_title . '</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-primary btn-flat btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-primary btn-flat btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<p>' . $knowledge->knowledge_description . ' </p>
			</div><!-- /.box-body -->
			<div class="box-footer">
				<a class="btn btn-success btn-flat btn-xs" >Details</a>
				<a class="btn btn-danger btn-flat btn-xs" id="request_knowledge" onclick="send_request(' . $knowledge->knowledge_id .')" data-toggle="confirmation" data-placement="right" data-btn-ok-label="Yes!" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="Stop!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger">Request</a>

        <div class="btn-group btn-xs ">
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


        <div class="btn btn-flat btn-xs" id="rating_message_'. $knowledge->knowledge_id . '">
            Your Rating: ' . $rating_message . '
        </div>
        <div class="btn btn-flat btn-xs" style="width: 150px;">   
            <input type="text" value="" id="rating_'. $knowledge->knowledge_id . ' " class="slider" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="'. $rating_for_knowledge .'" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-id="blue">
        </div>
        <div class="btn btn-primary btn-flat btn-xs" onclick="submit_rating('. $knowledge->knowledge_id .' )">
            <i class="fa fa-check"></i>
        </div>


        <div class="pull-right">
            Rating: ' . $knowledge->rating . '
            <div class="progress sm progress-striped active" style="width: 100px;">
                <div class="progress-bar progress-bar-' . $match_color_rating . '" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:' .$knowledge->rating * 10 . '%">
                    <span class="sr-only">20% Complete</span>
                </div>
            </div>
        </div>

        <div class="pull-right">
            Sharing: ' . $knowledge->count . '
            <div class="progress sm progress-striped active" style="width: 100px;">
                <div class="progress-bar progress-bar-' . $match_color_relativity . '" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:' .$knowledge->count * 10 . '%">
                    <span class="sr-only">20% Complete</span>
                </div>
            </div>
        </div>
			</div><!-- /.box-footer-->
		</div><!-- /.box -->
		';
	}
	?>
	<p><?php echo $link1; ?></p>
</div>

<!-- for update use -->
<input type="hidden" id="selected_value_<?php echo $changing; ?>"  value="<?php echo $selected; ?>" />



<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation();
$('[data-toggle=confirmation-singleton]').confirmation({ singleton:true });
$('[data-toggle=confirmation-popout]').confirmation({ popout: true });
$('[data-toggle=confirmation]').on('confirmed.bs.confirmation', function () {
    knowledge_id = $('#requested_knowledge_id').val();
    $.ajax({
      url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/check_requested_knowledge_exists/" + knowledge_id, //this is the submit URL
      type: 'POST', //or POST
      success: function(data){
        if(data == 1){
          $('#confirm_request_knowledge_button').click();
        }
        else{
          confirmed_request();
        }
      }
  });
});


$('.slider').slider({
    formatter: function(value) {
        return  value;
    }
});

$(".slider").on("slide", function(slideEvt) {
    $("#slider_value").val(slideEvt.value);
});

function submit_rating(knowledge_id){

    rating_field = "rating_" + knowledge_id;
    rating = $('#slider_value').val();
    data = { 'knowledge_id': knowledge_id , 'rating': rating};

    rating_message_field = "rating_message_" + knowledge_id;

    $.ajax({
        url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/submit_rating/", //this is the submit URL
        type: 'POST', //or POST
        data:data,
        success: function(data){
            alertify.success("Rating done!");
            $('#slider_value').val();
            document.getElementById(rating_message_field).innerHTML = "Your Rating: ";
        }
    });
    
}

</script>