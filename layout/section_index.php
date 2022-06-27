<?php
//查找投票人數前四主題語法
//SELECT `vote_member_subjects` . * , COUNT(`vote_member_log` . `user_id`) as '參加人數'
//FROM `vote_member_subjects`,`vote_member_log` 
//WHERE `vote_member_subjects` . `id` = `vote_member_log` . `subject_id`
//GROUP BY `vote_member_log` . `subject_id`
//ORDER BY COUNT(`vote_member_log` . `user_id`) DESC , `vote_member_subjects` . `end` DESC
//LIMIT 0,4
$topsql =
    "
SELECT `vote_member_subjects` . * , COUNT(`vote_member_log` . `user_id`) as '參加人數'
FROM `vote_member_subjects`,`vote_member_log` 
WHERE `vote_member_subjects` . `id` = `vote_member_log` . `subject_id`
GROUP BY `vote_member_log` . `subject_id`
ORDER BY COUNT(`vote_member_log` . `user_id`) DESC , `vote_member_subjects` . `end` DESC
LIMIT 0,4
";
$top_vote = $pdo->query($topsql)->fetchAll(PDO::FETCH_ASSOC);
//dd($top_vote);
?>
<div class="index">
<div class="information">
    <h3>熱門主題</h3>
</div>
<!-- 使用foreach將資料表數值帶入下幫保留原始html參考 -->
<div class='container'>
    <?php
    foreach ($top_vote as $value) {
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
<!-- 廣告圖片區 -->
<div class="advertise">
    <div class="adbar">
        我是廣告圖2:1
        後台圖片管理建置中
    </div>
</div>
</div>