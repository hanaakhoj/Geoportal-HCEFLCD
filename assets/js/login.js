
$(document).ready(function() {
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
                    $("#sumbitButton").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Envoi...');
                    
                },
                success : function(response){ 

                    if(response==1){

                        //location.replace("../index.php");
                        alert ("hello hanoua")

                    
                    } 
                    
                    if(response==0){
                        alert(0);
                    } 
                    
                    else {                                    
                        $("#error").fadeIn(1000, function(){                        
                            $("#error").html('<div class="alert alert-danger"> &nbsp; &nbsp; <span class="glyphicon glyphicon-info-sign"></span> &nbsp; &nbsp; '+response+' !</div>');
                            $("#sumbitButton").html('Se connecter');
                            
                        });
                    }
                }

            });

            return false;
        }
    });
    
});