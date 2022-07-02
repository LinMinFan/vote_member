<?php
//後台圖片處理

//更新第幾張圖片
$imgpage = (isset($_GET['p'])) ? $_GET['p'] : " ";

if (!empty($imgpage)) {

    //讀取現有圖片位置
    $oldsql = "SELECT * FROM `vote_member_image` WHERE `id` = '$imgpage'";
    $oldUrl = $pdo->query($oldsql)->fetch(PDO::FETCH_ASSOC);
    
    //讀取檔案位置
    $oldimg = (!empty($oldUrl))?$oldUrl['url']:" ";

    //讀取檔案縮圖位置
    $oldMin_img = (!empty($oldUrl))?$oldUrl['min_url']:" ";

    //舊圖刪除
    if(!empty($oldUrl)){
        unlink($oldimg);
        unlink($oldMin_img);
    }

    //利用時間來產生一個檔名
    $filename = time();

    //建立副檔名
    $subname = "";

    //檢視圖片資料
    //重新給予檔案名稱
    //只接受jpg png gif 檔案
    //比對檔案類型給予副檔名
    $typeImage = (!empty($_FILES['advertise']['type'])) ? $_FILES['advertise']['type'] : "";
    switch ($typeImage) {
        case "image/jpeg":
            $subname = ".jpg";
            break;
        case "image/png":
            $subname = ".png";
            break;
        case "image/gif":
            $subname = ".gif";
            break;
    }

    //新增圖片位置
    $saveimg = "./upload/" . $filename . $subname;

    //新增圖片縮圖位置
    $saveMin_img = "./result/" . $filename . ".jpg";

    if (isset($_FILES['advertise']) && $_FILES['advertise']['error'] == 0) {
        //dd($_FILES);
        //將上傳檔案由tmp移至upload資料夾
        move_uploaded_file($_FILES['advertise']['tmp_name'], $saveimg);

        //現有圖片寬高
        $src_width = getimagesize($saveimg)[0];
        $src_height = getimagesize($saveimg)[1];


        //建立空白畫布寬高(記憶體)
        $dst_img = imagecreatetruecolor(250,125);

        //由現有圖片建立新圖(記憶體)
        $src_img = imagecreatefromjpeg($saveimg);

        //在畫布上貼上圖片由畫布x,y來源圖片x,y畫布寬,高,來源圖片寬,高
        imagecopyresampled($dst_img, $src_img,0,0,0,0,250,125,$src_width,$src_height);

        //輸出圖像並設定品質儲存至指定位置
        imagejpeg($dst_img, $saveMin_img);

        //刪除畫布(記憶體)
        imagedestroy($dst_img);

        //刪除建立圖片(記憶體)
        imagedestroy($src_img);

        //將上傳檔案位置寫入資料庫
        $updatesql = "UPDATE `vote_member_image` SET `url`='$saveimg',`min_url`='$saveMin_img',`type`='$typeImage' WHERE `id` ='$imgpage'";
        $pdo->exec($updatesql);

        //接受格式以外檔案直接刪除
        if (empty($subname)) {
            echo "上傳檔案格式錯誤";
            unlink($saveimg);
        }
        //dd($saveimg);
        //dd(getimagesize($saveimg));
        to("./vote_admin.php?photo=active");
    }

    
    
    
}
?>

<div class="vote_admin">
    <div class="control">
        <a href="./vote_admin.php">主題管理</a>
        <a href="./vote_admin.php?photo=active">圖片管理</a>
    </div>
    <div class="information">
        <h3>圖片管理</h3>
    </div>
    <div class="photoform">
            <div class="form form1">
                <div class="img picture1" style="background-image: url(<?= $min_img1; ?>);">
                </div>
                <div class="upload upload1">
                    <form action="./vote_admin.php?photo=active&p=1" method="post" enctype="multipart/form-data">
                        <label for="">圖片一</label>
                        <input type="file" name="advertise" id="">
                        <input type="submit" value="上傳">
                    </form>
                </div>
            </div>
            <div class="form form2">
                <div class="img picture2" style="background-image: url(<?= $min_img2; ?>);">
                </div>
                <div class="upload upload2">
                    <form action="./vote_admin.php?photo=active&p=2" method="post" enctype="multipart/form-data">
                        <label for="">圖片二</label>
                        <input type="file" name="advertise" id="">
                        <input type="submit" value="上傳">
                    </form>
                </div>
            </div>
            <div class="form form3">
                <div class="img picture3" style="background-image: url(<?= $min_img3; ?>);">
                </div>
                <div class="upload upload3">
                    <form action="./vote_admin.php?photo=active&p=3" method="post" enctype="multipart/form-data">
                        <label for="">圖片三</label>
                        <input type="file" name="advertise" id="">
                        <input type="submit" value="上傳">
                    </form>
                </div>
            </div>
        </div>
</div>