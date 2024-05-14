<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Travaux</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajustements de style supplémentaires */
        body {
            padding: 20px;
        }
        .table h1 {
            margin-bottom: 0;
            /* font-size: 1.5rem; */
            
        }
        /* Style pour la table */
        .table thead th {
            background-color: #343a40; /* Couleur de fond de l'en-tête */
            color: #fff; /* Couleur du texte de l'en-tête */
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Couleur de fond des lignes impaires */
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6; /* Couleur de la bordure */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Couleur de fond des lignes impaires */
        }
    </style>
</head>
<body>
    <h2>Numero Client: <?= $detail[0]->numeroclient ?></h2>    
    <?php 
        $dateObj = new DateTime($detail[0]->datedevis); 
        $date = $dateObj->format('d F Y') ;
    ?>
    <h2>Date Devis: <?= $date?></h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" border="1">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Designation</th>
                    <th scope="col">Unite</th>
                    <th scope="col">Quantite</th>
                    <th scope="col">Prix Unitaire</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($detail as $row): ?>
                    <?php 
                        $quantites = explode(",", $row->quantites);
                        $designations = explode(",", $row->designations);
                        $prix_unitaires = explode(",", $row->prix_unitaires);
                        $prix_totals = explode(",", $row->prix_totals);
                        $nom_unites = explode(",", $row->nom_unites);
                    ?>
                    <?php for($j = 0; $j < count($quantites); $j++): ?>
                        <tr>
                            <td><?= $designations[$j] ?></td>
                            <td><?= $nom_unites[$j] ?></td>
                            <td><?=number_format($quantites[$j],2,'.',' ') ?></td>
                            <td><?= number_format($prix_unitaires[$j],2,'.',' ')?></td>
                            <td style="texte-align:left"><?= number_format($prix_totals[$j],2,'.',' ') ?></td>
                        </tr>
                    <?php endfor; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optionnel si vous n'avez pas besoin de JavaScript) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
