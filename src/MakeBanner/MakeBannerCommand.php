<?php
/**
 * MakeBannerCommand
 *
 * @author Daniel Ribes <daniel@danielribes.com>
 */

namespace MakeBanner;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;


class MakeBannerCommand extends Command {

    /**
     * configure command
     */
    protected function configure()
    {
        $this->setName('makebanner')
             ->setDescription('Tool to create multi page banners in PDF format')
             ->setHelp("Usage: php makebanner.php --message='Text for the banner' [--outline]\n")
             ->addOption(
                'message',
                null,
                InputOption::VALUE_REQUIRED,
                'Text for the banner : REQUIRED'
             )
             ->addOption(
                'outline',
                null,
                InputOption::VALUE_NONE,
                'Active the outline text mode'
             );
    }


    /**
     * Execute command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
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
            $output->writeln("Done, enjoy!");
        }
        else {
            $output->writeln("\nUsage: php makebanner.php --message='Text for the banner' [--outline]\n");
        }

        return 0;
    }
}