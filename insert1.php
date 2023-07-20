<? 
session_start();
$table = "free";
$ripple = "free_ripple";
 ?>

<meta charset="utf-8">
<?

$mode = $_GET['modify'];
  $num = $_GET['num'];
  $userid=$_POST['userid'];
  $username=$_SESSION['username'];
  $usernick=$_SESSION['usernick'];
  $subject=$_POST['subject'];
  $content=$_POST['content'];
  $regist_day=$_POST['regist_day'];
 $is_html=$_POST['is_html'];


	//if(!$userid) {
		if(!$_SESSION['userid']){
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	// 다중 파일 업로드
	$files = $_FILES["upfile"];
	$count = count($files["name"]);
	$upload_dir = './data/';

	for ($i=0; $i<$count; $i++)
	{
		$upfile_name[$i]     = $files["name"][$i]; // 업로드된 파일명
		$upfile_tmp_name[$i] = $files["tmp_name"][$i]; // 실제 서버에 저장되는 임시파일명
		$upfile_type[$i]     = $files["type"][$i]; // 업로드 파일 형식
		$upfile_size[$i]     = $files["size"][$i]; // 업로드 파일 크기
		$upfile_error[$i]    = $files["error"][$i]; //에러 발생여부 확인
		
		$file = explode(".", $upfile_name[$i]);
		// explode("A", B) : A을 기준으로 B 분리
		$file_name = $file[0];
		$file_ext  = $file[1];
		
		// 이미지 파일이 실제로 서버에 저장될 때는 동일한 파일명이 등록되지 않도록 파일명을 따로 정한다.
		if (!$upfile_error[$i])
		{
			$new_file_name = date("Y_m_d_H_i_s");
			$new_file_name = $new_file_name."_".$i;
			$copied_file_name[$i] = $new_file_name.".".$file_ext;      
			$uploaded_file[$i] = $upload_dir.$copied_file_name[$i];

			if( $upfile_size[$i]  > 500000 ) {
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
				exit;
			}

/*
 if (!(ext == "gif" || ext == "jpg" || ext == "png")) {
        alert("이미지파일 (.jpg, .png, .gif ) 만 업로드 가능합니다.");
        return false;
    }
*/

			if ( ($upfile_type[$i] != "image/gif") &&
				($upfile_type[$i] != "image/jpeg") &&
				($upfile_type[$i] != "image/png") )
			{
				echo("
					<script>
						alert('JPG와 PNG GIF 이미지 파일만 업로드 가능합니다!');
						history.go(-1)
					</script>
					");
				exit;
			}

			if (!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i]) )
			{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
	include "dbconn.php";       // dconn.php 파일을 불러옴


	$mode = $_GET['modify'];
	$page = $_GET['page'];
	$num=$_GET['num'];
	// $find = $_POST['find'];
	// $search = $_POST['search'];


   if (isset($_GET["mode"]))
   $mode = $_GET["mode"];
 else
   $mode = "";

	if ($mode=="modify")
	{
		$num_checked = count($_POST['del_file']);
		$position = $_POST['del_file'];

		for($i=0; $i<$num_checked; $i++)                      // delete checked item
		{
			$index = $position[$i];
			$del_ok[$index] = "y";
		}

		$sql = "select * from $table where num=$num";   // get target record
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_array($result);

		for ($i=0; $i<$count; $i++)					// update DB with the value of file input box
		{

			$field_org_name = "file_name_".$i;
			$field_real_name = "file_copied_".$i;

			$org_name_value = $upfile_name[$i];
			$org_real_value = $copied_file_name[$i];
			if ($del_ok[$i] == "y")
			{
				$delete_field = "file_copied_".$i;
				$delete_name = $row[$delete_field];				
				$delete_path = "./data/".$delete_name;

				unlink($delete_path);

				$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
				mysqli_query($connect,$sql,);  // $sql 에 저장된 명령 실행
			}
			else
			{
				if (!$upfile_error[$i])
				{
					$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
					mysqli_query( $connect,$sql);  // $sql 에 저장된 명령 실행					
				}
			}
		}
		$sql = "update $table set subject='$subject', content='$content' where num=$num";
		mysqli_query( $connect,$sql);  // $sql 에 저장된 명령 실행
	}
	else
	{
		if ($html_ok=="y")
		{
			$is_html = "y";
		}
		else
		{
			$is_html = "";
			$content = htmlspecialchars($content);
		}

		$sql = "insert into $table (id, name, nick, subject, content, regist_day, hit, is_html, ";
		$sql .= " file_name_0, file_name_1, file_name_2, file_copied_0,  file_copied_1, file_copied_2) ";
		$sql .= "values('$userid', '$username', '$usernick', '$subject', '$content', '$regist_day', 0, '$is_html', ";
		$sql .= "'$upfile_name[0]', '$upfile_name[1]',  '$upfile_name[2]', '$copied_file_name[0]', '$copied_file_name[1]','$copied_file_name[2]')";
		mysqli_query( $connect,$sql);  // $sql 에 저장된 명령 실행
	}
	mysqli_close($connect);                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'list.php?table=$table&page=$page';
	   </script>
	";
?>

  
