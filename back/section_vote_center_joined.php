<!-- 使用foreach將資料表數值帶入 -->
<div class='container'>
    <!-- 分類選單 -->
    <?php
    //dd($types);
    ?>
    <div class="select">
        <ul>
            <div class="selectText">分類</div>
            <?php
            foreach ($types as $kind) {
            ?>

                <li><a href="./vote_center.php?p=1&o=desc&t=<?= $kind['id']; ?>"><?= $kind['name']; ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
    <!-- 排序按鈕 -->
    <div class="order">
        <a href="">
            <i class="fa-solid fa-arrow-up-short-wide"></i>
        </a>
        <!-- <a href="">
        <i class="fa-solid fa-arrow-up-wide-short"></i>
        </a> -->
    </div>
    <?php
    //比對已投票紀錄將投票主題顯示在使用連表查詢
    //SELECT `vote_member_subjects` . * , `vote_member_log` . `user_id`
    //FROM `vote_member_subjects`,`vote_member_log` 
    //WHERE `vote_member_subjects` . `id` = `vote_member_log` . `subject_id` && `vote_member_log` . `user_id` = session['id'] ORDER BY `id` ASC
    $user_id = $_SESSION['id'];
    $logsql = "SELECT `vote_member_subjects` . * , `vote_member_log` . `user_id` 
    FROM `vote_member_subjects`,`vote_member_log` 
    WHERE `vote_member_subjects` . `id` = `vote_member_log` . `subject_id` && `vote_member_log` . `user_id` = $user_id 
    ORDER BY `id` ASC";
    
    $subject_log = $pdo->query($logsql)->fetchAll(PDO::FETCH_ASSOC);

    //需使用參數 id subject type_id start end
    
    foreach ($subject_log as $log) {
            $subject_id = $log['id'];     //subject_id
            $subject = $log['subject'];   //主題
            $type_id = $log['type_id'];   //分類
            $start = $log['start'];   //開始時間
            $end = $log['end'];   //結束時間
            $endtime = date(strtotime($end));   //結束秒數
    ?>
            <div class='card'>
                <div class='type'>
                    <?= $types[$type_id - 1]['name']; ?>
                </div>
                <div class='subject'>
                    <div class='title'>
                        <span>
                            <?= $subject; ?>
                        </span>
                    </div>
                    <div class='date'>
                        <span>
                            <?= $start . " ~ " . $end; ?>
                        </span>
                    </div>
                    <?php
                    if ($today > $endtime) {
                    ?>
                        <div class='buttom'>
                            <a href='./vote_result.php?subject=<?= $subject_id; ?>'>參加投票</a>
                            <a href='./vote_result.php?subject=<?= $subject_id; ?>'>查看結果</a>
                        </div>
                        <div class="vote_end">
                            <h3>已結束</h3>
                        </div>

                    <?php
                    } else {
                    ?>
                        <div class='buttom'>
                            <a href='./vote_result.php?subject=<?= $subject_id; ?>'>參加投票</a>
                            <a href='./vote_result.php?subject=<?= $subject_id; ?>'>查看結果</a>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
    <?php
        
    }
    ?>

    <!-- 分頁標籤 -->
    <div class="page">
        <!-- 上一頁 -->
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1"><i class="fa-solid fa-backward"></i></a>
        <!-- 固定第一頁 -->
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1">1</a>
        <!-- 以當前頁為準 固定5頁 前0後4 前1後3 前2後2 前3後1 前4後0 -->
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1">2</a>
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1">3</a>
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1">4</a>
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1">5</a>
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1">6</a>
        <!-- 固定最後一頁 -->
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1">7</a>
        <!-- 下一頁 -->
        <a href="./vote_center.php?kind=activ&p=1&o=desc&t=1"><i class="fa-solid fa-forward"></i></a>
    </div>
</div>