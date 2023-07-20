<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>html5문서</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/base.css">
		<link rel="stylesheet" href="css/main.css">
		<style>
		#login {width:250px;border:1px solid gray;height:150px; padding:10px 5px;
position:absolute;left:50%;top:50%;margin-left:-130px;margin-top:-60px;
/*background:rgba(255,255,255,0.1);*/ border-color:rgba(255,255,255,0.6);
background:transparent;
}

		
		p.center a {background:rgba(255,255,255,0.9);
  color: #000;  display:inline-block;
  font-weight: bold;
   width: 7em;
  padding: 6px 10px 6px 10px;
  margin-top: 10px;
  text-transform: uppercase;
  position:relative; top:6px;
  }
p.center a:hover{background-color: #000;  color:#fff;
  cursor: pointer;}
  
  p.center a.mm {margin-top:3px;}
  
  input[type=submit] {
  /*background-color: #1fb684;*/
  background:rgba(255,255,255,0.9);
  color: #000;
  font-weight: bold;
  width: 8.5em;
  padding: 6px 2px 6px 2px;
  margin-top: 10px;
  text-transform: uppercase;}
input[type=submit]:hover {
  background-color: #000;  color:#fff;
  cursor: pointer;}
  
		</style>
		</head>
	<body>
	<div id="login">
	      <form  name="member_form" method="post" action="login.php"> 
	  <p> <label for="name">ID</label><input type="text" id="name" name="id"></p>
      <p>    <label for="pwd">Password</label><input type="password" id="pwd" name="pass"></p>
  <p class="center"> <input type="submit"  value="로그인"> <a href="member_form.php">회원가입</a>
	  <a href="id_screen.php" class="mm">아이디찾기</a> <a href="pw_screen.php" class="mm">비밀번호찾기</a></p>
	  </form>
     </div>
  
  
</body>
</html>