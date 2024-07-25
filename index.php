<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, viewport-fit=cover">
  <title>おさかなハぅマっチ？ - スタート</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style_index.css?<?php echo date('YmdHis'); ?>"/>
  <link rel="icon" href="img/Logo2.webp" type="image/x-icon">
  <link rel="apple-touch-icon" href="img/Logo2.webp">
</head>

<body>
  <header class="header">
    <div class="logo">
      <img src="img/Logo.png" alt="ロゴ">
      <span>おさかなハぅマっチ？</span>
    </div>
  </header>
  <main>
    <div id="top_image">
      <img id="top" src="img/Logo.png" alt="">
    </div>
    <form class="login" name="form1" action="login_act.php" method="post">
      <div class="form-group">
        <input type="text" name="lid" class="form-control" placeholder="ログインID" />
        <p class="error">　
          <!-- ログインIDが未入力の場合にエラーメッセージ表示 -->
        <?php if (isset($_SESSION['err']['lid'])) : ?>
            <?php echo $_SESSION['err']['lid']; ?>
            <?php unset($_SESSION['err']); // エラーメッセージを表示した後にセッションから削除 ?>
        <?php endif; ?>
        </p>
      </div>
      <div class="form-group">
        <input type="password" name="lpw" class="form-control" placeholder="パスワード" />
        <p class="error">　
        <!--ログインPWが未入力 or ID、PWが不一致の場合にエラーメッセージ表示  -->
        <?php if (isset($_SESSION['err']['lpw'])) : ?>
            <?php echo $_SESSION['err']['lpw']; ?>
            <?php unset($_SESSION['err']); // エラーメッセージを表示した後にセッションから削除 ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['err'])) : ?>
            <?php echo $_SESSION['err']; ?>
          <?php unset($_SESSION['err']); // エラーメッセージを表示した後にセッションから削除 ?>
        <?php endif; ?>
        </p>
      </div>
      <button class="btn" type="submit">ログイン</button>
    </form>
    <p>はじめての方はこちら</p>
    <button class="btn" onclick="location.href='new_user_register.html'">新規登録</button>
  </main>

  <footer>
    &copy; 2024 Osakana How much？ All rights reserved.
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/fish_price_checker01.js"></script>
</body>
</html>
