document.addEventListener("DOMContentLoaded", function () {
  document.title = '訂單管理';

  // 取得 url ?page=
  const currentPage =
    new URLSearchParams(window.location.search).get("page") || 1;
    fetchOrders(currentPage);

  function fetchOrders(page) {
    fetch(`api/order-list-api.php?page=${page}`) // 加載指定頁數的資料
      .then((response) => response.json())
      .then((result) => {
        // 解構賦值 Destructuring Assignment
        const { data, totalPages } = result;
        const tableBody = document.querySelector(".orderTableBody");
        // 換頁後，清空原本 tbody 的內容
        tableBody.innerHTML = "";
        // 將新分頁的資料取出來
        data.forEach((order) => {
          const row = `<tr>
            <td>${order.order_id}</td>
            <td>${order.order_date}</td>
            <td>${order.name}</td>
            <td>${order.payment_method}</td>
            <td>${order.city_name + order.district_name + order.order_address}</td>
            <td>${order.recipient_name}</td>
            <td>${order.total_amount}</td>
            <td>${order.order_status}</td>
            <td>
            <a href="order-edit.php?id=${order.order_id}" class="btn btn-primary me-2"><i class="fa-solid fa-pen-to-square"></i></a>
            <a onclick="deleteOrder(${order.order_id})" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
            </tr>`;
          tableBody.innerHTML += row;
        });
        updatePagination(page, totalPages);
      })
      .catch((error) => console.error("Error loading orders:", error));
  }

  function updatePagination(currentPage, totalPages) {
    const pagination = document.querySelector("#pagination");
    //清空 pagination
    pagination.innerHTML = "";
    for (let page = 1; page <= totalPages; page++) {
      const pageItem = document.createElement("li");
      pageItem.className = "page-item " + (page == currentPage ? "active" : "");
      const pageLink = document.createElement("a");
      pageLink.className = "page-link";
      pageLink.href = `?page=${page}`;
      pageLink.textContent = page;
      pageItem.appendChild(pageLink);
      pagination.appendChild(pageItem);
    }
  }


  showToastFromStorage();

});

  
const deleteOrder = (orderId) => {
  if (confirm(`是否要刪除訂單 ${orderId}？`)) {
    fetch(`api/order-delete-api.php?orderId=${orderId}`)
      .then(response => response.json())
      .then(result => {
        if(result.success) {
          // alert('刪除成功');
          saveToastMessage('刪除成功');
          window.location.reload(); // 刷新當前頁面或重新載入數據
        } else {
          alert('刪除失敗');
        }
      })
      .catch(error => {
        console.error('刪除失敗:', error);
        alert('刪除錯誤，請稍後再試');
      });
  }
};

// 新增 toast
function showToast(message, isError = false) {
  const toastElement = document.getElementById('deleteToast');
  const toastBody = toastElement.querySelector('.toast-body');
  // Toast 內容
  toastBody.textContent = message;
  // Toast class
  toastBody.className = `toast-body ${isError ? 'text-danger' : 'text-success'}`;
  // 初始化 Toast、自動隱藏 toast
  const toast = new bootstrap.Toast(toastElement, {
    delay: 8000,
    autohide: true
  });
  // 顯示 toast
  toast.show();
}


// 儲存 Toast 到 sessionStorage
function saveToastMessage(message, isError = false) {
  sessionStorage.setItem('toastMessage', JSON.stringify({ message, isError }));
}

// 顯示 Toast
function showToastFromStorage() {
  const toastData = sessionStorage.getItem('toastMessage');
  if (toastData) {
      const { message, isError } = JSON.parse(toastData);
      showToast(message, isError);
      sessionStorage.removeItem('toastMessage');
  }
}