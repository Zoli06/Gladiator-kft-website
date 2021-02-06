<header>
  <div>
    <h1><?php echo ($text); ?></h1>
    <?php
    if (!$subpage) {
      echo ('<p>
      Itt mindent megtalálsz: gépkölcsönzés, valamint javítás <br />pénztárcabarát
      áron.
    </p>
    <a href="./index.php">
      <button>
        <p>Árlista</p>
        <p class="icon"><i class="fas fa-arrow-right"></i></p>
      </button>
    </a>');
    }
    ?>
  </div>
</header>