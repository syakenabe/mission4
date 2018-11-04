<!DOCTYPE html> 
<html>
<head>
<meta charset = "utf-8">
</head>
<title>
</title>
<body>

<h4> 新規投稿　</h4>
<form action = "mission_4.php" method = "post">
<p>
<input type = "text" placeholder = "名前" name = "name">
</p>

<p>
<textarea name = "comment" rows ="4" cols"60">コメントを入力してください。 
</textarea>
</p>
<p>
<input type = "text" placeholder = "パスワード" name = "password1">
<input type = "submit" value = "送信">
</p>
</form>

<h4>削除フォーム</h4>
<form action = "mission_4-2.php" method = "post">
<p> 
<input type = "text" placeholder= "削除対象番号" name = "del_num">
</p>
<p>
<input type = "text" placeholder = "パスワード" name = "password2">
<input type = "submit" value = " 削除">
</p>
</form>

<form action = "mission_4-1.php" method = "post">


<h4>編集フォーム</h4>
<p>
<input type = "text" placeholder = "編集対象番号"  name = "hensyu_num">
</p>
<p>
<input type = "text" placeholder = "パスワード" name = "password3">
<input type = "submit" value = "編集">
</p>
</form>




<?php
//データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,ture);

//内容の入力

if(!empty($_POST["name"]) and !empty($_POST["comment"])){
	//パスワードの入力チェック
	if(empty( $_POST["password1"] )){
		echo パスワードが未入力です。."<br>";
	}else{
		
		$sql = $pdo -> prepare("INSERT INTO board3 (name,comment,password,time) VALUES (:name,:comment,:password,:time)");
		$sql -> bindParam(':time',$time,PDO::PARAM_STR);
		$sql -> bindParam(':name',$name,PDO::PARAM_STR);
		$sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
		$sql -> bindParam(':password',$password,PDO::PARAM_STR);
		$time = date("Y/m/d H:i:s");		
		$password = $_POST["password1"];
		$name = $_POST["name"];
		$comment = $_POST["comment"];
		$sql -> execute();
	};
}else{
	echo 名前またはコメントが未入力です."<br>";
	echo "<br>";
};	

//編集内容の書き換え
$Re_name = $_POST["Re_name"];
$Re_comment = $_POST["Re_comment"];
$Re_id = $_POST["Re_id"];
$Re_password = $_POST["Re_password"];
$time = date("Y/m/d H:i:s");
if(!empty($_POST["Re_name"]) and !empty($_POST["Re_comment"])){

	$sql = "update board3 set name ='$Re_name',comment='$Re_comment',password='$Re_password',time='$time' where id =$Re_id";
	$result = $pdo->query($sql);

}	
?>



<h3>投稿内容</h3>
<?php
//内容の表示
$sql = $pdo->prepare('SELECT id, name, comment, time FROM board3 ORDER BY id ASC');
$sql->execute();
$content = $sql->fetchAll();
foreach($content as $row){
	echo $row['id'];
	echo "　　投稿名:";
	echo $row['name'];
	echo "　　投稿時間:";
	echo $row['time'];
	echo "<br>";
	echo nl2br($row['comment']).'<br>';
}


 ?>