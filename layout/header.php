<div class="logo">
    <a href="./index.php"><i class="fa-solid fa-cat"></i>會員投票網</a>
    <h3>
        <?php
        if (isset($session['user'])) {
            echo 'nick_name:您好';
        } else {
            echo '歡迎來訪，登入會員後可參加投票';
        }
        ?>
    </h3>
</div>
<div class="nav">
    <ul>
        <?php
        if (isset($session['user'])) {
            echo '<li><a href="./vote_center.php">投票中心</a></li>';
            echo '<li><a href="./member_center">會員中心</a></li>';
        } else {
            echo '<li><a href="./login.php">投票中心</a></li>';
            echo '<li><a href="./login.php">會員中心</a></li>';
        }
        ?>
        <li><a href="./login.php">登入</a></li>
    </ul>
</div>