/**
 * @todo Make a Select validator
 */

$(document).on('ready', function () {


  /**
   * 
   * Fields with the data-required attribute can not be empty
   */
  
  $("form").on("submit", function (e) {

    
    var numberOfInvalidFields = 0,
      errorMessage = "Je moet dit veld invullen";


    $("[data-required]", this).each(function () {
      
      var $parentOfInput = $(this),
        isValid = true,
        inputType;


      /**
       * 
       * Delete active error messages
       */
      $(".error-message", $parentOfInput).remove();
      $($parentOfInput).removeClass("has-error");


      /**
       * 
       * Determines what type of element must be validated
       */
      if ($parentOfInput.find("input").not("[type=hidden]").length !== 0) {

        $input = $parentOfInput.find("input").not("[type=hidden]");

        if ($input.attr("type") === "text" || $input.attr("type") === "password" || $input.attr("type") === "email" || $input.attr("type") === "tel") {
          inputType = "text";
        }

        if ($input.attr("type") === "checkbox") {
          inputType = "checkbox";
        }

        if ($input.attr("type") === "radio") {
          inputType = "radio";
        }

      }


      if ($parentOfInput.find("textarea").length !== 0) {

        $input = $parentOfInput.find("textarea");

        inputType = "text";

      }


      if ($parentOfInput.find("select").length !== 0) {

        $input = $parentOfInput.find("select");

        inputType = "select";

      }


      /**
       * 
       * Checks if the input is valid
       */

      if (inputType === "text") {
        if ($input.val() === "") {
          isValid = false;
        }
      }

      if (inputType === "checkbox") {
        if (!$input.prop('checked')) {
          isValid = false;
        }
      }

      if (inputType === "radio") {
        var checked;

        $input.each(function () {
          if ($(this).is(':checked')) {
            checked = true;
          }
        });

        if (!checked) {
          isValid = false;
        }
      }

      if (inputType === "select") {
        if ($("option:selected", $input).attr("data-invalid-value") === "") {
          isValid = false;
        }
      }




      /**
       * 
       * Gives user feedback
       */

      if (!isValid) {

        var $error = $(document.createElement("div"));

        $error.addClass("error-message");

        if ($parentOfInput.attr("data-error-message") !== "") {
          $error.append($parentOfInput.attr("data-error-message"));
        }

        else {
          $error.innerHTML(errorMessage);
        }

        $parentOfInput.append($error);
        $parentOfInput.addClass("has-error");

        numberOfInvalidFields++;

      }

    });


    if (numberOfInvalidFields !== 0) {
      e.preventDefault();
    }
        
  });

});



