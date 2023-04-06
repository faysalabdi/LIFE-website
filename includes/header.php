<!-- Header with logo and navigation links -->
<?php require_once('includes/functions.php'); ?>
<header>
    <div class="container">
      <!-- Logo -->
      <a href="index.php" class="logo">LIFE</a>
    
      <button id="toggle-header" onclick="toggleHeader()">Menu</button>
      <nav>
    <ul>
        
        <?php if(isUserLoggedIn()) { ?>
            <li>Welcome, <?php echo getLoggedInUser()['first_name']; ?></li>
            <li><a href="myServices.php"> myServices</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php } else { ?>
            <li><a href="myServices.php"> myServices</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            
            
        <?php } ?>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
</nav>
      
    </div>
  </header>


  