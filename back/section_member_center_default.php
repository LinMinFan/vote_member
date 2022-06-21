<!-- 帳號資料都以抓入$dateall[] -->
<?php
//dd($dateall);
?>
<div class="default">
        <form action="">
            <!-- 不得修改 -->
            <div class="inputbox">
            <label class="accLb" for="">帳號：</label>
            <input class="account" type="text" value="<?= $dateall['account']; ?>" disabled>
            </div>
            <!-- 可修改 -->
            <div class="inputbox">
            <label class="nickLb" for="">暱稱：</label>
            <input class="nick" type="text" value="<?= $dateall['nick']; ?>" disabled>
            </div>
            <!-- 不得修改 -->
            <div class="inputbox">
            <label class="nameLb" for="">姓名：</label>
            <input class="name" type="text" value="<?= $dateall['name']; ?>" disabled>
            </div>
            <!-- 不得修改 -->
            <div class="inputbox">
            <label class="emailLb" for="">信箱：</label>
            <input class="email" type="text" value="<?= $dateall['email']; ?>" disabled>
            </div>
        </form>
    </div>
