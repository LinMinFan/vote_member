<?php

//使用參數
//投票主題id 名稱
$subject_id = $_GET['subject'];
$subject = find('vote_member_subjects',$subject_id);
//dd($subject);

//抓取subject資料表
//SELECT * FROM `vote_member_subjects` WHERE `id`='$subject_id'
$subject_name = $subject['subject'];
echo '主題:' . $subject_name;
echo "<br>";

//計算主題投票人數
//SELECT COUNT(*) FROM `vote_member_log` WHERE `subject_id` = 'subject_id'
//$quantity = ;
$totalsql = "SELECT COUNT(*) FROM (SELECT * FROM `vote_member_log` WHERE `subject_id` = '$subject_id' GROUP BY `user_id`)A";
$quantity = $pdo->query($totalsql)->fetchColumn();
echo '參加人數:' . $quantity . '人';

//單數0 / 複數1
$multiple = $subject['multiple'];
$multiple_type = ($multiple == 0)? '單選題':'複選題';
echo $multiple_type;
echo "<br>";

//選項id 內容
//抓取選項
//SELECT * FROM `vote_member_options` WHERE `subject_id`='$subject_id'
$opwhere = ['subject_id' => $subject_id];
$options = all('vote_member_options',$opwhere);
//dd($options);

//選項選取次數
//SELECT COUNT(*) FROM `vote_member_note` WHERE `option_id` = '$option_id'
//$option_choice = ;
foreach ($options as $key => $option) {
    $option_id = $option['id'];
    $choicecount = "SELECT COUNT(*) FROM `vote_member_log` WHERE `option_id` = '$option_id'" ;

    $option_choice = $pdo->query($choicecount)->fetchColumn();

    echo '選項' . ($key+1) . ':' .$option['choice'] . '投票數:' . $option_choice;
    
    //計算各選項佔比
    //選項選取次數 / 投票人數 複選時選項為陣列每個項目個別計算比率
    //$vote_result = ;
    $vote_result = round(($option_choice / $quantity),2) * 100 . '%';
    echo '選取率:' . $vote_result;
    echo '<br>';
}





?>