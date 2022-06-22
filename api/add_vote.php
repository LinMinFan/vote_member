<?php
//建立資料庫連線以include引入
include "./function.php";
$pdo=pdo();
//接收來自表單傳來的投票主題文字內容
$subject=$_POST['subject'];
$type_id=$_POST['type_id'];
$admin=$_SESSION['id'] ;
$multiple=$_POST['multiple'] ;
//開始日期需大於今日如果小於今日 以今日為開始日
$start=$_POST['start'] ; //date("Y-m-d")
$starttime = date(strtotime($start));
$today = date(strtotime('today'));
if ($starttime >= $today) {
    $start = $start;
}else{
    $start = date('Y-m-d');
}
$starttime = date(strtotime($start)); //更新開始秒數

//結束日需大於開始日並大於今日
//1.大於開始日小於今日以今日為結束日
//2.小於開始日小於今日以開始日為結束日
//3.小於開始日大於今日以開始日為結束
//4.開始日先判斷是否大於今日後結束日只要小於開始日都是已開始日為結束日
$end=$_POST['end'] ;
$endtime = date(strtotime($end));
if ($endtime >= $starttime ) {
    $end = $end;
}else{
    $end =$start;
}
$endtime = date(strtotime($end)); //更新結束秒數

//$choice[]=$_POST['choice']; 選項不須另存

//依資料庫建立資料陣列
$add_subject=[
    'subject'=>$subject,
    'type_id'=>$type_id,
    'admin'=>$admin,
    'multiple'=>$multiple,
    'start'=>$start,
    'end'=>$end,
];
//先確認接收資料無誤
//dd($add_subject);
//exit();

//建立sql新增語法
//INSERT INTO `vote_member_subjects`
//(`subject`, `type_id`, `admin`, `multiple`, `start`, `end`) 
//VALUES ('$subject','$type_id','$admin','$multiple','$start','$end')
//使用save()函式把投票主題存至資料表中
save('vote_member_subjects',$add_subject);

//利用剛才存入的投票主題文字來找出該筆資料並取得id，請參考函式
//find($table,$id)
//sql語法SELECT * FROM `vote_member_subjects` WHERE `subject` = 'subject' 查找結果為陣列
//[array]['id']取id值
$id=find('vote_member_subjects',['subject'=>$subject])['id'];


//判斷表單資料有沒有option這個項目，如果有，則使用迴圈把選項一個一個取出
if(isset($_POST['choice'])){
    foreach($_POST['choice'] as $opt){
        if($opt!=""){
            //如果選項的文字內容不是空的 ,則建立資料陣列,並將主題對應的id代入
            $add_choice=[
                'choice'=>$opt,
                'subject_id'=>$id
            ];

            //使用save()函式把投票選項存至資料表vote_member_options中
            save("vote_member_options",$add_choice);
        }
    }
}

//使用to()函式來取代header
to('../vote_center.php');
