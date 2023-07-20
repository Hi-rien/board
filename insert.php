<?
           session_start();
?>
<meta charset="utf-8">
	<?
		$hp = $_POST['hp'];

  /* $hp = $hp1."-".$hp2."-".$hp3;*/
  /* $email = $email1."@".$email2;*/
  $email = $_POST['email'];

  $id=$_POST['id'];
  $pass=$_POST['pass'];
  $name=$_POST['name'];
  $nick=$_POST['nick'];

   $ip = $REMOTE_ADDR;         // 방문자의 IP 주소를 저장

   include "dbconn.php";       
      mysqli_query($connect,'set names utf8');  

   $sql = "select * from join_mem where id='$id'";
   $result = mysqli_query( $connect,$sql);
   $exist_id = mysqli_num_rows($result);

   if($exist_id) {
     echo("
           <script>
             window.alert('해당 아이디가 존재합니다.')
             history.go(-1)
           </script>
         ");
         exit;
   }
   else
   {            // 레코드 삽입 명령을 $sql에 입력
	    $sql = "insert into join_mem(id, pass, name, nick, hp, email) ";
		$sql .= "values('$id', '$pass', '$name', '$nick', '$hp', '$email')";

	
		mysqli_query( $connect,$sql);  // $sql 에 저장된 명령 실행
   }

   mysqli_close($connect);            
   echo "
	   <script>
	    location.href = 'main.html';
	   </script>
	";
	
	
	?>