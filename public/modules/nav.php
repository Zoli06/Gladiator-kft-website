<nav>
  <div>
    <a href="./index.php" class="default <?php if($active == 0) {echo('active');} ?>">
      <p>Kezdőlap</p>
    </a>
    <a href="./renting.php" <?php if($active == 1) {echo('class="active"');} ?>>
      <p>Kölcsönzés</p>
    </a>
    <a href="./pricelist.php" <?php if($active == 2) {echo('class="active"');} ?>>
      <p>Árlista</p>
    </a>
    <a href="./map.php" <?php if($active == 3) {echo('class="active"');} ?>>
      <p>Térkép</p>
    </a>
    <a href="./contact.php" <?php if($active == 4) {echo('class="active"');} ?>>
      <p>Kapcsolat</p>
    </a>
  </div>
</nav>