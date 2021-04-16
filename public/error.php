<?php include('./modules/network_header.php') ?>
<!DOCTYPE html>
<html lang="hu">

<?php
$subpage = true;
include('./modules/head.php');
?>

<body>
  <?php
  $active = '';
  include('./modules/nav.php');
  $text = 'Hiba';
  include('./modules/header.php');
  ?>
  <section>
    <div class="wide-div last error">
      <h2>
        <?php
        $valid_codes = array(
          100,
          101,
          102,
          103,
          200,
          201,
          202,
          203,
          204,
          205,
          206,
          207,
          300,
          301,
          302,
          303,
          304,
          305,
          306,
          307,
          400,
          401,
          402,
          403,
          404,
          405,
          406,
          407,
          408,
          409,
          410,
          411,
          412,
          413,
          414,
          415,
          416,
          417,
          418,
          422,
          423,
          424,
          425,
          426,
          449,
          450,
          500,
          501,
          502,
          503,
          504,
          505,
          506,
          507,
          509,
          510
        );
        if (isset($_GET['code'])) {
          if (in_array($_GET['code'], $valid_codes)) {
            echo (htmlspecialchars($_GET['code'], ENT_QUOTES, 'UTF-8'));
          }
        }
        ?>
      </h2>
      <div class="box wide error">
        <h3>Ahol a madár se jár..</h3>
        <p>Ha a hiba nem szűnik meg hamarosan, kérlek jelezd nekünk e-mailben!</p>
      </div>
    </div>
  </section>
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>