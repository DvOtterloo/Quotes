$(function () {
  
  $("#Person").keyup(function () {    
    var searchid = $(this).val();    
    var dataString = 'search=' + searchid;
    if (searchid !== '')
    {
      $.ajax({
        type: "POST",
        url: "http://localhost/Quotes/?page=getAllPersons",
        data: dataString,
        cache: false,
        success: function (html)
        {
          $("#result").html(html).show();
        }
      });
    }
    return false;
  });

  $("#result").on("click", function (e) {
    var $clicked = $(e.target);
    $("#Person").val($clicked.text());
  });
  
  $(document).on("click", function (e) {
    var $clicked = $(e.target);
    if (!$clicked.hasClass("search")) {
      $("#result").fadeOut();
    }
  });
  
  $('#searchid').click(function () {
    $("#Person").fadeIn();
  });
  
});
