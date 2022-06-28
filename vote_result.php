<?php
//連線資料庫讀取全部投票主題選項資料
include "./api/function.php";
$pdo = pdo();
if (isset($_SESSION['user'])) {
    $dateall = find('vote_member_users', $_SESSION['id']);
}
//結果頁無須驗證登入
//結果頁不須載入帳號資料

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票統計</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/vote_center.css">
    <link rel="stylesheet" href="./css/vote_star.css">
    <link rel="stylesheet" href="./css/vote_result.css">
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
        include './back/section_vote_result.php';
        ?>
    </div>
    <div class="footer">
        <?php
        include "./layout/footer.php";
        ?>
    </div>

</body>

</html>