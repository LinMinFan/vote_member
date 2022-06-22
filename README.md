# 投票系統作業

## 使用者故事(user story)

### 網頁配置

* 畫面切割為上中下三塊以min hight 100vh 設計
    * 上方(header)，佔畫面比約 10vh 或 100px 可視情況調整
        * 置頂navbar
        * logo 網頁主題 = 回首頁
        * 投票中心連結按鈕
        * 會員中心連結按鈕
        * 會員 登入 / 登出 按鈕
        * 訊息欄位
    * 中間(section)為主要內容區min hight 不小於 80vh
        * 主要內容分為 首頁 投票中心 會員登入頁 註冊會員 重設密碼 會員中心
    * 下方(footer)為版權宣告，佔5vh 或 50px 可視情況調整
    * 背景區(background)背景獨立區塊製作可用於各分頁維持網頁主題一致性

### 使用者端
* 進入首頁時，可以看到投票項目列表
* 未登入的使用者只可以看到"投票結果"
* 已登入的使用者可以在投票列表看到"投票結果"及"參加投票"按鈕
* 按下參加投票 前往投票中心 進入選擇主題參加投票
* 選擇項目後，按送出，完成投票
* 另有放棄投票按鈕，按下後回投票中心
* 完成投票後，跳至投票結果頁
* 投票結果有一顆按鈕可以返回投票中心
* 已登入使用者可直接前往投票中心參加投票
* 投票中心預設為投票項目列表並有投票分類查詢、查看已參加投票、新增投票、刪除投票
    * 投票列表提供排序功能 大=>小 / 小=>大
    * 投票列表可以分頁
    * 新增投票
        * 點選新增投票後進入新增投票表單頁面
        * 表單資料包含投票主題與選項
        * 選項可選單選複選
        * 提供增加選項按鈕，選項可自行增加但最少為2項
        * 提供刪除選項按鈕，自行增加選項可減少但最少為2項
        * 完成設定點選新增按鈕，即增加一個投票主題
        * 只有自己發起的投票才能編輯與刪除
        * 刪除主題會連同選項與結果資料由資料庫刪除

    * 投票分類
        * 以食、衣、住、行、育、樂、其他，共分七大類

## 會員註冊系統

### 會員登入頁

* 已註冊會員可直接登入，登入後會到會員中心
* 已註冊會員忘記密碼可前往忘記密碼頁申請變更密碼
* 未註冊會員可點選註冊帳號前往會員註冊頁
* 未註冊會員輸入帳號密碼會跳回會員登入頁並出現你還不是會員訊息

### 會員帳號密碼確認頁

* 於會員登入頁輸入帳號密碼後先轉至帳號密碼確認頁進行確認
* 比對資料庫帳號是否存在，密碼是否正確
* 正確會到會員中心登入紐變為登出紐並可以開始使用功能
* 帳號不正確回到會員登入頁並顯示帳號不存在訊息
* 帳號正確但密碼不正確回到會員登入頁並顯示密碼錯誤訊息

### 會員註冊頁

* 資料填寫完畢送往會員資料確認頁
* 若資料錯誤重回此頁
* 會員需註冊資料
    * "id":預設會員編號(不可修改)
    * "account":帳號(不可修改)
    * "password":密碼(可修改)
    * "chk_password":確認密碼，僅作核對不送入資料庫
    * "nick":暱稱(可修改)
    * "name":姓名(不可修改)
    * "birthday":生日(不可修改)
    * "信箱":email(不可修改，找回密碼時使用)
* 各欄位都須填寫資料才可送出
* 下方有送出按鈕與重置按鈕

### 會員資料確認頁

* 需比對資料(資料不得重複)包括"帳號"，密碼(可以重覆但須與確認密碼一致)，"信箱"
* 帳號重覆回到會員註冊頁並顯示此帳號已有人使用請變更帳號
* 密碼與確認密碼不一致回到會員註冊頁並顯示確認密碼錯誤
* 信箱重覆回到會員註冊頁並顯示此信箱已有人使用請變更信箱
* 輸入密碼以md5轉碼儲存於資料庫

