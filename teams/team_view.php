<?php
require __DIR__ . '/../config/pdo-connect.php';
$title = "觀看團隊資料";

$team_id = isset($_GET['team_id']) ? intval($_GET['team_id']) : 0;
if ($team_id < 1) {
  header('Location: /../team_list.php');
  exit;
}

$sql = "SELECT team_id, team_title, leader_id, nick_name, theme_desc, avatar, tour, theme_name, team_limit, count(join_user_id) as member_n
        FROM teams 
        join `users` on leader_id = users.user_id
        join `themes` on `tour` = themes.theme_id
        left join `teams_members` on team_id = join_team_id
        WHERE team_id={$team_id}";
$row = $pdo->query($sql)->fetch();

if (empty($row)) {
  header('Location: ./teams.php');
  exit;
};
/* fetch 留言 串用戶暱稱*/
$sql_c = "SELECT nick_name, chat_text, create_at
        FROM teams_chats
        join `users` on chat_by = users.user_id
        WHERE chat_at={$team_id}";
$stmt_c = $pdo->prepare($sql_c);
$stmt_c->execute();
$chats = $stmt_c->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/bt-navbar.php' ?>
<style>
  form .mb-3 .form-text {
    color: red;
    font-weight: 800;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-12">
    <a href="./teams.php"><button type="button" class="btn btn-primary">回到團隊列表</button></a>
    </div>

    <div class="col-12">
      <div class="card px-5 py-3">
        <h3><?= $row['team_title'] ?></h3>
        <div class="row">
          <div class="col-6">
            <p>行程: <?=$row['theme_name']; ?></p>
            <p>行程說明: <?=$row['theme_desc']; ?></p>
            <p>目前人數: <?= $row['member_n']?> / <?= $row['team_limit'] ?></p>
          </div>
          <div class="col-6">
            <p>團長: <?= $row['nick_name'] ?></p>
            <p><img src="../users/images/<?=$row['avatar']?>" alt="" class=""></p>
          </div>
      </div>
    </div>
    
    <div class="col-12">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChat">新增留言</button>
    </div>
    <div class="col-12">
    <?php foreach ($chats as $chat_i): ?>
      <div class="card px-3 pt-2">
          <h4><?php echo $chat_i['nick_name']; ?></h4>
          <p><?php echo $chat_i['chat_text']; ?></p>
          <p><?php echo $chat_i['create_at']; ?></p>
      </div>
      <?php endforeach; ?>
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
              <input type="hidden" class="form-control" id="chat_at" name="chat_at" value="<?= $row['team_id'] ?>">
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


    const chat_text = document.form1.chat_text;

    let isPass = true; // 表單有沒有通過檢查

    nameField.style.border = '1px solid #CCCCCC';
    nameField.nextElementSibling.innerText = '';
    chat_text.style.border = '1px solid #CCCCCC';
    chat_text.nextElementSibling.innerText = '';

    if (chat_text.value.length < 1) {
      isPass = false;
      chat_text.style.border = '1px solid red';
      chat_text.nextElementSibling.innerText = '留言字數不足';
    }
    if (chat_text.value.length > 200) {
      isPass = false;
      chat_text.style.border = '1px solid red';
      chat_text.nextElementSibling.innerText = '留言超出限制';
    }

    


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