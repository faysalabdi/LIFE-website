<?php
//This code is checking whether the user is logged in or not.
//and if the user is not logged in, it will redirect the user to the login page.


require_once('functions.php');

if(!isUserLoggedIn())
    redirect('login.php');
