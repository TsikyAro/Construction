<?php
// Supposons que $data soit votre tableau d'objets avec des propriétés label et value
$data = [
    (object) ['label' => 'January', 'value' => 65],
    (object) ['label' => 'February', 'value' => 59],
    (object) ['label' => 'March', 'value' => 80],
    (object) ['label' => 'April', 'value' => 81],
    (object) ['label' => 'May', 'value' => 56],
    (object) ['label' => 'June', 'value' => 55],
    (object) ['label' => 'July', 'value' => 40],
    (object) ['label' => 'Agust', 'value' => 20],
];
?>
<script src="<?= base_url('assets/js/html2pdf.bundle.js'); ?>"></script>
<main id="main" class="main">
<section class="section" id="section" style="align-items: center; justify-content: center; margin:35px;">
<div class="container">
        <form action="<?= base_url("index.php/ExportCsv/import_csv_process")?>" method="post"  enctype="multipart/form-data">
          <input type="file" name="file" id=""  accept=".csv"> 
          <input type="submit" value="Valider">
        </form>
    <div class="row">
      <h1>Le chart Graphique</h1>
      
      <div class="row">

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Line Chart</h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
                <script>
                document.addEventListener("DOMContentLoaded", () => {
                    var labels = [];
                    var values = [];
                    <?php foreach ($data as $item): ?>
                        labels.push("<?php echo $item->label; ?>");
                        values.push(<?php echo $item->value; ?>);
                    <?php endforeach; ?>

                    // Utilisez les tableaux JS pour créer le graphique
                    new Chart(document.querySelector('#lineChart'), {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Line Chart',
                                data: values,
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });

                  function exportToPDF() {
                      const content = document.getElementById('section');
                      html2pdf(content);
                  }
                </script>
                <!-- End Line CHart -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <button onclick="exportToPDF()">Exporter en PDF</button>
</main>