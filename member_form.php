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
	   <link rel="stylesheet" href="css/common.css">
		
		<script>



   function check_id()
   {
     window.open("check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
   }

   function check_nick()
   {
     window.open("check_nick.php?nick=" + document.member_form.nick.value,
         "NICKcheck",
          "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
   }


//let reg_pw2 = /(?=.*[a-zA-ZS])(?=.*?[#?!@$%^&*-]).{6,24}/; // 문자와 특수문자 조합의 6~24 자리

function check_input()
   {
   // const re1 = /^[a-zA-Z0-9]{4,12}$/ ;  //가능하다
   const re1 =/^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{6,10}$/;
    const id=document.member_form.id.value;
      if (!document.member_form.id.value)
      {
          alert("아이디를 입력하세요");    
          document.member_form.id.focus();
          return;
      }else if(!re1.test(id)){
        alert("6~10자의 영문자,숫자,특수기호 혼합해서 사용할 수 있습니다");
    return false;
      }


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
          document.member_form.hp.focus();
          return;
      }


      if (!document.member_form.email.value)
      {
          alert("Email을 입력하세요");    
          document.member_form.email.focus();
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

    



      //휴대전화번호 체크
const hp1=document.member_form.hp.value;
const re2= /^01([0|1|6|7|8|9])-?([0-9]{3,4})-?([0-9]{4})$/;
if (!re2.test(hp1)) {
          alert('휴대전화번호를 다시 입력해주세요.'); 
          return false;
      }



// 이메일 체크
const email=document.member_form.email.value;
//const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
 //위의 식도 가능하다
const re=/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/;
if (!re.test(email)) {
    alert("@를 포함해서 입력해주세요");
    return false;
        
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
				<h2>회원가입</h2>
		<div id="join_mem">

        <form  name="member_form" method="post" action="insert.php"> 
	
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
			<li><div id="id1"><input type="text" name="id"></div>
            <div id="id2"><a href="#"><img src="image/check_id.gif" onclick="check_id()"></a></div></li>
			<li><input type="password" name="pass"></li>
			<li><input type="password" name="pass_confirm"></li>
			<li><input type="text" name="name"></li>
			<li><div id="nick1"><input type="text" name="nick"></div><div id="nick2" ><a href="#"><img src="image/check_id.gif" onclick="check_nick()"></a></div></li>
			 <li><input type="tel" class="hp" name="hp"> </li> 
			<li><input type="email" id="email1" name="email"></li>
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