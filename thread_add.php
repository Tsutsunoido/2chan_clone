<?php

$error_message = array();

// ユーザーが送信したら実行される命令
if (isset($_POST['threadSubmitButton'])) {

  if (empty($_POST['title'])) {
    $error_message['title'] = "スレッド名を入力したください";
  } else {
    $escaped["title"] = htmlspecialchars($_POST["title"], ENT_QUOTES, "UTF-8");
  }

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
    $sql = "INSERT INTO `thread` (`title`) VALUES (:title);";
    $statement = $pdo->prepare($sql);

    // 値をセットする
    $statement->bindParam(":title", $escaped["title"], PDO::PARAM_STR);

    $statement->execute();

    $sql = "INSERT INTO comment (username, body, post_date, thread_id) VALUES (:username, :body, :post_date, (SELECT id FROM thread WHERE title = :title))";
    $statement = $pdo->prepare($sql);

    // 値をセット
    $statement->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
    $statement->bindParam(":body", $escaped["body"], PDO::PARAM_STR);
    $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
    $statement->bindParam(":title", $escaped["title"], PDO::PARAM_STR);

    $statement->execute();

    // 掲示板ページに遷移する
    header('Location: http://localhost:80/keijibann/index.php');
  }
}
