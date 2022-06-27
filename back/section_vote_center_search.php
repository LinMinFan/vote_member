<?php
if (!isset($_GET['p']) || !isset($_GET['o']) || !isset($_GET['t']) || !isset($_GET['codition'])) {
    to("./vote_center.php?search=activ&p=1&o=desc&t=0&codition=''");
}
//透過sql模糊搜尋
//語法SELECT * FROM `vote_member_subjects` WHERE `subject` LIKE '% %'
$search = (isset($_GET['codition'])) ? $_GET['codition'] : "";
$search_log = "SELECT * FROM `vote_member_subjects` WHERE `subject` LIKE '%$search%'";
//總比數
$vote_search = $pdo->query($search_log)->fetchAll(PDO::FETCH_ASSOC);

$sheet = 8;
$order = (isset($_GET['o']))?$_GET['o'] :"desc";    //排序
$ordersql = ($order == 'asc') ? 'ORDER BY `end` ASC' : 'ORDER BY `end` DESC';
$pageNow = (isset($_GET['p']))?$_GET['p'] :"1";  //當前頁
$limitstrt =  ($pageNow - 1) * $sheet; //計算每頁資料由第幾筆資料開始取0 = id 1
$limitsql = "limit $limitstrt,$sheet"; //分頁條件語法
$defaultT = (isset($_GET['t']))?$_GET['t'] :"0";
if ($defaultT == 0) {
    $kindsql = ""; //建立分類條件語法
} else {
    $kindsql = "&& `type_id` = '$defaultT'";
}
//組合語法
$allsql = $search_log . " " . $kindsql . " " . $ordersql . " " . $limitsql;
//echo $allsql;
$vote_all = $pdo->query($allsql)->fetchAll(PDO::FETCH_ASSOC);
//dd($vote_subjects);
//計算分類總數用
$typesum = $search_log . " " . $kindsql;
$typesum_log = $pdo->query($typesum)->fetchAll(PDO::FETCH_ASSOC);
//dd($typesum);
//dd($vote_subjects);
//計算總頁數 = ceil(總比數 / 每頁顯示筆數)
//抓取筆數
$pageSum = ($defaultT == 0) ? ceil(count($vote_search) / $sheet) : ceil(count($typesum_log) / $sheet);  //總頁數
//dd($vote_subjects);
//echo $pageSum;
$pageStart = 1; //第一頁 
$pageEnd = $pageSum;  //最後一頁就是總頁數
$pageBack = ($pageNow == 1) ? $pageNow : $pageNow - 1;   //前一頁 if 前一頁 == 0 前一頁 = 1
$pagefront = ($pageNow == $pageEnd) ? $pageEnd : $pageNow + 1;   //後一頁 if 後一頁 == end 後一頁 = end

?>
<div class="vote_search">
    <form action="./vote_center.php">
        <div class="search_input">
        <input type="text" name="search" value="activ" hidden>
        <input type="text" name="p" value="<?= $pageNow; ?>" hidden>
        <input type="text" name="o" value="<?= $order; ?>" hidden>
        <input type="text" name="t" value="<?= $defaultT; ?>" hidden>
        <input type="text" name="codition" required>
    </div>
    <div class="searc_button">
    <button class="search_submit" type="submit"><i class='fa-solid fa-magnifying-glass'></i></button>
    </div>
    </form>
