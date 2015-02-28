// request knowledge
function send_request(knowledge_id){
    $('#requested_knowledge_id').val(knowledge_id);
}

function confirmed_request(){
    knowledge_id = $('#requested_knowledge_id').val();
    $.ajax({
url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/request_knowledge/" + knowledge_id, //this is the submit URL
type: 'POST', //or POST
success: function(){
    alertify.success("Request Sent!");
}
});
}

alertify.set({ delay: 2500 });

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