<?php
//連線資料庫讀取全部投票主題
include "./api/function.php";
$pdo = pdo();
$types = all('vote_member_type');

//定義今日秒數
$today = date(strtotime('today'));

//dd($subjects);
//dd($types);
//檢視若有登入就載入暱稱
if (isset($_SESSION['user'])) {
    $dateall = find('vote_member_users', $_SESSION['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員投票系統</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/frontbackground.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/section_index.css">
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
        if (isset($_GET['enter'])) {
            include "./layout/section_index.php";
        } else {
            include "./front/frontbackground.php";
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