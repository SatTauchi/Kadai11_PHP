<!DOCTYPE html>
<html lang="ja">

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
  //セッションからadmin_flgを取得
  $admin_flg = $_SESSION['admin_flg'];
  ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>おさかなハぅマっチ？ - 設定</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style_settings.css?<?php echo date('YmdHis');?>"/>
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
    </div>
  </header>

    <!-- ここからナビゲーション -->
    <?php include('navigation_menu.php'); ?> 
    <!-- ここまでナビゲーション -->

  <div class="container">
    <div class="card">
      <h2 class="card-title">設定</h2>
      <div class="dashboard-grid">
    
      <?php
        $pdo = db_conn();
        $stmt = $pdo->prepare('SELECT * FROM osakana_user_table');
        $status = $stmt->execute();
        $view = '';
        if (!$status) {
          sql_error($stmt);
        } else {
          while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $view .= '<div class="record"><p>';
            $view .= h($r['user_id']) . " " . h($r['name']) . " " . h($r['lid']) . " " . h($r['admin_flg']) . " " . h($r['life_flg']);
            $view .= '</p>';
            $view .= '<a class="btn btn-danger" href="delete_user.php?user_id=' . $r['user_id'] . '">';
            $view .= '削除';
            $view .= '</a>';
            $view .= '</div>';
          }
        }
        echo $view;
        ?>

        
      </div>
    </div>
  </div>

  <footer>
    &copy; 2024 Osakana How much？ All rights reserved.
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/fish_price_checker01.js"></script>
</body>
</html>