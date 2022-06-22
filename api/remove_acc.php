<?php
//連線資料庫
include "./function.php";
$pdo = pdo();

//取得要刪除帳號
$acc = ['account' => $_SESSION['user']];

//刪除資料sql語法
//$sql="DELETE FROM `vote_member_users` where `account`='$acc'";
//$pdo->exec($sql);

del('`vote_member_users`',$acc);

unset($_SESSION['user']);
unset($_SESSION['id']);
unset($_SESSION['nick']);

//header('location:../login.php');
to('../login.php');

?>
