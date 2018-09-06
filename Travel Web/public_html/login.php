<doctype html>
<html>
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, user-scalable=no">
<title>sign up page</title>
</head>
<body>
<h1>login</h1>
    <form  method="post" action="login_check.php" >
            ID : <input type="text" name="id" /><br />
            PASSWORD : <input type="password" name="password" /><br />
            <input type="submit" value="login"/>
            <input type="button" name ="버튼" value="회원가입" onclick="location.href='http://localhost/join.php'";>
    </form>
</body>
</html>
