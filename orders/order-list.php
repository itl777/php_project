<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/bt-navbar.php' ?>

<div class="container">
  <h2 class="my-4">訂單管理</h2>
  <a href="order-add.php" class="btn btn-primary mb-3">新增訂單</a>
  <div class="row">
    <div class="row">
      <div class="col-10 d-flex gap-3">
        <input class="form-control" type="date" id="startDate">
        <input class="form-control" type="date" id="endDate">
        <input class="form-control" type="text" id="memberSearch" placeholder="請輸入會員編號或名稱">
        <input class="form-control" type="text" id="productSearch" placeholder="請輸入商品編號或名稱">
        <select class="form-select" id="orderStatus">
          <option>請選擇</option>
        </select>
      </div>
      <div class="col-2 d-flex gap-3">
        <button class="btn btn-outline-primary" id="resetSearch">清空</button>
        <button class="btn btn-primary" id="executeSearch">搜尋</button>
      </div>

      <div class="mt-4">
        <table class="table align-middle">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">訂單日期</th>
              <th scope="col">會員姓名</th>
              <th scope="col">付款方式</th>
              <th scope="col">配送地址</th>
              <th scope="col">收件人</th>
              <th scope="col">訂單總金額</th>
              <th scope="col">訂單狀態</th>
              <th scope="col">操作</th>
            </tr>
          </thead>
          <tbody class="orderTableBody">
            <!-- 從 order-list-fetch.js 加載內容 -->
          </tbody>
        </table>

      </div>
    </div>

    <!-- pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination" id="pagination">
        <!-- 從 order-list-fetch.js 加載內容 -->
      </ul>
    </nav>

    <!-- delete success toast -->
    <div id="deleteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <!-- Toast 儲存成功 -->
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>




  </div>

  <?php include __DIR__ . '/../parts/scripts.php' ?>
  <script src="js/order-list-fetch.js"></script>
  <script src="js/order-status-list.js"></script>

  <?php include __DIR__ . '/../parts/html-foot.php' ?>