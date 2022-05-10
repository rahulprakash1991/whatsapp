<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once dirname(__FILE__) . '/tcpdf/tcpdf-charts.php';

class MYPDF extends TCPDF {
    // Page footer

    public function Footer() {
       
   //      $this->SetY(-25);
       
   //      $logoX = 2; 

   //   $img_name= base_url('img/logo/footer.jpeg');
   // $logoFileName =  $img_name;

   // $logoWidth = 200; // 15mm
   // $logo = 'Page : '.$this->PageNo() . ' | '. $this->Image($logoFileName, $logoX, $this->GetY()+2, $logoWidth);

   // $this->SetX($this->w - $this->documentRightMargin - $logoWidth); // documentRightMargin = 18
   // $this->Cell(0,4, $logo, 0, 0, 'R');
$this->SetY(0);
        // Set font
        $this->SetFont("dejavusans", "", 9);
        // Page number
        // Logo
     $this->getPage();
    
      $page ='Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages();
      $img_name= base_url('img/logo/footer.png');
      $image_file =     $img_name;
      $this->Image($image_file, 6, 274, 199, "", "png", "", "T", false, 300, "", false, false, 0, false, false, false);
      $this->Cell(25,3, $page, 0,0, 'R');


    }
    public function Header() {
    $img_name= base_url('img/logo/header.png');
     $image_header =  $img_name;
       $this->Image($image_header,4,0, 202,30, 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);   
    }
}
