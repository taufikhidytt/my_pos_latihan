<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $judul?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('item')?>">Items</a></li>
        <li class="active"><i class="fa fa-archive"></i> Generate Barcode</li>
    </ol>
</section>
<?php $this->view('massage');?>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-left">
                <h4>Generate Barcode</h4>
            </div>
            <div class="pull-right">
                <a href="<?= base_url('item')?>" class="btn btn-xs btn-warning">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <!-- cetak barcode -->
            <!-- di github composer require picqer/php-barcode-generator -->
            <?php
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcode->barcode, $generator::TYPE_CODE_128)) . '">';
            ?><br>
            <?= $barcode->barcode?>
            <br><br>
            <a href="<?= base_url('item/barcode_print/'.$barcode->item_id)?>" target="blank" class="btn btn-github btn-xs">
                <i class="fa fa-print"></i> Print Barcode
            </a>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <div class="pull-left">
                <h4>Generate QrCode</h4>
            </div>
        </div>
        <div class="box-body">
            <!-- cetak qrcode -->
            <!-- di github composer require endroid/qr-code -->
            <?php
                require "./assets/vendor/autoload.php";
                use Endroid\QrCode\QrCode;
                use Endroid\QrCode\Writer\PngWriter;
                $qr = QrCode::create($barcode->barcode);
                $writer = new PngWriter();
                $writer->write($qr)->saveToFile('upload/qr-code/item-'.$barcode->barcode.'.png');
            ?>
                <img src="<?= base_url('upload/qr-code/item-'.$barcode->barcode.'.png')?>" alt="QrCode" width="10%">
                <br>
            <?= $barcode->barcode?>
            <br><br>
            <a href="<?= base_url('item/qrcode_print/'.$barcode->item_id)?>" target="blank" class="btn btn-github btn-xs">
                <i class="fa fa-print"></i> Print QrCode
            </a>
        </div>
    </div>
</section>
<!-- /.content -->