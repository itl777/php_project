// let pageNow = '';
const fetchUserListData = function (option) {
  let url = `api/user_list_data_api.php`;
  fetchJsonData(url, option).then((data) => {
    userTable(data["user_data"]);
    userTablePagination(data["page"], data["totalPages"]);
    pageNow = data["page"];
  });
};
fetchUserListData();

const userTable = function (data) {
  let userTable = "";

  if (data !== undefined && data !== null && data !== "") {
    data.forEach((item) => {
      userTable += `<tr onclick="editModalShow(${item["user_id"]})" class=" ${item["user_status"] === "0" ? 'bg-secondary bg-opacity-25' : ""}">`;

      userTable += `<td class="align-middle text-center" style="width: 50px;"><img src="images/${item["avatar"]}" class="rounded-circle" style="width: 40px;height: 40px;object-fit: cover;"></td>`;
      userTable += `<td class="align-middle text-center" style="width: 100px;">${item["user_id"]}</td>`;
      userTable += `<td class="align-middle text-center">${item["name"]}</td>`;
      userTable += `<td class="align-middle text-center" style="width: 100px;">${item["gender"] === "0" ? "男" : "女"
        }`;
      userTable += `<td class="align-middle ps-3">${item["account"]}</td>`;

      userTable += `<td class="align-middle text-center" style="width: 100px;">
        ${item["blacklist"] === "1"
          ? '<i class="bi btn btn-danger bi-exclamation-circle-fill"></i>'
          : ""
        }
        </td>`;
      //原本的編輯按鈕，函式改加在整個tr上了
      // userTable += `<td class="align-middle"><button type="button" class="btn btn-warning" onclick="editModalShow(${item['user_id']})"><i class="bi bi-pencil-square"></i></button></td>`;
      userTable += `</tr>`;
    });
  }
  $("#userList tbody").empty();
  $("#userList tbody").append(userTable);
};

const userTablePagination = function (page, totalPages) {
  // 值=page 就加 active class
  // 值<0 就加 disabled class
  // 值>totalPages 就加 disabled class
  let userTablePagination = "";

  userTablePagination += `<tr class="border-0"><td colspan=6 class="border-0" style="border-radius: 0  0  0.5rem 0.5rem;">
      <nav class="d-flex justify-content-end">
      <ul class="pagination m-0">
        <li class="page-item ${page <= 1 ? "disabled" : ""}">
          <a class="page-link" href="javascript:pageChange(${page - 1
    })">上一頁</a>
        </li>`;

  for (let i = page - 3; i <= totalPages; i++) {
    if (i < 1) continue;
    userTablePagination += `<li class="page-item ${i === page ? "active" : ""
      }"><a class="page-link" href="javascript:pageChange(${i})">${i}</a></li>`;
  }

  userTablePagination += `<li class="page-item ${page >= totalPages ? "disabled" : ""
    }">
          <a class="page-link" href="javascript:pageChange(${page + 1
    })">下一頁</a>
        </li>
      </ul>
    </nav>
    </td></tr>`;

  $("#userList tfoot").empty();
  $("#userList tfoot").append(userTablePagination);
};

const pageChange = function (toPage) {
  selectData(toPage);
  // console.log('有執行');
};

//user_id 會員編號查詢
//account 帳號查詢
//name 姓名查詢
//nick_name 暱稱查詢
//gender 性別查詢
//mobile_phone 電話號碼查詢
//user_status 啟用狀態篩選
//blacklist 黑名單篩選

// let select = {
//   //這邊可以寫篩選需求
//   page: 1, //當前頁 option給選?
//   perPage: 20, //一頁幾筆，看要不要給改
// };
