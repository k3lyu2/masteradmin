<?php
// Admin melihat seluruh menu. User hanya melihat menu yang diberi hak akses user.
$level = $_SESSION['leveluser'];
$sqlMenu = $level === 'admin'
    ? "SELECT * FROM menuutama WHERE aktif = 'Y' ORDER BY urutan, id_main"
    : "SELECT * FROM menuutama WHERE aktif = 'Y' AND hakakses = 'user' ORDER BY urutan, id_main";
$hasilMenu = mysqli_query($koneksi, $sqlMenu);
?>
<nav>
    <ul class="sidebar-menu">
        <li class="<?= $module === 'home' ? 'active' : '' ?>">
            <a href="media.php?module=home"><span class="menu-icon">⌂</span> Dashboard</a>
        </li>

        <?php while ($menu = mysqli_fetch_assoc($hasilMenu)): ?>
            <?php
            // Hak akses submenu mengikuti hak akses menu utamanya.
            $sqlSub = "SELECT * FROM submenu WHERE id_main = ? AND aktif = 'Y' ORDER BY urutan, id_sub";
            $stmtSub = mysqli_prepare($koneksi, $sqlSub);
            mysqli_stmt_bind_param($stmtSub, 'i', $menu['id_main']);
            mysqli_stmt_execute($stmtSub);
            $hasilSub = mysqli_stmt_get_result($stmtSub);
            $daftarSub = mysqli_fetch_all($hasilSub, MYSQLI_ASSOC);
            $aktif = false;
            foreach ($daftarSub as $sub) {
                if (str_contains($sub['link_sub'], 'module=' . $module)) {
                    $aktif = true;
                }
            }
            ?>
            <li class="treeview <?= $aktif ? 'active open' : '' ?>">
                <button type="button" class="treeview-title">
                    <span><span class="menu-icon">▣</span> <?= e($menu['nama_menu']) ?></span>
                    <span>›</span>
                </button>
                <ul class="treeview-menu">
                    <?php foreach ($daftarSub as $sub): ?>
                        <li>
                            <a href="media.php<?= e($sub['link_sub']) ?>"
                               class="<?= str_contains($sub['link_sub'], 'module=' . $module) ? 'active' : '' ?>">
                                › <?= e($sub['nama_sub']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endwhile; ?>
    </ul>
</nav>
