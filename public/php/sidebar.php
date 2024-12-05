<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
  <?php if ($user_role == 1): ?>
    <li class="nav-item">
      <a class="nav-link" href="./">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
  <?php elseif ($user_role == 2): ?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-book menu-icon"></i>
        <span class="menu-title">Data</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="./pengguna">Pengguna</a></li>
          <li class="nav-item"> <a class="nav-link" href="./dokter">Dokter</a></li>
          <li class="nav-item"> <a class="nav-link" href="./tenaga-medis">Tenaga Medis</a></li>
          <li class="nav-item"> <a class="nav-link" href="./pasien">Pasien</a></li>
        </ul>
      </div>
    </li>
  <?php endif; ?>
  <?php if ($user_role == 1 || $user_role == 3): ?>
    <li class="nav-item">
      <a class="nav-link" href="./kunjungan">
        <i class="mdi mdi-calendar menu-icon"></i>
        <span class="menu-title">Kunjungan</span>
      </a>
    </li>
  <?php endif; ?>
  </ul>
</nav>
