<?php 
/**
 * makebanner.php
 *
 * Tool to create multi page banners in PDF format
 *
 * @author Daniel Ribes <daniel@danielribes.com>
 *
 * Usage: $ php makebanner.php --message='Text to banner' [--outline]
 *
 */

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use MakeBanner\MakeBannerCommand;

$cmd = new MakeBannerCommand();
$app = new Application('MakeBanner: Create multi page banner in PDF format','0.2');
$app->add($cmd);
$app->setDefaultCommand($cmd->getName());
$app->run();