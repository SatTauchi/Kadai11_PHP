<?php
session_start();
//関数群の読み込み
require_once('init.php');
require_once('funcs.php');
 //ログインセッションの確認
loginCheck();
//セッションからuser_idを取得
$user_id = $_SESSION['user_id'];
//セッションからnameを取得
$name = $_SESSION['name'];
// 1. クエリパラメータの確認 = GETで取得している内容を確認する
$id = $_GET['id'];
require_once('funcs.php');
$pdo = db_conn();
//２．データ詳細表示SQL作成
$stmt = $pdo->prepare('SELECT * FROM osakana_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
//３．データ表示
$view = '';
if ($status === false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>おさかなハぅマっチ？ - 新規データ登録</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style_data_update.css?<?php echo date('YmdHis');?>"/>
  <link rel="icon" href="img/Logo2.webp" type="image/x-icon">
  </head>

  <body>
  <header class="header">
    <div class="logo">
      <img src="img/Logo.png" alt="ロゴ">
      <span>おさかなハぅマっチ？</span>
    </div>
    <!--ここからハンバーガーメニュー-->
    <?php include('hamburger_menu.php'); ?>
    <!--ここまでハンバーガーメニュー-->
  </header>

    <!-- ここからナビゲーション -->
    <?php include('navigation_menu.php'); ?> 
    <!-- ここまでナビゲーション -->

  <div class="container">
    <div class="card">
      <h2 class="card-title">データ更新</h2>
      <form id="fishPriceForm" action="update.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $result['id'] ?>"> <!-- hidden input to pass the id -->  
        <div class="form-group">
          <label for="date">日付</label>
          <input id="date" class="form-control"  type="date" name="date" value="<?= $result['date'] ?>" required>
        </div>
        <div class="form-group">
          <label for="fish">魚種</label>
          <select id="fish" class="form-control" name="fish" required>
          <option value="ハマチ" <?= $result['fish'] == 'ハマチ' ? 'selected' : '' ?>>ハマチ</option>
                    <option value="マグロ" <?= $result['fish'] == 'マグロ' ? 'selected' : '' ?>>マグロ</option>
                    <option value="サバ" <?= $result['fish'] == 'サバ' ? 'selected' : '' ?>>サバ</option>
                    <option value="アジ" <?= $result['fish'] == 'アジ' ? 'selected' : '' ?>>アジ</option>
          </select>
        </div>
        <div class="form-group">
          <label for="place">産地</label>
          <select id="place" class="form-control" name="place">
                    <option value="北海道" <?= $result['place'] == '北海道' ? 'selected' : '' ?>>北海道</option>
                    <option value="江戸前" <?= $result['place'] == '江戸前' ? 'selected' : '' ?>>江戸前</option>
                    <option value="九州" <?= $result['place'] == '九州' ? 'selected' : '' ?>>九州</option>
          </select>
        </div>
        <div class="form-group">
          <label for="price">仕入価格 (円/kg)</label>
          <input id="price" class="form-control" type="number" placeholder="金額を入力（円/kg）" name="price" value="<?= $result['price'] ?>" required>
        </div>
        <!-- 備考欄は200文字上限の制限 -->
        <div class="form-group">
          <label for="remarks">メモ</label>
          <textarea id="remarks" class="form-control" maxlength="200" name="remarks" placeholder="200文字以内"><?= $result['remarks'] ?></textarea>
          <!-- 入力文字数のカウント-->
          <span id="charCount">0/200</span>
          <!-- 200文字を超えた場合にエラーメッセージ表示 -->
          <div id="error-message" style="color:red; display:none;">200文字を超えています</div>
        </div>
        <div class="form-group">
            <div class="input_file">
            <label id="label_imgFile" for="imgFile">写真を選択</label>
                <div class="preview_field">
                    <input accept="image/*" id="imgFile" type="file" name="imgFile"> 
                    <img id="currentImage" src="<?= $result['photo'] ?>" alt="current image">
                </div>
            </div>
        </div>
        <button type="submit" class="btn">データ更新</button>
        <button class="btn" type="button" onclick="location.href='data_list.php'">戻る</button>
      </form>
    </div>
  </div>

  <footer>
    &copy; 2024 Osakana How much？ All rights reserved.
  </footer>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
  <script src="js/fish_price_checker01.js"></script>
  <script type="module" src="js/fish_price_checker01.js"></script>
  <script>
    // プレビュー表示のためのJavaScript
    document.getElementById('imgFile').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('currentImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>