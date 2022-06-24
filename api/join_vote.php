<?php
//連線資料庫
//$dsn = 'mysql:host=localhost;chratset=utf8;dbname=vote';
//$pdo =new PDO($dsn,'root','');
include "./function.php";
$pdo = pdo();

//單複數
$multiple = $_GET['multiple'];

//userid
$user = find('vote_member_users', $_SESSION['id']);
$userid = $user['id'];

//subject_id
$subject_id = $_GET['subject_id'];

//$opts = $_POST['opt'];
//echo $opts;
//紀錄投票結果
//dd($_POST['opt']);
$option_id = '';

if (isset($_POST['opt'])) {
    //檢查選項單選0或複選1
    //複選狀況 用迴圈紀錄個選項
    if ($multiple == 1) {
        foreach ($_POST['opt'] as $key => $opt) {

            //用id抓取選項資料
            $option = find("vote_member_options", $opt);
            //dd($option);
            $option_id = $option['id'];

            //note表單 => 要記錄 subject_id option_id
            $sqlnote = "INSERT INTO `vote_member_note`(`subject_id`, `option_id`) VALUES ('$subject_id','$option_id')";
            $pdo->exec($sqlnote);
        }
        //單選狀況    
    } else {

        $option_id = $_POST['opt'];
        //note表單 => 要記錄 subject_id option_id
        $sqlnote = "INSERT INTO `vote_member_note`(`subject_id`, `option_id`) VALUES ('$subject_id','$option_id')";
        $pdo->exec($sqlnote);
    }
    //log表單 => 要記錄 user_id subject_id
    $sqllog = "INSERT INTO `vote_member_log`(`user_id`, `subject_id`) VALUES ('$userid','$subject_id')";
    $pdo->exec($sqllog);
}


//header('../vote_result.php?subject_id=$subject_id');
to("../vote_result.php?subject=$subject_id");
