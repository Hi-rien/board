<?
    session_start();
?>
<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>html5문서</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/base.css">
		<link rel="stylesheet" href="css/member.css">
	<!--  <link rel="stylesheet" href="css/common.css">-->
<style>
body{font-size:0.8em;}
		#top_login span {padding:0 10px;}
		#top_login {float:right;margin-right:0;margin-top:-15px;}
		#header {margin:10px 10px 0 0;}
		#top_login a {text-decoration:none; color:#999;font-size: "NGothic";}
	#top_login a:hover { color:#666; }
	.clear { clear:both; }
			</style>
		<script>
   function check_id()
   {
     window.open("check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
   }

   function check_nick()
   {
     window.open("check_nick.php?nick=" + document.member_form.nick.value,
         "NICKcheck",
          "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
   }

   function check_input()
   {
      if (!document.member_form.pass.value)
      {
          alert("비밀번호를 입력하세요");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value)
      {
          alert("비밀번호확인을 입력하세요");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (!document.member_form.hp.value)
      {
          alert("휴대폰 번호를 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit();
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.hp.value = "";
      document.member_form.email.value = "";
	  
      document.member_form.id.focus();

      return;
   }
</script>
	</head>
	<body>
	<?
    include "dbconn.php";
    mysqli_query($connect,'set names utf8');  

  //  $sql = "select * from member where id='$userid'";
  // 아래문자 위의문장 수정한 내용
    $sql = "select * from join_mem where id='$_SESSION[userid]'";
    $result = mysqli_query($connect,$sql);

    $row = mysqli_fetch_array($result);
/*
    $hp = explode("-", $row[hp]);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];
*/
    mysqli_close($connect);
?>


  <div id="header">
    <? include "top_login2.php"; ?>
  </div>  
	<h2>회원정보수정</h2>
 	<div id="join_mem">
        <form  name="member_form" method="post" action="modify.php"> 

		<!--추가한곳-->
      <input type="hidden" name=id value=<?=$row['id']?>>
        	<!--추가한곳 끝-->

			
		<div id="form_join">
			<div id="join1">
			<ul>
			<li>* 아이디</li>
			<li>* 비밀번호</li>
			<li>* 비밀번호 확인</li>
			<li>* 이름</li>
			<li>* 닉네임</li>
			<li>* 휴대폰</li>
			<li>* 이메일</li>
			</ul>
			</div>
			<div id="join2">
			<ul>
			<li><?= $row['id'] ?></li>
			<li><input type="password" name="pass" value="<?= $row['pass'] ?>"></li>
			<li><input type="password" name="pass_confirm" value="<?= $row['pass'] ?>"></li>
			<li><input type="text" name="name" value="<?= $row['name'] ?>"></li>
			<li><div id="nick1"><input type="text" name="nick" value="<?= $row['nick'] ?>"></div><div id="nick2" ><a href="#"><img src="image/check_id.gif" onclick="check_nick()"></a></div></li>
			<li> <input type="tel" class="hp" name="hp" value="<?= $row['hp'] ?>"></li>
			<li><input type="email" id="email1" name="email" value="<?= $row['email'] ?>"> </li>
			</ul>
			</div>
			<div class="clear"></div>
			<div id="must"> * 는 필수 입력항목입니다.^^</div>
		</div>

		<div id="button"><a href="#"><img src="image/button_save.gif"  onclick="check_input()"></a>&nbsp;&nbsp;
		                 <a href="#"><img src="image/button_reset.gif" onclick="reset_form()"></a>
		</div>
	    </form>
	</div>


  
  
</body>
</html>