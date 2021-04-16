<?php include('./modules/network_header.php') ?>
<!DOCTYPE html>
<html lang="hu">

<?php
$subpage = false;
include('./modules/head.php');
?>

<body>
  <?php
  $active = 0;
  include('./modules/nav.php');
  $text = 'Gladiátor Team Kft.';
  include('./modules/header.php');
  ?>
  <section>
    <h2 class="uppercase-title"><a href="pricelist.php">Árlista</a></h2>
    <div class="box-container scrollable-machine-container">
      <img class="scroll-box prev-box" alt="prev" src="./images/prev.svg" />
      <div class="box-container">
        <?php
        function getSubDirectories($dir)
        {
          $subDir = array();
          $directories = array_filter(glob($dir), 'is_dir');
          $subDir = array_merge($subDir, $directories);
          foreach ($directories as $directory) $subDir = array_merge($subDir, getSubDirectories($directory . '/*'));
          return $subDir;
        }

        $mainDir = './goods';
        $categoryDirs = glob($mainDir . '/*');
        $machineDirs = array();

        for ($i = 0; $i != count($categoryDirs); $i++) {
          $dirs = glob($categoryDirs[$i] . '/*');
          for ($i2 = 0; $i2 != count($dirs); $i2++) {
            array_push($machineDirs, $dirs[$i2]);
          }
        }

        shuffle($machineDirs);
        //$machineDirs = array_slice($machineDirs, 0, 40);

        for ($i = 0; $i != count($machineDirs); $i++) {
          $machine = substr($machineDirs[$i], strrpos($machineDirs[$i], '/') + 1);
          $tempPath = str_replace("./goods/", "", $machineDirs[$i]);
          echo ('<div class="box scrollable-machine" onclick="redirectToSubpage(\'' . $machine . '\', \'' . $machineDirs[$i] . '\')" itemscope itemtype="http://schema.org/Product">
                    <h3 itemprop="name">' . $machine . '</h3>
                    <meta itemprop="url" content="https://www.gladiator-gepkolcsonzo.hu/pricelist.php?category=' . substr($tempPath, 0, strpos($tempPath, "/", strpos($tempPath, "/"))) . '&scroll=' . $machine . '"  />
                    <meta itemprop="image" content="https://www.gladiator-gepkolcsonzo.hu' . str_replace(".", "", $machineDirs[$i]) .  '/image.png' . '"  />
                    <div class="img-container">
                      <img alt="' . $machine . '" src="' . $machineDirs[$i] .  '/image.png' . '" />
                    </div>
                    <p itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                      <meta itemprop="seller" contect="Gladiátor Team Kft." />
                      <meta itemprop="url" content="https://www.gladiator-gepkolcsonzo.hu/pricelist.php?category=' . substr($tempPath, 0, strpos($tempPath, "/", strpos($tempPath, "/"))) . '&scroll=' . $machine . '"  />
                      <meta itemprop="priceCurrency" content="HUF" />
                      <span itemprop="price">' . file_get_contents($machineDirs[$i] . "/price.txt") . '</span> ft/nap</p>
                  </div>');
        }
        ?>
      </div>
      <img class="scroll-box next-box" alt="next" src="./images/next.svg" />
    </div>
    <div>
      <h2><a href="contact.php">Elérhetőségünk</a></h2>
      <div class="box-container small-elements overflowing-text contact">
        <div class="box map">
          <img alt="map" src="./images/map-marked-alt-solid.svg" class="title-img" />
          <div class="img-container google-maps">
            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4704.750499788218!2d19.07733520527396!3d47.571989195245976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741da23ecba6b4f%3A0x29979b66898e66ae!2zQnVkYXBlc3QsIFbDoWNpIMO6dCA1OSwgMTA0Nw!5e0!3m2!1shu!2shu!4v1608304731556!5m2!1shu!2shu" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
          </div>
          <p>Budapest, Váci út 59, 1047</p>
        </div>
        <div class="small-elements-container">
          <div class="box small-element start">
            <img alt="email" src="./images/envelope-open-text-solid.svg" class="title-img" />
            <p class="description">gladiatorteamkft@gmail.com</p>
          </div>
          <div class="box small-element end">
            <img alt="tel" src="./images/phone-solid.svg" class="title-img" />
            <p class="description">Fax: 06-1/ 389-0460</p>
            <p class="description">Tel: 06-30/ 948-8021</p>
          </div>
        </div>
        <div class="box last">
          <img alt="nyitvatartás" src="./images/i01_open.png" class="title-img" />
          <p class="description"><span class="small-title">Hétfő-Péntek</span></p>
          <p class="description">7:00 - 16:30</p>
          <br />
          <p class="description"><span class="small-title">Szombat-Vasárnap</span></p>
          <p class="description">Zárva</p>
        </div>
      </div>
      <h2>Rólunk</h2>
      <div class="box-container small-elements last">
        <div class="box long-text last">
          <p class="long-text min">
            Cégünk, a GLADIÁTOR TEAM Gépjavító, Beszerző és Kölcsönző Kft. 2003-ban alakult. A cél,
            hogy az építkezők, barkácsolók és kertészkedők számára segítséget nyújtsunk szerszámok és eszközök
            biztosítására.
          </p>
          <p class="long-text min">
            Gépparkunkban minden neves márka megtalálható (Makita, Hitachi, Wacker, Kango, Flex).
          </p>
          <p class="long-text min">
            Bérbe adás mellett szerelést is vállalunk, erről telefonon és e-mailen tudunk bővebb tájékoztatást adni.<span> <a style="color: blue; text-decoration: none; cursor: pointer;" onclick="watchFullText()">tovább</a></span></p>
          </p>
          <p class="long-text max" style="display: none;">
            A vevőközpontúság számunkra fontos, így próbálunk igazodni az igényekhez. A kínálatban szereplő eszközökre több bérlési, kölcsönzési lehetőséget biztosítottunk.
          </p>
          <p class="long-text max" style="display: none;">
            Vállalkozásunk építőipari gépek, kertészeti gépek és különféle szerszámok bérbeadásával foglalkozik, ezekben a kategóriákban nálunk biztosan megtalálja, amire szüksége van!
          </p>
          <p class="long-text max" style="display: none;">
            Hosszú távú bérlés esetén kedvezményt biztosítunk!
          </p>
          <p class="long-text max" style="display: none;">
            Naprakész árlistánkat és a szerződési feltételeket honlapunkon megnézhetik, vagy munkatársainktól tájékozódhatnak.
          </p>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>