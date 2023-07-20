<? 
	session_start(); 

	$table = "free";
	$ripple = "free_ripple";

	include "dbconn.php";

$num=$_GET['num'];
$page=$_GET['page'];
	$mode=$_GET['modify'];

	if (isset($_GET["mode"]))
	$mode = $_GET["mode"];
  else
	$mode = "";


	
	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysqli_query( $connect,$sql);
		//$row = mysqli_fetch_array($result);  
		if ($result){
			while($row = mysqli_fetch_array($result)){     
	
		$item_subject     = $row['subject'];
		$item_content     = $row['content'];
		$item_file_0 = $row['file_name_0'];
		$item_file_1 = $row['file_name_1'];

		$copied_file_0 = $row['file_copied_0'];
		$copied_file_1 = $row['file_copied_1'];
	}

}
}
?>
<!doctype html>
<html lang="ko">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>html5문서</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/condition.css">
  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/greet.css">

  <style>
  #header {
    height: 100px;
  }

  #top_login span {
    padding: 0 10px;
  }

  #top_login {
    float: right;
    margin: 10px 10px 0 0;
  }

  #menu {
    width: 100%;
    height: 50px;
    line-height: 50px;
    background: #ff5f61;
  }

  #menu ul {
    display: flex;
    text-align: center;
    width: 50%;
    margin: 0 auto;
  }

  #menu ul li {
    width: 33.33%;
  }

  #menu ul li a {
    color: #000;
    display: inline-block;
    font-weight: bold;
    font-size: 16px;
  }

  #header {
    margin-bottom: 0;
  }
  </style>

  <script>
  function check_input() {
    if (!document.board_form.subject.value) {
      alert("제목을 입력하세요1");
      document.board_form.subject.focus();
      return;
    }

    if (!document.board_form.content.value) {
      alert("내용을 입력하세요!");
      document.board_form.content.focus();
      return;
    }
    document.board_form.submit();
  }
  </script>
</head>

<body>
  <div id="header">
    <? include "top_login1.php"; ?>
  </div>
  <nav id="menu">
    <ul class="menu">
      <li><a href="#">MENU1</a></li>
      <li><a href="#">MENU2</a></li>
      <li><a href="#">MENU3</a></li>
      <li><a href="list.php">Q&amp;A</a></li>
    </ul>
  </nav>
  <div id="wrap">


    <div id="content">


      <div id="col2">
        <div id="title">
          <img src="img/title_free.gif">
        </div>
        <div class="clear"></div>

        <div id="write_form_title">
          <img src="img/write_form_title.gif">
        </div>
        <div class="clear"></div>
        <?

	if($mode=="modify")
	{
?>
        <form name="board_form" method="post"
          action="insert1.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>"
          enctype="multipart/form-data">
          <?
	}
	else
	{
?>
          <form name="board_form" method="post" action="insert1.php?table=<?=$table?>" enctype="multipart/form-data">
            <?
	}
?>
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1">
				<div class="col1"> 별명 </div>
				<div class="col2"><?=$_SESSION['usernick']?></div>
				<?
	if( $userid && ($mode != "modify"))
	{
?>
			<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
			<?
	}
?>
			</div>
			<div class="write_line"></div>
			<div id="write_row2">
				<div class="col1"> 제목 </div>
				<div class="col2"><input type="text" name="subject" value="<?=$item_subject?>"></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row3">
				<div class="col1"> 내용 </div>
				<div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row4">
				<div class="col1"> 이미지파일1 </div>
				<div class="col2"><input type="file" name="upfile[]"></div>
			</div>
			<div class="clear"></div>
			<? 	if ($mode=="modify" && $item_file_0)
	{
?>
		<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]"
				value="0"> 삭제</div>
		<div class="clear"></div>
		<?
	}
?>
		<div class="write_line"></div>
		<div id="write_row5">
			<div class="col1"> 이미지파일2 </div>
			<div class="col2"><input type="file" name="upfile[]"></div>
		</div>
		<? 	if ($mode=="modify" && $item_file_1)
	{
?>
		<div class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]"
				value="1"> 삭제</div>
		<div class="clear"></div>
		<?
	}
?>
					<div class="write_line"></div>

					<div class="clear"></div>
				</div>

				<div id="write_button"><a href="#"><img src="img/ok.png" onclick="check_input()"></a>&nbsp;
					<a href="list.php?table=<?=$table?>&page=<?=$page?>"><img src="img/list.png"></a>
				</div>
			</form>

      </div> <!-- end of col2 -->
    </div> <!-- end of content -->
  </div> <!-- end of wrap -->

</body>

</html>