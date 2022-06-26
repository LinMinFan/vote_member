<?php
//連線資料庫
include "./function.php";
$pdo = pdo();
//取得要刪除帳號
$acc = ['account' => $_SESSION['user']];
//刪除資料sql語法

//$sql="DELETE FROM `vote_member_users` WHERE `account` = '$acc'";
//$pdo->exec($sql);

del('`vote_member_users`',$acc);

//帳號刪除連同投票主題紀錄刪除
//須建立語法
//DELETE FROM `vote_member_subjects` WHERE `admin`= '$admin_id'
//DELETE FROM `vote_member_options` WHERE `subject_id`
//DELETE FROM `vote_member_note` WHERE `subject_id`
//DELETE FROM `vote_member_log` WHERE `user_id`= '$admin_id'

//先抓出所有subject_id
$admin_id = $_SESSION['id'];
$subjects_sql = "SELECT * FROM `vote_member_subjects` WHERE `admin` = '$admin_id'";
$subjects = $pdo->query($subjects_sql)->fetchAll(PDO::FETCH_ASSOC);
//dd($subjects);
foreach ($subjects as $sub_id) {
    $subject_id = $sub_id['id'];
    $options_sql = "DELETE FROM `vote_member_options` WHERE `subject_id` = '$subject_id'";
    $note_sql = "DELETE FROM `vote_member_note` WHERE `subject_id` = '$subject_id'";
    $pdo->exec($options_sql);
    $pdo->exec($note_sql);
}
$log_sql = "DELETE FROM `vote_member_log` WHERE `user_id`= '$admin_id'";
$pdo->exec($log_sql);
$subjects_del = "DELETE FROM `vote_member_subjects` WHERE `admin`= '$admin_id'";
$pdo->exec($subjects_del);


unset($_SESSION['user']);
unset($_SESSION['id']);
unset($_SESSION['nick']);

//header('location:../login.php');
to('../login.php');

?>
