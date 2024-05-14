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
        <form name="editForm" id="editForm" onsubmit="userModalSendData(event)">







        </form>
        <form name="avatarForm" hidden>
          <input type="file" name="avatar_upload" accept="image/.jpg,.jpeg,.png,.bmp,.gif,.svg,.webp" />
        </form>
        <!-- edit form end -->


      </div>
    </div>
  </div>
</div>
<!-- edit modal end -->