<div class="logo">
    <a href="./index.php"><i class="fa-solid fa-cat"></i>會員投票網</a>
    <h3>
        <?php
        //若有登入以暱稱顯示歡迎
        if (isset($_SESSION['user'])) {
            echo $dateall['nick'] . ':您好';
        } else {
            echo '歡迎來訪，登入會員後可參加投票';
        }
        ?>
    </h3>
</div>
<div class="nav">
    <ul>
        <?php
        //若有登入 按鈕為登出否則為登入
        if (isset($_SESSION['user'])) {
            echo '<li><a href="./vote_center.php">投票中心</a></li>';
            echo '<li><a href="./member_center.php">會員中心</a></li>';
            echo '<li><a href="./api/logout.php">登出</a></li>';
        } else {
            echo '<li><a href="./login.php">投票中心</a></li>';
            echo '<li><a href="./login.php">會員中心</a></li>';
            echo '<li><a href="./login.php">登入</a></li>';
        }
        ?>
    </ul>
</div>