<?php
//連線資料庫
include "./function.php";
$pdo = pdo();

//取得要刪除主題id 再次確認session['id'] = subject_admin 避免網址傳值刪除
$subject_id = $_GET['subject'];
$admin_id = $_SESSION['id'];

//語法SELECT * FROM `vote_member_subjects` WHERE `admin` = '$admin_id' && `id` = '$subject_id'
$chk_sql = "SELECT COUNT(*) FROM `vote_member_subjects` WHERE `admin` = '$admin_id' && `id` = '$subject_id'";
$chk_again = $pdo->query($chk_sql)->fetchColumn();

//0表示非發起者且非正常路徑則回投票中心首頁1則刪除
//vote_member_subjects資料表主題刪除
//DELETE FROM `vote_member_subjects` WHERE `admin` = '$admin_id' && `id` = '$subject_id'
//vote_member_options資料表選項刪除
//DELETE FROM `vote_member_options` WHERE `subject_id` = '$subject_id'
//vote_member_log資料表投票紀錄刪除
//DELETE FROM `vote_member_log` WHERE `subject_id` = '$subject_id'
if ($chk_again > 0) {
    $dlsubsql = "DELETE FROM `vote_member_subjects` WHERE `admin` = '$admin_id' && `id` = '$subject_id'";
    $dloptsql = "DELETE FROM `vote_member_options` WHERE `subject_id` = '$subject_id'";
    $dllogsql = "DELETE FROM `vote_member_log` WHERE `subject_id` = '$subject_id'";
    $pdo->exec($dlsubsql);
    $pdo->exec($dloptsql);
    $pdo->exec($dllogsql);
    //回到刪除投票頁
    //header('../vote_center.php?delete=activ');
    to('../vote_center.php?delete=activ');
}else{
    to('../vote_center.php');
}

?>
