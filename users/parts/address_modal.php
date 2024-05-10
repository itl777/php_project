<!-- address modal start -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable w-50">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">編輯地址</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form name="addressForm" id="addressForm">
          <!-- user_id -->
          <input type="hidden" name="user_id">
          <div class="row align-items-center">




          </div>

          <button type="button" class="btn btn-warning" onclick="addAddressLine()">新增</button>

          <button type="button" class="btn btn-secondary" data-bs-target="#editModal" data-bs-toggle="modal">關閉</button>
          <button type="button" class="btn btn-primary" data-bs-target="#editModal" data-bs-toggle="modal">送出</button>

        </form>


      </div>
    </div>
  </div>
</div>
<!-- address modal end