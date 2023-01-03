<?php

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

Route::get("/warga/qrcode/{id}", function ($id) {
    $warga = \App\Models\Warga::find($id);

    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data(base64_encode($warga->no_kk))
        ->encoding(new Encoding("UTF-8"))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->logoPath(public_path("img/logo-bu-sm.png"))
        ->labelText($warga->nama_lengkap)
        ->labelFont(new NotoSans(14))
        ->labelAlignment(new LabelAlignmentCenter())
        ->validateResult(false)
        ->build();

    $dataUri = $result->getDataUri();

    return view("warga.qr", compact("result", "warga", "dataUri"));
});
