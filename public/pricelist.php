<!DOCTYPE html>
<html>

<?php
$subpage = true;
$extraCss = './css/pricelist.css';
$extraJs = './js/pricelist.js';
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
      <div method="get" class="page-menu">
        <h2>Árak</h2>
        <div class="box">
          <?php
          $mainDir = getcwd() . '\goods';
          $directories = glob($mainDir . '\*', GLOB_ONLYDIR);
          $categories = str_replace($mainDir . '\\', '', $directories);
          if (in_array('Egyéb gépek', $categories)) { //move this value to last
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

          function getLast($i, $goods)
          {
            if ((int) $i + 1 == count($goods)) {
              return 'last';
            } else {
              return '';
            }
          }

          for ($i = 0; $i != count($goods); $i++) {
            echo ('<div class="box ' . getLast($i, $goods) . '">
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
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>