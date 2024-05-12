<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/lib/bootstrap/css/bootstrap.min.css') ?>">
    <title>Test page</title>
</head>

<body>
    <h1 class="text-success"><?= $session ?></h1>
    <ul>
        <?php for ($i = 0; $i < count($students); $i++) { ?>
        <li><?= $students[$i]['name']; ?></li>
        <?php } ?>
    </ul>
</body>

</html>