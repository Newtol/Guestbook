<?php

if(!isset($_COOKIE['username'])){
    exit('�Ƿ�����!');
}
?>


<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>���Թ���</title>
</head>
<body>
<?php
require("./conn.php");
require("./config.php");

$p = isset($_GET['p'])?$_GET['p']:1;
$offset = ($p-1)*$pagesize;
$query_sql = "SELECT * FROM guestbook ORDER BY id DESC LIMIT  $offset , $pagesize";
$result = mysql_query($query_sql);
if(!$result) exit('��ѯ���ݴ���'.mysql_error());

while($gb_array = mysql_fetch_array($result)){
    echo $gb_array['nickname'],'&nbsp;';
    echo '�����ڣ�',date("Y-m-d H:i:s", $gb_array['createtime']);
	echo ' ID�ţ�',$gb_array['id'],'<br />';
    echo '���ݣ�',nl2br($gb_array['content']),'<br />';
	
?>
<div id="reply">
<form id="form1" name="form1" method="post" action="reply.php">
<p><label for="reply">�ظ���������:</label></p>
<textarea id="reply" name="reply" cols="40" rows="5"><?=$gb_array['reply']?></textarea>
<p>
<input name="id" type="hidden" value="<?=$gb_array['id']?>" />
<input type="submit" name="submit" value="�ظ�����" />
<a href="reply.php?action=delete&id=<?=$gb_array['id']?>">ɾ������</a>
</p>
</form>
</div>
<?php
	echo "<hr />";
}

$count_result = mysql_query("SELECT count(*) FROM guestbook3");
$count_array = mysql_fetch_array($count_result);
$pagenum=ceil($count_array['count(*)']/$pagesize);
echo '�� ',$count_array['count(*)'],' ������';
if ($pagenum > 1) {
	for($i=1;$i<=$pagenum;$i++) {
		if($i==$p) {
			echo '&nbsp;[',$i,']';
		} else {
			echo '&nbsp;<a href="admin.php?p=',$i,'">'.$i.'</a>';
		}
	}
}
?>
</body>
</html>