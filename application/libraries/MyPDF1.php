<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once dirname(__FILE__) . '/tcpdf/tcpdf-charts.php';

class MYPDF1 extends TCPDF {
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
$this->SetY(10);
        // Set font
        $this->SetFont("dejavusans", "", 9);
        // Page number
        // Logo
        //  $img_name= base_url('img/logo/footer.png');
        // $image_file =     $img_name;
        // $this->Image($image_file, 1, 274, 208, "", "png", "", "T", false, 300, "", false, false, 0, false, false, false);
        $this->getPage();
    
      $page ='Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages();
        $this->Cell(219,510, $page, 0,0, 'R');

    }
    public function Header() {
    // $img_name= base_url('img/logo/header.jpg');
    //  $image_header =  $img_name;
    //    $this->Image($image_header, 2,1, 205, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);   
    }
}
