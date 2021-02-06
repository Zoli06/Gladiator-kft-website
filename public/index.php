<!DOCTYPE html>
<html>

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
    <div>
      <h2 class="uppercase-title">Kölcsönzés</h2>
      <div class="box-container">
        <img class="scroll-box prev-box" src="./images/prev.svg" />
        <div class="box">
          <h3>Bontókalapács</h3>
          <div class="img-container">
            <img src="./images/_vyrn_844utvefuro-esvesogeppneumatikuswjsdsmax-i14616-removebg-preview.png" />
          </div>
          <p><span>1200</span> ft/nap</p>
        </div>
        <div class="box">
          <h3>Döngölő</h3>
          <div class="img-container">
            <img src="./images/BS-600-removebg-preview.png" />
          </div>
          <p><span>1200</span> ft/nap</p>
        </div>
        <div class="box last">
          <h3>Ütvefúró</h3>
          <div class="img-container">
            <img src="./images/Kango_950_S-removebg-preview.png" />
          </div>
          <p><span>1200</span> ft/nap</p>
        </div>
        <img class="scroll-box next-box" src="./images/next.svg" />
      </div>
      <h2>Elérhetőségünk</h2>
      <div class="box-container small-elements">
        <div class="box">
          <img src="./images/map-marked-alt-solid.svg" class="title-img" />
          <div class="img-container">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4704.750499788218!2d19.07733520527396!3d47.571989195245976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741da23ecba6b4f%3A0x29979b66898e66ae!2zQnVkYXBlc3QsIFbDoWNpIMO6dCA1OSwgMTA0Nw!5e0!3m2!1shu!2shu!4v1608304731556!5m2!1shu!2shu"
              width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
              tabindex="0"></iframe>
          </div>
        </div>
        <div class="small-elements-container">
          <div class="box small-element start">
            <img src="./images/envelope-open-text-solid.svg" class="title-img" />
            <p class="description">gladiatorteamkft@gmail.com</p>
          </div>
          <div class="box small-element end">
            <img src="./images/phone-solid.svg" class="title-img" />
            <p class="description">Fax: 06-1/ 389-0460</p>
            <p class="description">Tel: 06-30/ 948-8021</p>
          </div>
        </div>
        <div class="box last">
          <img src="./images/i01_open.png" class="title-img" />
          <p class="description"><span class="small-title">Hétfő-Péntek</span></p>
          <p class="description">7:00 - 16:30</p>
          <br /><br />
          <p class="description"><span class="small-title">Szombat-Vasárnap</span></p>
          <p class="description">Zárva</p>
        </div>
      </div>
      <h2>Rólunk</h2>
      <div class="box-container small-elements last">
        <div class="box long-text last">
          <p class="long-text">Cégünk, a GLADIÁTOR TEAM Gépjavító, Beszerző és Kölcsönző Kft. 2003-ban alakult. A cél,
            hogy az építkezők, barkácsolók és kertészkedők számára segítséget nyújtsunk szerszámok és eszközök
            biztosítására...</p>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>