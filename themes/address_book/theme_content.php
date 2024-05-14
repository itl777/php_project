<?php

$title = '主題內容頁';
$pageName = 'theme_content';
?>
<?php
require __DIR__ . '/../../config/pdo-connect.php';
?>

<?php include __DIR__ . '/../../parts/html-head.php' ?>
<?php include __DIR__ . '/../../parts/navbar.php' ?>

<div class="container-fluid pt-5">

    <!-- 分頁膠囊   -->
    <div class="container">
        <div class="row">

            <!-- 左邊選單 -->
            <div class="accordion accordion-flush col-2" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            行程管理
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body d-flex ">
                            <div class="d-flex flex-column bd-highlight mb-3">
                                <div class="p-2 bd-highlight "><a class="link-secondary" href="branch_list.php"
                                        style="text-decoration: none;">分店管理</a></div>
                                <div class="p-2 bd-highlight"><a class="link-secondary" href="theme_list.php"
                                        style="text-decoration: none;">主題管理</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="content"></div>


            <?php include __DIR__ . '/../../parts/scripts.php' ?>

            <script>
                var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'))
                triggerTabList.forEach(function (triggerEl) {
                    var tabTrigger = new bootstrap.Tab(triggerEl)

                    triggerEl.addEventListener('click', function (event) {
                        event.preventDefault()
                        tabTrigger.show()
                    })
                })


                // 從 API 獲取資料
                fetch('theme_add_api.php')
                    .then(response => response.json())
                    .then(data => {
                        // 處理資料並顯示在 HTML 頁面上
                        const contentDiv = document.getElementById('content');
                        contentDiv.innerHTML = `
                <h1>${data.title}</h1>
                <p>${data.description}</p>
                <img src="${data.image}" alt="Image">
            `;
                    })
                    .catch(error => {
                        // 處理錯誤情況
                        console.error('Error fetching data:', error);
                        // 顯示錯誤訊息
                        const contentDiv = document.getElementById('content');
                        contentDiv.innerHTML = '<p>Error fetching data. Please try again later.</p>';
                    });
            </script>


            <?php include __DIR__ . '/parts/html-foot.php' ?>