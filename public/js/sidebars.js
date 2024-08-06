/* global bootstrap: false */
(function () {
  'use strict'
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })
})()

$(document).ready(function () {
  $('#loader').hide();

  $(document).on('click', '#close_side_bar', function (e) {
    e.preventDefault();

    var toggleStatus = $(this).attr('toggle');

    toggleSideBar(toggleStatus);

  });

  function toggleSideBar(toggleStatus = null) {
    if (toggleStatus === 'open') {
      $('ul#side-bar-full').hide();
      $('ul#side-bar-half').show();

      $('#side-bar').css({
        width: '76px'
      });
      $('#content').css({
        'margin-left': '76px'
      });

      $('#close_side_bar_wrapper').removeClass('text-right').addClass('text-center');

      $('#close_side_bar').attr('toggle', 'close');
    } else {
      $('ul#side-bar-half').hide();
      $('ul#side-bar-full').show();

      $('#side-bar').css({
        width: '250px'
      });
      $('#content').css({
        'margin-left': '250px'
      });

      $('#close_side_bar_wrapper').removeClass('text-center').addClass('text-right');

      $('#close_side_bar').attr('toggle', 'open');
    }
  }
});
