<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$document= new Dompdf();

$page=file_get_contents("en.php");
$document->loadHtml($page);
$document->setPaper('A4','landscape');

$document->render();
$document->stream("Webslesson", array("Attachment"=>0));

?>