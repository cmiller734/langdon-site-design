$(document).ready(function(){
    $("#submit-btn").click(function(){
        
        //get input field values
        var user_name = $('input[name=name]').val();
        var user_phone = $('input[name=phone]').val();
        var user_email = $('input[name=email]').val();
        var user_company = $('input[name=company]').val();
        var user_message = $('textarea[name=message]').val();
        
        //simple validation at client's end
        //we simply change border color to red if empty field using .css()
        var proceed = true;
        if (user_name == "") {
            $('input[name=name]').css('border-color', '#e41919');
            proceed = false;
        }
        if (user_phone == "") {
            $('input[name=phone]').css('border-color', '#e41919');
            proceed = false;
        }
        if (user_email == "") {
            $('input[name=email]').css('border-color', '#e41919');
            proceed = false;
        }
        if (user_company == "") {
            $('input[name=email]').css('border-color', '#e41919');
            proceed = false;
        }
        if (user_message == "") {
            $('textarea[name=message]').css('border-color', '#e41919');
            proceed = false;
        }
        
        //everything looks good! proceed...
        if (proceed) {

            //data to be sent to server
            var post_data = {
                'userName': user_name,
                'userPhone': user_phone,
                'userEmail': user_email,
                'userCompany': user_company,
                'userMessage': user_message
            };
            
            //Ajax post data to server
            $.post('./php/contact.php', post_data, function(response){
                
               // load json data from server and output message     
                if (response.includes('Error')) { //fix this - this isn't the best way to do it. For now, any error
                                                    //messages your PHP throws will need to include "error" in the output text ($output)
                    output = '<h6 class="error">' + response + '</h6>';
                }
                else {
                    output = '<h6 class="success">' + response + '</h6>';
                    
                    //reset values in all input fields
                    $('#contact-form input').val('');
                    $('#contact-form textarea').val('');
                }
                
                $("#result").hide().html(output).slideDown();
            });
        }
        return false;
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form input, #contact_form textarea").keyup(function(){
        $("#contact_form input, #contact_form textarea").css('border-color', '');
        $("#result").slideUp();
    });
    
});
