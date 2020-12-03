$(document).ready(function(){

//##### FOOTER DATE 
    let date = new Date();
    let year = date.getFullYear();
    $('#year').html(year);



//##### HANDLE TODO POST REQUEST
   $(document).on("submit", "#todoForm", function (event) {
        event.preventDefault();

        // INIALIZE NOTIFICATION VARIABLES
        let message, messageType ;

        // RESET FORM
        resetForm();
        
        var title = $('#title').val();
        var li = $('.todo-list-item');
        var todo_order_no = li.length;
        

        // VALIDATION
        if (title.length == 0) {

            // SEND NOTIFICATION MESSAGE
            message = 'Please fill out this field';
            messageType = 'error';
            noficationMessage(message, messageType);

            return false;
        }
        else {
            var data = {
                'save':  1, 
                'title': title,
                'todo_order_no': todo_order_no
            };

            var type = 'POST';
            // SERVER REQUEST FUNCTION
            handleFormAjaxRequest(data, type);

            return true;
        }
    });


//##### HANDLE DELETE TODO REQUEST 
   $(document).on('click', '.delete', function(){

    // GET LIST ITEM ID
        var id = $(this).data('id');
        var clicked_btn_id = $(this);

    // STRUCTURE DATA AND POST TYPE
        var  type = 'GET';
        var  data = {
            'delete':  1, 
            'id': id
        };
            
        // SERVER REQUEST FUNCTION
        handleFormAjaxRequest(data, type, clicked_btn_id);
    });


//##### HANDLE DRAG AND DROP 
    $("#todo-list").sortable({      
        update: function( event, ui ) {
            updateOrder();
        }
    });

});


//###### HANDLE FORM AJAX REQUEST
const handleFormAjaxRequest = (data, type, id) => {

    // INIALIZE NOTIFICATION VARIABLES
    let message, messageType ;

    // MAKE AJAX REQUEST TO SERVER
    $.ajax({
     url: './server/form-server.php',
     type: type,
     data: data,
     success: function(response){
        
        // CHECK POST TYPE AND DISPLAY CORRESPONDING MESSAGES / REMOVE LIST ITEM 
        if (type == "POST") {

            // NOTIFICATION MESSAGE
            message = 'Todo added successfully!!!';
            messageType = 'success';


            // APPEND RESULT
            $('.todo-list').append(response);
        } else {

            // NOTIFICATION MESSAGE
            message = 'Todo deleted successfully!!!';
            messageType = 'success';

            // REMOVE DELETED TODO
            id.parent().remove();
        }

        // SEND NOTIFICATION MESSAGE
        noficationMessage(message, messageType);

        // CLEAR INPUT
        $('#title').val('');
     }
   });
}


//#### HANDLE NOTIFICATION MESSAGE
const noficationMessage = (message, messageType) => {

    // EMBED MESSAGE
    $('.form-message').removeClass('hide');
    $('.form-message').addClass(messageType);
    $('.form-message-title').text(message);

    // RESET FORM
    resetForm();
}


//##### RESET FORM
const resetForm = () => {
    setTimeout(() => {
        $('.form-message').addClass('hide');
        $('.form-message').removeClass('error');
        $('.form-message').removeClass('success');
        $('.form-message').removeClass('updated');
        $('.form-message-title').text('');
    }, 2000);
}


//##### DRAG AND DROP FUNCTION TO UPDATE TODO ORDER NO
function updateOrder() {    

    // INITIALIZE NOTIFICATION VARIABLES
    var message, messageType;

    // INITIALIZE ORDER ARRAY AND PUSH CORRESPONDING ID NO
    var item_order = new Array();
    $('.todo-list-item').each(function() {
        item_order.push($(this).attr("data-todo-id"));
    });

    // STRUCTURE ORDER NO DATA
    var order_string = 'order='+item_order;

    // MAKE AJAX REQUEST TO SERVER
    $.ajax({
        type: "GET",
        url: "./server/form-server.php",
        data: order_string,
        cache: false,
        success: function(data){  

        // NOTIFICATION MESSAGE
          message = 'Todo Order Updated!!!';
          messageType = 'updated'; 
          noficationMessage(message, messageType);

        }
    });
}

