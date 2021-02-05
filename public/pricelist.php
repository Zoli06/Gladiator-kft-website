<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/subpages.css" />
  <link rel="stylesheet" href="./css/pricelist.css" />
  <script src="./js/jquery.quickfit.js"></script>
  <script src="./js/app.js"></script>
  <script src="./js/pricelist.js"></script>
  <title>Gladiátor Team Kft.</title>
</head>

<body>
  <nav>
    <div>
      <a href="./index.php" class="default">
        <p>Kezdőlap</p>
      </a>
      <a href="./renting.php">
        <p>Kölcsönzés</p>
      </a>
      <a href="./pricelist.php" class="active">
        <p>Árlista</p>
      </a>
      <a href="./map.php">
        <p>Térkép</p>
      </a>
      <a href="./contact.php">
        <p>Kapcsolat</p>
      </a>
    </div>
  </nav>
  <header>
    <div>
      <h1>Árlista</h1>
    </div>
  </header>
  <section>
    <div class="hole-container">
      <div method="get" class="page-menu">
        <h2>Árak</h2>
        <div class="box">
          <?php
          $mainDir = getcwd() . '\goods';
          $directories = glob($mainDir . '\*', GLOB_ONLYDIR);
          $categories = str_replace($mainDir . '\\', '', $directories);
          if(in_array('Egyéb gépek', $categories)) { //move this value to last
            array_splice($categories, 1, 1);
            array_push($categories, 'Egyéb gépek');
          }
          $selected = '';

          function firstSelected($i)
          {
            $GLOBALS['selected'] = $GLOBALS['categories'][0];
            if ($i == 0) {
              return ' selected';
            } else {
              return '';
            }
          }

          function getSelected($i)
          {
            if (isset($_GET['category'])) {
              $category = htmlspecialchars($_GET['category']);
              if (in_array($category, $GLOBALS['categories'])) {
                $GLOBALS['selected'] = $category;
                if ($category == $GLOBALS['categories'][$i]) {
                  return ' selected';
                } else {
                  return '';
                }
              } else {
                return firstSelected($i);
              }
            } else {
              return firstSelected($i);
            }
          }

          for ($i = 0; $i != count($categories); $i++) {
            echo ('<p onclick="selectCategory(this)" class="description' . getSelected($i) . '">' . $categories[$i]);
          }

          ?>
        </div>
        </div>
      <div class="content">
        <h2><?php echo ($selected); ?></h2>
        <div class="goods-container">
          <?php
          $mainDir2 = $mainDir . '/' . $selected;
          $directories2 = glob($mainDir2 . '\*', GLOB_ONLYDIR);
          $goods = str_replace($mainDir2 . '\\', '', $directories2);
          
          function getLast($i, $goods) {
            if ((int) $i + 1 == count($goods)) {
              return 'last';
            } else {
              return '';
            }
          }

          for ($i = 0; $i != count($goods); $i++) {
            echo('<div class="box ' . getLast($i, $goods) . '">
            <h3>' . $goods[$i] . '</h3>
            <div class="img-container">
              <img src="' . './goods/' . $selected . '/' . $goods[$i] . '/image.png' . '" />
            </div>
            <p><span>' . file_get_contents($mainDir2 . "/" . $goods[$i] . "/price.txt") . '</span> ft/nap</p>
          </div>');
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <p>Copyright © 2020 All rights reserved | This website is made with ♥ by <a target="_blank" href="https://github.com/Zoli06">Zoli06</a></p>
    <p><a href="#">Terms of use</a> | <a href="#">Privacy Policy</a></p>
  </footer>
</body>

</html>