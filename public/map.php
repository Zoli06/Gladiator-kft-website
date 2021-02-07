<!DOCTYPE html>
<html>

<?php
$subpage = true;
include('./modules/head.php');
?>

<body>
  <?php
  $active = 3;
  include('./modules/nav.php');
  $text = 'Térkép';
  include('./modules/header.php');
  ?>
  <section>
    <div class="wide-div last">
      <h2>Google maps</h2>
      <div class="box wide">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4704.750499788218!2d19.07733520527396!3d47.571989195245976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741da23ecba6b4f%3A0x29979b66898e66ae!2zQnVkYXBlc3QsIFbDoWNpIMO6dCA1OSwgMTA0Nw!5e0!3m2!1shu!2shu!4v1608304731556!5m2!1shu!2shu" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
    </div>
  </section>
  <?php
  include('./modules/footer.php');
  ?>
</body>

</html>