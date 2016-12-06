<?php 
/**
 * makebanner.php
 *
 * Tool to make multipage PDF banners
 *
 * @author Daniel Ribes <daniel@danielribes.com>
 *
 */

require_once __DIR__.'/vendor/tecnickcom/tcpdf/tcpdf.php';

/**
 * Path where save the final PDF
 * @var String
 */
$outputDir = __DIR__.'/output';


//======================================================================
// Functions
//======================================================================

/**
 * Get command line parameters
 * @return Array
 */
function getParams()
{
    global $argv, $argc;

    $options = array();

    if ($argc < 2) {
        showInstructions();
    } else {
        if ($argv[1] == '-o') {
            $options['o'] = 'outline';
            if (!empty($argv[2])) {
                $options['t'] = $argv[2];
            } else {
                showInstructions();
            }
        } else {
            $options['t'] = $argv[1];
        }
    }

    return $options;
}

/**
 * Usage instructions
 * @return Void
 */
function showInstructions()
{
    echo "\nMake a banner!\n";
    echo "\nUsage: makebanner.php [-o] 'String to make as Banner'\n\n";
    die();
}


/**
 * Init PDF and defaults
 * @param Array $options
 * @return TCPDF
 */
function initPDF($options)
{
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,
                     PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('makebanner.php');
    $pdf->SetTitle('Text banner');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->SetFont('helvetica', 'B', 520, '', true);

    if (isset($options['o'])) {
        $pdf->setTextRenderingMode(3, false, false);
    }

    return $pdf;
}


/**
 * Render the PDF
 * @param  TCPDF $pdf
 * @param  String $filename (path + filename) to save PDF
 * @return Void
 */
function closePDF($pdf, $filename)
{
    $pdf->Output($filename, 'F');
}


/**
 * Make page with a big character from input text
 * @param TCPDF $pdf
 * @param String $character
 * @return Void
 */
function addCharacterPage(&$character, $key, $moreParams)
{
    $pdf = $moreParams['pdf'];
    $pHeight = $moreParams['page_height'];
    $pdf->AddPage();

    // Work fine on A4 paper size
    $pdf->Cell(0, $pHeight-50, $character, 0, 0, 'C', false, '', 0, true, '', 'C');
}


/**
 * Is the 'main' function that run the script, and of course, the 'mainStreet'
 * name is a joke about classic C main() function
 * @param  String $outputDir
 * @return Void
 */
function mainStreet($outputDir)
{
    $options = getParams();
    $pdf = initPDF($options);
    $pHeight = $pdf->getPageHeight();
    $moreParams = array('pdf' => $pdf, 'page_height' => $pHeight);
    $theText = preg_replace('/\s+/', '', $options['t']);
    array_walk(preg_split('/(?<!^)(?!$)/u', $theText), 'addCharacterPage', $moreParams);
    closePDF($pdf, $outputDir.'/banner.pdf');
}


//======================================================================
//  RUN
//======================================================================

mainStreet($outputDir);

// That's all folks!
