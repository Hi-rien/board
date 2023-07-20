<? 
	session_start(); 
	$table = "free";
	$ripple = "free_ripple";
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


  <?
	include "dbconn.php";


	$mode = $_GET['search'];
	$page = $_GET['page'];
 $num = $_GET['num'];


	$find = $_POST['find'];
	$search = $_POST['search'];


   if (isset($_GET["mode"]))
   $mode = $_GET["mode"];
 else
   $mode = "";


	$scale=10;			// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}
		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysqli_query( $connect,$sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>

  <div id="wrap">


    <div id="content">


      <div id="col2">
        <!-- <div id="title">
			<img src="img/title_free.gif">
		</div> -->

        <form name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search">
          <div id="list_search">
            <div id="list_search1">▷ 총 <?= $total_record ?> 개의 게시물이 있습니다. </div>
            <div id="list_search2"><img src="img/select_search.gif"></div>
            <div id="list_search3">
              <select name="find">
                <option value='subject'>제목</option>
                <option value='content'>내용</option>
                <option value='nick'>별명</option>
                <option value='name'>이름</option>
              </select>
            </div>
            <div id="list_search4"><input type="text" name="search"></div>
            <div id="list_search5"><input type="image" src="img/list_search_button.gif"></div>
          </div>
        </form>
        <div class="clear"></div>

        <div id="list_top_title">
          <ul>
            <li id="list_title1"><img src="img/list_title1.gif"></li>
            <li id="list_title2"><img src="img/list_title2.gif"></li>
            <li id="list_title3"><img src="img/list_title3.gif"></li>
            <li id="list_title4"><img src="img/list_title4.gif"></li>
            <li id="list_title5"><img src="img/list_title5.gif"></li>
          </ul>
        </div>

        <div id="list_content">
          <?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysqli_data_seek($result, $i);     // 포인터 이동        
      $row = mysqli_fetch_array($result); // 하나의 레코드 가져오기	      
      
	  $item_num     = $row['num'];
	  $item_id      = $row['id'];
	  $item_name    = $row['name'];
  	  $item_nick    = $row['nick'];
	
	  $item_hit     = $row['hit'];
      $item_date    = $row['regist_day'];
	  $item_date = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row['subject']);

	  $sql = "select * from $ripple where parent=$item_num";
	  $result2 = mysqli_query( $connect,$sql);
	  $num_ripple = mysqli_num_rows($result2);

?>
          <div id="list_item">
            <div id="list_item1"><?= $number ?></div>
            <div id="list_item2"><a
                href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a>
              <?
		if ($num_ripple)
				echo " [$num_ripple]";
?>
            </div>
            <div id="list_item3"><?= $item_nick ?></div>
            <div id="list_item4"><?= $item_date ?></div>
            <div id="list_item5"><?= $item_hit ?></div>
          </div>
          <?
   	   $number--;
   }
?>
          <div id="page_button">
            <div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp;
              <?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{ 
			echo "<a href='list.php?table=$table&page=$i'> $i </a>";
		}      
   }
?>
              &nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
            </div>
            <div id="button">
              <a href="list.php?table=<?=$table?>&page=<?=$page?>"><img src="img/list.png"></a>&nbsp;
              <? 
	// if($userid)
	if($_SESSION['userid'] )
	{
?>
              <a href="write_form.php?table=<?=$table?>"><img src="img/write.png"></a>
              <?
	}
?>
            </div>
          </div> <!-- end of page_button -->
        </div> <!-- end of list content -->
        <div class="clear"></div>

      </div> <!-- end of col2 -->
    </div> <!-- end of content -->
  </div> <!-- end of wrap -->

</body>

</html>