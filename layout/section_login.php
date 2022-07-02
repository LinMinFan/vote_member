<!-- 帳號密碼錯誤訊息提示訊息 -->
<h2 class="message">
    <?=(isset($_GET['error']))?$_GET['error']:'' ;?>
</h2>
<div class="login">
        <div class="loginform">
            <h2>會員登入</h2>
            <form action="./api/chk_login.php" method="post">
                <div class="inputbox">
                    <input type="text" name="account" id="" placeholder="帳號:" required>
                </div>
                <div class="inputbox">
                    <input type="password" name="password" id="" placeholder="密碼:" required>
                </div>
                <div class="inputbox">
                    <input type="submit" name="" id="" value="登入">
                </div>
                <a class="fgbt" href="./forgot.php">忘記密碼</a>
                <a class="rgbt" href="./register.php">註冊帳號</a>
            </form>
        </div>
    </div>
