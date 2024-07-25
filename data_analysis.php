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
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>おさかなハぅマっチ？ - データ分析</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_data_analysis.css?<?php echo date('YmdHis');?>" />
    <link rel="icon" href="img/Logo2.webp" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <h2 class="card-title">データ分析</h2>
            <div class="dashboard-grid">
                <div class="dashboard-card" id="card1" draggable="true">
                    <div id="button02">
                        <select id="fish-select">
                            <option value="">魚を選択して下さい</option>
                            <option value="all">全データ表示</option>
                            <option value="ハマチ">ハマチ</option>
                            <option value="マグロ">マグロ</option>
                            <option value="サバ">サバ</option>
                            <option value="アジ">アジ</option>
                        </select>
                        <!-- <button id="back" onclick="location.href='dashboard.php'">戻る</button> -->
                    </div>
                    <canvas id="priceChart"></canvas>
                </div>
                <div class="dashboard-card" id="card2" draggable="true">
                    <div id="button02">
                        <select id="fish-select2">
                            <option value="">魚を選択して下さい</option>
                            <option value="all">全データ表示</option>
                            <option value="ハマチ">ハマチ</option>
                            <option value="マグロ">マグロ</option>
                            <option value="サバ">サバ</option>
                            <option value="アジ">アジ</option>
                        </select>
                        <!-- <button id="back" onclick="location.href='dashboard.php'">戻る</button> -->
                    </div>
                    <canvas id="priceChart2"></canvas>
                </div>
                <div class="dashboard-card" id="card3" draggable="true">
                    <div id="button02">
                        <select id="fish-select2">
                            <option value="">魚を選択して下さい</option>
                            <option value="all">全データ表示</option>
                            <option value="ハマチ">ハマチ</option>
                            <option value="マグロ">マグロ</option>
                            <option value="サバ">サバ</option>
                            <option value="アジ">アジ</option>
                        </select>
                        <!-- <button id="back" onclick="location.href='dashboard.php'">戻る</button> -->
                    </div>
                    <img id="chart_sample1" src="img/chart_sample1.png">
                </div>
            </div>
            <div class="dashboard-grid">
                <div class="dashboard-card" id="card4" draggable="true">
                    <div id="button02">
                        <select id="fish-select4">
                            <option value="">魚を選択して下さい</option>
                            <option value="all">全データ表示</option>
                            <option value="ハマチ">ハマチ</option>
                            <option value="マグロ">マグロ</option>
                            <option value="サバ">サバ</option>
                            <option value="アジ">アジ</option>
                        </select>
                        <!-- <button id="back" onclick="location.href='dashboard.php'">戻る</button> -->
                    </div>
                    <canvas id="priceChart4"></canvas>
                </div>
                <div class="dashboard-card" id="card5" draggable="true">
                    <div id="button02">
                        <select id="fish-select5">
                            <option value="">魚を選択して下さい</option>
                            <option value="all">全データ表示</option>
                            <option value="ハマチ">ハマチ</option>
                            <option value="マグロ">マグロ</option>
                            <option value="サバ">サバ</option>
                            <option value="アジ">アジ</option>
                        </select>
                        <!-- <button id="back" onclick="location.href='dashboard.php'">戻る</button> -->
                    </div>
                    <canvas id="priceChart5"></canvas>
                </div>
                <div class="dashboard-card" id="card6" draggable="true">
                    <div id="button02">
                        <select id="fish-select6">
                            <option value="">魚を選択して下さい</option>
                            <option value="all">全データ表示</option>
                            <option value="ハマチ">ハマチ</option>
                            <option value="マグロ">マグロ</option>
                            <option value="サバ">サバ</option>
                            <option value="アジ">アジ</option>
                        </select>
                        <!-- <button id="back" onclick="location.href='dashboard.php'">戻る</button> -->
                    </div>
                    <canvas id="priceChart6"></canvas>
                </div>
            </div>
        </div>
    </div>
    <footer>
        &copy; 2024 Osakana How much？ All rights reserved.
    </footer>

    <script src="js/jquery-2.1.3.min.js"></script>
    <script>
        function fetchDataAndDrawChart(selectId, chartId) {
            document.getElementById(selectId).addEventListener('change', function() {
                const selectedFish = this.value;
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
                                // 日付でソート
                                data.sort((a, b) => new Date(a.date) - new Date(b.date));

                                let dates = [];
                                let prices = [];

                                data.forEach(function(item) {
                                    dates.push(item.date);
                                    prices.push(item.price);
                                });

                                drawChart(chartId, dates, prices);
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
        }

        let chart1;
        let chart2;
        let chart4;
        let chart5;
        let chart6;

        function drawChart(chartId, dates, prices) {
            const ctx = document.getElementById(chartId).getContext('2d');
            let chart;

            if (chartId === 'priceChart') {
                if (chart1) {
                    chart1.destroy();
                }
                chart1 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: '価格 (円/kg)',
                            data: prices,
                            borderColor: 'rgba(255, 0, 0, 0.3)', // 折れ線の色を赤に設定
                            backgroundColor: 'rgba(255, 0, 0, 0.1)', // 領域を透明度の高い赤で塗る
                            borderWidth: 3, // 折れ線の太さを設定
                            fill: true // 領域を塗る
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: '日付'
                                },
                                grid: {
                                    borderWidth: 2 // X軸の罫線を太く
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: '価格 (円/kg)'
                                },
                                grid: {
                                    borderWidth: 2 // Y軸の罫線を太く
                                }
                            }
                        }
                    }
                });
                chart = chart1;
            } else if (chartId === 'priceChart2') {
                if (chart2) {
                    chart2.destroy();
                }
                chart2 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: '価格 (円/kg)',
                            data: prices,
                            borderColor: 'rgba(0, 0, 255, 0.3)', // 折れ線の色を青に設定
                            backgroundColor: 'rgba(0, 0, 255, 0.1)', // 領域を透明度の高い青で塗る
                            borderWidth: 3, // 折れ線の太さを設定
                            fill: true // 領域を塗る
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: '日付'
                                },
                                grid: {
                                    borderWidth: 2 // X軸の罫線を太く
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: '価格 (円/kg)'
                                },
                                grid: {
                                    borderWidth: 2 // Y軸の罫線を太く
                                }
                            }
                        }
                    }
                });
                chart = chart2;
            } else if (chartId === 'priceChart4') {
                if (chart4) {
                    chart4.destroy();
                }
                chart4 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: '価格 (円/kg)',
                            data: prices,
                            borderColor: 'rgba(0, 255, 0, 0.3)', // 折れ線の色を緑に設定
                            backgroundColor: 'rgba(0, 255, 0, 0.1)', // 領域を透明度の高い緑で塗る
                            borderWidth: 3, // 折れ線の太さを設定
                            fill: true // 領域を塗る
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: '日付'
                                },
                                grid: {
                                    borderWidth: 2 // X軸の罫線を太く
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: '価格 (円/kg)'
                                },
                                grid: {
                                    borderWidth: 2 // Y軸の罫線を太く
                                }
                            }
                        }
                    }
                });
                chart = chart4;
            } else if (chartId === 'priceChart5') {
                if (chart5) {
                    chart5.destroy();
                }
                chart5 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: '価格 (円/kg)',
                            data: prices,
                            borderColor: 'rgba(255, 165, 0, 0.3)', // 折れ線の色をオレンジに設定
                            backgroundColor: 'rgba(255, 165, 0, 0.1)', // 領域を透明度の高いオレンジで塗る
                            borderWidth: 3, // 折れ線の太さを設定
                            fill: true // 領域を塗る
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: '日付'
                                },
                                grid: {
                                    borderWidth: 2 // X軸の罫線を太く
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: '価格 (円/kg)'
                                },
                                grid: {
                                    borderWidth: 2 // Y軸の罫線を太く
                                }
                            }
                        }
                    }
                });
                chart = chart5;
            } else if (chartId === 'priceChart6') {
                if (chart6) {
                    chart6.destroy();
                }
                chart6 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: '価格 (円/kg)',
                            data: prices,
                            borderColor: 'rgba(255, 255, 0, 0.3)', // 折れ線の色を黄色に設定
                            backgroundColor: 'rgba(255, 255, 0, 0.2)', // 領域を透明度の高い黄色で塗る
                            borderWidth: 3, // 折れ線の太さを設定
                            fill: true // 領域を塗る
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: '日付'
                                },
                                grid: {
                                    borderWidth: 2 // X軸の罫線を太く
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: '価格 (円/kg)'
                                },
                                grid: {
                                    borderWidth: 2 // Y軸の罫線を太く
                                }
                            }
                        }
                    }
                });
                chart = chart6;
            }
        }
        

        fetchDataAndDrawChart('fish-select', 'priceChart');
        fetchDataAndDrawChart('fish-select2', 'priceChart2');
        fetchDataAndDrawChart('fish-select4', 'priceChart4');
        fetchDataAndDrawChart('fish-select5', 'priceChart5');
        fetchDataAndDrawChart('fish-select6', 'priceChart6');
    </script>
    <script>
    document.querySelectorAll('.dashboard-card').forEach(element => {
    element.ondragstart = function(event) {
        event.dataTransfer.setData('text/plain', event.target.id);
    };

    element.ondragover = function(event) {
        event.preventDefault();
    };

    element.ondragenter = function(event) {
        this.style.border = "2px dashed #000";
    };

    element.ondragleave = function() {
        this.style.border = "";
    };

    element.ondrop = function(event) {
        event.preventDefault();
        this.style.border = "";

        let draggedElementId = event.dataTransfer.getData('text');
        let draggedElement = document.getElementById(draggedElementId);
        let dropTarget = event.currentTarget;

        if (draggedElement !== dropTarget) {
            let dropTargetNextSibling = dropTarget.nextElementSibling;
            let draggedElementParent = draggedElement.parentNode;

            draggedElementParent.insertBefore(dropTarget, draggedElement);

            if (dropTargetNextSibling) {
                draggedElementParent.insertBefore(draggedElement, dropTargetNextSibling);
            } else {
                draggedElementParent.appendChild(draggedElement);
            }
        }
    };
});

document.querySelectorAll('.dashboard-card').forEach(card => {
    card.addEventListener('mousedown', initResize, false);

    function initResize(e) {
        window.addEventListener('mousemove', resize, false);
        window.addEventListener('mouseup', stopResize, false);
    }

    function resize(e) {
        card.style.width = (e.clientX - card.offsetLeft) + 'px';
        card.style.height = (e.clientY - card.offsetTop) + 'px';
    }

    function stopResize() {
        window.removeEventListener('mousemove', resize, false);
        window.removeEventListener('mouseup', stopResize, false);
    }
});


</script>


</body>
</html>
