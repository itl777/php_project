<?php

$title = '新增分店';
$pageName = 'branch_add';
?>

<?php include __DIR__ . '/../../parts/html-head.php' ?>

<style>
  form .mb-3 .form-text {
    color: tomato;
    font-weight: 800;
  }
</style>


<div class="container mt-5">
  <div class="row">
    <div class="col-10">
      <div class="card">
        <div class="card-body">
          <form name="form1" class="p-3" onsubmit="sendData(event)">
            <div class="mb-3 col-5">
              <label for="branch_name" class="form-label">分店名字</label>
              <input type="text" class="form-control" id="branch_name" name="branch_name">
              <div class="form-text"></div>
            </div>

            <div class="mb-3 col-5 ">
              <label for="theme_id" class="form-label">遊玩行程主題</label>
              <select name="theme_id" id="theme_id">
                <?php foreach ($branches as $branch): ?>
                  <option value="<?php echo $branch['theme_id']; ?>"><?php echo $branch['theme_name']; ?></option>
                <?php endforeach; ?>
              </select><br>
            </div>

            <div class="mb-3 col-5">
              <label for="branch_phone" class="form-label">電話</label>
              <input type="text" class="form-control" id="branch_phone" name="branch_phone" placeholder="請輸入電話">
              <div class="form-text"></div>
            </div>

            <div class="row">
              <div class="mb-3 col-5">
                <label for="open_time" class="form-label">開門時間</label>
                <input type="text" class="form-control" id="open_time" name="open_time" placeholder="請輸入時間">
                <div class="form-text"></div>
              </div>
              <div class="mb-3 col-5">
                <label for="close_time" class="form-label">閉門時間</label>
                <input type="text" class="form-control" id="close_time" name="close_time" placeholder="請輸入時間">
                <div class="form-text"></div>
              </div>
            </div>

            <div class="row">
              <div class="mb-3 col-5">
                <label for="branch_status" class="form-label">營業狀態</label>
                <select class="form-select" aria-label="Default select example" id="branch_status" name="branch_status">
                  <option selected>狀態</option>
                  <option value="新開幕">新開幕</option>
                  <option value="營業中">營業中</option>
                  <option value="裝潢">裝潢中</option>
                  <option value="停止營業">停止營業</option>
                </select>
              </div>

              <div class="mb-3 col-8">
                <label for="branch_address" class="form-label">地址</label>
                <textarea class="form-control" id="branch_address" name="branch_address" cols="30" rows="3"
                  placeholder="請輸入地址"></textarea>
                <div class="form-text"></div>
              </div>

              <div class="d-flex justify-content-end me-3">
                <button type="submit" class="btn btn-primary">新增</button>
              </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal bt 彈跳視窗-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">新增成功</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          資料新增成功 d(`･∀･)b
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" onclick="location.href='theme_list.php'">到主題頁</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../../parts/scripts.php' ?>



