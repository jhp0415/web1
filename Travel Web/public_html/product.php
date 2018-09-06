<?php include_once $_SERVER["DOCUMENT_ROOT"]."./DataBase.php"; ?>
<?
    header('Content-Type: text/html; charset=utf-8');
  $query = "select * from $_REQUEST[table] where no='$_REQUEST[no]';";

  $data = Database::getInstance()->query($query);  
?>
<doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
   
<title>상품 보여주기</title>
</head>
<?
    $rowVal = mysqli_fetch_array($data)
?>
<body>
    <div data-role="header">
        <h1><?echo $rowVal['name']?></h1>
            <a href="./orderlist_add.php?table=<?echo $_REQUEST['table']?>&no=<?echo $_REQUEST['no']?>" class="ui-btn ui-icon-arrow-r ui-btn-icon-notext ui-corner-all"></a>
            
    </div>
    
    
    <div data-role="content">
    <div data-role="navbar">
        <img src="<?echo $rowVal['image_url']?>" width=500 height=500 align="center">
			<ul data-role="listview" data-inset="true" >
                <li>주소</li><li ><?echo $rowVal['address']?></li>
                <li>전화번호</li><li ><?echo $rowVal['phone']?></li>
                <li>주차</li><li ><?echo $rowVal['park']?></li>
                <li>홈페이지</li><li ><?echo $rowVal['homepage']?></li>
                <li>마일리지</li><li ><?echo $rowVal['mileage']?></li>
            </ul>
        </div>
      
        <div>
        <ul data-role="listview" data-inset="true" >
            <li>소개</li><li ><?echo $rowVal['intro']?></li>
            <li>exc</li><li ><?echo $rowVal['exc']?></li>
            </ul>
        </div>
        
</div>   
</body>
</html>
