
</div> 

<div class="modal fade " id="RemoveQuoteModal" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body form">
        <h1>De Quote verwijderen?!</h1>
        <form action="<?= URL ?>?page=removeQuote" method="post">
          <input id="QuoteIdField" type="hidden" name="quoteId" value=""/>
          <button class="btn">Quote verwijderen</button>
        </form>        
      </div>
    </div>
  </div>
</div>

<!-- HTML NEEDED FOR THE IMPORTANT MESSAGE MODAL POPUP -->
<div class="modal fade " id="AddQuoteModal" tabindex="-1" role="dialog" aria-labelledby="important-msg-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body form">
        <form action="<?= URL ?>?page=addQuote" method="post">
          <div data-required data-error-message="Maak een Quote">
            <label for="Quote">Quote</label>
            <textarea id="Quote" name="quote"></textarea>
          </div>
          <div>
            <label for="Tags">Tags</label>
            <input type="text" id="Tags" name="tags"/>
          </div>
          <div>
            <label for="Person">Gemaakt door</label>
            <input type="text" id="Person" name="person"/>
            <div id="result"></div>
          </div>              
          <input type="submit" class="btn" />
        </form>
      </div>
    </div>
  </div>
</div>
<!-- / HTML NEEDED FOR THE IMPORTANT MESSAGE MODAL POPUP -->

<!-- JAVASCRIPT -->
<script type="text/javascript" src="<?= URL ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= URL ?>js/modal.min.js"></script>
<script type="text/javascript" src="<?= URL ?>js/validation.js"></script>
<script type="text/javascript" src="<?= URL ?>js/js.js"></script>
<script type="text/javascript" src="<?= URL ?>js/ajax.js"></script>
<!-- / JAVASCRIPT -->

</body>
</html>