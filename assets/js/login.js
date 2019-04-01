
$(document).ready(function() {
    /*
    $("#email_div").hide();
    $("#password_div").hide();

    $("#admin_login").click(function(){
        $("#admin_login").hide();
        $("#email_div").show();
        $("#password_div").show();
      });
      */
    
    $('input.test').on('change', function() {
        $('input.test').not(this).prop('checked', false);  
    });

    "use strict";

    /*==================================================================
    [ Focus Contact ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate1(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate1(input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    // Validate To Server : 

    $('#loginForm').validate({
        
        submitHandler: function(form) {
        
            var data=$("#loginForm").serialize();
            $.ajax({
                type :'POST',
                url  : 'assets/php/login.php',
                data : data,
                beforeSend: function(){ 
                    $("#error").fadeOut();
                    $("#submitButton").html('<i class="fas fa-spinner fa-pulse"></i> &nbsp; Envoi...');
                    
                },
                success : function(response){ 
                    //alert(response);

                    if(response==1){

                        location.replace("admin.php");

                    } 
                    
                    if(response==0){
                        $("#submitButton").html('Connectez-vous');

                    } 

                    if(response==2){
                        alert("coucou simo agent");
                    }
                    
                    else {                                    
                        $("#error").fadeIn(1000, function(){                        
                            $("#error").html('<div class="alert alert-danger"> &nbsp; &nbsp; <span class="glyphicon glyphicon-info-sign"></span> &nbsp; &nbsp; '+response+' !</div>');
                            $("#submitButton").html('Connectez-vous');
                            
                        });
                    }
                }

            });

            return false;
        }
    });
/*
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        
        linkElement: '.animsition-link',
        // e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
        loading: true,
        loadingParentElement: 'body', //animsition wrapper element
        loadingClass: 'animsition-loading',
        unSupportCss: [
          'animation-duration',
          '-webkit-animation-duration',
          '-o-animation-duration'
        ],
        //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'body'
      });
*/
    
});