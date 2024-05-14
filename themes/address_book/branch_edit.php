<?php
require __DIR__ . '/../../config/pdo-connect.php';
$title = '修改分店資料';

$branchId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($branchId < 1) {
    header('Location: branch_list.php');
    exit;
}

$sql = "SELECT * FROM `branches` WHERE id={$branchId}";

$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: branch_edit.php');
    exit;
}

$pageName = 'branch_add';
?>

<?php include __DIR__ . '/../../parts/html-head.php' ?>
<?php include __DIR__ . '/../../parts/navbar.php' ?>

<style>
    form .mb-4 .form-text {
        color: tomato;
        font-weight: 800;
    }
</style>


<div class="container mt-5">
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <form name="form1" class="p-3" onsubmit="sendData(event)">

                        <div class="mb-4 col-2">
                            <label for="id" class="form-label">編號</label>
                            <input type="text" class="form-control" disabled value="<?= $row['id'] ?>">
                        </div>

                        <div class="mb-4 col-5">
                            <label for="branch_name" class="form-label fw-bold">分店名字</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" value="<?= $row['branch_name'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-4 col-10">
                            <label class="form-label fw-bold">遊玩行程主題</label><br>
                            <?php foreach ($themes as $theme) : ?>
                                <div class="form-check form-check-inline me-3 mb-3">
                                    <input class="form-check-input" type="checkbox" id="theme_<?php echo $theme['theme_id']; ?>" name="theme_id[]" value="<?php echo $theme['theme_id']; ?>">
                                    <label class="form-check-label" for="theme_<?php echo $theme['theme_id']; ?>"><?php echo $theme['theme_name']; ?></label>
                                </div>
                            <?php endforeach; ?>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-4 col-5">
                            <label for="branch_phone" class="form-label fw-bold">電話</label>
                            <input type="text" class="form-control" id="branch_phone" name="branch_phone" placeholder="請輸入電話" value="<?= $row['branch_phone'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-5">
                                <label for="open_time" class="form-label fw-bold">開門時間</label>
                                <input type="text" class="form-control" id="open_time" name="open_time" placeholder="請輸入時間" value="<?= $row['open_time'] ?>">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-4 col-5">
                                <label for="close_time" class="form-label fw-bold">閉門時間</label>
                                <input type="text" class="form-control" id="close_time" name="close_time" placeholder="請輸入時間" value="<?= $row['close_time'] ?>">
                                <div class="form-text"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-4 col-5">
                                <label for="branch_status" class="form-label fw-bold">營業狀態</label>
                                <select class="form-select" aria-label="Default select example" id="branch_status" name="branch_status">
                                    <option value="" selected disabled>請選擇狀態</option>
                                    <option value="新開幕"><?= $row['branch_status'] == "新開幕" ? 'selected' : '' ?>新開幕</option>
                                    <option value="營業中"><?= $row['branch_status'] == "營業中" ? 'selected' : '' ?>營業中</option>
                                    <option value="裝潢"><?= $row['branch_status'] == "裝潢中" ? 'selected' : '' ?>裝潢中</option>
                                    <option value="停止營業"><?= $row['branch_status'] == "停止營業" ? 'selected' : '' ?>停止營業</option>
                                </select>
                                <div class="form-text"></div>
                            </div>

                            <div class="mb-4 col-10">
                                <label for="branch_address" class="form-label fw-bold">地址</label>
                                <textarea class="form-control" id="branch_address" name="branch_address" cols="30" rows="3" placeholder="請輸入地址" <?= $row['branch_address'] ?>></textarea>
                                <div class="form-text"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end me-3">
                            <button type="submit" class="btn btn-primary">新增</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal bt 彈跳視窗-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">新增成功</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    資料新增成功 d(`･∀･)b
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="location.href='theme_list.php'">到主題頁</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">修改失敗</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    資料修改失敗...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="location.href='theme_list.php'">到主題頁</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續編輯</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../parts/scripts.php' ?>

<script>
    const nameField = document.getElementById('branch_name');
    const phoneField = document.getElementById('branch_phone');
    const openTimeField = document.getElementById('open_time');
    const closeTimeField = document.getElementById('close_time');
    const statusField = document.getElementById('branch_status');
    const addressField = document.getElementById('branch_address');
    const form = document.form1;

    const sendData = e => {
        e.preventDefault();

        nameField.style.border = '1px solid #CCCCCC';
        nameField.nextElementSibling.innerText = '';

        phoneField.style.border = '1px solid #CCCCCC';
        phoneField.nextElementSibling.innerText = '';

        openTimeField.style.border = '1px solid #CCCCCC';
        openTimeField.nextElementSibling.innerText = '';

        closeTimeField.style.border = '1px solid #CCCCCC';
        closeTimeField.nextElementSibling.innerText = '';

        statusField.style.border = '1px solid #CCCCCC';
        statusField.nextElementSibling.innerText = '';

        addressField.style.border = '1px solid #CCCCCC';
        addressField.nextElementSibling.innerText = '';

        // TODO: 欄位資料檢查

        let isPass = true; // 表單有沒有通過檢查
        // 清除主题选择的错误信息
        // const themeError = document.querySelector('.theme-error');
        // themeError.innerText = '';


        if (nameField.value.trim() === '') {
            isPass = false;
            nameField.style.border = '1px solid tomato';
            nameField.nextElementSibling.innerText = '請填寫分店名稱';
        }

        // 检查勾选框是否有选中主题
        const selectedThemes = Array.from(document.querySelectorAll('input[name="theme_id[]"]:checked'));
        if (selectedThemes.length === 0) {
            isPass = false;
            const themeCheckboxes = document.querySelectorAll('input[name="theme_id[]"]');
            themeCheckboxes.forEach(checkbox => {
                checkbox.nextElementSibling.style.color = 'tomato';
            });
            themeError.innerText = '请至少选择一个主题';
        } else {
            const themeCheckboxes = document.querySelectorAll('input[name="theme_id[]"]');
            themeCheckboxes.forEach(checkbox => {
                checkbox.nextElementSibling.style.color = ''; // 重置颜色
            });
        }

        if (phoneField.value.trim() === '') {
            isPass = false;
            phoneField.style.border = '1px solid tomato';
            phoneField.nextElementSibling.innerText = '請填寫電話';
        }

        if (openTimeField.value.trim() === '') {
            isPass = false;
            openTimeField.style.border = '1px solid tomato';
            openTimeField.nextElementSibling.innerText = '請填寫開門時間';
        }

        if (closeTimeField.value.trim() === '') {
            isPass = false;
            closeTimeField.style.border = '1px solid tomato';
            closeTimeField.nextElementSibling.innerText = '請填寫閉門時間';
        }

        if (statusField.value === '') {
            isPass = false;
            statusField.style.border = '1px solid tomato';
            statusField.nextElementSibling.innerText = '請選擇營業狀態';
        }

        if (addressField.value.trim() === '') {
            isPass = false;
            addressField.style.border = '1px solid tomato';
            addressField.nextElementSibling.innerText = '請填寫地址';
        }

        // 重置其他欄位樣式和錯誤訊息
        // const fields = [form.branch_phone, form.open_time, form.close_time, form.branch_status, form.branch_address];
        // fields.forEach(field => {
        //   field.style.border = '';
        //   field.nextElementSibling.innerText = '';
        // });



        // 有通過檢查, 才要送表單
        if (isPass) {
            const fd = new FormData(document.form1); // 沒有外觀的表單物件

            fetch('branch_edit_api.php', {
                    method: 'POST',
                    body: fd, // Content-Type: multipart/form-data
                }).then(r => r.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        myModal.show();
                    } else {}
                })
                .catch(ex => console.log(ex))
        }
    };
    const myModal = new bootstrap.Modal('#staticBackdrop')
    const myModal2 = new bootstrap.Modal('#staticBackdrop2')
</script>
<?php include __DIR__ . '/../../parts/html-foot.php' ?>