<? 
	session_start(); 
	include "dbconn.php";
	$table = "free";
	$ripple = "free_ripple";


    $num=$_GET['num'];
	 $page=$_GET['page'];
	 $subject=$_POST['item_subject'];
	 $content=$_POST['content'];
	 $mode = $_GET['modify'];


	 if (isset($_GET["mode"]))
	 $mode = $_GET["mode"];
   else
	 $mode = "";


	$sql = "select * from $table where num=$num";
	$result = mysqli_query( $connect,$sql);
   // $row = mysqli_fetch_array($result);       
	if ($result){
		while($row = mysqli_fetch_array($result)){

	

	$item_num     = $row['num'];
	$item_id      = $row['id'];
	$item_name    = $row['name'];
  	$item_nick    = $row['nick'];
	$item_hit     = $row['hit'];

	$image_name[0]   = $row['file_name_0'];
	$image_name[1]   = $row['file_name_1'];
	$image_name[2]   = $row['file_name_2'];
	$image_copied[0] = $row['file_copied_0'];
	$image_copied[1] = $row['file_copied_1'];
	$image_copied[2] = $row['file_copied_2'];

    $item_date    = $row['regist_day'];
	$item_subject = str_replace(" ", "&nbsp;", $row['subject']);
	$item_content = $row['content'];
	$is_html      = $row['is_html'];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) 
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}





	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
}
}

	mysqli_query( $connect,$sql);
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
		#header {height:100px;}
		#top_login span {padding:0 10px;}
		#top_login {float:right;margin:10px 10px 0 0;}
		#menu {width:100%; height:50px;line-height:50px; background:#000;}
		#menu ul {display:flex; text-align:center; width:50%; margin:0 auto;}
		#menu ul li {width:33.33%;}
		#menu ul li a {color:#fff;display:inline-block;}
		#header {margin-bottom: 0;}

		</style>
<script>
	function check_input()
	{
		if (!document.ripple_form.ripple_content.value)
		{
			alert("내용을 입력하세요!");    
			document.ripple_form.ripple_content.focus();
			return;
		}
		document.ripple_form.submit();
    }

    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>
<style>
#ripple_box1 {font-weight:bold; font-size:1rem;margin:1rem 0;}
#ripple_box3 {margin-top:0.5rem;}
	</style>
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

		<div id="view_comment"> &nbsp;</div>
		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?>  
			                      | <?= $item_date ?> </div>	
		</div>

		<div id="view_content">
<?
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$img_name = $image_copied[$i];
			$img_name = "./data/".$img_name;
			$img_width = $image_width[$i];
			
			echo "<img src='$img_name' width='$img_width'>"."<br><br>";
		}
	}
?>
			<?= $item_content ?>
		</div>

		<div id="ripple">
<?

	    $sql = "select * from free_ripple where parent='$item_num'";
	    $ripple_result = mysqli_query($connect,$sql);

		while ($row_ripple = mysqli_fetch_array($ripple_result))
		{
			$ripple_num     = $row_ripple['num'];
			$ripple_id      = $row_ripple['id'];
			$ripple_nick    = $row_ripple['nick'];
			$ripple_content = str_replace("\n", "<br>", $row_ripple['content']);
		//$ripple_subject = str_replace("\n", "<br>", $row_ripple['subject']);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple['regist_day'];
?>
			<div id="ripple_writer_title">
			<ul>
			<li id="writer_title1"><?=$ripple_nick?></li>
			<li id="writer_title2"><?=$ripple_date?></li>
			<li id="writer_title3"> 
		      <? 
					if($userid=="admin" || $userid==$ripple_id)
			          echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>"; 
			  ?>
			</li>
			</ul>
			</div>
			<div id="ripple_content"><?=$ripple_content?></div>
			<div class="hor_line_ripple"></div>
<?
		}
?>			
			<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
			<div id="ripple_box">
				<div id="ripple_box1">[댓글쓰기]<!--img src="img/title_comment.gif">--></div>
				<div id="ripple_box2"><textarea rows="5" cols="65" name="ripple_content"></textarea>
				</div>
				<div id="ripple_box3"><a href="#"><img src="img/ok_ripple.gif"  onclick="check_input()"></a></div>
			</div>
			</form>
		</div> <!-- end of ripple -->

		<div id="view_button">
				<a href="list.php?table=<?=$table?>&page=<?=$page?>"><img src="img/list.png"></a>&nbsp;
<? 
//$_SESSION['userid'] 
$userid=$_SESSION['userid'];
$item_id=$_SESSION['userid'];
	if($userid && ($userid==$item_id))
	{
?>
				<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>"><img src="img/modify.png"></a>&nbsp;
				<a href="javascript:del('delete2.php?table=<?=$table?>&num=<?=$num?>')"><img src="img/delete.png"></a>&nbsp;
<?
	}
?>
<? 
	if($userid)
	{
?>
				<a href="write_form.php?table=<?=$table?>"><img src="img/write.png"></a>
<?
	}
?>
		</div>
		<div class="clear"></div>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
