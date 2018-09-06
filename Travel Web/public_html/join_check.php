
<html>
   <meta charset="utf-8">
<?php include_once $_SERVER["DOCUMENT_ROOT"]."./DataBase.php"; ?>
<?
    header('Content-Type: text/html; charset=utf-8');
    $id = $_POST['id'];
    $password = $_POST['pwd'];
    $name = $_POST['name'];
    $sql = "insert into userinfo(uid,upassword,uname) values ('$id','$password','$name')";
    $data = Database::getInstance()->query($sql);  

    if($data!=null){
        echo "success";
    }
    else
        echo "실패";
    
    mysqli_close($conn);

?>
<input type="button" value="로그인하러가기" onclick="location='login.php'">
</html>
