<div class="create">
    <div class="createForm">
        <form action="./api/add_vote.php" method="post">
            <div class="inputbox submajor">
                <label class="subLb" for="">投票主題：</label>
                <input class="subjectVote" type="text" name="subject" required>
            </div>
            <!-- 主題分類 -->
            <div class="type_id">
                <label for="">類別:</label>
                <select name="type_id" id="">
                    <option value="1">食</option>
                    <option value="2">衣</option>
                    <option value="3">住</option>
                    <option value="4">行</option>
                    <option value="5">育</option>
                    <option value="6">樂</option>
                    <option value="7">其他</option>
                </select>
            </div>
            <!-- 開始 / 結束時間 -->
            <div class="start_end">
                <label for="">開始時間</label>
                <input type="date" name="start" required>
                <label for="">結束時間</label>
                <input type="date" name="end" required>
            </div>
            <!-- 選擇 單 / 複 選 -->
            <div class="selector">
                <h4>選擇 單 / 複選</h4>
                <input type="radio" name="multiple" value="0" checked>
                <label>單選</label>
                <input type="radio" name="multiple" value="1">
                <label>複選</label>
            </div>
            <div class="optionLimit" id="optionLimit">
                <label class="opt">選項1:</label><input type="text" name="choice[]" required>
                <label class="opt">選項2:</label><input type="text" name="choice[]" required>
                <label class="opt">選項3:</label><input type="text" name="choice[]">
            </div>
            <div class="inputbox opbth">
                <input type="submit" name="" id="" value="送出">
                <input type="reset" name="" id="" value="清除">
            </div>
        </form>
        <!-- 選項區 -->
        <div class="selebth">
            <button onclick="add()">增加</button>
            <button onclick="del()">減少</button>
            <span id="text"></span>
        </div>
    </div>
</div>


<script>
    //建立增加選項數函式
    function add() {
        let total=document.querySelectorAll(".opt");
        console.log(total.length);
        
    //建立標籤lable,input
    let para1 = document.createElement("label");
    let para2 = document.createElement("input");
    para2.setAttribute('type','text');
    para2.setAttribute('name','choice[]');
    para2.setAttribute("class","opt")    
    // 建立lable文字內容
    let node = document.createTextNode(`選項${total.length + 1}:`);
    
    // 插入lable文字內容
    para1.appendChild(node);
    
    //限制增加數量 基本3個
    if(total.length < 10){
    document.getElementById("optionLimit").appendChild(para1);
    document.getElementById("optionLimit").appendChild(para2);
    }else{
        document.getElementById('text').innerHTML='最多填寫10項';
    }
}
    //建立減少選項數函式
    function del() {
        let total=document.querySelectorAll(".opt");
        console.log(total.length);
        
    
    //移除標籤限制數量 基本3個
    if(total.length > 3){
    console.log(document.getElementById("optionLimit").lastElementChild);
    document.getElementById("optionLimit").lastElementChild.remove();
    document.getElementById("optionLimit").lastElementChild.remove();
    }else{
        document.getElementById('text').innerHTML='最少填寫2項';
    }
}
</script>