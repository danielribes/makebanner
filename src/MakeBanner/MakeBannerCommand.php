<?php
/**
 * Created by PhpStorm.
 * User: danielribes
 * Date: 4/8/17
 * Time: 16:46
 */

namespace MakeBanner;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;


class MakeBannerCommand extends Command {

    protected function configure()
    {
        $this->setName('makebanner')
             ->setDescription('Tool to make multipage PDF banners')
             ->setHelp("Usage: php makebanner.php --message='Text to banner' [--outline]\n")
             ->addOption(
                'message',
                null,
                InputOption::VALUE_REQUIRED,
                'el TEXT A imprimir!'
             )
             ->addOption(
                'outline',
                null,
                InputOption::VALUE_NONE,
                'el pdf en mode OUTLINE'
             );
    }



    protected function execute( InputInterface $input, OutputInterface $output )
    {
        if($input->getOption('message'))
        {
            $bm = new BannerMachine();

            if($input->getOption('outline'))
            {
                $bm->setOutlineMode();
            }

            $bm->mainStreet($input->getOption('message'));
            $output->writeln("Done!");
        }
        else {
            $output->writeln("\nUsage: php makebanner.php --message='Text to banner' [--outline]\n");
        }
    }
}