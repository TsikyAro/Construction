
<main id="main" class="main">
  <section class="section" id="section" >
    <div class="row">
      <div class="col-lg-12">
          <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Liste Devis </h5>
                    <!-- Start Table -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">
                              <input type="checkbox" name="id" id="">
                               Devis numero
                              <p>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=0&&name=idmarque">ASC</a>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=1&&name=idmarque">DESC</a>
                              </p>
                            </th>
                            <th scope="col">
                              <input type="checkbox" name="marque" id="">
                                Montant Total
                              <p>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=0&&name=nommarque">ASC</a>
                                <a href="<?=base_url('index.php/MarqueController/trie')?>?trie=1&&name=nommarque">DESC</a>
                              </p>
                            </th>
                            <th scope="col">
                              <input type="checkbox" name="action" id="">
                               Montant deja Effectuer
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
                          <?php if(isset($devis)){?>
                            <?php for($i = 0; $i<count($devis);$i++){?>
                                <tr>
                                  <td>DEVISE00<?= $devis[$i]->iddevis?></td>
                                  <td><?= $devis[$i]->somme_total?></td>
                                  <?php $effectuer = $devis[$i]->somme_total- $devis[$i]->reste_payer?>
                                  <td><?= $effectuer?></td>
                                  <td><p><a href="<?= base_url('index.php/ClientController/exportpdf')?>?iddevis=<?= $devis[$i]->iddevis?>">Exporter Pdf</a></p></td>
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