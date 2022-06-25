<?php
//印出vote_member_subjects資料表發起人id = session['id'] 按鈕替換成刪除按鈕將subject_id帶往api處理刪除subject_id = get[id]
//語法SELECT * FROM `vote_member_subjects` WHERE `admin` = $_SESSION['id'];
$user_id = $_SESSION['id'];
$admin_log = "SELECT * 
FROM `vote_member_subjects` 
WHERE `admin` = $user_id 
ORDER BY `id` ASC";

$vote_admin = $pdo->query($admin_log)->fetchAll(PDO::FETCH_ASSOC);

?>
<div class='container'>
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
foreach ($vote_admin as $vote_log) {
    $subject_id = $vote_log['id'];  //主題id
    $subject = $vote_log['subject'];   //主題
    $type_id = $vote_log['type_id'];   //分類
    $start = $vote_log['start'];   //開始時間
    $end = $vote_log['end'];   //結束時間
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
                <!-- 刪除按鈕 -->
                <div class="confirm">
                    <!-- 雙重確認刪除主題 -->
                    <a class="delete" id="delete" href="./vote_center.php?delete=activ&confirm=true&subject=<?=$subject_id;?>" style="--clr:#ff1867"><span>刪除主題</span><i></i></a>
                    <!-- 先點擊確認再彈跳視窗確認才刪除主題 -->
                </div>

                <div class="vote_end">
                    <h3>已結束</h3>
                </div>

            <?php
            } else {
            ?>
                <!-- 刪除按鈕 -->
                <div class="confirm">
                    <!-- 雙重確認刪除主題 -->
                    <a class="delete" id="delete" href="./vote_center.php?delete=activ&confirm=true&subject=<?=$subject_id;?>" style="--clr:#ff1867"><span>刪除主題</span><i></i></a>
                    <!-- 先點擊確認再彈跳視窗確認才刪除主題 -->
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
<?php
//使用js功能彈跳視窗
if (isset($_GET['confirm'])) {
    $delid = $_GET['subject'];
    echo "<script>
    if (confirm('確定刪除？')) {
        location.href='./api/remove_vote.php?subject=$delid';
    }else{
        location.href='./vote_center.php?delete=activ';
    }
    </script>";
}

?>