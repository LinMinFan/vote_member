<?php

//連線資料庫
include "./function.php";
$pdo = pdo();

//若無session直接導向登入頁不停留此頁
if (!isset($_SESSION['user'])) {
    //header('location:/login.php');
    to('login.php');
}
$user_id = $_SESSION['id'];
$account = $_SESSION['user'];
//若session非管理者回使用者投票中心
//SELECT * FROM `vote_member_admin` WHERE `user_id` = '$user_id' && `account` = '$account'
$chk_sql = "SELECT * FROM `vote_member_admin` WHERE `user_id` = '$user_id' && `account` = '$account'";
$chk_acc = $pdo->query($chk_sql)->fetchColumn();
if ($chk_acc == 0) {
    to('vote_center.php');
}


//取得要刪除主題id
$subject_id = $_GET['subject'];

//vote_member_subjects資料表主題刪除
//DELETE FROM `vote_member_subjects` WHERE `admin` = '$admin_id' && `id` = '$subject_id'
//vote_member_options資料表選項刪除
//DELETE FROM `vote_member_options` WHERE `subject_id` = '$subject_id'
//vote_member_log資料表投票紀錄刪除
//DELETE FROM `vote_member_log` WHERE `subject_id` = '$subject_id'
    $dlsubsql = "DELETE FROM `vote_member_subjects` WHERE  `id` = '$subject_id'";
    $dloptsql = "DELETE FROM `vote_member_options` WHERE `subject_id` = '$subject_id'";
    $dllogsql = "DELETE FROM `vote_member_log` WHERE `subject_id` = '$subject_id'";
    $pdo->exec($dlsubsql);
    $pdo->exec($dloptsql);
    $pdo->exec($dllogsql);
    //回到主題管理頁
    //header('../vote_admin.php');
    to('../vote_admin.php');


?>
