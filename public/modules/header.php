<header <?php if($subpage) echo('id="subpage"')?> >
  <div>
    <h1><?php echo ($text); ?></h1>
    <?php
    if (!$subpage) {
      echo ('<h2>
      Építőipari és kertészeti gépek bérbe adása és javítása
    </h2>
    <a href="./pricelist.php">
      <button>
        <p>Árlista</p>
        <p class="icon"><i class="fas fa-arrow-right"></i></p>
      </button>
    </a>');
    }
    ?>
  </div>
  <?php
    /*for($pictures = 5, $i = 1; $i <= $pictures; $i++) {
      echo('<div class="background" style="background-image: url(\'../images/background' . $i .'.webp\')"></div>');
    }*/
  ?>
</header>