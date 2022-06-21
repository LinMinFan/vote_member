    <!-- 主內容 -->
    <div class="main">
        <!-- 選單 -->
        <div class="menu">
            <ul>
                <li><a href="./vote_center.php">投票列表</a></li>
                <li><a href="./vote_center.php?kind=activ">投票分類查詢</a></li>
                <li><a href="./vote_center.php?joined=activ">已參加主題</a></li>
                <li><a href="./vote_center.php?create=activ">新增投票主題</a></li>
                <li><a href="./vote_center.php?delete=activ">刪除投票主題</a></li>
                <!-- 有需要可增加選項 -->
                <!-- <li><a href="#">Team</a></li>
                <li><a href="#">Content</a></li> -->
            </ul>
        </div>
        <!-- 頁面內容 -->
        <div class="vote">
            <div class="information">
                <h3>投票中心</h3>
            </div>

            <?php
            if (isset($_GET['kind'])) {
                include './back/section_vote_center_kind.php';
            } else if (isset($_GET['joined'])) {
                include './back/section_vote_center_joined.php';
            } else if(isset($_GET['create'])){
                include './back/section_vote_center_create.php';
            } else if(isset($_GET['delete'])){
                include './back/section_vote_center_delete.php';
            } else{
                include './back/section_vote_center_default.php';
            }
            ?>
        </div>
    </div>
