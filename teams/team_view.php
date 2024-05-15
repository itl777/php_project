<?php
require __DIR__ . '/../config/pdo-connect.php';
$title = "觀看團隊資料";

$team_id = isset($_GET['team_id']) ? intval($_GET['team_id']) : 0;
if ($team_id < 1) {
  header('Location: /../team_list.php');
  exit;
}

$sql = "SELECT * FROM teams 
        join `users` on leader_id = users.user_id
        join `themes` on `tour` = themes.theme_id
        WHERE team_id={$team_id}";

$row = $pdo->query($sql)->fetch();

if (empty($row)) {
  header('Location: /../team_list.php');
  exit;
};

$sql_c = "SELECT * FROM teams_chats
        join `users` on chat_by = users.user_id";

$row_c = $pdo->query($sql_c)->fetch();



// 讀取所有themes資料，放入$tours，用來將teams.tour對應到themes.theme_name
$sql1 = "SELECT * FROM themes";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();
$tours = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM teams_status";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$status = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT * FROM teams_chats join `users` on chat_by = users.user_id";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();
$chats = $stmt3->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode($row);
?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/navbar.php' ?>
<style>
  form .mb-3 .form-text {
    color: red;
    font-weight: 800;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-12">
    <a href="../team_list.php"><button type="button" class="btn btn-primary">回到團隊列表</button></a>
    </div>

    <div class="col-12">
      <div class="card px-5 py-3">
        <h3><?= $row['team_title'] ?></h3>
        <p>團長: <?= $row['nick_name'] ?></p>
        <p>人數: n / <?= $row['team_limit'] ?></p>
        <p>行程: <?= $row['theme_id'],' - ', $row['theme_name']; ?></p>
      </div>
    </div>
    <div class="col-12">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChat">新增留言</button>
    </div>
    <div class="col-12">
      <div class="card px-3 pt-2">
      <?php foreach ($chats as $chat_i): ?>
        <?php if ($chat_i['chat_at'] == $row['team_id']): ?>
        <h4><?php echo $chat_i['nick_name']; ?></h4>
        <p><?php echo $chat_i['chat_text']; ?></p>
        <p><?php echo $chat_i['create_at']; ?></p>
          <hr>
        <?php endif; ?>
            <?php endforeach; ?>
      </div>
    </div>
  </div>

</div>
<!-- Modal -->
<div class="modal fade" id="addChat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">新增留言</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form name="form1" onsubmit="sendData(event)">
          <div class="mb-3">
              <input type="hidden" class="form-control" name="team_id" value="<?= $row['team_id'] ?>">
            </div>
          <div class="mb-3">
            <label for="chat_by" class="form-label">留言ID</label>
            <input type="text" class="form-control" id="chat_by" name="chat_by">
            <div class="form-text"></div>
          </div>
          <div class="mb-3">
            <label for="chat_text" class="form-label">留言內容(上限200字)</label>
            <textarea class="form-control" id="chat_text" name="chat_text" rows="3"></textarea>
             <div class="form-text"></div>
          </div>
          <button type="submit" class="btn btn-primary">完成留言</button>
          </form>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/js/scripts.php' ?>
<script>

  const sendData = e => {
    e.preventDefault(); // 不要讓 form1 以傳統的方式送出

    let isPass = true; // 表單有沒有通過檢查

    // 有通過檢查, 才要送表單
    if (isPass) {
      const fd = new FormData(document.form1); // 沒有外觀的表單物件
      fetch('api-chat.php', {
          method: 'POST',
          body: fd, // Content-Type: multipart/form-data
        }).then(r => r.json())
        .then(data => {
          console.log(data);
          if (data.success) {
            myModal.show();
          }
        })
        .catch(ex => console.log(ex))
    }
  };

  const myModal = new bootstrap.Modal('#addChat')
</script>
<?php include __DIR__ . '/../parts/html-foot.php' ?>