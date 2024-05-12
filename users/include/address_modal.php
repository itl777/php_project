<!-- address modal start -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable w-50">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addressLabel">編輯地址</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form name="addressForm" id="addressForm">
          <!-- user_id -->
          <input type="hidden" name="user_id">
          <div class="row align-items-center">








          </div>
          <div class="col">
            <div class="row align-items-center">
              <div class="col-4 d-flex justify-content-start">
                <button type="button" class="btn btn-warning" onclick="addAddressLine()">新增</button>
              </div>
              <div class="col-4 d-flex justify-content-start">
                <div class="alert alert-success opacity-0 m-0 " role="alert" style="transition: all 500ms ease-out;">地址新增成功</div>
              </div>
              <div class="col-4 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-target="#editModal" data-bs-toggle="modal">關閉</button>
                <button type="submit" class="btn btn-primary" onclick="addressSendData(event)">送出</button>
              </div>
            </div>
          </div>
        </form>


      </div>
    </div>
  </div>
</div>
<!-- address modal end