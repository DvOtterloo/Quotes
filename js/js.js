$(document).ready(function () {
  $('.add-quote .btn').on('click', function () {
    $('#AddQuoteModal').modal('show');
  });

  $('#AddQuoteModal').on('hidden.bs.modal', function () {
    $('[data-required]').removeClass('has-error');
    $('.error-message').remove();
    $('#Quote, #Tags, #Person').val("");
  });

  $('.delete-quote').on('click', function (e) {    
    var quoteId = $(this).attr('data-quote-id')
    console.log(quoteId);
    $("#QuoteIdField").val(quoteId);
    $('#RemoveQuoteModal').modal('show');    
    e.preventDefault();
  });
  
  $('.search').submit(function(e){    
    if($('[name=search]', this).val() == ''){
    e.preventDefault();
    return false;
  }
  });

});

