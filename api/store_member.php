<?php
//連線資料庫
include "./function.php";
$pdo = pdo();
//先比對確認密碼正確再檢查欄位是否都有填寫
$acc = $_POST['account'];
$nick = $_POST['nick'];
$name = $_POST['name'];
//密碼使用MD5轉碼
//$pw=md5($_POST['pw']);
$pw = md5($_POST['password']);
$chk_pw = md5($_POST['chk_password']);
$email = $_POST['email'];
//驗證帳號沒有重複1重複0不重複
$chk_acc = "SELECT count(*) FROM `vote_member_users` WHERE `account`='$acc';";
$chk_a = $pdo->query($chk_acc)->fetchColumn();
//驗證信箱沒有重複1重複0不重複
$chk_email = "SELECT count(*) FROM `vote_member_users` WHERE `email`='$email';";
$chk_e = $pdo->query($chk_email)->fetchColumn();
//密碼與確認密碼是否一致
if ($pw != $chk_pw) {
    //header('location:register.php?error=確認密碼錯誤');
    to('../register.php?error=確認密碼錯誤');
}else if (!empty($chk_a)) {
    //header('location:register.php?error=帳號已是會員');
    to('../register.php?error=帳號已是會員');
}else if (!empty($chk_e)) {
    //header('location:register.php?error=信箱已註冊會員');
    to('../register.php?error=信箱已註冊會員');
}else{
    //新增會員資料sql語法
    $sql = "INSERT INTO `vote_member_users` (`account`,`password`,`nick`,`name`,`email`) 
        values('$acc','$pw','$nick','$name','$email');";
    
    $pdo->exec($sql);
    
    //header('location:login.php');
    to('../login.php');
}
