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
    <div class="search-div">
      <input type="text" class="search" id="search" placeholder="Keresés..." <?php if(isset($_GET['lookingFor']) && $_GET['lookingFor'] != '') {echo('value="' . htmlspecialchars($_GET['lookingFor']) . '"');} ?> />
      <img src="./images/search.png" alt="search" onclick="search()" id="search-img" />
      <img src="./images/search.png" alt="open-search-bar" id="open-img" />
      <img src="./images/close.png" alt="close-search-bar" style="height: 47.5%; display: none" id="close-img" />
</div>
  </div>
</nav>