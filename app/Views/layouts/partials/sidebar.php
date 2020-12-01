<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">s!lau</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SIL</a>
        </div>
        <ul class="sidebar-menu">
            <!-- <li class="menu-header">Dashboard</li> -->
            <?php
            $db = \Config\Database::connect();
            $request = \Config\Services::request();
            $role_id = session('role');
            $all_menu = $db->table('menu')
                ->select('menu.*')
                ->join('menu_roles', 'menu_roles.menu_id = menu.id')
                ->where(['menu_roles.role_id' => $role_id, 'menu.is_active' => 1])
                ->orderBy('menu.id', 'ASC')
                ->get()
                ->getResultArray();
            $path = $request->uri->getPath();
            $firstSegment = $request->uri->getSegment(1);
            $secondSegment = $request->uri->getSegment(2);
            ?>
            <?php foreach ($all_menu as $menu) : ?>
                <?php if ($menu['type'] == 'dynamic') : ?>
                    <li class="nav-item dropdown <?= $firstSegment == $menu['name'] ? 'active' : ''; ?>">
                        <a href="#" class="nav-link has-dropdown"><i class="<?= $menu['icon']; ?>"></i><span><?= $menu['display_name']; ?></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $all_submenu = $db->table('submenu')
                                ->select('submenu.*')
                                ->join('menu', 'menu.id = submenu.menu_id')
                                ->where(['submenu.menu_id' => $menu['id'], 'submenu.is_active' => 1])
                                ->get()
                                ->getResultArray();
                            ?>
                            <?php foreach ($all_submenu as $submenu) : ?>
                                <li><a class="nav-link <?= ($path == $submenu['url']) ? 'text-primary font-weight-bold' : ($secondSegment == $submenu['name'] ? 'text-primary font-weight-bold' : ''); ?>" href="/<?= $submenu['url']; ?>"><?= $submenu['display_name']; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php else : ?>
                    <li <?= ($path == $menu['url']) ? 'class="active"' : ''; ?>><a class="nav-link" href="/<?= $menu['url']; ?>"><i class="<?= $menu['icon']; ?>"></i> <span><?= $menu['display_name']; ?></span></a></li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </aside>
</div>