<?php

if(!isset($_POST['nickname'])){
    exit('非法访问!');
}

$nickname = htmlspecialchars(trim($_POST['nickname']));
$email = htmlspecialchars(trim($_POST['email']));
$content = htmlspecialchars(trim($_POST['content']));


require("./conn.php");
$createtime = time();
$insert_sql = "INSERT INTO guestbook(nickname,email,content,createtime)VALUES";
$insert_sql .= "('$nickname','$email','$content',$createtime)";
if(mysql_query($insert_sql)){
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="2;url=index.php">
<title>留言成功</title>
</head>
<body>
<div class="refresh">
<p>留言成功！非常感谢您的留言。<br />请稍后，页面正在返回...</p>
</div>
</body>
</html>
<?php
} else {
	echo '留言失败：',mysql_error(),'[ <a href="javascript:history.back()">返 回</a> ]';
}
?>