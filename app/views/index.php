<?php require("app/views/includes/header.php"); ?>
<div class="header">
  <div class="search form">
    <form class=search-form" action="<?= URL ?>?page=search" method="post">
      <input type="text" placeholder="zoek..." name="search" <?php if(isset($data['searchQuery'])):?>value="<?=$data['searchQuery']?>"<?php endif;?>/>
      <?php if(isset($data['searchQuery'])):?><a class="cancel-search" href="<?=URL?>">Terug</a><?php endif;?>
      <input type="submit" style="position: absolute; left: -9999px"/>
    </form>
  </div>
  <div class="add-quote"><button class="btn">+</button></div>
  <div class="clear"></div>
</div>
<?php require("app/views/includes/quoteLoop.php"); ?>
<?php require("app/views/includes/footer.php"); ?>