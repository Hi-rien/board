	<div id="top_login">
  
	  
	  <?
    if(!$_SESSION['userid'] )
	{
?>
          <a href="main.html">HOME</a> | <a href="login_form.php">로그인</a> | <a href="member_conditions.html">회원가입</a> 
<?
	}
	else
	{
?>
		<a href="main.html">HOME</a> | <?=$_SESSION['usernick']?> | 
		<a href="logout.php">로그아웃</a> | <a href="member_form_modify.php">정보수정</a> | <a 

href="member_delete.php">회원탈퇴</a>
<?
	}
?>
	  
     </div>
  
