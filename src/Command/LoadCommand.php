<?php

namespace App\Command;

use App\Entity\Legislator;
use App\Entity\Term;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LoadCommand extends Command
{
    protected static $defaultName = 'app:load';
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ParameterBagInterface
     */
    private $bag;

    public function __construct(EntityManagerInterface $em, ParameterBagInterface $bag, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->bag = $bag;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('url', InputArgument::OPTIONAL, 'Argument description', 'https://theunitedstates.io/congress-legislators/legislators-current.json')
            ->addOption('cache', null, InputOption::VALUE_NONE, 'Use the cache, useful during development')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $fn = $this->bag->get('kernel.project_dir') . "/public/data.json";
        $io->info("Loading from " . ($url = $input->getArgument('url')));
        if ($input->getOption('cache')) {
            if (file_exists($fn)) {
                $data = json_decode(file_get_contents($fn));
            } else {
                $io->info("Fetching " . $url);
                $data = json_decode($json = file_get_contents($url));
                file_put_contents($fn,$json);
            }
        } else {
            $data = json_decode(file_get_contents($url));
        }


        foreach ($data as $d) {
            $name = $d->name;
            $legislator = (new Legislator())
                ->setName($name->official_full ?? "$name->first $name->last")
            ;
            foreach ($d->terms as $t) {
                $t->endData = new \DateTime($t->end);
                $t->start = new \DateTime($t->start);
                unset($t->end);
                $term = (new Term())
                    ->populateFromOptions((array) $t);
                $legislator->addTerm($term);
            }
            $this->em->persist($legislator);
            unset($d->terms);
            $legislator
                ->setData($d);
        }
        $this->em->flush();
        $io->success('Data loaded from ' . $url);

        return Command::SUCCESS;
    }
}
