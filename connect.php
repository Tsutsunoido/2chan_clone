<?php

// 以下の$userと$passの値は、初めから設定されているものです。
$user = 'root';
$pass = '';

// DBと接続
try {
  $pdo = new PDO('mysql:host=localhost;dbname=keijibann', $user, $pass);
  // echo 'DBとの接続に成功しました。';
} catch (PDOException $error) {
  echo $error->getMessage();
}