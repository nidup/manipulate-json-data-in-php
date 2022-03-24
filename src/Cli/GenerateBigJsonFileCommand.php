<?php

declare(strict_types=1);

namespace App\Cli;

use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class GenerateBigJsonFileCommand extends Command
{
    /** @var Stopwatch */
    private $stopwatch;

    public function __construct(Stopwatch $stopwatch)
    {
        parent::__construct();
        $this->stopwatch = $stopwatch;
    }

    protected function configure()
    {
        $this->setName('nidup:json:generate-big-file')
            ->setDescription('Generate 500k lines in a JSON file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        # TODO: look at DockerFile to increase memory to generate this file

        // read lines in CSV from source
        $path = 'data/movies-10000.csv';
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);
        $rows = $csv->getRecords();

        // generate a large JSON file
        $data = [];
        for ($idx = 0; $idx < 50; $idx++) {
            foreach ($rows as $row) {
                // convert movies genres to an array
                $object = $row;
                $object['genres'] = explode(', ', $row['genres']);
                $data[] = $object;
            }
        }

        // write in json file
        $jsonPath = 'data/movies-500000.json';
        $fp = fopen($jsonPath, 'w');
        fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
        fclose($fp);
        $output->writeln("I generate ".count($data)." rows in the JSON File ".$jsonPath);

        return 0;
    }
}
