<!-- 錯誤訊息提示訊息 -->
<h2 class="message">
    <?= (isset($_GET['error'])) ? $_GET['error'] : ''; ?>
</h2>
<div class="forgot">
    <div class="forgotform">
        <h2>重設密碼</h2>
        <form action="./api/chk_acc.php" method="post">
            <div class="inputbox">
                <input type="text" name="account" id="" placeholder="帳號:" required>
            </div>
            <div class="inputbox">
                <input type="email" name="email" id="" placeholder="信箱:" required>
            </div>
            <div class="inputbox">
                <input type="submit" name="" id="" value="確定">
                <input type="reset" name="" id="" value="清除">
            </div>
        </form>
    </div>
</div>