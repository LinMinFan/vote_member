<?php
//連線資料庫
include "./function.php";
$pdo = pdo();
//檢查帳號信箱是否正確
$acc = $_POST['account'];
$email = $_POST['email'];
//驗證帳號沒有存在1存在0不存在
//$chk_acc = "SELECT count(*) FROM `member_users` WHERE `account`='$acc';";
$chk_acc = "SELECT count(*) FROM `vote_member_users` WHERE `account`='$acc';";
$chk_a = $pdo->query($chk_acc)->fetchColumn();
//驗證信箱沒有存在1存在0不存在
//$chk_email = "SELECT count(*) FROM `member_users` WHERE `account`='$acc' && `email`='$email';";
$chk_email = "SELECT count(*) FROM `vote_member_users` WHERE `account`='$acc' && `email`='$email';";
$chk_e = $pdo->query($chk_email)->fetchColumn();
//密碼將變更為1234轉碼後儲存
$pw = md5("1234");
if (empty($chk_a)) {
    //header('location:forgot.php?error=帳號不存在');
    to('../forgot.php?error=輸入帳號不存在');
} else if (empty($chk_e)) {
    //header('location:forgot.php?error=信箱不存在');
    to('../forgot.php?error=輸入信箱不存在');
} else {
    //變更密碼sql語法
    $sql="UPDATE `vote_member_users` SET `password`='$pw' WHERE `account`= '$acc';";
    $pdo->exec($sql);
    //header('location:login.php?update=ok');
    to('../login.php?error=密碼已變更1234');
}

?>