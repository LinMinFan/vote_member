<!-- 預設分頁在第一頁預設排序為新到舊 -->
<?php
if(!isset($_GET['p']) || !isset($_GET['o'])){
    to('./vote_center.php?p=1&o=desc');
}
$pageStart = 1; //第一頁
$pageNow = $_GET['p'];  //當前頁
//最後一頁
$pageBack = $pageNow - 1;   //前一頁 if 前一頁 == 0 前一頁 = 1
$pagefront = $pageNow + 1;   //後一頁 if 後一頁 == end 後一頁 = end
?>
<!-- 使用foreach將資料表數值帶入下幫保留原始html參考 -->
<div class='container'>
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
    foreach ($subjects as $value) {
        $subject = $value['subject'];   //主題
        $type_id = $value['type_id'];   //分類
        $start = $value['start'];   //開始時間
        $end = $value['end'];   //結束時間
    ?>
        <div class='card'>
            <div class='type'>
                <?= $type[$type_id - 1]['name']; ?>
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
                    <div class='buttom'>
                        <a href=''>參加投票</a>
                        <a href=''>查看結果</a>
                    </div>
            </div>
        </div>
    <?php
    }
    ?>
<!-- 分頁標籤 -->
<div class="page">
    <!-- 上一頁 -->
    <a href="./vote_center.php?p=1&o=desc"><i class="fa-solid fa-backward"></i></a>
    <!-- 固定第一頁 -->
    <a href="./vote_center.php?p=1&o=desc">1</a>
    <!-- 以當前頁為準 固定5頁 前0後4 前1後3 前2後2 前3後1 前4後0 -->
    <a href="./vote_center.php?p=1&o=desc">2</a>
    <a href="./vote_center.php?p=1&o=desc">3</a>
    <a href="./vote_center.php?p=1&o=desc">4</a>
    <a href="./vote_center.php?p=1&o=desc">5</a>
    <a href="./vote_center.php?p=1&o=desc">6</a>
    <!-- 固定最後一頁 -->
    <a href="./vote_center.php?p=1&o=desc">7</a>
    <!-- 下一頁 -->
    <a href="./vote_center.php?p=1"><i class="fa-solid fa-forward"></i></a>
</div>
</div>
<!-- <div class="container">
    <div class="card">
        <div class="type">
            分類
        </div>
        <div class="subject">
            <div class="title">
                <span> 一二三四五六七八九十
                </span>
            </div>
            <div class="date">
                <span>2022-06-18~2022-07-20</span>
            </div>
            <div class="buttom">
                <a href="">參加投票</a>
                <a href="">查看結果</a>
            </div>
        </div>
    </div>
</div> -->