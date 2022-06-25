<?php
//連線資料庫讀取全部投票主題選項資料
include "./api/function.php";
$pdo = pdo();

//若無session直接導向登入頁不停留此頁
if (!isset($_SESSION['user'])) {
    //header('location:/login.php');
    to('login.php');
}

//抓取資料
$subjects = all('vote_member_subjects');
$types = all('vote_member_type');
$options = all('vote_member_options');
$logs = all('vote_member_log');

//定義今日秒數
$today = date(strtotime('today'));

//以登入的session抓取會員資料
//$sql ="SELECT * FROM `vote_member_users` WHERE `account`='{$_SESSION['user']}'";
//$dateall = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
//$date = ['account' => $_SESSION['user']];
//$dateall = all('vote_member_users', $date);
$dateall = find('vote_member_users', $_SESSION['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票中心</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/vote_center.css">
    <link rel="stylesheet" href="./css/vote_center_default.css">
    <link rel="stylesheet" href="./css/vote_center_joined.css">
    <link rel="stylesheet" href="./css/vote_center_create.css">
    <link rel="stylesheet" href="./css/vote_center_delete.css">
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
        include "./layout/section_vote_center.php";
        ?>
    </div>
    <div class="footer">
        <?php
        include "./layout/footer.php";
        ?>
    </div>

</body>

</html>