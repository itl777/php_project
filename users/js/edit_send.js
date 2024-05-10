const {
  account: accountEl,
  name: nameEl,
  nick_name: nick_nameEl,
  birthday: birthdayEl,
  mobile_phone: mobile_phoneEl,
} = document.editForm;

const fields = [accountEl, nameEl, nick_nameEl, birthdayEl, mobile_phoneEl];

function validateAccount(account) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(account);
}

function validatemobile_phone(mobile_phone) {
  const re = /^09\d{2}-?\d{3}-?\d{3}$/;
  return re.test(mobile_phone);
}


const editSend = function (e) {
  e.preventDefault(); // 不要讓表單以傳統的方式送出
  let isPass = true; // 整個表單有沒有通過檢查


  // 回復欄位的外觀
  for (let el of fields) {
    el.style.border = '1px solid #CCC';
    el.nextElementSibling.innerHTML = '';
  }


  // TODO: 檢查各個欄位的資料, 有沒有符合規定

  if (accountEl.value && !validateAccount(accountEl.value)) {
    isPass = false;
    console.log(`${isPass} accountEl`);
    accountEl.style.border = '1px solid red';
    accountEl.nextElementSibling.innerHTML = '請填寫正確的 Email ! 並請勿超過100字元';
  }


  if (nameEl.value.length < 2 || nameEl.value.length > 20) {
    isPass = false; // 沒有通過檢查
    console.log(`${isPass} nameEl`);
    nameEl.style.border = '1px solid red';
    nameEl.nextElementSibling.innerHTML = '請填寫正確的姓名! 介於2~20字元之間';
  }

  if (nick_nameEl.value.length > 50) {
    isPass = false; // 沒有通過檢查
    console.log(`${isPass} nick_nameEl`);
    nick_nameEl.style.border = '1px solid red';
    nick_nameEl.nextElementSibling.innerHTML = '暱稱請勿超過50字元!';
  }

  let today = new Date();
  let date = new Date(today);
  date.setFullYear(date.getFullYear() - 18);

  if (birthdayEl.value && new Date(birthdayEl.value) > new Date(date)) {
    isPass = false; // 沒有通過檢查
    console.log(`${isPass} birthdayEl`);
    birthdayEl.style.border = '1px solid red';
    birthdayEl.nextElementSibling.innerHTML = '未成年請勿申請喔!';
  }


  if (mobile_phoneEl.value.length !== 10 || !validatemobile_phone(mobile_phoneEl.value)) {
    isPass = false;
    console.log(`${isPass} mobile_phoneEl`);
    mobile_phoneEl.style.border = '1px solid red';
    mobile_phoneEl.nextElementSibling.innerHTML = '請填寫正確的手機10碼數字，勿填寫其他標記';
  }

  // 有通過檢查才發送表單
  if (isPass) {
    const fd = new FormData(document.editForm); // 沒有外觀的表單物件

    fetch(`api/edit_send_api.php`, {
      method: 'POST',
      body: fd,
    }).then(r => r.json()).then(data => {
      let failureInfo = document.querySelector('#failureInfo');
      failureInfo.innerHTML = '';
      failureInfo.classList = 'alert';
      if (data.success) {
        failureInfo.classList.add('alert-success');
        failureInfo.innerHTML = '資料修改成功';

      } else {
        failureInfo.classList.add('alert-danger');
        failureInfo.innerHTML = data.error;
      }
    })
  }



  // 地址: 兩層選單的參考
  // https://dennykuo.github.io/tw-city-selector/#/


}