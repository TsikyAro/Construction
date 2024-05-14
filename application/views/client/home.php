
<main id="main" class="main">
  <section class="section" id="section" >
  <form action="<?= base_url("index.php/ExportCsv/import_csv_")?>" method="post"  enctype="multipart/form-data">
          <input type="file" name="file" id=""  accept=".csv"> 
          <input type="submit" value="Valider">
        </form>
    <div class="row">
      <div class="col-lg-12">
          <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Liste Devis d'un Utilisateur</h5>
                    <!-- Start Table -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">
                              <input type="checkbox" name="id" id="">
                                Date Devis
                              <p>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=0&&name=idmarque">ASC</a>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=1&&name=idmarque">DESC</a>
                              </p>
                            </th>
                            <th scope="col">
                              <input type="checkbox" name="marque" id="">
                                Idmaison
                              <p>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=0&&name=nommarque">ASC</a>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=1&&name=nommarque">DESC</a>
                              </p>
                            </th>
                            <th scope="col">
                              <input type="checkbox" name="action" id="">
                               Finition
                              <p>
                                <a href="#">ASC</a>
                                <a href="#">DESC</a>
                              </p>
                            </th>
                            <th>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($devis_client)){?>
                            <?php for($i = 0; $i<count($devis_client);$i++){?>
                                <tr>
                                  <td><?= $devis_client[$i]->datedevis?></td>
                                  <td><?= $devis_client[$i]->idmaison?></td>
                                  <td><?= $devis_client[$i]->idfinition?></td>
                                  <td><p><a href="<?= base_url('index.php/ClientController/exportpdf')?>?iddevis=<?= $devis_client[$i]->iddevis?>">Exporter Pdf</a></p></td>
                                </tr>
                            <?php }?>
                          <?php }?>
                        </tbody>
                      </table>
                    <!-- End Table with hoverable rows -->
                    </div>
                  </div>
          </div>
      </div>
  </section>
</main>