<?php
// セッションの有効期間を設定（例：30分）
ini_set('session.gc_maxlifetime', 1800);
session_set_cookie_params(1800);
session_start();
?>
