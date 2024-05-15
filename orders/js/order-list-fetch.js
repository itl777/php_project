document.addEventListener("DOMContentLoaded", function () {
  document.title = "訂單管理";

  // 取得 url ?page=
  const currentPageParam = new URLSearchParams(window.location.search).get("page") || 1;
  const currentPage = parseInt(currentPageParam) || 1;
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
        // // 將頁碼保持在有效的區間裡
        // page = Math.max(1, Math.min(page, totalPages));

        // 將新分頁的資料取出來
        data.forEach((order) => {
          const row = `<tr>
            <td>${order.order_id}</td>
            <td>${order.order_date}</td>
            <td>${order.member_name}</td>
            <td>${order.payment_method}</td>
            <td>${
              order.city_name + order.district_name + order.order_address
            }</td>
            <td>${order.recipient_name}</td>
            <td>${order.total_amount}</td>
            <td>${order.order_status_name}</td>
            <td>
            <a href="order-edit.php?id=${
              order.order_id
            }" class="btn btn-primary me-2"><i class="fa-solid fa-pen-to-square"></i></a>
            <a onclick="deleteOrder(${
              order.order_id
            })" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
            </tr>`;
          tableBody.innerHTML += row;
        });
        updatePagination(page, totalPages);
        changeUrl(totalPages);
      })
      .catch((error) => console.error("Error loading orders:", error));
  }


  function changeUrl(totalPages) {
    // 從 URL 中獲取 page 參數或預設為 1
    const params = new URLSearchParams(window.location.search);
    let currentPageParam = parseInt(params.get("page") || 1);

    // 確保 page 參數不會小於 1 或大於 totalPages
    currentPageParam = Math.max(1, Math.min(currentPageParam, totalPages));

    // 更新 URL 中的 page 參數
    params.set("page", currentPageParam);

    // 將更新後的 URL 參數重新賦值給當前頁面（不重新加載頁面）
    window.history.replaceState({}, '', `${location.pathname}?${params}`);
  }


  function updatePagination(currentPage, totalPages) {
    const pagination = document.querySelector("#pagination");
    pagination.innerHTML = ""; // 清空之前的分頁鏈接

    // 計算當前組的起始和結束頁碼
    let groupStart = Math.floor((currentPage - 1) / 10) * 10 + 1;
    let groupEnd = groupStart + 9;
    if (groupEnd > totalPages) {
      groupEnd = totalPages;
    }

    // 上10頁按鈕
    const prevGroupPage = Math.max(1, groupStart - 10);
    const backTenPage = createPageItem(
      prevGroupPage,
      "<<",
      currentPage > 10 && prevGroupPage > 0
    );
    pagination.appendChild(backTenPage);

    // 上一頁按鈕
    const previousPage = Math.max(1, currentPage - 1);
    const prevPageItem = createPageItem(previousPage, "<", currentPage > 1);
    pagination.appendChild(prevPageItem);

    // 頁碼按鈕
    for (let page = groupStart; page <= groupEnd; page++) {
      const isCurrent = page === currentPage;
      const pageItem = createPageItem(page, page, page !== currentPage, isCurrent);
      pagination.appendChild(pageItem);
    }


    // 下一頁按鈕
    const nextPage = Math.min(totalPages, currentPage + 1);
    const nextPageItem = createPageItem(
      nextPage,
      ">",
      currentPage < totalPages
    );
    pagination.appendChild(nextPageItem);

    // 下10頁按鈕
    const nextGroupPage = Math.min(totalPages, groupStart + 10);
    const forwardTenPage = createPageItem(
      nextGroupPage,
      ">>",
      groupStart + 10 <= totalPages && nextGroupPage <= totalPages
    );
    pagination.appendChild(forwardTenPage);
  }

  function createPageItem(page, text, isClickable, isCurrent) {
    const pageItem = document.createElement("li");
    // 確保當頁碼是當前頁時不添加 disabled 類
    pageItem.className = "page-item" + (isCurrent ? " active" : "") + (!isClickable && !isCurrent ? " disabled" : "");
    const pageLink = document.createElement("a");
    pageLink.className = "page-link";
    // 如果按鈕是 disabled，則不應該有實際的跳轉鏈接
    pageLink.href = (isClickable || isCurrent) ? `?page=${page}` : "#";
    pageLink.textContent = text;
    pageItem.appendChild(pageLink);
    return pageItem;
  }


  showToastFromStorage();
});

const deleteOrder = (orderId) => {
  if (confirm(`是否要刪除訂單 ${orderId}？`)) {
    fetch(`api/order-delete-api.php?orderId=${orderId}`)
      .then((response) => response.json())
      .then((result) => {
        if (result.success) {
          // alert('刪除成功');
          saveToastMessage("刪除成功");
          window.location.reload(); // 刷新當前頁面或重新載入數據
        } else {
          alert("刪除失敗");
        }
      })
      .catch((error) => {
        console.error("刪除失敗:", error);
        alert("刪除錯誤，請稍後再試");
      });
  }
};

// 新增 toast
function showToast(message, isError = false) {
  const toastElement = document.getElementById("deleteToast");
  const toastBody = toastElement.querySelector(".toast-body");
  // Toast 內容
  toastBody.textContent = message;
  // Toast class
  toastBody.className = `toast-body ${
    isError ? "text-danger" : "text-success"
  }`;
  // 初始化 Toast、自動隱藏 toast
  const toast = new bootstrap.Toast(toastElement, {
    delay: 8000,
    autohide: true,
  });
  // 顯示 toast
  toast.show();
}

// 儲存 Toast 到 sessionStorage
function saveToastMessage(message, isError = false) {
  sessionStorage.setItem("toastMessage", JSON.stringify({ message, isError }));
}

// 顯示 Toast
function showToastFromStorage() {
  const toastData = sessionStorage.getItem("toastMessage");
  if (toastData) {
    const { message, isError } = JSON.parse(toastData);
    showToast(message, isError);
    sessionStorage.removeItem("toastMessage");
  }
}
