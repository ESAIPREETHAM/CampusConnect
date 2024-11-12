<?php
   session_start();
   if(isset($_SESSION)){
       session_destroy();
       header('location: Reg.php');
   }
   else{
       header('location: Reg.php');
   }
?>
          