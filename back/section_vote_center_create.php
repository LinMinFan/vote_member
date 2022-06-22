<div class="create">
    <div class="createForm">
        <form action="" method="POST">
            <div class="inputbox submajor">
                <label class="subLb" for="">投票主題：</label>
                <input class="subjectVote" type="text" required>
            </div>
            <!-- 選擇 單 / 複 選 -->
            <div class="selector">
                <h4>選擇 單 / 複選</h4>
                <input type="radio" name="multiple" value="0" checked>
                <label>單選</label>
                <input type="radio" name="multiple" value="1">
                <label>複選</label>
            </div>
            <!-- 選項區 -->
            <div class="selebth">
                <button onclick="add()">增加</button>
                <button value="click">減少</button>
            </div>
            <div class="optionLimit" id="optionLimit">
                <label>選項1:</label><input type="text" name="option[]" required>
                <label>選項2:</label><input type="text" name="option[]" required>
                <label>選項3:</label><input type="text" name="option[]">
            </div>
            <div class="inputbox opbth">
                <input type="submit" name="" id="" value="送出">
                <input type="reset" name="" id="" value="清除">
            </div>
        </form>
    </div>
</div>


<script>
    //建立選項數

    //建立標籤lable
    let x = document.createElement('lable');

    //建立標籤input與屬性    
    let y = document.createElement('input');
    y.setAttribute('type', 'text');
    y.setAttribute('name', 'option[]');

    //定位增加減少按鈕
    let bth = document.querySelectorAll('button');
    let addbth = bth[0];
    let debth = bth[1];

    let opt = document.getElementById('optionLimit');

    let lables = document.querySelectorAll('label');
    console.log(lables);

    //lables[3] = 選項1 12 = 10
    
    //監聽按鈕點擊增加欄位
    let i = lables.length;
    function add() {
        x.innerHTML = `選項${i-2}:`;
        let sumx ='';
        let sumy = '';
        sunx = sumx + opt.appendChild(x);
        suny = suny + opt.appendChild(y);
        opt.appendChild(sunx);
        opt.appendChild(suny);
        i++;
        console.log(i);
    }
</script>