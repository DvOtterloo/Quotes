<!DOCTYPE html>
<html>
  <head>
    
    <!-- SEO -->
    <title><?= $data["seo"]["title"] ?></title>
    <meta name="description" content="<?= $data["seo"]["description"] ?>"/>
    <!-- / SEO-->
    
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="<?= URL ?>css/reset.css">
    <link rel="stylesheet" href="<?= URL ?>css/style.css">
    <link rel="stylesheet" href="<?= URL ?>css/modal.min.css">
    <!-- / STYLESHEETS -->
    
  </head>
  <body>

    <div class="container">
      <div class="header">
        <div class="search form"><input type="text" placeholder="zoek..."/></div>
        <div class="add-quote"><button class="btn">+</button></div>
        <div class="clear"></div>
      </div>
      <ul class="list">
        <?php foreach ($data['quotes'] as $quote) : ?>          
          <li class="list-item">
            <div class="quote">"<?= $quote->getQuote(); ?>"</div>
            <div class="person"> - <?= $quote->getPerson()->getName(); ?></div>
            <div class="tags">
              <?php foreach ($quote->getTags() as $tag) : ?>
                <span class="tag">#<?= $tag->getTag(); ?></span>
              <?php endforeach; ?>
            </div>
            <div class="clear"></div>
          </li>           
        <?php endforeach; ?>
      </ul>
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
              <div data-required data-error-message="Hallo Tags?">
                <label for="Tags">Tags</label>
                <input type="text" id="Tags" name="tags"/>
              </div>
              <div data-required data-error-message="Wie heeft dit gezegd?">
                <label for="Person">Gemaakt door</label>
                <input type="text" id="Person" name="person"/>
                <div id="result">
                  
                </div>
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