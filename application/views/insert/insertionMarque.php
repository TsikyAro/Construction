
<main id="main" class="main">
  <section class="section" id="section" >
    <div class="row">
      <div class="col-lg-6">
        <?php if(isset($notification)){?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $notification?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php }?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Insertion Marque</h5>
              <!-- General Form Elements -->
              <form action="<?= base_url('index.php/MarqueController/insertionMarque')?>" method="post">
                <div class="row mb-3">
                  <label for="inputText" >Nom Marque</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomMarque" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>
          <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Liste Marque</h5>
                    <!-- Start Table -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">
                              <input type="checkbox" name="id" id="">
                              Id Marque
                              <p>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=0&&name=idmarque">ASC</a>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=1&&name=idmarque">DESC</a>
                              </p>
                            </th>
                            <th scope="col">
                              <input type="checkbox" name="marque" id="">
                                Marque
                              <p>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=0&&name=nommarque">ASC</a>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=1&&name=nommarque">DESC</a>
                              </p>
                            </th>
                            <th scope="col">
                              <input type="checkbox" name="action" id="">
                                Action
                              <p>
                                <a href="#">ASC</a>
                                <a href="#">DESC</a>
                              </p>
                            </th>
                            <th>
                                <!-- Ajoutez un bouton "Valider" -->
                                <p>
                                  <button id="validerBtn" class="btn btn-primary">Valider</button>
                                  <button id="reset" class="btn btn-primary">Revoir La liste</button>
                                  <a href="<?= base_url('index.php/MarqueController/export')?>">Export Pdf</a>
                                </p>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($marques)){?>
                            <?php for($i = 0; $i<count($marques);$i++){?>
                                <tr>
                                  <td><?= $marques[$i]->idmarque?></td>
                                  <td><?= $marques[$i]->nommarque?></td>
                                  <td> 
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered<?=$marques[$i]->idmarque?>">
                                      <i class="bi bi-pen-fill"></i>
                                    </button>
                                  <!-- Modifier -->
                                    <div class="modal fade" id="verticalycentered<?=$marques[$i]->idmarque?>" tabindex="-1">
                                      <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">Modifier</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <form id="modalForm" action="<?= base_url('index.php/MarqueController/update')?>" method="post">
                                                  <div class="modal-body">
                                                      <input type="text" name="nomMarque" id="nomMarque" class="form-control" value="<?=$marques[$i]->nommarque?>">
                                                      <input type="hidden" name="idMarque" id="idMarque" value="<?=$marques[$i]->idmarque?>">
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Valider</button>
                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                    </div>
                                    <!-- End Modifier -->
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentereds<?=$marques[$i]->idmarque?>">
                                        <i class="bi bi-trash"></i>
                                      </button>
                                    </td>
                                  <!-- Suprimer -->
                                  <div class="modal fade" id="verticalycentereds<?=$marques[$i]->idmarque?>" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                              <center><h2 style="color:red; margin-top:35px">Vous etes sur de suprimer <?=$marques[$i]->nommarque ?>?</h2></center>
                                            <form id="modalForm" action="<?= base_url('index.php/MarqueController/delete')?>" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="idMarque" id="idMarque" value="<?=$marques[$i]->idmarque?>">
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                  <button type="submit" class="btn btn-primary">Valider</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                  </div>
                                  <!-- End Suprimer -->
                                </tr>
                            <?php }?>
                          <?php }?>
                        </tbody>
                      </table>
                    <!-- End Table with hoverable rows -->
                    
                    <!-- Pagination -->
                        <div class="pagination">
                          <?php if ($curent-1>=1) : ?>
                              <a href="<?=base_url('index.php/MarqueController/pagination')?>?page=0&&debut=<?=count($marques)?>&&curent=<?=$curent-1?>"><?= $curent - 1 ?></a>
                          <?php endif; ?>
                          <a class="active" href="#"><?= $curent ?></a>
                          <?php if($page >= $curent+1) {?>
                            <a href="<?=base_url('index.php/MarqueController/pagination')?>?page=1&&debut=<?=count($marques)?>&&curent=<?=$curent+1?>"><?= $curent + 1 ?></a>
                          <?php }?>
                        </div>
                    <!-- End Pagination -->
                    </div>
                  </div>
          </div>
      </div>
  </section>
</main>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var validerBtn = document.getElementById('validerBtn');
    validerBtn.addEventListener('click', function() {
      // Récupérer les cases à cocher pour les colonnes "marque" et "action"
      var marqueCheckboxes = document.querySelectorAll('input[type="checkbox"][name="marque"]');
      var actionCheckboxes = document.querySelectorAll('input[type="checkbox"][name="action"]');
      var id = document.querySelectorAll('input[type="checkbox"][name="id"]');
      
      // Parcourir les cases à cocher pour les colonnes "marque"
      marqueCheckboxes.forEach(function(checkbox, index) {
        var cells = document.querySelectorAll('tbody tr td:nth-child(' + (index + 2) + ') ,thead tr th:nth-child(' + (index + 2) + ')');
        if (checkbox.checked) {
          cells.forEach(function(cell) {
            cell.style.display = 'none';
          });
        } else {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        }
      });
      
      // Parcourir les cases à cocher pour les colonnes "action"
      actionCheckboxes.forEach(function(checkbox, index) {
        var cells = document.querySelectorAll('tbody tr td:nth-child(' + (index + 3) + ') ,thead tr th:nth-child(' + (index + 3) + ')');
        if (checkbox.checked) {
          cells.forEach(function(cell) {
            cell.style.display = 'none';
          });
        } else {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        }
      });
      
      id.forEach(function(checkbox, index) {
        var cells = document.querySelectorAll('tbody tr td:nth-child(' + (index + 1) + ') ,thead tr th:nth-child(' + (index + 1) + ')');
        if (checkbox.checked) {
          cells.forEach(function(cell) {
            cell.style.display = 'none';
          });
        } else {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        }
      });
    });

    var reset = document.getElementById('reset');
    reset.addEventListener('click',function(){
      var marqueCheckboxes = document.querySelectorAll('input[type="checkbox"][name="marque"]');
      var actionCheckboxes = document.querySelectorAll('input[type="checkbox"][name="action"]');
      var id = document.querySelectorAll('input[type="checkbox"][name="id"]');
      
      // Parcourir les cases à cocher pour les colonnes "marque"
      marqueCheckboxes.forEach(function(checkbox, index) {
        var cells = document.querySelectorAll('tbody tr td:nth-child(' + (index + 2) + ') ,thead tr th:nth-child(' + (index + 2) + ')');
        if (checkbox.checked) {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        } else {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        }
      });
      
      // Parcourir les cases à cocher pour les colonnes "action"
      actionCheckboxes.forEach(function(checkbox, index) {
        var cells = document.querySelectorAll('tbody tr td:nth-child(' + (index + 3) + ') ,thead tr th:nth-child(' + (index + 3) + ')');
        if (checkbox.checked) {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        } else {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        }
      });

      id.forEach(function(checkbox, index) {
        var cells = document.querySelectorAll('tbody tr td:nth-child(' + (index + 1) + ') ,thead tr th:nth-child(' + (index + 1) + ')');
        if (checkbox.checked) {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        } else {
          cells.forEach(function(cell) {
            cell.style.display = '';
          });
        }
      });
    });
  });
</script>
<style>
  .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 20px 0;
  }

  .pagination a {
      display: inline-block;
      padding: 5px 10px;
      margin-right: 5px;
      text-decoration: none;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 3px;
  }

  .pagination a:hover {
      background-color: #f0f0f0;
  }

  .pagination a.active {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
  }

</style>
