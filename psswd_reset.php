
<?php 
   function get_random_word () {
 $words = preg_split('//', 'abcdefgklm0123', -1);
shuffle($words);
foreach($words as $word) {
    return $word;
}
};
function reset_password($username) {

  $new_password = get_random_word();

  if($new_password == false) {
    throw new Exception('Could not generate new password.');
  }


  
  $conn = db_connect();
  $result = $conn->query("update user
                          set passwd = sha1('".$new_password."')
                          where username = '".$username."'");
  if (!$result) {
    throw new Exception('Could not change password.');  
  } else {
    return $new_password;  
  }
}

function notify_password($username, $password) {


    $conn = db_connect();
    $result = $conn->query("select email from user
                            where username='".$username."'");
    if (!$result) {
      throw new Exception('Could not find email address.');
    } else if ($result->num_rows == 0) {
      throw new Exception('Could not find email address.');
     
    } else {
      $row = $result->fetch_object();
      $email = $row->email;
      $from = "From: support@CST Login/LogOut \r\n";
      $mesg = "Your password has been changed to ".$password."\r\n"
              ."Please change it next time you log in.\r\n";

      if (mail($email, ' login information', $mesg, $from)) {
        return true;
      } else {
        throw new Exception('Could not send email.');
      }
    }
}
?>