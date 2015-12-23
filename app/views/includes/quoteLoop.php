<?php if (count($data['quotes']) > 0) : ?>
<ul class="list">
  <?php foreach ($data['quotes'] as $quote) : ?>          
    <li class="list-item">
      <a href="" data-quote-id="<?= $quote->getQuoteId(); ?>" class="delete-quote">X</a>
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
<?php else : ?>
<h1 class="error">Er zijn geen quotes gevonden</h1>
<?php endif;?>

