<?
      session_start();
     include "dbconn.php";
      $table = "free";
	$ripple = "free_ripple";
      $num=$_GET['num'];
      $ripple_num = $_GET['ripple_num'];
      $sql = "delete from free_ripple where num=$ripple_num";
      mysqli_query( $connect,$sql);
      mysqli_close($connect);

      echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num';
	   </script>
	  ";
?>
