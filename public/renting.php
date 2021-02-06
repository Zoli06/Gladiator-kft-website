<!DOCTYPE html>
<html>

<?php
$subpage = true;
include('./modules/head.php');
?>

<body>
  <?php
  $active = 1;
  include('./modules/nav.php');
  $text = 'Kölcsönzés';
  include('./modules/header.php');
  ?>
  <section>
    <div class="wide-div">
      <h2>Kivonat</h2>
      <div class="box long-text wide">
        <h3>Bérleti feltételek</h3>
        <p class="long-text black-text">
          A bérléshez személyi igazolvány, lakcímkártya, utolsó havi közüzemi számla és készpénzletét szükséges!
          <br />
          Nem budapesti bérlőktől, az alap letéti díj kétszerese szükséges. Az árak az ÁFÁ-t tartalmazzák.
        </p>
      </div>
      <div class="box long-text wide">
        <h3>Kedvezmény</h3>
        <p class="long-text black-text">
          5 napot meghaladó folyamatos bérlés esetén 10% kedvezmény, a köv. kitételek mellett.
          <br />
          Vasárnap díjtalan, hivatalos ünnepnapokra 50% kedvezmény a bérleti díjakból .2 egymást követő ünnepnapra 1 nap bérleti díj fizetendő.
          <br />
          A kedvezmények nem összevonhatók.
        </p>
      </div>
      <div class="box long-text wide">
        <h3>Megjegyzés</h3>
        <p class="long-text">
          A gépek bérleti díja nem tartalmazza a tartozékok árát, valamint egyéb bérleti tárgy bérleti díját.
          <br />
          A bérleti eszközök három órán belüli késedelmes visszaszolgáltatása esetén (min. egy napi bérlés után) a napi díj 70%-át, három órán túli késés esetén a napi díjat számítja fel a Bérbeadó.
        </p>
      </div>
    </div>
  </section>
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>