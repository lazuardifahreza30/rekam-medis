<?php
$pathContent = 'http://'.$_SERVER['HTTP_HOST'].'/';
?>

<div class="nav">
  <h6 class="app-name">MBKM Dashboard</h6>
  <ul class="menu">
    <li class="home">
      <img src="<?=$pathContent?>img/home.svg" />
      <a href="<?=$pathContent?>">Home</a></li>
    <?php if ($data['role'] == 4): ?>
      <li class="data">
        <img src="<?=$pathContent?>img/dropdown-list.svg" />
        <a>Data</a>
        <img src="<?=$pathContent?>img/arrow-up.svg" style="float: right; margin-top: -10px" />
        <ul class="submenu">
            <li class="kaprodi">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>kaprodi">Kaprodi</a></li>
            <li class="bkp">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>data-bkp">BKP</a></li>
            <li class="skema">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>data-skema">Skema</a></li>
            <li class="mitra">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>data-mitra">Mitra</a></li>
            <li class="form">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>form">Form</a></li>
        </ul>
      </li>
    <?php else: ?>
      <li class="kegiatan">
        <img src="<?=$pathContent?>img/dropdown-list.svg" />
        <a>Kegiatan</a>
        <img src="<?=$pathContent?>img/arrow-up.svg" style="float: right; margin-top: -10px" />
        <ul class="submenu">
          <?php if ($data['role'] == 1): ?>
            <li class="registrasi">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>registrasi">Registrasi</a></li>
          <?php elseif ($data['role'] == 2): ?>
            <li class="bimbingan">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>bimbingan">Bimbingan</a></li>
          <?php elseif($data['role'] == 3): ?>
            <li class="mahasiswa">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>mahasiswa">Mahasiswa</a></li>
          <?php endif; ?>
          <?php if ($data['role'] == 1 && isset($bkp_nama)): ?>
            <li class="logbook">
              <img src="<?=$pathContent?>img/status-app.svg" />
              <a href="<?=$pathContent?>log-book">Logbook</a></li>
            <li class="laporan-akhir">
              <img src="<?=$pathContent?>img/file-register.svg" />
              <a href="<?=$pathContent?>laporan">Laporan Akhir</a></li>
          <?php endif; ?>
        </ul>
      </li>
    <?php endif; ?>
    <li class="settings">
      <img src="<?=$pathContent?>img/settings.svg" />
      <a>Settings</a></li>
    <li class="logout">
      <img src="<?=$pathContent?>img/logout.svg" />
      <a href="<?=$pathContent?>logout">Logout</a></li>
  </ul>
</div>

<div class="right_nav">
  <a>
    <img src="<?=$pathContent?>img/Ellipse 1.png" style="height: 20px" />
    <span class="name"><?=isset($data['nama'])? $data['nama'] : ''?></span></a>
  <a>
    <img src="<?=$pathContent?>img/notification.svg" />
  </a>
</div>
