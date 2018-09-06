<?
    include"session.php";   //session.php파일을 포함
?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."./DataBase.php"; ?>
<?
    header('Content-Type: text/html; charset=utf-8');
    $query = "
     select * from information_schema.tables where table_schema='dbproject'
     ;";
    $result = Database::getInstance()->query($query);
?>

<doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<title>sign up page</title>
</head>
  
<body>
    <div data-role="header">
        <div style="overflow: hidden;" data-role="footer">
            <h4 style="text-align: center;">Home</h4>
            <div data-role="navbar">
                <ul>
                    <li><a href="./login.php">로그인</a></li>
                    <li><a href="./join.php">회원가입</a></li>
                    <li><a href="./orderlist.php">장바구니</a></li>
                </ul>
            </div><!-- /navbar -->     
        </div>        
    </div>
    
    
    
    <div data-role="content" name="category">
        <ul data-role="listview" data-inset="true">

<?			
    if (mysqli_num_rows($result) > 0){
        while ($value = mysqli_fetch_assoc($result)) {
            //print_r($value);
            $tablename=$value['TABLE_NAME'];
            if($tablename!="userinfo" && $tablename!="orderlist"){
?>
            <li>
              <a href="./listview.php?tablename=<?echo $tablename?>" rel="external">
                <img src="./<?echo $tablename?>.JPG" style="height: 100px;">
                <h2><?echo $tablename?></h2>
              </a>  
            </li>
<?
            }
        }
    }
?>		           
        </ul>
    </div>
    
    <div data-role="footer">
        <h1><?echo $_REQUEST['userid']?>안녕하세요</h1>
    </div>
</body>
</html>
