<!-- 帳號資料都以抓入$dateall[] -->
<?php
//dd($dateall);
?>
<div class="edit">
        <form action="">
            <!-- 不得修改 -->
            <div class="inputbox">
            <label class="accLb" for="">帳號：</label>
            <input class="account" type="text" value="<?= $dateall[0]['account']; ?>" disabled>
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
            <input class="nick" type="text" value="<?= $dateall[0]['nick']; ?>" required>
            </div>
            <!-- 不得修改 -->
            <div class="inputbox">
            <label class="nameLb" for="">姓名：</label>
            <input class="name" type="text" value="<?= $dateall[0]['name']; ?>" disabled>
            </div>
            <!-- 不得修改 -->
            <div class="inputbox">
            <label class="emailLb" for="">信箱：</label>
            <input class="email" type="text" value="<?= $dateall[0]['email']; ?>" disabled>
            </div>
            <div class="inputbox">
                <input type="submit" name="" id="" value="送出">
                <input type="reset" name="" id="" value="清除">
            </div>
        </form>
    </div>
