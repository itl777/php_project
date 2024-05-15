<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/bt-navbar.php' ?>

<div class="container">
  <h2 class="my-5">編輯訂單</h2>

  <div class="container">
    <form name="orderEditForm" class="row justify-content-between">

      <div class="col-7 d-flex flex-wrap p-0 pe-5" style="height: 960px">

        <input type="number" class="form-control d-none" id="orderId" name="orderId">
        <input type="hidden" id="originalProductIds" name="originalProductIds" value="">

        <!-- 會員資料 -->
        <div class="col-6 mb-3 pe-3">
          <label for="orderDate" class="form-label">訂單日期</label>
          <input type="date" class="form-control" id="orderDate" name="orderDate">
          <span class="helper-text"></span>
        </div>

        <div class="col-6 mb-3 ps-3">
          <label for="memberId" class="form-label">會員編號</label>
          <input type="text" class="form-control search-member" id="memberId" name="memberId" placeholder="請輸入會員編號或姓名">
          <div class="dropdown-menu member-id-dropdown"></div>
          <span class="helper-text"></span>
        </div>

        <div class="col-6 mb-3 pe-3">
          <label for="memberName" class="form-label">會員姓名</label>
          <input type="text" class="form-control" id="memberName" name="memberName">
        </div>

        <!-- 付款方式 -->
        <div class="col-6 mb-3 ps-3">
          <label class="form-label mb-3">付款方式</label>
          <div class="col-12">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="credit-card">
              <label class="form-check-label" for="creditCard">信用卡</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="paymentMethod" id="linePay" value="line-pay">
              <label class="form-check-label" for="linePay">LINE PAY</label>
            </div>
          </div>
        </div>


        <div class="col-6 mb-3 pe-3">
          <label for="orderStatus" class="form-label">訂單狀態</label>
          <select class="form-select" id="orderStatus" name="orderStatus">
            <option disabled>請選擇</option>
          </select>
          <span class="helper-text"></span>
        </div>



        <!-- 收件人資料 -->
        <h5 class="col-12 mt-4 mb-3">收件人</h5>

        <div class="col-12 d-flex flex-column">

          <!-- 使用常用收件地址 -->
          <div class="form-check mb-2 p-0">
            <input class="form-check-input  d-none" type="radio" id="useSavedAddress" name="groupAddressType" value="">
            <label class="form-check-label  d-none" for="useSavedAddress">常用收件地址</label>
            <!-- 常用地址視窗按鈕 -->
            <button button type="button" class="btn btn-link btn-sm saved-address-modal-btn" data-bs-toggle="modal"
              data-bs-target="#addressModal">常用地址</button>
          </div>

          <!-- 常用地址視窗 -->
          <div class="modal fade modal-lg" id="addressModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="addressModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addressModalLabel">請選擇常用地址</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                  <button type="button" class="btn btn-primary">確定</button>
                </div>
              </div>
            </div>
          </div>


          <!-- 新增收件地址 -->
          <div class="form-check mb-3 d-none">
            <input class="form-check-input" type="radio" id="useNewAddress" name="groupAddressType" value="">
            <label class="form-check-label" for="useNewAddress">新增收件地址</label>
          </div>

          <!-- 新增收件地址內容表單 -->
          <div class="col-12 d-flex flex-wrap new-address">
            <!-- <div class="form-check col-12 mb-3 use-member-info">
              <input class="form-check-input" type="checkbox" value="" id="useMemberInfo">
              <label class="form-check-label" for="useMemberInfo">帶入會員資料</label>
            </div> -->
            <div class="col-6 mb-3 pe-3">
              <label for="recipientName" class="form-label">收件人</label>
              <input type="text" class="form-control" id="recipientName" name="recipientName">
              <span class="helper-text"></span>
            </div>

            <div class="col-6 mb-3 ps-3">
              <label for="recipientMobile" class="form-label">收件人手機</label>
              <input type="text" class="form-control" id="recipientMobile" name="recipientMobile">
              <span class="helper-text"></span>
            </div>


            <div class="col-6 mb-3 pe-3">
              <label for="city" class="form-label">縣市</label>
              <select class="form-select" id="city" name="city">
                <option selected>請選擇</option>
              </select>
              <span class="helper-text"></span>
            </div>

            <div class="col-6 mb-3 ps-3">
              <label for="district" class="form-label">鄉鎮市區</label>
              <select class="form-select" id="district" name="district">
                <option selected>請選擇</option>
              </select>
              <span class="helper-text"></span>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">地址</label>
              <input type="text" class="form-control" id="address" name="address">
              <span class="helper-text"></span>
              <span class="helper-text address-helper-text"></span>
            </div>
          </div>

          <hr class="my-4">
          <h5 class="col-12 mb-3">發票</h5>

          <div class="col-12 d-flex flex-wrap">

            <div class="col-12 mb-2 form-check">
              <input class="form-check-input" type="radio" id="useMemberInvoice" name="groupInvoiceType" value="">
              <label class="form-check-label" for="useMemberInvoice">會員載具</label>
            </div>

            <div class="col-12 mb-2 form-check">
              <input class="form-check-input" type="radio" id="useMobileInvoice" name="groupInvoiceType" value="">
              <label class="form-check-label" for="useMobileInvoice">手機載具</label>
            </div>

            <!-- 手機載具 input -->
            <div class="col-12 d-flex mobile-invoice-div">
              <div class="col-6 mb-3 pe-3">
                <input type="text" class="form-control" id="mobileInvoice" name="mobileInvoice" placeholder="請輸入手機載具">
                <span class="helper-text"></span>
              </div>


              <div class="col-6 form-check d-none">
                <input class="form-check-input d-none" type="checkbox" id="saveMobileInvoice" value="">
                <label class="col-12 form-check-label  d-none" for="saveMobileInvoice">儲存至會員資料</label>
              </div>
            </div>


            <div class="col-12 mb-2 form-check">
              <input class="form-check-input" type="radio" id="useTaxId" name="groupInvoiceType" value="">
              <label class="form-check-label" for="useTaxId">公司發票</label>
            </div>

            <!-- 公司發票 input -->
            <div class="col-12 d-flex tax-id-div">
              <div class="col-6 mb-3 pe-3">
                <input type="text" class="form-control" id="taxId" name="taxId" placeholder="請輸入公司統編">
                <span class="helper-text"></span>
              </div>

              <div class="col-6 form-check d-none">
                <input class="form-check-input d-none" type="checkbox" id="saveTaxId" value="option1">
                <label class="col-12 form-check-label  d-none" for="saveTaxId">儲存至會員資料</label>
              </div>
            </div>

          </div>
        </div>
      </div>


      <!-- 訂購商品 -->
      <div class="col-5 p-4 order-list position-relative d-flex flex-column">
        <h5 class="col-12 mb-4">訂購商品</h5>
        <div class="col-12 mb-4">
          <input type="text" class="form-control search-product"  placeholder="請輸入商品編號或名稱完成新增">
          <div class="dropdown-menu product-id-dropdown"></div>
          <span class="helper-text product-helper-text"></span>
        </div>

        <div class="order-item-container">
          <!-- 資料從 search-product.js 過來 -->
        </div>

        <div class="col-12 mt-3">
          <p class="fw-bold mb-1">訂單總金額</p>
          <h3 class="orderTotal"></h3>
        </div>


      </div>


      <input type="submit" class="btn btn-primary my-5" value="儲存訂單">

    </form>
  </div>



</div>

<?php include __DIR__ . '/../parts/scripts.php' ?>

<script src="js/order-status-list.js"></script>
<script src="js/get-order.js"></script>
<script src="js/order-general.js"></script>
<script src="js/get-member-address-fetch.js"></script>
<script src="js/search-member.js"></script>
<!-- <script src="js/address.js"></script> -->
<script src="js/city-district-selection.js"></script>
<script src="js/order-invoice.js"></script>
<script src="js/search-product.js"></script>
<script src="js/order-edit-submit.js"></script>
<script>
  // 設定 <title>
  document.title = '編輯訂單';
</script>

<?php include __DIR__ . '/../parts/html-foot.php' ?>
