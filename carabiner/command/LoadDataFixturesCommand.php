<?php

namespace Carabiner\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use InvalidArgumentException;

class LoadDataFixturesCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('orm:fixtures:load')
            ->setDescription('Load data fixtures to your database.')
            ->addOption('fixtures', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'The directory to load data fixtures from.')
            ->addOption('append', null, InputOption::VALUE_NONE, 'Append the data fixtures instead of deleting all data from the database first.')
            ->addOption('em', null, InputOption::VALUE_REQUIRED, 'The entity manager to use for this command.')
            ->addOption('purge-with-truncate', null, InputOption::VALUE_NONE, 'Purge data by using a database-level TRUNCATE statement')
            ->setHelp(<<<EOT
The <info>doctrine:fixtures:load</info> command loads data fixtures from your bundles:

  <info>./carabiner/console doctrine:fixtures:load</info>

You can also optionally specify the path to fixtures with the <info>--fixtures</info> option:

  <info>./carabiner/console doctrine:fixtures:load --fixtures=/path/to/fixtures1 --fixtures=/path/to/fixtures2</info>

If you want to append the fixtures instead of flushing the database first you can use the <info>--append</info> option:

  <info>./carabiner/console doctrine:fixtures:load --append</info>

By default Doctrine Data Fixtures uses DELETE statements to drop the existing rows from
the database. If you want to use a TRUNCATE statement instead you can use the <info>--purge-with-truncate</info> flag:

  <info>./carabiner/console doctrine:fixtures:load --purge-with-truncate</info>
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->isInteractive() && !$input->getOption('append'))
        {
            $dialog = $this->getHelperSet()->get('dialog');

            if (!$dialog->askConfirmation($output, '<question>Careful, database will be purged. Do you want to continue Y/N ?</question>', false))
                return;
        }

        $dirOrFile = $input->getOption('fixtures');
        if ($dirOrFile)
        {
            $paths = is_array($dirOrFile) ? $dirOrFile : array($dirOrFile);
        }
        // else
        // {
        //     $paths = array();
        //     foreach ($this->getApplication()->getKernel()->getBundles() as $bundle)
        //     {
        //         $paths[] = $bundle->getPath().'/DataFixtures/ORM';
        //     }
        // }

        foreach ($paths as $path)
        {
            if (is_dir($path))
            {
                $loader = new \Doctrine\Common\DataFixtures\Loader();
                $loader->loadFromDirectory($path);

                $fixtures = $loader->getFixtures();
                if ( ! $fixtures)
                {
                    throw new InvalidArgumentException(
                        sprintf('Could not find any fixtures to load in: %s', "\n\n- ".implode("\n- ", $paths))
                    );
                }
            }
            else
            {
                throw new InvalidArgumentException(
                    sprintf('Directory not found: %s', $path)
                );
            }
        }
        
        $purger = new ORMPurger();
        $purger->setPurgeMode($input->getOption('purge-with-truncate') ? ORMPurger::PURGE_MODE_TRUNCATE : ORMPurger::PURGE_MODE_DELETE);
        $executor = new ORMExecutor($this->getHelper('em')->getEntityManager(), $purger);
        $executor->setLogger(function($message) use ($output)
        {
            $output->writeln(sprintf('  <comment>></comment> <info>%s</info>', $message));
        });

        $executor->execute($fixtures, $input->getOption('append'));
    }
}