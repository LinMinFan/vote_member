<?php
if (!isset($_GET['p']) || !isset($_GET['o']) || !isset($_GET['t'])) {
    to('./vote_center.php?joined=activ&p=1&o=desc&t=0');
}
$sheet = 8;
$order = $_GET['o'];    //排序
$ordersql = ($_GET['o'] == 'asc') ? 'ORDER BY `end` ASC' : 'ORDER BY `end` DESC';
$pageNow = $_GET['p'];  //當前頁
$limitstrt =  ($pageNow - 1) * $sheet; //計算每頁資料由第幾筆資料開始取0 = id 1
$limitsql = "limit $limitstrt,$sheet"; //分頁條件語法
$defaultT = $_GET['t'];
if ($defaultT == 0) {
    $kindsql = ""; //建立分類條件語法
} else {
    $kindsql = "&& `type_id` = '$defaultT'";
}

//比對已投票紀錄將投票主題
//SELECT * 
//FROM (SELECT * FROM `vote_member_log` WHERE `user_id` = '14' GROUP BY `subject_id`)A
$user_id = $_SESSION['id'];
$logsql = "SELECT `vote_member_subjects` . * FROM `vote_member_subjects` , 
(SELECT * FROM `vote_member_log` WHERE `user_id` = '$user_id' GROUP BY `subject_id`)A
WHERE `vote_member_subjects` . `id` = A . `subject_id`
";
//組合語法
$allsql = $logsql . " " . $kindsql . " " . $ordersql . " " . $limitsql;
//echo $allsql;
$vote_subjects = $pdo->query($allsql)->fetchAll(PDO::FETCH_ASSOC);
//dd($vote_subjects);
//計算所有主題數用
$subject_log = $pdo->query($logsql)->fetchAll(PDO::FETCH_ASSOC);
//計算分類總數用
$typesum = $logsql . " " . $kindsql;
$typesum_log = $pdo->query($typesum)->fetchAll(PDO::FETCH_ASSOC);
//dd($typesum);
//dd($vote_subjects);
//計算總頁數 = ceil(總比數 / 每頁顯示筆數)
//抓取筆數
$pageSum = ($defaultT == 0) ? ceil(count($subject_log) / $sheet) : ceil(count($typesum_log) / $sheet);  //總頁數
//dd($vote_subjects);
//echo $pageSum;
$pageStart = 1; //第一頁 
$pageEnd = $pageSum;  //最後一頁就是總頁數
$pageBack = ($pageNow == 1) ? $pageNow : $pageNow - 1;   //前一頁 if 前一頁 == 0 前一頁 = 1
$pagefront = ($pageNow == $pageEnd) ? $pageEnd : $pageNow + 1;   //後一頁 if 後一頁 == end 後一頁 = end
?>

<div class="information">
    <h3>已參加主題</h3>
</div>
<!-- 使用foreach將資料表數值帶入 -->
<div class='container'>
    <!-- 分類選單 -->
    <?php
    //dd($types);
    ?>
    <div class="select">
        <ul>
            <div class="selectText">分類</div>
            <li><a href="./vote_center.php?joined=activ&p=1&o=<?= $order; ?>&t=0">全部</a></li>
            <?php
            foreach ($types as $kind) {
            ?>
                <li><a href="./vote_center.php?joined=activ&p=1&o=<?= $order; ?>&t=<?= $kind['id']; ?>"><?= $kind['name']; ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
    <!-- 排序按鈕 -->
    <div class="order">
        <?php
        if ($_GET['o'] == 'desc') {
        ?>
            <a href="./vote_center.php?joined=activ&p=<?= $pageNow; ?>&o=asc&t=<?= $defaultT; ?>">
                <i class="fa-solid fa-arrow-up-short-wide"></i>
            </a>
        <?php
        } else {
        ?>
            <a href="./vote_center.php?joined=activ&p=<?= $pageNow; ?>&o=desc&t=<?= $defaultT; ?>">
                <i class="fa-solid fa-arrow-up-wide-short"></i>
            </a>
        <?php
        }
        ?>
    </div>
    <?php

    //需使用參數 id subject type_id start end

    foreach ($vote_subjects as $log) {
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
        <a href="./vote_center.php?joined=activ&p=<?= $pageBack; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><i class="fa-solid fa-backward"></i></a>
        <!-- 以當前頁為準 固定5頁 前0後4 前1後3 前2後2 前3後1 前4後0 使用判斷式判斷各種狀況-->
        <?php
        if ($pageSum <= 1) {
        ?>
            <!-- 固定第一頁 -->
            <a class="pageNow" href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>

        <?php
        } else if ($pageSum == 2) {
        ?>
            <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <!-- 固定最後一頁 -->
            <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else if ($pageSum == 3) {
        ?>
            <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <a class="<?= ($pageNow == ($pageStart + 1)) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 1); ?></a>
            <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else if ($pageSum == 4) {
        ?>
            <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <a class="<?= ($pageNow == ($pageStart + 1)) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 1); ?></a>
            <a class="<?= ($pageNow == ($pageStart + 2)) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= ($pageStart + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 2); ?></a>
            <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else if ($pageSum == 5) {
        ?>
            <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <a class="<?= ($pageNow == ($pageStart + 1)) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 1); ?></a>
            <a class="<?= ($pageNow == ($pageStart + 2)) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= ($pageStart + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 2); ?></a>
            <a class="<?= ($pageNow == ($pageStart + 3)) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= ($pageStart + 3); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 3); ?></a>
            <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else if ($pageSum > 5 && $pageNow == $pageStart) {
        ?>
            <a class="pageNow" href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 1); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageStart + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 2); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageStart + 3); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageStart + 3); ?></a>
            <span>...</span>
            <a href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else if ($pageSum > 5 && $pageNow == $pageStart + 1) {
        ?>
            <a href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <a class="pageNow" href="./vote_center.php?joined=activ&p=<?= ($pageNow); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageNow + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow + 1); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageNow + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow + 2); ?></a>
            <span>...</span>
            <a href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else if ($pageSum > 5 && $pageNow == $pageEnd) {
        ?>
            <a href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <span>...</span>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageEnd - 3); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageEnd - 3); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageEnd - 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageEnd - 2); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageEnd - 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageEnd - 1); ?></a>
            <a class="pageNow" href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else if ($pageSum > 5 && $pageNow == ($pageEnd - 1)) {
        ?>
            <a href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <span>...</span>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageNow - 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow - 2); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageNow - 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow - 1); ?></a>
            <a class="pageNow" href="./vote_center.php?joined=activ&p=<?= ($pageNow); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        } else {
        ?>
            <a href="./vote_center.php?joined=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageStart; ?></a>
            <span>...</span>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageNow - 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow - 1); ?></a>
            <a class="pageNow" href="./vote_center.php?joined=activ&p=<?= ($pageNow); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow); ?></a>
            <a href="./vote_center.php?joined=activ&p=<?= ($pageNow + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= ($pageNow + 1); ?></a>
            <span>...</span>
            <a href="./vote_center.php?joined=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><?= $pageEnd; ?></a>
        <?php
        }
        ?>

        <!-- 下一頁 -->
        <a href="./vote_center.php?joined=activ&p=<?= $pagefront; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>"><i class="fa-solid fa-forward"></i></a>
    </div>
</div>