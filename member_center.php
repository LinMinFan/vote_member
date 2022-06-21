<?php
include "./api/function.php";
//若無session直接導向登入頁不停留此頁
if (!isset($_SESSION['user'])) {
    //header('location:/login.php');
    to('login.php');
}
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
    <title>會員中心</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/member_center.css">
    <link rel="stylesheet" href="./css/member_center_default.css">
    <link rel="stylesheet" href="./css/member_center_edit.css">
    <link rel="stylesheet" href="./css/member_center_delete.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/section.css">
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
        include "./layout/section_member_center.php";
        ?>
    </div>
    <div class="footer">
        <?php
        include "./layout/footer.php";
        ?>
    </div>

</body>

</html>