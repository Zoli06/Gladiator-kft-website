<?php include('./modules/network_header.php') ?>
<!DOCTYPE html>
<html lang="hu">

<?php
$mainDir = './goods';
$directories = glob($mainDir . '/*');
$directories = str_replace($mainDir . '/', '', $directories);
$categories = str_replace($mainDir . '/', '', $directories);
if (in_array('Egyéb gépek', $categories)) { //move this value to last
  array_splice($categories, 1, 1);
  array_push($categories, 'Egyéb gépek');
}
$selected = '';
$lookingFor = '';

function firstSelected($i)
{
  $GLOBALS['selected'] = $GLOBALS['categories'][0];
  if (isset($_GET['category']) && $_GET['category'] == 'search' && isset($_GET['lookingFor']) && $_GET['lookingFor'] != '') {
    $GLOBALS['selected'] = 'Keresés';
    $GLOBALS['lookingFor'] = $_GET['lookingFor'];
    return '';
  }
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

$subpage = true;
$title = 'Árlista';
for ($i = 0; $i != count($categories); $i++) {
  if (getSelected($i) == ' selected') {
    $title = $categories[$i] . ' | Gladiátor Gépkölcsönző';
  }
}
$extraCss = './css/pricelist.css';
include('./modules/head.php');
?>

<body>
  <?php
  $active = 2;
  include('./modules/nav.php');
  $text = 'Árlista';
  include('./modules/header.php');
  ?>
  <section>
    <div class="hole-container">
      <div class="page-menu">
        <div>
          <h2>Kategóriák</h2>
          <div class="box" itemscope itemtype="https://schema.org/BreadcrumbList">
            <?php

            for ($i = 0; $i != count($categories); $i++) {
              echo ('<p itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" onclick="selectCategory(this)" class="description' . getSelected($i) . '">
                        <meta itemprop="position" content="' . ($i + 1) . '" />
                        <meta itemprop="item" content="https://www.gladiator-gepkolcsonzo.hu/pricelist.php?category=' . $categories[$i] . '" />
                        <meta itemprop="name" content="' . $categories[$i] . '" />' .
                $categories[$i]);
            }

            ?>
          </div>
        </div>
      </div>
      <div class="content">
        <h2>
          <?php
          if ($selected == 'Keresés') {
            echo ($selected . ': ' . htmlspecialchars($lookingFor, ENT_QUOTES, 'UTF-8'));
          } else {
            echo ($selected);
          }
          ?>
        </h2>
        <div class="goods-container">
          <?php

          /*Search*/
          function search($searchword)
          {
            function getSubDirectories($dir)
            {
              $subDir = array();
              $directories = array_filter(glob($dir), 'is_dir');
              $subDir = array_merge($subDir, $directories);
              foreach ($directories as $directory) $subDir = array_merge($subDir, getSubDirectories($directory . '/*'));
              return $subDir;
            }

            function getLast($i, $goods)
            {
              if ((int) $i + 1 == count($goods)) {
                return 'last';
              } else {
                return '';
              }
            }

            $mainDir = $GLOBALS['mainDir'];
            $categoryDirs = glob($mainDir . '/*');
            $machineDirs = array();

            for ($i = 0; $i != count($categoryDirs); $i++) {
              $dirs = glob($categoryDirs[$i] . '/*');
              for ($i2 = 0; $i2 != count($dirs); $i2++) {
                array_push($machineDirs, $dirs[$i2]);
              }
            }

            $machines = array();

            for ($i = 0; $i != count($machineDirs); $i++) {
              array_push($machines, substr($machineDirs[$i], strrpos($machineDirs[$i], '/') + 1));
            }

            $matchesDirs = array();
            foreach ($machineDirs as $k => $v) {
              if (/*preg_match("/\b$searchword\b/i", substr($v, strrpos($v, '/') + 1)) */stripos(substr($v, strrpos($v, '/') + 1), $searchword) !== false) {
                $matchesDirs[$k] = $v;
              }
            }

            $matchesDirs = array_values($matchesDirs);

            if (!(empty($matchesDirs))) {
              for ($i = 0; $i != count($matchesDirs); $i++) {
                $machine = substr($matchesDirs[$i], strrpos($matchesDirs[$i], '/') + 1);
                $tempPath = str_replace("./goods/", "", $machineDirs[$i]);
                echo ('<div itemscope itemtype="http://schema.org/Product" class="box ' . getLast($i, $matchesDirs) . '">
                        <h3 itemprop="name">' . htmlspecialchars($machine) . '</h3>
                        <meta itemprop="url" content="https://www.gladiator-gepkolcsonzo.hu/pricelist.php?category=' . substr($tempPath, 0, strpos($tempPath, "/", strpos($tempPath, "/"))) . '&scroll=' . $machine . '"  />
                        <meta itemprop="image" content="https://www.gladiator-gepkolcsonzo.hu' . str_replace(".", "", $machineDirs[$i]) .  '/image.png' . '"  />
                        <div class="img-container">
                          <img alt="' . $machine . '" src="' . $matchesDirs[$i] .  '/image.png' . '" />
                        </div>
                        <p itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                          <meta itemprop="seller" contect="Gladiátor Team Kft." />
                          <meta itemprop="url" content="https://www.gladiator-gepkolcsonzo.hu/pricelist.php?category=' . substr($tempPath, 0, strpos($tempPath, "/", strpos($tempPath, "/"))) . '&scroll=' . $machine . '"  />
                          <meta itemprop="priceCurrency" content="HUF" />
                          <span itemprop="price">' . file_get_contents($matchesDirs[$i] . "/price.txt") . '</span> ft/nap
                        </p>
                      </div>');
              }
            } else {
              echo ('<h3>Nincs találat!</h3>');
            }
          }

          if ($selected == 'Keresés' && $lookingFor != '') {
            search($lookingFor);
          } else {
            $mainDir2 = $mainDir . '/' . $selected;
            $directories2 = glob($mainDir2 . '/*', GLOB_ONLYDIR);
            $goods = str_replace($mainDir2 . '/', '', $directories2);

            function getLast($i, $goods)
            {
              if ((int) $i + 1 == count($goods)) {
                return 'last';
              } else {
                return '';
              }
            }

            $mainDir = $GLOBALS['mainDir'];
            $categoryDirs = glob($mainDir . '/*');
            $machineDirs = array();

            for ($i = 0; $i != count($categoryDirs); $i++) {
              $dirs = glob($categoryDirs[$i] . '/*');
              for ($i2 = 0; $i2 != count($dirs); $i2++) {
                array_push($machineDirs, $dirs[$i2]);
              }
            }

            for ($i = 0; $i != count($goods); $i++) {
              $tempPath = str_replace("./goods/", "", $machineDirs[$i]);
              $machine = htmlspecialchars($goods[$i]);
              echo ('<div itemscope itemtype="http://schema.org/Product" class="box ' . getLast($i, $goods) . '">
                      <h3 itemprop="name">' . htmlspecialchars($goods[$i]) . '</h3>
                      <meta itemprop="url" content="https://www.gladiator-gepkolcsonzo.hu/pricelist.php?category=' . substr($tempPath, 0, strpos($tempPath, "/", strpos($tempPath, "/"))) . '&scroll=' . $machine . '"  />
                      <meta itemprop="image" content="https://www.gladiator-gepkolcsonzo.hu' . str_replace(".", "", $machineDirs[$i]) .  '/image.png' . '"  />
                      <div class="img-container">
                        <img alt="' . htmlspecialchars($goods[$i]) . '" src="' . './goods/' . htmlspecialchars($selected) . '/' . htmlspecialchars($goods[$i]) . '/image.png' . '" />
                      </div>
                      <p itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="seller" contect="Gladiátor Team Kft." />
                        <meta itemprop="url" content="https://www.gladiator-gepkolcsonzo.hu/pricelist.php?category=' . substr($tempPath, 0, strpos($tempPath, "/", strpos($tempPath, "/"))) . '&scroll=' . $machine . '"  />
                        <meta itemprop="priceCurrency" content="HUF" />
                        <span itemprop="price">' . htmlspecialchars(file_get_contents($mainDir2 . "/" . $goods[$i] . "/price.txt")) . '</span> ft/nap
                      </p>
                    </div>');
            }
          }

          //search('fúró');
          ?>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>