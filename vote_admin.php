<?php
//連線資料庫讀取全部投票主題選項資料
include "./api/function.php";
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

//抓取分類資料
$types = all('vote_member_type');

//定義今日秒數
$today = date(strtotime('today'));

//以登入的session抓取會員資料
//$sql ="SELECT * FROM `vote_member_users` WHERE `account`='{$_SESSION['user']}'";
//$dateall = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
//$date = ['account' => $_SESSION['user']];
//$dateall = all('vote_member_users', $date);
$dateall = find('vote_member_users', $_SESSION['id']);

//讀取現有圖片位置
//圖片一
$p1sql = "SELECT * FROM `vote_member_image` WHERE `id` = '1'";
$p1Url = $pdo->query($p1sql)->fetch(PDO::FETCH_ASSOC);
//dd($p1Url);
$min_img1 = $p1Url['min_url'];
//圖片二
$p2sql = "SELECT * FROM `vote_member_image` WHERE `id` = '2'";
$p2Url = $pdo->query($p2sql)->fetch(PDO::FETCH_ASSOC);
$min_img2 = $p2Url['min_url'];
//圖片三
$p3sql = "SELECT * FROM `vote_member_image` WHERE `id` = '3'";
$p3Url = $pdo->query($p3sql)->fetch(PDO::FETCH_ASSOC);
$min_img3 = $p3Url['min_url'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理中心</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/vote_center.css">
    <link rel="stylesheet" href="./css/vote_center_create.css">
    <link rel="stylesheet" href="./css/vote_center_admin.css">
    <link rel="stylesheet" href="./css/vote_center_photo.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">

</head>

<body>
    <div class="background">

    </div>
    <div class="header">
        <?php
        include "./layout/header.php";
        ?>
    </div>
    <div class="section">
        <?php
        if(isset($_GET['photo'])){
            include "./admin/section_vote_photo.php";
        }else {
            include "./admin/section_vote_admin.php";
        }
        ?>
    </div>
    <div class="footer">
        <?php
        include "./layout/footer.php";
        ?>
    </div>

</body>

</html>