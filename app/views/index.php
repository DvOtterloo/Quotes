<?php require("app/views/includes/header.php"); ?>
<div class="header">
  <div class="search form">
    <form action="<?= URL ?>search" method="post">
      <input type="text" placeholder="zoek..." name="search"/>
      <input type="submit" style="position: absolute; left: -9999px"/>
    </form>
  </div>
  <div class="add-quote"><button class="btn">+</button></div>
  <div class="clear"></div>
</div>
<?php require("app/views/includes/quoteLoop.php"); ?>
<?php require("app/views/includes/footer.php"); ?>