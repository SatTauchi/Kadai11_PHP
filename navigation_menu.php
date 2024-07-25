<?php 
session_start();
//関数群の読み込み
require_once('funcs.php');
//ログインセッションの確認
loginCheck();

//セッションからuser_idを取得
$user_id = $_SESSION['user_id'];
//セッションからnameを取得
$name = $_SESSION['name'];
//セッションからnameを取得
$name = $_SESSION['name'];
//セッションからadmin_flgを取得
$admin_flg = $_SESSION['admin_flg'];
?>

<nav class="nav-menu">
    <a href="dashboard.php" class="nav-item"><i class="fas fa-home"></i> ホーム</a>
    <a href="data_analysis.php" class="nav-item"><i class="fas fa-chart-line"></i> 分析</a>
    <a href="data_list.php" class="nav-item"><i class="fas fa-database"></i> データ</a>
    <!-- admin_flgが1の時に設定パネルを表示 -->
    <?php if($admin_flg === 1): ?>
        <a href="settings.php" class="nav-item"><i class="fas fa-cog"></i> 設定</a>
    <?php endif; ?>
</nav>