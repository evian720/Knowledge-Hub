    function initial_to_do_list(){
         //to do list
        $(".todo-list").sortable({
            placeholder: "sort-highlight",
            handle: ".handle",
            forcePlaceholderSize: true,
            zIndex: 999999
        }).disableSelection();
        ;

        //The todo list plugin
        $(".todo-list").todolist({
            onCheck: function(ele) {
                //console.log("The element has been checked")
                var to_do_id = $('input', this).parents("li").attr("name");
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_to_do_list_status/" + to_do_id, //this is the submit URL
                    type: 'POST', //or POST
                    success: function(data){
                        
                    }
                });
 
            },
            onUncheck: function(ele) {
                //console.log("The element has been unchecked")
                var to_do_id = $('input', this).parents("li").attr("name");
                $.ajax({
                    url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_to_do_list_status/" + to_do_id, //this is the submit URL
                    type: 'POST', //or POST
                    success: function(data){
                        
                    }
                });
            }
        });   
    }


    $(document).ready(function(){
        initial_to_do_list();
    });

    //The Calender
    $("#calendar").datepicker();


    //callback handler for form submit
    $("#to_do_creation_form").submit(function(e)
    {
        var postData = $(this).serializeArray();
        var formURL = "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/create_to_do_list/";
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data){
                $('#close_create_to_do_form').click();
                update_to_do_list();
            }
        });
        e.preventDefault(); //STOP default action
    });

    function update_to_do_list(){
        $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/update_to_do_list/", //this is the submit URL
            type: 'POST', //or POST
            success: function(data){
                $('#to_do_list_area').html(data);
                initial_to_do_list();
            }
        });
    }

    function delete_to_do(to_do_list_id){
        $.ajax({
            url: "http://101.78.175.101:8580/fyp/knowledge_hub/index.php/main/delete_to_do_list/" + to_do_list_id, //this is the submit URL
            type: 'POST', //or POST
            success: function(data){
                update_to_do_list();
                initial_to_do_list();
            }
        });
    }

    function update_status(){
        alert("hahaha");
    }