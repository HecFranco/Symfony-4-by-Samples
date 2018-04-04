$(document).ready(function(){
    /* Inputs ******************************************************************************************/
        var submit_buttom = document.getElementById('user_submit');
        var user_username = document.getElementById('user_username');
        var user_email = document.getElementById('user_email');        
        var plainPassword_first = document.getElementById('user_plainPassword_first');
        var plainPassword_second = document.getElementById('user_plainPassword_second');   
    /***************************************************************************************************/
    /* messages ****************************************************************************************/    
        var message = document.getElementById("message");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
    /***************************************************************************************************/  
    /* messages ****************************************************************************************/    
        var tab_configuration = document.getElementById("tab_configuration");
        var tab_registration = document.getElementById("tab_registration");
        var card_configuration = document.getElementById("card_configuration");
        var card_registration = document.getElementById("card_registration");
        var form_configuration = document.getElementById("form_configuration");
        var form_registration = document.getElementById("form_registration");
        var anchor_configuration = document.getElementById("anchor_configuration");
        var anchor_registration = document.getElementById("anchor_registration");

        var progress_bar = document.getElementsByClassName("progress-bar");
    /***************************************************************************************************/              
    // Listen for click events
    document.addEventListener('click', function (event) {
        // If the clicked element isn't our show password checkbox, bail
        if (event.target.id == 'show_password'){
            console.log('input '+event.target.id+' click detected');
            // Get the password field
            var password = document.getElementById('user_plainPassword_first');
            var confirm_password = document.getElementById('user_plainPassword_second');
            if (!password) return;
            // Check if the password should be shown or hidden
            if (event.target.checked) {
                // Show the password
                password.type = 'text';
                confirm_password.type = 'text';
            } else {
                // Hide the password
                password.type = 'password';
                confirm_password.type = 'password';
            }            
        }
        if( event.target == anchor_registration || event.target == anchor_configuration || event.target.parentNode == anchor_configuration ){
            console.log('first_user_change_form');
            tab_configuration.classList.toggle('active');
            tab_configuration.classList.toggle('show');
            tab_registration.classList.toggle('active');
            tab_registration.classList.toggle('show'); 
            card_configuration.classList.toggle('d-none');
            card_registration.classList.toggle('d-none'); 
            form_configuration.classList.toggle('active');
            form_registration.classList.toggle('active');
            form_configuration.classList.toggle('show');
            form_registration.classList.toggle('show');
            if(progress_bar[0].style.width == '50%'){
                progress_bar[0].style.width = '100%';
            }else{
                progress_bar[0].style.width = '50%'; 
            }
        }
    }, false);      

    window.addEventListener('keyup',function (event) {
        // If the clicked element isn't our show password checkbox, bail
        if (event.target.id === 'user_username'){
            console.log('input '+event.target.id+' keyup detected');
            searchRequest = $.ajax({
                type: 'POST',			            // Shipping method
                url: '/user-nick-exist',		    // Controller Url
                data:{
                    'username' : event.target.value // variable that we will send
                },		
                dataType:'json',
                success: function(response){
                    if(response != null){
                        console.log('user already exist');
                        user_username.style.borderColor = 'red';
                        submit_buttom.setAttribute('disabled','');
                    }else{
                        console.log('user already exist');
                        user_username.style.borderColor = '#ced4da';
                        submit_buttom.removeAttribute('disabled');
                    }
                }
            });
        }
        if (event.target.id === 'user_email'){
            console.log('input '+event.target.id+' keyup detected');
            searchRequest = $.ajax({
                type: 'POST',			            // Shipping method
                url: '/user-email-exist',		    // Controller Url
                data:{
                    'email' : event.target.value // variable that we will send
                },		
                dataType:"json",
                success: function(response){
                    if(response != null){
                        console.log('email already exist');
                        submit_buttom.setAttribute('disabled','');
                        user_email.style.borderColor = 'red';
                    }else{
                        console.log('email does not exist');
                        submit_buttom.removeAttribute('disabled');
                        user_email.style.borderColor = '#ced4da';
                    }
                }
            });
        }
        if (event.target.id === 'user_plainPassword_first' || event.target.id === 'user_plainPassword_second'){
            console.log('input '+event.target.id+' keyup detected');

            if(plainPassword_first.value != plainPassword_second.value){
                console.log('different password');
                submit_buttom.setAttribute('disabled','');
                plainPassword_first.style.borderColor = 'red';
                plainPassword_second.style.borderColor = 'red';
            }else if(plainPassword_first.value === plainPassword_second.value){
                console.log('same password');
                submit_buttom.removeAttribute('disabled');
                plainPassword_first.style.borderColor = '#ced4da';
                plainPassword_second.style.borderColor = '#ced4da';
            }
        }
    }, false);
    window.addEventListener('focus',function (event) {
        // When the user clicks on the password field, show the message box
        if (event.target.id === 'user_plainPassword_first' ){
            console.log('condition password view');
            message.classList.remove('d-none');
        }        
    }, true);
    window.addEventListener('blur',function (event) {
        // When the user clicks outside of the password field, hide the message box
        if (event.target.id === 'user_plainPassword_first' ){
            console.log('condition password hidden');
            message.classList.remove('d-none');
        }        
    }, true);
    window.addEventListener('keyup',function (event) {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(plainPassword_first.value.match(lowerCaseLetters)) { 
            letter.classList.replace('invalid', 'valid');
            letter.firstElementChild.classList.replace('fa-times', 'fa-check');
        } else {
            letter.classList.replace('valid', 'invalid');
            letter.firstElementChild.classList.replace('fa-check', 'fa-times');
        }
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(plainPassword_first.value.match(upperCaseLetters)) {
            capital.classList.replace('invalid', 'valid');            
            capital.firstElementChild.classList.replace('fa-times', 'fa-check');
        } else {
            capital.classList.replace('valid', 'invalid');             
            capital.firstElementChild.classList.replace('fa-check', 'fa-times');
        }
        // Validate numbers
        var numbers = /[0-9]/g;
        if(plainPassword_first.value.match(numbers)) { 
            number.classList.replace('invalid', 'valid');             
            number.firstElementChild.classList.replace('fa-times', 'fa-check');
        } else {
            number.classList.replace('valid', 'invalid');            
            number.firstElementChild.classList.replace('fa-check', 'fa-times');
        }
        // Validate length
        if(plainPassword_first.value.length >= 8) {
            length.classList.replace('invalid', 'valid');             
            length.firstElementChild.classList.replace('fa-times', 'fa-check');
        } else {
            length.classList.replace('valid', 'invalid');             
            length.firstElementChild.classList.replace('fa-check', 'fa-times');
        }
    }, false);            
});