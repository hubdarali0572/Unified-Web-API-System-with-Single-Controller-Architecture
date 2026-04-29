// npm package: jquery-validation
// github link: https://github.com/jquery-validation/jquery-validation

$(function() {
  'use strict';

  $(function() {
    $("#studentForm").validate({
      rules: {
        first_name: {
          required: true
        },
        last_name: {
          required: true
        },
        religion: {
          required: true
        },
        father_name: {
          required: true
        },
        mother_name: {
          required: true
        },
        joining_date: {
          required: true
        },
        short_bio: {
          required: true
        },
        class_id: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        section: {
          required: true
        },
        roll_no: {
          required: true
        },
        address: {
          required: true
        },
        date_of_birth: {
          required: true
        },
        phone: {
          required: true
          
        },
        gender: {
          required: true
        },
        fee: {
          required: true
        },
      },
      messages: {
        email: "Please enter a valid email address",
       
        class_id: "Please select class",
        first_name: "Please enter first name",
        last_name: "Please enter last name",
        religion: "Please enter religion",
        father_name: "Please enter father name",
        mother_name: "Please enter mother name",
        joining_date: "Please enter joining date",
        date_of_birth: "Please enter date of birth",
        fee: "Please enter fee amount",
        short_bio: "Please enter short bio",
        roll_no: "Please enter roll number",
        section: "Please enter section",
        parents: "Please enter parents name",
        address: "Please enter address",
        phone: "Please enter a valid phone number",
        gender: "Please select your gender",

        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        },
        confirm_password: {
          required: "Please confirm your password",
          minlength: "Your password must be at least 5 characters long",
          equalTo: "Please enter the same password as above"
        },
        terms_agree: "Please agree to terms and conditions"
      },
      errorPlacement: function(error, element) {
        error.addClass( "invalid-feedback" );

        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        }
        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
          error.insertAfter(element.parent().parent());
        }
        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.appendTo(element.parent().parent());
        }
        else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        }
      },
      unhighlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
      }
    });
  });
});