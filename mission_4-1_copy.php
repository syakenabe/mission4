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

//投稿番号の取得
$hensyu_num = $_POST["hensyu_num"];
$password3 = $_POST["password3"];

$sql = $pdo->prepare("SELECT id FROM board3 WHERE id='$hensyu_num'");
$sql->execute();
$result1 = $sql->fetch(PDO::FETCH_ASSOC);

//対象の番号の投稿が存在するか
if ( $hensyu_num === $result1['id'] ){
	//編集対象の内容を取得
	$hensyu_num = intval($hensyu_num);;
	$sql = $pdo->prepare("SELECT id, name, comment, time, password FROM board3 WHERE id='$hensyu_num'");
	$sql->execute();
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	
	//パスワードの確認
	$password3 = intval($password3);
	$result['password'] = intval($result['password']);
	if( $password3 !== $result['password']){			
		echo パスワードが違います。;
		echo "<br>";
		echo '<form action = "mission_4.php" method = "post">'."<br>";
		echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
		echo '</form>';
		exit();
	};
		
}else{
echo 編集対象番号がありません。."<br>";
echo '<form action = "mission_4.php" method = "post">'."<br>";
echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
echo '</form>';
exit();
};

?>
<!--入力フォーム-->
<form action = "mission_4.php" method = "post">

内容を編集してください

<p> 名前	:<br>
<input type = "text" 
 value = <?php echo $result['name']; ?> 
 name = "Re_name"></p>

<p> コメント	:<br>
<input type = "text"
 value = <?php echo $result['comment']; ?>
 name = "Re_comment"></p>

<input type = "hidden" 
 value = <?php echo $result['password']; ?> 
 name = "Re_password"></p>

<input type = "hidden" 
 value =  <?php echo $result['id'];?>
 name = "Re_id"></p>

<p><input type = "submit" value = "編集"></p>
</form>

</body>
</html>
</body>
</html>