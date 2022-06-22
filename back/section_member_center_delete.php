<div class="confirm">
<!-- 雙重確認刪除帳號 -->
<a class="delete" id="delete" href="./member_center.php?delete=activ&confirm=true" style="--clr:#ff1867"><span>刪除帳號</span><i></i></a>
<!-- 先點擊確認再彈跳視窗確認才轉至刪除帳號頁 -->
</div>
<?php
//使用js功能彈跳視窗
if (isset($_GET['confirm'])) {
    echo "<script>
    if (confirm('確定刪除？')) {
        location.href='./api/remove_acc.php';
    }else{
        location.href='./member_center.php?delete=activ';
    }
    </script>";
    }

?>
