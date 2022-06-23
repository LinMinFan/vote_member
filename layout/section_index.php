<!-- 使用foreach將資料表數值帶入下幫保留原始html參考 -->
<div class='container'>
    <?php
    foreach ($subjects as $value) {
        $subject = $value['subject'];   //主題
        $type_id = $value['type_id'];   //分類
        $start = $value['start'];   //開始時間
        $end = $value['end'];   //結束時間
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
                <!-- 判斷是否有登入決定功能鍵連結 -->
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <div class='buttom'>
                        <a href='./vote_star.php?subject=<?= $value['id']; ?>'>參加投票</a>
                        <a href=''>查看結果</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class='buttom'>
                        <a href='./login.php'>參加投票</a>
                        <a href=''>查看結果</a>
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