<?php
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Spipu\Html2Pdf\Html2Pdf;
//generate qr code
$options = new QROptions(
    [
        'eccLevel' => QRCode::ECC_L,
        'outputType' => QRCode::OUTPUT_IMAGE_JPG,
        'version' => 5,
    ]
);
$member_code = $_GET["print"]??"";
$viewing_type = $_GET["view"] ?? "farmer";
$link = getBaseUrl()."/details?product=$member_code";
if($viewing_type == "vendor"){
    $link = getBaseUrl()."/details?product=$member_code&view=vendor";
}
$qrcode = (new QRCode($options))->render((string)$link);
$data_selas = '
<table style="border: 2px solid green; border-radius: 10px; width: auto; padding-right: 25px;
 background-image: url(assets/icons/cards.png);">
    <tr>
        <td>
            <h4 style="color: green; text-align: center">Product Sticker</h4>
        </td>
    </tr>
    <tr>
        <td>
            <h6 align="left" style="color: #640303; font-size: 12px; font-weight: bold;">
                Product Code: '.$member_code.'
            </h6>
            <img src="'.$qrcode.'" style="width: 100%; height: 200px; object-fit: contain;">
        </td>
    </tr>
</table>
    ';
echo $data_selas;
$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($data_selas);
ob_end_clean();
clearstatcache();
$html2pdf->output($member_code.'.pdf');