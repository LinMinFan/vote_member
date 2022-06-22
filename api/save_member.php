<?php
//連線資料庫
include "./function.php";
$pdo = pdo();
//會變更的數值只有暱稱、密碼
$acc = $_SESSION['user'];
$nick = $_POST['nick'];
//要比對的資料只有密碼與確認密碼，確認密碼一致就送出資料
//密碼為md5轉碼,比對時確認密碼先轉碼比對或比對後轉碼都可以(不使用預設值不須再判斷密碼是否變更)
$pw = md5($_POST['password']);
$chk_pw = md5($_POST['chk_password']);
echo $pw;
echo $chk_pw;
if($pw == $chk_pw){
    $sql="UPDATE `vote_member_users` SET `nick`='$nick',`password`='$pw' WHERE `account`='$acc';";
    $pdo->exec($sql);
    //header('location:../member_center.php');
    to('../member_center.php');
}else{
    //header("location:../member_center.php?edit=activ&error=確認密碼錯誤");
    to('../member_center.php?edit=activ&error=確認密碼錯誤');
}

?>