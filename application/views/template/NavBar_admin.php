<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
  <li class="nav-item">
    <a class="nav-link " href="<?= base_url("index.php/Admin")?>">
      <i class="bi bi-grid"></i>
      <span>Tableau de Bord</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Maison</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url('index.php/Admin/maison_disponible')?>">
          <i class="bi bi-circle"></i><span>Liste de Tous Les Maison</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url('index.php/Admin/devis_en_cours')?>">
          <i class="bi bi-circle"></i><span>Devis en Cours</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url('index.php/Admin/finition')?>">
          <i class="bi bi-circle"></i><span>Voir Finition </span>
        </a>
      </li>
      <li>
        <a href="<?= base_url('index.php/Admin/import')?>">
          <i class="bi bi-circle"></i><span>import </span>
        </a>
      </li>
    </ul>
  </li>
</ul>

</aside>
