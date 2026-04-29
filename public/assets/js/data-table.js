$(function () {
  'use strict';

  var table = $('#dataTableExample').DataTable({
    "aLengthMenu": [
      [10, 30, 50, -1],
      [10, 30, 50, "All"]
    ],
    "iDisplayLength": 10,
    "language": {
      search: "",
      lengthMenu: "Show _MENU_ Records",
      info: "Showing _START_ - _END_ of _TOTAL_ Records",
      paginate: {
        previous: "<",
        next: ">"
      }
    },
    initComplete: function () {
      // Move length menu to custom div
      $('#dataTableExample_length').append($('.dataTables_length').find('label'));

      // Move search input to custom div
      $('#dataTableExample_filter').append($('.dataTables_filter').find('input'));

      $('#dataTableExample_filter input')
        .attr('placeholder', 'Search')
        .removeClass('form-control-sm')
        .addClass('form-control p-1 w-auto')
        .css({
          'border': '1px solid black',
          'max-width': '200px',
          'height': '25px',
          'line-height': '1.2',
        });
        
      // Style length dropdown
      $('#dataTableExample_length select')
        .removeClass('form-control-sm')
        .addClass('form-select form-select-sm w-auto')
        .css({
          'border': '1px solid black',
          'height': '25px',
          'width': '140px',
          'line-height': '25px', // Match the height for vertical centering
          'padding-top': '0px',
          'padding-bottom': '0px'
        });
    }
  });
});
