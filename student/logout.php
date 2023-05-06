/* This php is called when the user press the logout button. It will destory the session and redirect the user to login page.  */

<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: ../index.php");
   }
?>
