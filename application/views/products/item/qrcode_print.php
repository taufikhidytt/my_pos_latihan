<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qr-Code <?= $row->barcode?></title>
</head>
<body style="text-align: center; margin-top:20%;">
    <img src="<?= base_url()?>upload/qr-code/item-<?= $row->barcode?>.png" alt="QrCode" width="30%">
    <br>
    <?= $row->barcode?>
</body>
</html>