<?php
//比對已投票紀錄將投票主題顯示在使用連表查詢
//SELECT `vote_member_subjects` . * , `vote_member_log` . `user_id`
//FROM `vote_member_subjects`,`vote_member_log` 
//WHERE `vote_member_subjects` . `id` = `vote_member_log` . `subject_id` && `vote_member_log` . `user_id` = session['id'] ORDER BY `id` ASC$logsql = "SELECT * FROM `vote_member_log` WHERE `user_id` = " . $_SESSION['id'];
//需要參數 log 表內 subject_id
// 若表內id = GETid 表示已投票過 直接前往結果頁
$user_id = $_SESSION['id'];
$logsql = "SELECT `vote_member_subjects` . * , `vote_member_log` . `user_id` 
    FROM `vote_member_subjects`,`vote_member_log` 
    WHERE `vote_member_subjects` . `id` = `vote_member_log` . `subject_id` && `vote_member_log` . `user_id` = $user_id";

$subject_log = $pdo->query($logsql)->fetchAll(PDO::FETCH_ASSOC);
$subject_id = $_GET['subject'];

foreach ($subject_log as $join_log) {
    $log_id = $join_log['id'];
    if ($log_id == $subject_id) {
        to("./vote_result.php?subject=$subject_id");
    }
}

$subject = find('vote_member_subjects', $subject_id);
//dd($subject);
//sql語法SELECT * FROM `vote_member_options` WHERE `subject_id`= '$subject_id';
//where 條件 `subject_id`= '$subject_id' = `$key`='$value'
$where = ['subject_id' => $subject_id];
$opts = all('vote_member_options', $where);
//dd($opts);
?>
<div class="vote_star">
    <div class="subject_name">
        <h1><?= $subject['subject']; ?></h1>
    </div>
    <div class="subject_form">
        <form class="vote_item" action="./api/join_vote.php?multiple=<?= $subject['multiple']; ?>&&subject_id=<?= $subject_id; ?>" method="post">
            <table>
                <?php
                foreach ($opts as $key => $opt) {
                ?>
                    <?php
                    if ($subject['multiple'] == 0) {
                    ?>
                        <tr>
                            <td>
                                <input id="opt<?= $key; ?>" type="radio" name="opt" value="<?= $opt['id']; ?> ">
                            <?php
                        } else {
                            ?>
                        <tr>
                            <td>
                                <input id="opt<?= $key; ?>" type="checkbox" name="opt[]" value="<?= $opt['id']; ?>">
                            <?php
                        }
                            ?>
                            <label for="opt<?= $key; ?>"><?= $opt['choice']; ?></label>
                            </td>
                        </tr>

                    <?php
                }
                    ?>
            </table>
            <div class="subject_button">
                <input type="submit" value="確定">
                <input type="reset" value="重置">
            </div>
        </form>
    </div>
</div>