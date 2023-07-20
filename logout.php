<?
  session_start();
  unset($_SESSION['userid']);
  unset($_SESSION['username']);
  unset($_SESSION['usernick']);
 
  echo("
       <script>
          location.href = 'main.html'; 
         </script>
       ");
?>
