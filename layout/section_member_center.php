    <!-- 主內容 -->
    <div class="main">
        <!-- 選單 -->
        <div class="menu">
            <ul>
                <li><a href="./member_center.php">會員基本資料</a></li>
                <li><a href="./member_center.php?edit=activ">編輯會員資料</a></li>
                <li><a href="./member_center.php?delete=activ">刪除帳號</a></li>
                <!-- 有需要可增加選項 -->
                <!-- <li><a href="#">Team</a></li>
                <li><a href="#">Content</a></li> -->
            </ul>
        </div>
        <!-- 頁面內容 -->
        <div class="member">
            <div class="information">
                <h3>會員資料</h3>
            </div>

            <?php
            if (isset($_GET['edit'])) {
                include './back/section_member_center_edit.php';
            } else if (isset($_GET['delete'])) {
                include './back/section_member_center_delete.php';
            } else {
                include './back/section_member_center_default.php';
            }
            ?>
        </div>
    </div>
