<?php 
/**
 * makebanner.php
 *
 * Tool to make multipage PDF banners
 *
 * @author Daniel Ribes <daniel@danielribes.com>
 *
 */

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use MakeBanner\MakeBannerCommand;

$cmd = new MakeBannerCommand();
$app = new Application('Make a multipage PDF banner','0.2');
$app->add($cmd);
$app->setDefaultCommand($cmd->getName());
$app->run();