<script>
  const nameField = document.getElementById('branch_name');
  // const imgField = document.getElementById('theme_img');
  // const descField = document.getElementById('theme_desc');
  // const priceField = document.getElementById('price');
  // const diffField = document.getElementById('difficulty');
  // const playersField = document.getElementById('suitable_players');
  // const startTimeField = document.getElementById('start_time');
  // const endTime = document.getElementById('end_time');
  // const themeTime = document.getElementById('theme_time');
  // const intervals = document.getElementById('intervals');
  // const startDate = document.getElementById('start_date');
  // const endDate = document.getElementById('end_date');

  // console.log(document.form1.name);

  const sendData = e => {
    e.preventDefault(); // 不要讓 form1 以傳統的方式送出

    // nameField.style.border = '1px solid #CCCCCC';
    // nameField.nextElementSibling.innerText = '';

    // imgField.style.border = '1px solid #CCCCCC';

    // descField.style.border = '1px solid #CCCCCC';
    // descField.nextElementSibling.innerText = '';

    // priceField.style.border = '1px solid #CCCCCC';
    // priceField.nextElementSibling.innerText = '';

    // diffField.style.border = '1px solid #CCCCCC';

    // playersField.style.border = '1px solid #CCCCCC';
    // playersField.nextElementSibling.innerText = '';

    // startTimeField.style.border = '1px solid #CCCCCC';
    // startTimeField.nextElementSibling.innerText = '';

    // endTime.style.border = '1px solid #CCCCCC';
    // endTime.nextElementSibling.innerText = '';

    // themeTime.style.border = '1px solid #CCCCCC';
    // intervals.style.border = '1px solid #CCCCCC';
    // startDate.style.border = '1px solid #CCCCCC';
    // endDate.style.border = '1px solid #CCCCCC';

    // TODO: 欄位資料檢查

    let isPass = true; // 表單有沒有通過檢查
    if (nameField.value.length < 1) {
      isPass = false;
      nameField.style.border = '1px solid tomato';
      nameField.nextElementSibling.innerText = '請填寫主題名稱';
    }
    // if (imgField.value.length === 0) {
    //   isPass = false;
    //   imgField.style.border = '1px solid tomato';
    // }
    // if (descField.value.length < 1) {
    //   isPass = false;
    //   descField.style.border = '1px solid tomato';
    //   descField.nextElementSibling.innerText = '請填寫描述';
    // } else if (descField.value.length > 250) {
    //   isPass = false;
    //   descField.style.border = '1px solid tomato';
    //   descField.nextElementSibling.innerText = '超過字數限制';
    // }
    // if (priceField.value.length < 1) {
    //   isPass = false;
    //   priceField.style.border = '1px solid tomato';
    //   priceField.nextElementSibling.innerText = '請填寫價錢';
    // }

    // 檢查是否已經存在警告訊息元素
    // var existingWarningMessage = diffField.parentNode.querySelector('.warning-message');

    // if (diffField.value === '難度') {
    //   isPass = false;
    //   diffField.style.border = '1px solid tomato';

    // 如果不存在警告訊息元素，則創建並插入
    // if (!existingWarningMessage) {
    //   var warningMessage = document.createElement('div');
    //   warningMessage.textContent = '請選擇一個不同的難度等級!';
    //   warningMessage.style.fontSize = '13px';
    //   warningMessage.style.fontWeight = 'bold';
    //   warningMessage.style.marginTop = '5px';
    //   warningMessage.style.color = 'tomato';
    //   warningMessage.className = 'warning-message'; // 添加一個唯一的類名

    // 插入警告訊息元素到 diffField 下面
    // diffField.parentNode.insertBefore(warningMessage, diffField.nextSibling);
    //   }
    // } else {
    //   // 如果不再是 '難度'，且存在警告訊息元素，則移除
    //   if (existingWarningMessage) {
    //     existingWarningMessage.parentNode.removeChild(existingWarningMessage);
    //   }
    // }

    // if (playersField.value.length < 1) {
    //   isPass = false;
    //   playersField.style.border = '1px solid tomato';
    //   playersField.nextElementSibling.innerText = '請填寫遊玩人數 _ ~ _ 人';
    // }
    // if (startTimeField.value.length < 1) {
    //   isPass = false;
    //   startTimeField.style.border = '1px solid tomato';
    //   startTimeField.nextElementSibling.innerText = '請填寫開始時間';
    // }
    // if (endTime.value.length < 1) {
    //   isPass = false;
    //   endTime.style.border = '1px solid tomato';
    //   endTime.nextElementSibling.innerText = '請填寫結束時間';
    // }

    // 檢查是否已經存在警告訊息元素
    // var existingWarningMessage = themeTime.parentNode.querySelector('.warning-message');

    // if (themeTime.value === '時長') {
    //   isPass = false;
    //   themeTime.style.border = '1px solid tomato';

    //   // 如果不存在警告訊息元素，則創建並插入
    //   if (!existingWarningMessage) {
    //     var warningMessage = document.createElement('div');
    //     warningMessage.textContent = '請選擇時長';
    //     warningMessage.style.fontSize = '13px';
    //     warningMessage.style.fontWeight = 'bold';
    //     warningMessage.style.marginTop = '5px';
    //     warningMessage.style.color = 'tomato';
    //     warningMessage.className = 'warning-message'; // 添加一個唯一的類名

    //     // 插入警告訊息元素到 下面
    //     themeTime.parentNode.insertBefore(warningMessage, themeTime.nextSibling);
    //   }
    // } else {
    //   // 如果不再是 '時長'，且存在警告訊息元素，則移除
    //   if (existingWarningMessage) {
    //     existingWarningMessage.parentNode.removeChild(existingWarningMessage);
    //   }
    // }

    // // 檢查是否已經存在警告訊息元素
    // var existingWarningMessage = intervals.parentNode.querySelector('.warning-message');

    // if (intervals.value === '間隔') {
    //   isPass = false;
    //   intervals.style.border = '1px solid tomato';

    //   // 如果不存在警告訊息元素，則創建並插入
    //   if (!existingWarningMessage) {
    //     var warningMessage = document.createElement('div');
    //     warningMessage.textContent = '請選擇間隔時間';
    //     warningMessage.style.fontSize = '13px';
    //     warningMessage.style.fontWeight = 'bold';
    //     warningMessage.style.marginTop = '5px';
    //     warningMessage.style.color = 'tomato';
    //     warningMessage.className = 'warning-message'; // 添加一個唯一的類名

    //     // 插入警告訊息元素到 diffField 下面
    //     intervals.parentNode.insertBefore(warningMessage, intervals.nextSibling);
    //   }
    // } else {
    //   // 如果不再是 '難度'，且存在警告訊息元素，則移除
    //   if (existingWarningMessage) {
    //     existingWarningMessage.parentNode.removeChild(existingWarningMessage);
    //   }
    // }

    // // 檢查是否已經存在警告訊息元素
    // var existingWarningMessage = startDate.parentNode.querySelector('.warning-message');

    // if (startDate.value === '') {
    //   // 日期是必填欄位，如果沒有輸入則顯示錯誤
    //   isPass = false;
    //   startDate.style.border = '1px solid tomato';
    //   startDate.nextElementSibling.innerText = '請選擇開始日期';
    // }

    // // 檢查是否已經存在警告訊息元素
    // var existingWarningMessage = startDate.parentNode.querySelector('.warning-message');

    // if (endDate.value === '') {
    //   // 日期是必填欄位，如果沒有輸入則顯示錯誤
    //   isPass = false;
    //   endDate.style.border = '1px solid tomato';
    //   endDate.nextElementSibling.innerText = '請選擇結束日期';
    // }


    // 有通過檢查, 才要送表單
    if (isPass) {
      const fd = new FormData(document.form1); // 沒有外觀的表單物件

      fetch('branch_add_api.php', {
        method: 'POST',
        body: fd, // Content-Type: multipart/form-data
      }).then(r => r.json())
        .then(data => {
          console.log(data);
          if (data.success) {
            myModal.show();
          } else { }
        })
        .catch(ex => console.log(ex))
    }
  };
  const myModal = new bootstrap.Modal('#staticBackdrop')
</script>
<?php include __DIR__ . '/../../parts/html-foot.php' ?>