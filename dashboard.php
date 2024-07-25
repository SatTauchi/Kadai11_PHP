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
  <title>おさかなハぅマっチ？ - ダッシュボード</title>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style_dashboard.css?<?php echo date('YmdHis');?>"/>
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
      <h2 class="card-title">
        <!-- admin_flgが1の時に「管理者用」という文言をH2に追加 -->
      <?php if($admin_flg === 1) echo "管理者用";?> 
        ダッシュボード</h2>
      <div class="dashboard-grid">
        <!-- admin_flgが1ではない時にデータ入力パネルを表示 -->
      <?php if(!$admin_flg == 1): ?>
        <div class="dashboard-card" onclick="location.href='data_input.php'">
          <i class="fas fa-edit"></i>
          <h3>データ入力</h3>
          <p>新しいデータを登録します</p>
        </div>
        <?php endif; ?>
        <!-- admin_flgが1ではない時にデータ分析パネルを表示 -->
        <?php if(!$admin_flg == 1): ?>
        <div class="dashboard-card" onclick="location.href='data_analysis.php'">
          <i class="fas fa-chart-line"></i>
          <h3>データ分析</h3>
          <p>登録データを様々な形式で表示します</p>
        </div>
        <?php endif; ?>
        <div class="dashboard-card" onclick="location.href='data_list.php'">
          <i class="fas fa-database"></i>
          <h3>データ一覧</h3>
          <p>登録データを確認・更新します</p>
        </div>
        <!-- admin_flgが1の時に設定パネルを表示 -->
        <?php if($admin_flg === 1): ?>
          <div class="dashboard-card" onclick="location.href='settings.php'">
            <i class="fas fa-cog"></i>
            <h3>設定</h3>
            <p>アプリケーションの設定を変更します</p>
          </div>
        <?php endif; ?>
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