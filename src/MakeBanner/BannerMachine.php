<?php
/**
 * BannerMachine
 * -> This is where magic happend!
 *
 * @author Daniel Ribes <daniel@danielribes.com>
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

    /**
     * Is the 'main' method, and of course, the 'mainStreet'
     * name is a joke about classic C main() function
     *
     * @param $message Text message for the banner
     */
    public function mainStreet($message)
    {
        $this->initPDF();
        $pHeight = $this->pdf->getPageHeight();

        // Remove spaces, we do not want white pages in the pdf
        $theText = preg_replace('/\s+/', '', $message);

        // We separate the message character to character in UTF mode and set a character per page
        $moreParams = array('page_height' => $pHeight);
        array_walk(preg_split('/(?<!^)(?!$)/u', $theText), array($this, 'addCharacterPage'), $moreParams);

        // That's all folks!
        $this->closePDF($this->outputDir.'/banner.pdf');

    }


    /**
     * Some PDF configurations
     */
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
     * @param Array $moreParams Callback extra parameters
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


    /**
     * Yes! we have a outline text mode
     */
    public function setOutlineMode()
    {
        $this->pdf->setTextRenderingMode(3, false, false);
    }

}