</div>
<div class='container'>
    <div class="select">
        <ul>
            <div class="selectText">分類</div>
            <li><a href="./vote_center.php?search=activ&p=<?= $pageNow; ?>&o=<?= $order; ?>&t=0&codition=<?= $search; ?>">全部</a></li>
            <?php
            foreach ($types as $kind) {
            ?>
                <li><a href="./vote_center.php?search=activ&p=<?= $pageNow; ?>&o=<?= $order; ?>&t=<?= $kind['id']; ?>&codition=<?= $search; ?>"><?= $kind['name']; ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
    <!-- 排序按鈕 -->
    <div class="order">
        <?php
        if ($order == 'desc') {
        ?>
            <a href="./vote_center.php?search=activ&p=<?= $pageNow; ?>&o=asc&t=<?= $defaultT; ?>&codition=<?= $search; ?>">
                <i class="fa-solid fa-arrow-up-short-wide"></i>
            </a>
        <?php
        } else {
        ?>
            <a href="./vote_center.php?search=activ&p=<?= $pageNow; ?>&o=desc&t=<?= $defaultT; ?>&codition=<?= $search; ?>">
                <i class="fa-solid fa-arrow-up-wide-short"></i>
            </a>
        <?php
        }
        ?>
    </div>
    <?php

    foreach ($vote_all as $value) {
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
    ?>
</div>
<!-- 分頁標籤 -->
<div class="page">
    <!-- 上一頁 -->
    <a href="./vote_center.php?search=activ&p=<?= $pageBack; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><i class="fa-solid fa-backward"></i></a>
    <!-- 以當前頁為準 固定5頁 前0後4 前1後3 前2後2 前3後1 前4後0 使用判斷式判斷各種狀況-->
    <?php
    if ($pageSum <= 1) {
    ?>
        <!-- 固定第一頁 -->
        <a class="pageNow" href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>

    <?php
    } else if ($pageSum == 2) {
    ?>
        <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <!-- 固定最後一頁 -->
        <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else if ($pageSum == 3) {
    ?>
        <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a class="<?= ($pageNow == ($pageStart + 1)) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 1); ?></a>
        <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else if ($pageSum == 4) {
    ?>
        <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a class="<?= ($pageNow == ($pageStart + 1)) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 1); ?></a>
        <a class="<?= ($pageNow == ($pageStart + 2)) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= ($pageStart + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 2); ?></a>
        <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else if ($pageSum == 5) {
    ?>
        <a class="<?= ($pageNow == $pageStart) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a class="<?= ($pageNow == ($pageStart + 1)) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 1); ?></a>
        <a class="<?= ($pageNow == ($pageStart + 2)) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= ($pageStart + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 2); ?></a>
        <a class="<?= ($pageNow == ($pageStart + 3)) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= ($pageStart + 3); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 3); ?></a>
        <a class="<?= ($pageNow == $pageEnd) ? "pageNow" : ""; ?>" href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else if ($pageSum > 5 && $pageNow == $pageStart) {
    ?>
        <a class="pageNow" href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageStart + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 1); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageStart + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 2); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageStart + 3); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageStart + 3); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else if ($pageSum > 5 && $pageNow == $pageStart + 1) {
    ?>
        <a href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a class="pageNow" href="./vote_center.php?search=activ&p=<?= ($pageNow); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageNow + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow + 1); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageNow + 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow + 2); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else if ($pageSum > 5 && $pageNow == $pageEnd) {
    ?>
        <a href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageEnd - 3); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageEnd - 3); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageEnd - 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageEnd - 2); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageEnd - 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageEnd - 1); ?></a>
        <a class="pageNow" href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else if ($pageSum > 5 && $pageNow == ($pageEnd - 1)) {
    ?>
        <a href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageNow - 2); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow - 2); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageNow - 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow - 1); ?></a>
        <a class="pageNow" href="./vote_center.php?search=activ&p=<?= ($pageNow); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    } else {
    ?>
        <a href="./vote_center.php?search=activ&p=<?= $pageStart; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageStart; ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageNow - 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow - 1); ?></a>
        <a class="pageNow" href="./vote_center.php?search=activ&p=<?= ($pageNow); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= ($pageNow + 1); ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= ($pageNow + 1); ?></a>
        <a href="./vote_center.php?search=activ&p=<?= $pageEnd; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><?= $pageEnd; ?></a>
    <?php
    }
    ?>

    <!-- 下一頁 -->
    <a href="./vote_center.php?search=activ&p=<?= $pagefront; ?>&o=<?= $order; ?>&t=<?= $defaultT; ?>&codition=<?= $search; ?>"><i class="fa-solid fa-forward"></i></a>
</div>
