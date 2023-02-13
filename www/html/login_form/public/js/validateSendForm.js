jQuery(function ($){

    $("#submitFormLogin").click(function (event) {

        let form = $('#login_form');
        let msg = form.serialize();

        let email = $('#loginEmail');
        let password = $('#loginPassword');

        $(".error_info_form").remove();

        if (email.val().length < 1) {
            email.after('<span class="error_info_form">This field is required</span>');
            return false;
        } else {
            let regEx = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            let validEmail = regEx.test(email.val());

            if (!validEmail) {
                email.after('<span class="error_info_form">Enter a valid email</span>');
                return false;
            }
        }
        if (password.val().length < 1) {
            password.after('<span class="error_info_form">This field is required</span>');
            return false;
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://' + window.location.hostname + '/loginUser',
            data: msg,
            success: function (data) {
                if (data.status === 401) {
                    $(".textInfoModal").remove();
                    $('#ModalBody').append('<strong class="error_info_form">' + data.messages + '</strong>')
                    $('#Modal').modal('show');
                } else {
                    window.location.href = data.locationPage
                }
            },
            error: function (logError) {
                $(".textInfoModal").remove();
                $('#ModalBody').append('<strong  class="error_info_form">An error has occurred, please try again later</strong>')
                $('#Modal').modal('show');
            }
        });
    })

    $("#submitFormRegistration").click(function (event) {

        let form = $('#registration_form');
        let msg = form.serialize();


        $(".error_info_form").remove();
        $("#messagesApi").remove();

        let alert = $('#alertErrorInformation');

        let firstName = $('#registrationFirstName');
        let lastName = $('#registrationLastName');
        let email = $('#registrationEmail');
        let password = $('#registrationPassword');
        let password_retry = $('#registrationPasswordRetry');



        if (firstName.val().length < 1) {
            firstName.after('<span class="error_info_form">This field is required</span>');
            return false;
        }

        if (lastName.val().length < 1) {
            alert.after('<span class="error_info_form">This field is required</span>');
            return false;
        }

        if (email.val().length < 1) {
            alert.after('<span class="error_info_form">This field is required</span>');
            return false;
        } else {
            let regEx = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            let validEmail = regEx.test(email.val());

            if (!validEmail) {
                alert.after('<span class="error_info_form">Enter a valid email</span>');
                return false;
            }
        }

        if (password.val().length < 1) {
            password.after('<span class="error_info_form">This field is required</span>');
            return false;
        }

        if (password_retry.val().length < 1) {
            password_retry.after('<span class="error_info_form">This field is required</span>');
            return false;
        }

        if(password.val() !== password_retry.val()){
            password_retry.after('<span class="error_info_form">Passwords do not match</span>');
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://' + window.location.hostname + '/registrationUser',
            data: msg,
            success: function (data) {
                if (data.status === 401) {
                    $('#alertMessage').after('<span class="messagesApi"> '+data.messages+'</span>')
                    alert.show()
                } else {
                    content()
                }
            },
            error: function (logError) {
                $('#alertMessage').after('<span class="messagesApi"> An error has occurred, please try again later</span>')
                alert.show()
            }
        });
    })

    function content (){
        $('#maimContentRegistration').remove()
        $("#maimBlockRegistration").append('<h3 class="display-4">User is successfully registered !</h3>' +
            '<p class="text-muted mb-4">Go to the user view page? </p>' +
            '<a href="afterLogin"><button type="button" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">User list page</button></a>')
    }



}) ;
