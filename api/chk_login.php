<?php
//建立資料庫連線以include引入
//$dsn="mysql:host=localhost;charset=utf8;dbname=vote";
//$pdo=new PDO($dsn,'root','');
include "./function.php";
$pdo=pdo();
//檢查帳密是否正確
//接收帳號密碼傳值註冊時密碼以md5轉碼登入時也要先轉碼
//$pw = md5($_POST['password']);
$acc = $_POST['account'];
$pw = md5($_POST['password']);
//dd($acc);
//dd($pw);

/* if($acc==資料表中的account && $pw==資料表中的password){
    //登入成功->會員中心
}else if{
    //帳號錯誤->回到登入頁->顯示帳號錯誤
}else if{
    //密碼錯誤->回到登入頁->顯示密碼錯誤
}
 */


$chk_acc = "SELECT count(*) FROM `vote_member_users` WHERE `account`='$acc'";
$chk_pw = "SELECT count(*) FROM `vote_member_users` WHERE  `account`='$acc' && `password`='$pw'";


$useracc = $pdo->query($chk_acc)->fetchColumn();
$userpw = $pdo->query($chk_pw)->fetchColumn();

//測試回傳值 1 正確 / 0 錯誤或不存在
if (empty($useracc)) {
    //核對帳號
    //header('location:../login.php?error=帳號錯誤');
    to('../login.php?error=輸入帳號不存在');
} else if (empty($userpw)) {
    //核對密碼
    //header('location:../login.php?error=密碼錯誤');
    to('../login.php?error=輸入密碼有錯誤');
} else {
    //登入成功並使用帳號&&id&&nick設定session
    //$sql = "SELECT `id` FROM `vote_member_users` WHERE `account`='$acc'";
    //$id = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $chk_user = ['account' => $acc];
    $userdate = all('vote_member_users',$chk_user);
    //dd($dateall);
    $_SESSION['user'] = $acc;
    $_SESSION['id'] = $userdate[0]['id'];
    //header('location:../member_center.php');
    to('../member_center.php');
}
?>