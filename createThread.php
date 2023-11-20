<?php

// データベースの情報を取得する
include_once('../database/connect.php');
include_once('../parts/thread_add.php');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規スレッド作成ページ</title>
  <link rel="stylesheet" href="../../style.css">
</head>

<body>

  <?php include('../../app/parts/header.php'); ?>

  <div style="color: blue; margin: 16px 32px;">
    <h2>新規スレッド立ち上げ場</h2>
  </div>

  <form method="POST" class="formWrapper" style="margin: 0 32px;">
    <div>
      <label>スレッド名</label>
      <input type="text" name="title">
      <label>名前</label>
      <input type="text" name="username">
    </div>
    <div>
      <textarea name="body" class="commentTextArea"></textarea>
    </div>
    <input type="submit" value="立ち上げ" name="threadSubmitButton">
  </form>
</body>

</html>