<!doctype html>

<html lang="eng">
<link rel="stylesheet" type="text/css" href="./css/contact.css"> 
<link rel="stylesheet" type="text/css" href="./css/style.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="jquery.validate.js"></script>

<?php require_once("includes/head.php"); ?> 


<script>
$.validator.addMethod("comEmail", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
}, "Please enter a valid email address with .com domain.");



  $(document).ready(function() {
    $("#contact-form").validate({
      rules: {
        name: {
          required: true,
        },
        email: {
          required: true,
          email: true,
          comEmail: true
        },
        message: {
          required: true,
        }
      },
      messages: {
        name: "Please enter your name",
        email: {
          required: "Please enter your email address",
          email: "Please enter a valid email address"
        },
        message: "Please enter a message"
      },
      errorClass: "error",
      submitHandler: function(form){
        form.submit();
      }
    });
  });
</script>
       
<body>

  <?php require_once("includes/header.php"); ?> 
  <main>
    <section id="contact">
      <div class="container">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Please use the form below to get in touch.</p>
      </div>
    </section>
       

    <section>
  <div class="EnquiryForm">
    <h2>Contact Information</h2>
    <p>Address: 123 Main Street, Melbourne, VIC 3000</p>
    <p>Email: info@life.com</p>
    <p>Phone: (03) 1234 5678</p>
  </div>
</section>

<section>
  <div class="container">
    <h2>Enquiry Form</h2>
    <form id="contact-form" action="submitted.html" method="get">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name"><br>
      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email"><br>
      <label for="message">Message:</label><br>
      <textarea id="message" name="message" rows="5" cols="30"></textarea><br>
      <input type="submit" value="Send">
    </form>
  </div>
</section>




  </main>

  
  <?php require_once("includes/footer.php"); ?>



  <script src="header.js"></script>
</body>
</html>
