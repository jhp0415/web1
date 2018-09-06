<?
    include"session.php";   //session.php파일을 포함
?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."./DataBase.php"; ?>
<?
    header('Content-Type: text/html; charset=utf-8');
   
    $query = "select * from orderlist";
    $search = Database::getInstance()->query($query);
?>


<doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <style>
        ul{list-style-type:none; margin: 0; padding: 0;}
        li {float:left; text-align : center}

    </style>
<title>sign up page</title>
</head>
<body>

    <div data-role="content"> 
     
<?			
    if (mysqli_num_rows($search) > 0){
        while ($value = mysqli_fetch_assoc($search)) {
            if($_SESSION[ses_username] == $value['userid']){
?>
        <div data-role="navbar">
            <ul data-role="listview" data-inset="true">
                <li><?echo $value['no']?></li>
                <li><?echo $value['userid']?></li>
                <li><?echo $value['type']?></li>
                <li><?echo $value['tid']?></li>
            </ul>     
        </div>

<?
            }
        }
    }
?>		
                 
        
    </div>
</body>
</html>
