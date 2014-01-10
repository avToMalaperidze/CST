<?php

  require('function.php');
  require('auth_valid.php');
  session_start();

if (isset($_POST['username']) && isset($_POST['passwd'])) {
$username = $_POST['username'];
$passwd = $_POST['passwd'];

if ($username && $passwd) {

  try  {
    login($username, $passwd);
    
    $_SESSION['valid_user'] = $username;
  }
  catch(Exception $e)  {
   
    do_html_header('Problem:');
    echo 'You could not be logged in.
          You must be logged in to view this page.';
    do_html_url('login.php', 'Login');
    do_html_footer();
    exit;
  }
}
};

do_html_header('Home');
check_valid_user();

display_user_menu();

do_html_footer();




?>