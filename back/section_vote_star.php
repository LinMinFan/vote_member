<?php
$subject_id = $_GET['subject'];
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
        <form action="./api/join_vote.php?multiple=<?=$subject['multiple'];?>&&subject_id=<?=$subject_id;?>" method="post">
            <?php
            foreach ($opts as $opt) {
            ?>
                <div class="vote_item">
                    <?php
                    if ($subject['multiple'] == 0) {
                    ?>
                        <input type="radio" name="opt" value="<?= $opt['id']; ?>">
                    <?php
                    } else {
                    ?>
                        <input type="checkbox" name="opt[]" value="<?= $opt['id']; ?>">
                    <?php
                    }
                    ?>
                    <label for=""><?= $opt['choice']; ?></label>
                </div>

            <?php
            }
            ?>
            <div class="subject_button">
                <input type="submit" value="確定">
                <input type="reset" value="重置">
            </div>
        </form>
    </div>
</div>