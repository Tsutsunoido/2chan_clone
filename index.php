<?php

// データベースの情報を取得する
include_once('./app/database/connect.php');

$error_message = array();

// ユーザーが送信したら実行される命令
if (isset($_POST['submitButton'])) {

  // 名前またはコメントが未入力の時の処理
  if (empty($_POST['username'])) {
    $error_message['username'] = "名前を入力したください";
  } else {
    $escaped["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
  }
  if (empty($_POST['body'])) {
    $error_message['body'] = "コメントを入力してください";
  } else {
    $escaped["body"] = htmlspecialchars($_POST["body"], ENT_QUOTES, "UTF-8");
  }

  if (empty($error_message)) {

    $post_date = date("Y-m-d H:i:s");

    // データベースにユーザーが送信した内容を追加
    $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`, `thread_id`) VALUES (:username, :body, :post_date, :thread_id);";
    $statement = $pdo->prepare($sql);

    // 値をセットする
    $statement->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
    $statement->bindParam(":body", $escaped["body"], PDO::PARAM_STR); 
    $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
    $statement->bindParam(":thread_id", $_POST['threadID'], PDO::PARAM_STR);

    $statement->execute();
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>あたおか掲示板</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php include('./app/parts/header.php'); ?>
  <?php include('./app/parts/thread_get.php'); ?>
  <?php include('./app/parts/thread.php'); ?>
  <?php include('./app/parts/newThreadButton.php'); ?>

</body>

</html>