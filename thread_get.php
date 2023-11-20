<?php
// データを入れるための変数
$thread_array = array();

// データベースから値を取得する
$sql = "SELECT * FROM thread";
$statement = $pdo->prepare($sql);
$statement->execute();

$thread_array = $statement;