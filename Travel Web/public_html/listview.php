<?
    include"session.php";   //session.php파일을 포함
?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."./DataBase.php"; ?>
<?
    header('Content-Type: text/html; charset=utf-8');
  $query = "select * from $_REQUEST[tablename];";
  $data = Database::getInstance()->query($query);  
?>

<doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <style>
        ul{list-style-type:none; margin: 0; padding: 0;}
        li {float:left; text-align : center}

    </style>
<title>리스트 보여주기</title>
</head>
<body>
    

<div data-role="content"> 
    <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Columns to display..." data-column-popup-theme="a">
        <div data-role="navbar">
			<ul data-role="listview" data-inset="true" >
              <li data-priority="1">번호</li>
              <li data-priority="2">이미지</li>
              <li data-priority="3">이름</li>
            </ul>
        </div>         
<?
  if (mysqli_num_rows($data) > 0){     
  while($rowVal = mysqli_fetch_array($data)) {
?>    
        <div data-role="navbar">
        <ul data-role="listview" data-inset="true">
            <a href="./product.php?table=<?echo $_REQUEST['tablename']?>&no=<?echo $rowVal['no']?>" rel="external">
                <li><?echo $rowVal['no']?></li>
                <li><img src="<?echo $rowVal['image_url']?>" width=100 height=100></li>
                <li><?echo $rowVal['name']?></li>
             </a>
        </ul>      
        </div>   
<?
  }
}
?>
    </table>
</div>
</body>
</html>


