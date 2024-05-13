<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
  <li class="nav-item">
    <a class="nav-link " href="<?= base_url("index.php/IndexController")?>">
      <i class="bi bi-grid"></i>
      <span>Tous les Devis</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Devis</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url('index.php/DevisController')?>">
          <i class="bi bi-circle"></i><span>Creation Devis</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url('index.php/DevisController/choixPayement')?>">
          <i class="bi bi-circle"></i><span>Choisir Mode Payement</span>
        </a>
      </li>
    </ul>
  </li>
</ul>

</aside>
