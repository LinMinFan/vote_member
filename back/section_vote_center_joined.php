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
    //比對已投票紀錄將投票主題顯示在此
    //sql語法SELECT * FROM `vote_member_log` WHERE `user_id` = $_SESSION['id'];
    $logsql = "SELECT * FROM `vote_member_log` WHERE `user_id` = " . $_SESSION['id'];
    $subject_log = $pdo->query($logsql)->fetchAll(PDO::FETCH_ASSOC);

    //用符合條件的subject_id再帶入vote_member_subjects資料表查找印出
    //語法SELECT * FROM `vote_member_subjects` WHERE `id` = $log['subject_id']
    foreach ($subject_log as $log) {
        $logwhere = ['id' => $log['subject_id']];
        $logsubject = all('vote_member_subjects', $logwhere);
        foreach ($logsubject as $value) {
            $subject = $value['subject'];   //主題
            $type_id = $value['type_id'];   //分類
            $start = $value['start'];   //開始時間
            $end = $value['end'];   //結束時間
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
                            <a href='./vote_result.php?subject=<?= $value['id']; ?>'>參加投票</a>
                            <a href='./vote_result.php?subject=<?= $value['id']; ?>'>查看結果</a>
                        </div>
                        <div class="vote_end">
                            <h3>已結束</h3>
                        </div>

                    <?php
                    } else {
                    ?>
                        <div class='buttom'>
                            <a href='./vote_star.php?subject=<?= $value['id']; ?>'>參加投票</a>
                            <a href='./vote_result.php?subject=<?= $value['id']; ?>'>查看結果</a>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
    <?php
        }
    }
    exit();
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