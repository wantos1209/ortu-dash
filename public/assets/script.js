$(document).ready(function() {
    $('.buttonwheel').click(function() {
      var target = $(this).data('target');
      $('#' + target).css('display', 'flex');
    });
  
    $(document).click(function(event) {
      var target = $(event.target);
      if (!target.closest('.moodalspinwl').length && !target.closest('.buttonwheel').length) {
        $('.moodalspinwl').css('display', 'none');
      }
    });
  });