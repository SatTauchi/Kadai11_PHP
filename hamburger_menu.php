<div class="hamburger-menu">
        <input type="checkbox" id="menu-btn-check">
        <label for="menu-btn-check" class="menu-btn"><span></span></label>
        <!--ここからメニュー内容-->
        <div class="menu-content">
            <ul>
                <li>
                    <p class="user_name"><?PHP echo $name ?></p>
                </li>
                <li>
                    <a href="user_register_update.php"><i class="fa-solid fa-user-gear"></i>ユーザー設定</a>
                </li>
                <li>
                    <a href="logout.php" class="logout-item"><i class="fas fa-arrow-right-from-bracket"></i> ログアウト</a>
                </li>
            </ul>
        </div>
</div>
