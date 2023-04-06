<!DOCTYPE html>
<html lang="eng">
<link rel="stylesheet" type="text/css" href="./css/style.css">
<link rel="stylesheet" type="text/css" href="plugin/slick/slick-theme.css">
 <link rel="stylesheet" type="text/css" href="plugin/slick/slick.css">


<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="plugin/slick/slick.min.js"></script>

<?php require_once("includes/head.php"); ?>  
<body>
  
  <?php require_once("includes/header.php"); ?>    

  <section class="vertical-center-4">
    <div>
      <img src="assets/images/family2.jpg" width="400" height="300" alt="twit">
    </div>
    <div>
      <img src="assets/images/family3.jpg" width="400" height="300" a;t="Inst">
    </div>
    <div>
      <img src="assets/images/family4.jpg" width="400" height="300" alt="twit">
    </div>
    <div>
      <img src="assets/images/family.jpg" width="400" height="300" alt="twit">
    </div>
    
  </section>
  <!-- Main content area with service sections -->
  <main>
 



    <!--  image with introduction and call to action -->
    <div class="Main">
      <h1>Find peace and balance in your life</h1>
      <p>LIFE is a digital wellness program that helps you manage stress and live a more mindful and productive life. Join us for online yoga, meditation, stretching, and healthy habit resources.</p>
     
    </div>

    <!-- The container for the yoga, meditation, stretching, and healthy habit sections -->
    <div class="container">

      <!-- The yoga section, which includes a heading and an image -->
      <div class="section">
        <h2>Yoga</h2>
        <img src="assets/images/yoga1.jpg" alt="Yoga" width="300" height="200">
        <p>Our yoga lessons are intended to strengthen the body and calm the mind. To find the ideal practise for you, select from a number of styles and levels.</p>
      </div>

       <!-- The meditation section, which includes a heading and an image -->
      <div class="section">
        <h2>Meditation</h2>
        <img src="assets/images/meditation.jpg" alt="Meditation" width="300" height="200">
        <p>Meditation is a powerful tool for reducing stress and increasing focus. Join us for guided meditations to discover how to make this training a part of your everyday life.</p>
      </div>

      <!-- The stretching section, which includes a heading and an image -->
      <div class="section">
        <h2>Stretching</h2>
        <img src="assets/images/stretching.jpg" alt="Stretching" width="300" height="200">
        <p>You can increase your flexibility and lessen body tension by participating in our stretching classes. Spend a few minutes stretching daily and experience the positive effects on your body and mind.</p>
      </div>

       <!-- The healthy habits section, which includes a heading and an image -->
      <div class="section">
        <h2>Healthy Habits</h2>
        <img src="assets/images/fruits.jpg" alt="Healthy Habits" width="300" height="200">
        <p>Your general health can be greatly improved by incorporating healthy habits into your daily routine. For advice and inspiration on how to incorporate healthy living into your life, look through our resources.</p>
      </div>
    </div>

    <?php if(!isUserLoggedIn()) { ?>
                              
  <div  class="Main">
    <h1>Daily activities & classes online</h1>
    <p>From Yoga to Stretching and other activities, explore 2,000 videos in twelve different styles, ranging from vinyasa and Hatha to yin and restorative. Learn yoga at home or on the go with the top yoga instructors in the world.</p>
    <a href="register.php" class="button" id="get-started">Get Started</a>
  </div>
  <?php }?>
  
  </main>

  <?php require_once("includes/footer.php"); ?>  
  
    <script src="header.js"></script>
    <script type="text/javascript">

    $(document).ready(function(){
      $('.vertical-center-4').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
  
    centerMode: true,
    centerPadding: '500px',
    dots: true,
    autoplay: true,
    autoplaySpeed: 1500,
});
    });
  </script>
    </body>
    </html>
    