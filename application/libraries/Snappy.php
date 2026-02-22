<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once("./vendor/autoload.php");
use Knp\Snappy\Pdf;

class Snappy {
    
    public function generate(){
    	$snappy = new Pdf('C:\Dev\wkhtmltopdf\bin\wkhtmltopdf');
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename="file.pdf"');
		echo $snappy->getOutput('http://localhost/sipede/spd/print_snappy?id=11');
    }

    public function local_generate($html){
    	$snappy = new Pdf('C:\Dev\wkhtmltopdf\bin\wkhtmltopdf');
    	header('Content-Type: application/pdf');
		//header('Content-Disposition: attachment; filename="file.pdf"');
		echo $snappy->getOutputFromHtml($html);
    }
}
