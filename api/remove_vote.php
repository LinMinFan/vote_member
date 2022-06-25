<?php
//連線資料庫
include "./function.php";
$pdo = pdo();

//取得要刪除主題id 再次確認session['id'] = subject_admin 避免網址傳值刪除
$subject_id = $_GET['subject'];
$admin_id = $_SESSION['id'];

//需刪除資料包括主題 選項 紀錄

//刪除資料
//sql語法DELETE FROM `vote_member_subjects` WHERE `id` = subject_id &&
//$pdo->exec();


//回到刪除投票頁
//header('../vote_center.php?delete=activ');
to('../vote_center.php?delete=activ');

?>
