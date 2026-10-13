<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= $adminlte_url . 'dist/img/avatar5.png' ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Login sebagai: <br><strong><?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></strong></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU ADMIN</li>
        <li class="active">
          <a href="<?= htmlspecialchars(site_url('admin'), ENT_QUOTES, 'UTF-8') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?= htmlspecialchars(site_url('admin/madmin'), ENT_QUOTES, 'UTF-8') ?>">
            <i class="fa fa-users"></i> <span>Manajemen Admin</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>