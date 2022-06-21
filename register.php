<?php
include "./api/function.php";
//若有session直接導向會員中心不再停留此頁
if (isset($_SESSION['user'])) {
    //header('location:/member_center.php');
    to('member_center.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/register.css">
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
        include "./layout/section_register.php";
        ?>
    </div>
    <div class="footer">
        <?php
        include "./layout/footer.php";
        ?>
    </div>

</body>

</html>