### 忘記密碼頁

* 已註冊帳號但密碼忘記則在此頁填寫帳號與信箱重新設定密碼
* 填寫送出前往忘記密碼帳號信箱核對頁

### 忘記密碼帳號信箱核對頁

* 帳號不正確回到忘記密碼頁並顯示帳號不存在訊息
* 信箱不正確回到忘記密碼頁並顯示信箱錯誤訊息
* 帳號信箱都正確時將密碼變更為1234儲存資料庫並回到會員登入頁顯示密碼已變更為1234，請以此密碼登入後進行變更密碼(可以的話用email發回)

### 會員中心頁

* 提供功能包括
    * 編輯會員資料
        * 前往編輯會員頁
    * 刪除帳號功能
        * 前往刪除帳號頁
            * 點選確認視窗後才執行功能
    * 其他可擴充功能

### 刪除帳號頁

* 僅處理刪除帳號刪除帳號功能，刪除後回會員登入頁
* 確定刪除時不傳值，由session[user]取帳號刪除避免帶值輸入網址刪除帳號

### 編輯會員頁

* 提供修改會員資料包括
* 變更暱稱，密碼
* 暱稱不需核對
* 點選編輯後前往編輯會員核對頁

### 編輯會員核對頁

* 僅核對密碼與確認密碼
* 密碼與確認密碼不一致回到編輯會員頁並顯示確認密碼錯誤

### 會員登出頁

* 會員登入後登入按鈕都變成登出按鈕
* 點選登出按鈕回到會員登入頁按鈕恢復登入按鈕狀態

# 資料表設計

## 資料庫名稱:vote

### 會員資料:users

* 密碼使用md5存入長度需32

|名稱|類型|屬性|預設值|額外資訊|備註|
|--|--|--|--|--|--|
|id|int(11)|UNSIGNED|無|AI|會員編號|
|account|varchar(12)|--|無|--|帳號|
|password|varchar(40)|--|無|--|密碼|
|nick|varchar(18)|--|無|--|暱稱|
|name|varchar(30)|--|無|--|姓名|
|email|varchar(128)|--|無|--|電子信箱|

### 投票列表:subjects

|名稱|類型|屬性|預設值|額外資訊|備註|
|--|--|--|--|--|--|
|id|int(11)|UNSIGNED|無|AI|序號|
|subjects|varchar(128)|--|無|--|投票主題|
|type_id|int(11)|--|無|--|主題類別|
|admin|int(11)|--|無|--|發起人id|
|multiple|boolean(1)|--|無|--|單/複選|
|mulit_limit|tinyint(2)|--|1|--|項目數|
|start|date|--|無|--|開始日期|
|end|date|--|無|--|結束日期|
|total|int(11)|--|無|--|參加人數|

### 投票選項:options

|名稱|類型|屬性|預設值|額外資訊|備註|
|--|--|--|--|--|--|
|id|int(11)|UNSIGNED|無|AI|序號|
|subject_id|int(11)|--|無|--|投票主題id|
|choice|varchar(128)|--|無|--|選項內容|
|total|int(11)|--|無|--|選取次數|

### 投票紀錄:log

|名稱|類型|屬性|預設值|額外資訊|備註|
|--|--|--|--|--|--|
|id|int(11)|UNSIGNED|無|AI|序號|
|user_id|int(11)|--|無|--|投票者id|
|subject_id|int(11)|--|無|--|投票主題id|
|vote_time|timestamp|--|無|--|投票時間|

### 投票類型:type

|名稱|類型|屬性|預設值|額外資訊|備註|
|--|--|--|--|--|--|
|id|int(11)|UNSIGNED|無|AI|序號|
|name|varchar(4)|--|無|--|分類名稱|
