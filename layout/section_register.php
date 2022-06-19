<div class="register">
    <div class="registerform">
        <h2>註冊帳號</h2>
        <form action="./store_member.php" method="post">
            <div class="inputbox">
                <label class="accLb" for="">帳號：</label>
                <input class="account" type="text" name="account" required>
                <label class="nickLb" for="">暱稱：</label>
                <input type="text" name="nick"  required>
            </div>
            <div class="inputbox">
                <label class="pssLb" for="">密碼：</label>
                <input class="password" type="password" name="password" required>
                <label class="chk_pssLb" for="">確認密碼：</label>
                <input class="chk_password" type="password" name="chk_password"  required>
            </div>
            <div class="inputbox">
                <label class="nameLb" for="">姓名：</label>
                <input class="name" type="text" name="name" required>
            </div>
            <div class="inputbox">
                <label class="emailLb" for="">信箱：</label>
                <input class="email" type="email" name="email" required>
            </div>
            <div class="inputbox">
                <input type="submit" name="" id="" value="註冊">
                <input type="reset" name="" id="" value="清除">
            </div>
        </form>
    </div>
</div>