<!-- edit modal start -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable w-50">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">編輯客戶</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <!-- edit form start -->
        <form name="editForm" id="editForm" onsubmit="editSend(event)">
          <input type="hidden" name="user_id" id="user_id">
          <div class="row align-items-center">
            <div class="col-12">
              <img src="" id="editAvatar" alt="頭像">
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row">
                <div class="col-2">
                  <label for="account" class="col-form-label">帳號</label>
                </div>
                <div class="col-10">
                  <input type="text" id="account" name="account" class="form-control" aria-describedby="emailHelpInline">
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row">
                <div class="col-2">
                  <label for="password" class="col-form-label">密碼</label>
                </div>
                <div class="col-10">
                  <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpInline" disabled>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <label for="name" class="col-form-label">姓名</label>
                </div>
                <div class="col-8">
                  <input type="text" id="name" name="name" class="form-control" aria-describedby="nameInline">
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <label for="nick_name" class="col-form-label">暱稱</label>
                </div>
                <div class="col-8">
                  <input type="text" id="nick_name" name="nick_name" class="form-control" aria-describedby="nick_nameInline">
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <span class="col-form-label">性別</span>
                </div>
                <div class="col-8">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="0">
                    <label class="form-check-label" for="gender1">
                      男
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="1">
                    <label class="form-check-label" for="gender2">
                      女
                    </label>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <label for="birthday" class="col-form-label">生日</label>
                </div>
                <div class="col-8">
                  <input type="date" id="birthday" name="birthday" class="form-control" aria-describedby="birthdayHelpInline">
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <label for="mobile_phone" class="col-form-label">手機號碼</label>
                </div>
                <div class="col-8">
                  <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" aria-describedby="mobile_phoneInline">
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <label for="mobile_barcode" class="col-form-label">常用載具</label>
                </div>
                <div class="col-8">
                  <input type="text" id="mobile_barcode" name="mobile_barcode" class="form-control" aria-describedby="mobile_barcodeInline">
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <label for="gui_number" class="col-form-label">常用統編</label>
                </div>
                <div class="col-8">
                  <input type="text" id="gui_number" name="gui_number" class="form-control" aria-describedby="gui_numberInline">
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row">
                <div class="col-2">
                  <label for="address" class="col-form-label">常用地址</label>
                </div>
                <div class="col-8">
                  <select name="address" class="form-select" aria-label="Default select example">
                  </select>
                </div>
                <div class="col-2">
                  <button type="button" class="btn btn-primary" data-bs-target="#addressModal" data-bs-toggle="modal" onclick="addressModalData()">編輯地址</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row">
                <div class="col-2">
                  <label for="note" class="form-label">備註</label>
                </div>
                <div class="col-10">
                  <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                  <div class="form-text"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <span class="col-form-label">帳號狀態</span>
                </div>
                <div class="col-8">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status2" value="1">
                    <label class="form-check-label" for="status2">
                      啟用
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="status1" value="0">
                    <label class="form-check-label" for="status1">
                      停用
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <span class="col-form-label">建立時間</span>
                </div>
                <div class="col-8">
                  <span id="editCreateTime"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <span class="col-form-label">修改時間</span>
                </div>
                <div class="col-8">
                  <span id="editUpdateTime"></span>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-4">
                  <span class="col-form-label">修改人員</span>
                </div>
                <div class="col-8">
                  <span id="editFKUpdateId"></span>
                </div>
              </div>
            </div>
          </div>

          <div class="row align-items-center">
            <div class="col-6">
              <div class="alert" role="alert" id="failureInfo">

              </div>
            </div>
          </div>

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
          <button type="submit" class="btn btn-primary">送出</button>
        </form>
        <!-- edit form end -->


      </div>
    </div>
  </div>
</div>
<!-- edit modal end -->