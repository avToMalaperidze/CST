<?php


function db_connect() {
   $result = new mysqli('localhost', 'root', '', 'users');
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }
};


function register($username, $email, $password) {

  // connect to db
  $conn = db_connect();

  
  $result = $conn->query("select * from user where username='".$username."'");
  if (!$result) {
    throw new Exception('Could not execute query');
  }

  if ($result->num_rows>0) {
    throw new Exception('That username is taken - go back and choose another one.');
  }

 
  $result = $conn->query("insert into user values
                         ('".$username."', sha1('".$password."'), '".$email."')");
  if (!$result) {
    throw new Exception('Could not register you in database - please try again later.');
  }

  return true;
};
function do_html_heading($heading) {

?>
  <h2><?php echo $heading;?></h2>
<?php
}
function do_html_header($title) {
  
?>
  <html>
  <head>
    <title><?php echo $title;?></title>
    <style>
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      a { color: #000000 }
    </style>
  </head>
  <body>
  <img src="1.jpg" alt="logo" border="0"
       align="left" valign="bottom" height="55" width="57" />
  <h1>CST-LogIn/LogOut</h1>
  
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
  
?>
  </body>
  </html>
<?php
}

function do_html_URL($url, $name) {
 
?>
  <br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
}

 function display_user_menu() {
 
?>
<a href="member.php">Home</a> &nbsp;|&nbsp;


<a href="change_passwd_form.php">Change password</a>

<a href="logout.php">Logout</a>


<?php
}

function display_password_form() {
  
?>
   <br />
   <form action="change_passwd.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Old password:</td>
       <td><input type="password" name="old_passwd"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type="password" name="new_passwd"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type="password" name="new_passwd2"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan="2" align="center">
       <input type="submit" value="Change password"/>
   </td></tr>
   </table>
   <br />
<?php
}

?>