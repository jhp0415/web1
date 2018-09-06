<?
    include"session.php";   //session.php파일을 포함
?>
 
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>DB</title>
  </head>
<body>
    <div data-role="header"></div>
    <div data-role="content">
        
   <?php include_once $_SERVER["DOCUMENT_ROOT"]."./DataBase.php"; ?>
<?
    header('Content-Type: text/html; charset=utf-8');
        $memberId = $_POST['id'];
        $memberPw = $_POST['password'];

        $query = "SELECT * FROM userinfo WHERE uid = '$memberId' and upassword = '$memberPw'"; //my sqli 연결의 끈을 생성시키고, 쿼리를 실행
          //고른다 모든것 member테이블로부터 id와 pwd가 일치하는 것을
        //$res = mysqli_query($conn,$sql); //실행결과는 $res에 저장
        $data = Database::getInstance()->query($query);  
        $row = mysqli_fetch_array($data);

        if ($row != null) {       //만약 배열에 존재한다면
            $_SESSION['ses_username'] = $row[3];    // 세션을 만들어준다. 
            echo $_SESSION['ses_username'].'님 안녕하세요<p/>';   // name님 안녕하세요.
            echo '<a href="./index.php?userid='; echo $_SESSION['ses_username']; echo '">홈으로</a><br/>';
            echo '<a href="./logout.php">로그아웃 하기</a>';  //로그아웃 페이지 링크.
        }

        if($row == null){       
            echo "틀렸습니다.";//만약 배열에 아무것도 없다면
         //echo("<script>location.href='RSDB_starterror.php';</script>");          //애러 화면으로 넘김
        }
    ?>
    </div>
    
    </body>
</html>