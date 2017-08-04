<?php
/**
 * Created by PhpStorm.
 * User: danielribes
 * Date: 4/8/17
 * Time: 17:31
 */

namespace MakeBanner;


class BannerMachine {

    private $outputDir;
    private $pdf;


    public function __construct()
    {
        $this->outputDir = getcwd().'/output';
        $this->pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,
            PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    public function mainStreet($message)
    {
        $this->initPDF();
        $pHeight = $this->pdf->getPageHeight();
        $moreParams = array('page_height' => $pHeight);
        $theText = preg_replace('/\s+/', '', $message);
        array_walk(preg_split('/(?<!^)(?!$)/u', $theText), array($this, 'addCharacterPage'), $moreParams);
        $this->closePDF($this->outputDir.'/banner.pdf');
    }


    private function initPDF()
    {
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('makebanner.php');
        $this->pdf->SetTitle('Text banner');
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);

        $this->pdf->SetFont('helvetica', 'B', 520, '', true);
    }


    /**
     * Make page with a big character from input text
     * @param String $character
     * @return Void
     */
    private function addCharacterPage(&$character, $key, $moreParams)
    {
        $pHeight = $moreParams['page_height'];
        $this->pdf->AddPage();

        // Work fine on A4 paper size
        $this->pdf->Cell(0, $pHeight-50, $character, 0, 0,
                       'C', false, '', 0, true, '', 'C');
    }


    /**
     * Render the PDF
     * @param  String $filename (path + filename) to save PDF
     * @return Void
     */
    private function closePDF($filename)
    {
        $this->pdf->Output($filename, 'F');
    }


    public function setOutlineMode()
    {
        $this->pdf->setTextRenderingMode(3, false, false);
    }

}