<?php

require 'vendor/autoload.php';

use Mpdf\Mpdf;

$mpdf = new Mpdf();

$mpdf->WriteHTML('<h1>Olá, Mundo!</h1>');
$mpdf->WriteHTML('<p>Este é um PDF gerado usando o pacote mPDF.</p>');

$mpdf->WriteHTML('<img src="3RXXMoub_400x400.jpg" style="width: 300px;">');

$mpdf->Output();