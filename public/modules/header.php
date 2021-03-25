<header <?php if($subpage) echo('class="subpage"')?> >
  <div>
    <h1><?php echo ($text); ?></h1>
    <?php
    if (!$subpage) {
      echo ('<p>
      Köszöntjük weboldalunkon!
    </p>
    <a href="./pricelist.php">
      <button>
        <p>Árlista</p>
        <p class="icon"><i class="fas fa-arrow-right"></i></p>
      </button>
    </a>');
    }
    ?>
  </div>
  <!--<div class="background" style="background-image: url('../images/background2.jpg')"></div>-->
  <?php
    /*for($pictures = 6, $i = 1; $i <= $pictures; $i++) {
      echo('<div class="background" style="background-image: url(\'../images/background' . $i .'.webp\')"></div>');
    }*/
  ?>
</header>