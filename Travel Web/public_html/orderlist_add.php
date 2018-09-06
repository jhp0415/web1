<?
    include"session.php";   //session.php파일을 포함
?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."./DataBase.php"; ?>
<?
    header('Content-Type: text/html; charset=utf-8');

    $query = "insert into orderlist(userid, type, tid) values('$_SESSION[ses_username]', '$_REQUEST[table]', '$_REQUEST[no]')";
echo $query;
    $result = Database::getInstance()->query($query);

    $query2 = "select * from userinfo;";
    $search = Database::getInstance()->query($query2);

$query3 = "select * from $_REQUEST[table] where no=$_REQUEST[no];";
$result2 = Database::getInstance()->query($query3);

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
            if($_SESSION['ses_username']==$value['uid']){
?>
        <div data-role="navbar">
            <ul data-role="listview" data-inset="true">
                <li><?echo $value['uno']?></li>
                <li><?echo $value['uid']?></li>
                <?
                if (mysqli_num_rows($result2) > 0){
                while ($item = mysqli_fetch_assoc($result2)) {
                    echo '<li><img src="';echo $item['image_url']; echo '" width=100 height=100></li>';
                    echo '<li>'; echo $item['name']; echo '</li>';
                    //echo '<h1>'$value['name']'</h1>';
                    }
                }
                ?>
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
