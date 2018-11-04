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

$del_num = $_POST["del_num"];
$password2 = $_POST["password2"];

//投稿番号
$sql = $pdo->prepare("SELECT id FROM board3 WHERE id='$hensyu_num'");
$sql->execute();
$result1 = $sql->fetch(PDO::FETCH_ASSOC);


//対象の番号が数字であるか
if($hensyu_num === $result1['id']){

		//パスワードの確認
		$del_num = intval($del_num);
		$sql = $pdo->prepare("SELECT id, name, comment, password FROM board3 WHERE id='$del_num'");
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_ASSOC);

		$password2 = intval($password2);
		$result['password'] = intval($result['password']);
		
		if ( $password2 === $result['password']){
			$id = $del_num;
			$sql = "delete from board3 where id='$id'";
			$result = $pdo->query($sql);

		}else{
			echo パスワードが違います。."<br>";
			echo '<form action = "mission_4.php" method = "post">'."<br>";
			echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
			echo '</form>';
			exit();
		};
	
}else{
	echo 削除対象番号がありません。."<br>";
	echo '<form action = "mission_4.php" method = "post">'."<br>";
	echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
	echo '</form>';
	exit();

};	
header("Location:http://tt-575.99sv-coco.com/mission_4.php");
?>

</body>
</html>