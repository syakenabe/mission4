<!DOCTYPE html> 
<html>
<head>
<meta charset = "utf-8">
</head>
<title>
</title>
<body>
<?php
//データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,ture);

//テーブルの作成
$sql = "CREATE TABLE board3"
."("
."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
."name char(32),"
."comment TEXT,"
."password char(32),"
."time TEXT"
.");";
$stmt = $pdo->query($sql);

echo テーブルを作成しました."<br>";

$sql = 'SHOW TABLES';
$result = $pdo -> query($sql);
foreach ($result as $row){
	echo $row[0];
	echo '<br>';
};
echo"<hr>";


?>
</body>
</html>