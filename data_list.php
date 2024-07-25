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

<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>おさかなハぅマっチ？ - データ一覧</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_data_list.css?<?php echo date('YmdHis');?>" />
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
            <h2 class="card-title">データ一覧</h2>
            <div id="button02">
                <select id="fish-select">
                    <option value="">魚を選択して下さい</option>
                    <option value="all">全データ表示</option>
                    <option value="ハマチ">ハマチ</option>
                    <option value="マグロ">マグロ</option>
                    <option value="サバ">サバ</option>
                    <option value="アジ">アジ</option>
                </select>
                <button id="fetch-data">データを見る</button>
                <button id="back" onclick="location.href='dashboard.php'">戻る</button>
            </div>
            <div id="list" class="dashboard-grid">
                <!-- データがここに表示される -->
            </div>
        </div>
    </div>
    <footer>
        &copy; 2024 Osakana How much？ All rights reserved.
    </footer>

    <script src="js/jquery-2.1.3.min.js"></script>
    <script>
        document.getElementById('fetch-data').addEventListener('click', function() {
            const selectedFish = document.getElementById('fish-select').value;
            if (selectedFish !== "") {
                $.ajax({
                    url: 'fetch_data.php',
                    type: 'GET',
                    data: { fish: selectedFish === "all" ? "" : selectedFish },
                    dataType: 'json',
                    success: function(data) {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            let output = '';
                            data.forEach(function(item) {
                                output += `<div class="dashboard-card" data-id="${item.id}">
                                              <img src="${item.photo}" alt="${item.fish}">
                                              <p>日付：${item.date} <br> 魚：${item.fish} <br> 産地：${item.place} <br> 仕入金額：${item.price} 円/kg<br>メモ：${item.remarks}</p>
                                              <div id="delete_field">
                                                <button class="renew" type="button" data-id="${item.id}">更新</button>
                                                <button class="delete" type="button">削除</button>
                                              </div>
                                           </div>`;
                            });
                            document.getElementById('list').innerHTML = output;
                            addEventListeners();
                        }
                    },
                    error: function() {
                        alert('データの取得に失敗しました。');
                    }
                });
            } else {
                alert('魚を選択してください');
            }
        });

        function addEventListeners() {
            document.querySelectorAll('.delete').forEach(function(button) {
                button.addEventListener('click', function() {
                    const itemDiv = this.closest('.dashboard-card');
                    const id = itemDiv.getAttribute('data-id');

                    if (confirm('データベースから削除しますか？')) {
                        $.ajax({
                            url: 'delete_data.php',
                            type: 'POST',
                            data: { id: id },
                            dataType: 'json',
                            success: function(response) {
                                if (response.error) {
                                    alert(response.error);
                                } else {
                                    itemDiv.remove();
                                }
                            },
                            error: function() {
                                alert('データの削除に失敗しました。');
                            }
                        });
                    }
                });
            });

            document.querySelectorAll('.renew').forEach(function(button) {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    location.href = `data_update.php?id=${id}`;
                });
            });
        }
    </script>
</body>
</html>
