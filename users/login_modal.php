<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">登入</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form name="loginForm" id="loginForm" onsubmit="loginData(event)">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">帳號</label>
            <input type="text" class="form-control" name="account">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">密碼</label>
            <input type="password" class="form-control" name="password">
          </div>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
          <button type="submit" class="btn btn-primary">登入</button>
        </form>

      </div>
    </div>
  </div>
</div>


<script>
  const loginData = function(e){
    e.preventDefault();
    let sendData = new FormData(document.loginForm); // 沒有外觀的表單物件
    fetch(`login_api.php`, {
      method: 'POST',
      body: sendData,
    }).then(r => r.json()).then(data => {
      console.log(output);
    });
  }
</script>