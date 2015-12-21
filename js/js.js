$(document).ready(function () {
  $('.add-quote .btn').on('click', function () {
    $('#AddQuoteModal').modal('show');
  });

  $('#AddQuoteModal').on('hidden.bs.modal', function () {
    $('[data-required]').removeClass('has-error');
    $('.error-message').remove();
    $('#Quote, #Tags, #Person').val("");
  });

});

