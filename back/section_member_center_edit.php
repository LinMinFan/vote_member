<!-- 帳號資料都以抓入$dateall[] -->
<?php
//dd($dateall);
//echo $dateall['nick'];
?>
<!-- 帳號密碼錯誤訊息提示訊息 -->
<h2 class="message">
    <?=(isset($_GET['error']))?$_GET['error']:'' ;?>
</h2>
<div class="edit">
        <form action="./api/save_member.php" method="POST">
            <!-- 不得修改 -->
            <div class="inputbox">
            <label class="accLb" for="">帳號：</label>
            <input class="account" type="text" value="<?= $dateall['account']; ?>" disabled>
            </div>
            <!-- 可修改 -->
            <div class="inputbox">
                <label class="pssLb" for="">變更密碼：</label>
                <input class="password" type="password" name="password" required>
                <label class="chk_pssLb" for="">確認密碼：</label>
                <input class="chk_password" type="password" name="chk_password"  required>
            </div>
            <!-- 可修改 -->
            <div class="inputbox">
            <label class="nickLb" for="">暱稱：</label>
            <input class="nick" type="text" placeholder="<?= $dateall['nick']; ?>" value="<?= $dateall['nick']; ?>" name="nick" required >
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
            <div class="inputbox">
                <input type="submit" name="" id="" value="送出">
                <input type="reset" name="" id="" value="清除">
            </div>
        </form>
    </div>
