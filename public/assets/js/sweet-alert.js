
//  Delete Button Sweet Alert

$(function () {
  // Function to display the SweetAlert confirmation
  window.confirmDelete = function (id) {
    'use strict';

    // Trigger the SweetAlert2 confirmation
    Swal.fire({
      html: '<p class="custom-swal-title">Are you sure you want to delete ?</p>',
      icon: 'warning',
      iconColor: 'grey',
      showCancelButton: true,
      confirmButtonColor: '#286090', // Blue color for the 'Yes' button
      cancelButtonColor: 'red', // Red color for the 'No' button
      confirmButtonText: 'Yes',
      cancelButtonText: 'No',
      reverseButtons: true,
      customClass: {
        confirmButton: 'swal2-confirm-custom', // Custom class for confirm button
        cancelButton: 'swal2-cancel-custom' // Custom class for cancel button
      }
    }).then((result) => {
      if (result.isConfirmed) {
        // If confirmed, submit the form
        $('#delete-form-' + id).submit();
      }

    });
  };




});


