<?php include('./modules/network_header.php') ?>
<!DOCTYPE html>
<html lang="hu">

<?php
$subpage = true;
$title = 'Kapcsolat';
include('./modules/head.php');
?>

<body>
  <?php
  $active = 4;
  include('./modules/nav.php');
  $text = 'Kapcsolat';
  include('./modules/header.php');
  ?>
  <section>
    <div class="padding-div">
      <h2>Elérhetőségünk</h2>
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
    </div>
    <form onsubmit="sendMail(); return false;">
      <div class="wide-div last" style="padding-top: 0px !important;">
        <h2>Írjon nekünk</h2>
        <div class="box long-text wide email">
        <h3 style="width: 100%; text-align: center; font-size: 3vmin; color: red; margin-bottom: 1vmin"><b>Tisztelt Ügyfeleink!</b> A felület egyelőre nem működik.</h3>
          <p class="long-text black-text" id="textboxes">
            <span class="first">
              Név:
              <input type="text" id="name" />
              E-mail cím:
              <input type="email" id="email" />
              Tárgy:
              <input type="text" id="subject" />
            </span>
            <span class="second" id="message">
              Üzenet:
              <textarea></textarea>
            </span>
            <span class="third">
              <input type="reset" />
            </span>
            <span class="fourth">
              <input type="submit" />
            </span>
          </p>
          <!--<p id="waiting" class="completed-status hide">
            <img src="./images/ezgif-5-eda144892486.gif" alt="completed_symbol" />
            <span>Küldés...</span>
          </p>
          <p id="finished" class="completed-status hide">
            <img src="./images/imageedit_1_9183836706.gif" alt="completed_symbol" />
            <span>E-mail elküldve!</span>
          </p>-->
        </div>
    </form>
    <?php
    //print phpinfo();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $subject = htmlspecialchars($_POST['subject']);
      $message = htmlspecialchars($_POST['message']);
      $message = wordwrap($message, 70);

      $to = 'zolixvagyok@gmail.com';
      $sender = 'service.gladiatorkft@gmail.hu';
      $headers = 'From:' . $sender;

      mail($to, $subject, $message, $headers);
    }
    ?>
  </section>
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>