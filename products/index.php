<?php
require __DIR__ . '/../config/pdo-connect.php';  // 引入資料庫設定


// 取得分類
include 'db_select/select_category.php';
// 取得分頁及使用者搜尋結果
include 'db_select/select_page.php';



?>



<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include 'components/navbar.php' ?>


<!-- 主內容 -->
<div class="container mt-3">
    <div class="row">
        <div class="col-12 mt-4 mb-3">
            <h2>商品列表</h2>
        </div>
        <!-- 產品分類 -->
        <div class="col-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php"><i class="fa-solid fa-ghost"></i></i>所有商品</a>
                </li>

                <?php foreach ($category_all_row as $r) : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="?category_id=<?= $r['category_id'] ?>"><i class="fa-solid fa-ghost"></i></i><?= $r['category_name'] ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>


        <div class="col-10">

            <!-- 搜尋列+新增商品+新增庫存 -->
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid d-flex justify-content-between">
                    <!-- 搜尋 -->
                    <form class="d-flex align-items-center m-0" name="searchForm">
                        <div class="input-group">
                            <input class="form-control me-2" type="search" placeholder="商品編號或名稱" aria-label="Search" name="my_search">
                            <button class="btn btn-outline-success" type="submit">搜尋</button>
                        </div>
                    </form>

                    <!-- 搜尋結束 -->


                    <div>

                        <a class="btn btn-primary" href="add.php">
                            <i class="bi bi-person-fill-add"></i>
                            新增商品
                        </a>
                        <!--  新增庫存 -->
                        <a class="btn btn-primary" href="add-Warehousing.php">
                            <i class="bi bi-bag-plus-fill"></i>
                            新增庫存
                        </a>
                        <a class="btn btn-danger" href="javascript: deleteAll()">
                            <i class="bi bi-trash-fill"></i>刪除多筆
                        </a>
                    </div>
                </div>
            </nav>
            <!-- 搜尋列結束 -->






            <!-- 表單開始 -->
            <table id="ProductTable" class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" id="check_all" value="" aria-label="delete_box"></th>
                        <th scope="col">商品編號</th>
                        <th scope="col">商品名稱</th>
                        <th scope="col">商品單價</th>
                        <th scope="col">庫存</th>
                        <th scope="col">編輯&刪除</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- TODO 拆分到獨立檔案 -->
                    <?php
                    if (isset($category_id)) :
                        // 有選類別
                        foreach ($category_row as $r) : ?>
                            <tr>
                                <td> <input class="form-check-input delete_box" type="checkbox" value="<?= $r['product_id'] ?>" aria-label="delete_box"></td>
                                <td><?= $r['product_id'] ?></td>
                                <!-- 做字元跳脫避免JS注入 -->
                                <td><?= htmlentities($r['product_name']) ?></td>
                                <td><?= $r['price'] ?></td>

                                <!-- TODO 庫存連結 -->
                                <td>111</td>

                                <!-- 按鈕 -->
                                <td>
                                    <a class="btn btn-warning" href="edit.php?product_id=<?= $r['product_id'] ?>">
                                        <i class="bi bi-pen-fill"></i>編輯
                                    </a>
                                    <a class="btn btn-danger" href="javascript: deleteOne(<?= $r['product_id'] ?>)">
                                        <i class="bi bi-trash-fill"></i>刪除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <!-- 沒有選類別 -->
                        <?php foreach ($all_page as $r) : ?>
                            <tr>
                                <td> <input class="form-check-input delete_box" type="checkbox" value="<?= $r['product_id'] ?>" aria-label="delete_box"></td>
                                <td><?= $r['product_id'] ?></td>
                                <!-- 做字元跳脫避免JS注入 -->
                                <td><?= htmlentities($r['product_name']) ?></td>
                                <td><?= $r['price'] ?></td>
                                <td>111</td>

                                <!-- 按鈕 -->
                                <td>
                                    <a class="btn btn-warning" href="edit.php?product_id=<?= $r['product_id'] ?>">
                                        <i class="bi bi-pen-fill"></i>編輯
                                    </a>
                                    <a class="btn btn-danger" href="javascript: deleteOne(<?= $r['product_id'] ?>)">
                                        <i class="bi bi-trash-fill"></i>刪除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
            <!-- 表單結束 -->

            <!-- 分頁開始 -->
            <nav aria-label="Page navigation example" class="my-3 d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>


                    <li class="page-item">
                        <a class="page-link" href="?page=<?= min($totalPages, $page + 1) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- 分頁結束 -->

        </div>








    </div>
</div>

<?php include __DIR__ . '/../parts/scripts.php' ?>

<script>
    const deleteOne = (product_id) => {
        if (confirm(`是否要刪除編號為 ${product_id} 的資料?`)) {
            location.href = `delete.php?product_id=${product_id}`;
        }
    }
    // 刪除多筆
    const deleteAll = () => {
        let delArr = [];

        if (confirm(`是否要刪除所選資料?`)) {
            $(".delete_box").each(function() {
                if ($(this).prop("checked") == true) {
                    delArr.push($(this).val())
                }
            })
            console.log(delArr);
            console.log('刪除--');

            fetch('delete-all.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        delArr: delArr
                    })
                })
                .then((r) => r.json())
                .then(data => {
                    console.log(data);
                    
                    if(data.success){
                        console.log('success');
                        console.log(data.success);
                        location.reload();

                    }else{
                        console.log('else');
                        console.log(data.success);

                        location.reload();

                    }
                })
                .catch(e => {
                    console.error('Error:', e);
                })
        }
    }

    $("#check_all").click(() => {
        if ($("#check_all").prop("checked")) {
            console.log('true')
            $(".delete_box").prop("checked", true);

        } else {
            console.log('false')
            $(".delete_box").prop("checked", false);
        }
    })
</script>

<?php include 'components/foot.php' ?>