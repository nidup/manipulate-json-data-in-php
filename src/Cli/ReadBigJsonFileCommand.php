<?php

declare(strict_types=1);

namespace App\Cli;

use JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;
use League\Csv\Reader;
use League\Csv\UnavailableStream;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class ReadBigJsonFileCommand extends Command
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
        $this->setName('nidup:json:read-big-file')
            ->setDescription('Read a big JSON file and measure time and memory');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \JsonMachine\Exception\InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $section = 'read_json_file';
            $this->stopwatch->start($section);
            $path = 'data/movies-500000.json';

            $jsonData = Items::fromFile($path, ['decoder' => new ExtJsonDecoder(true)]);
            foreach ($jsonData as $object) {
                // do nothing, but we want to browse each object
                // echo $object["title"];
            }

            $this->stopwatch->stop($section);
            $output->writeln("I read ".iterator_count($jsonData)." rows from the JSON File ".$path);
            $output->writeln((string) $this->stopwatch->getEvent($section));
            return 0;
        } catch (UnavailableStream $exception) {
            $output->writeln("File ".$path." does not exist, it has to be generated with the command 'nidup:json:generate-big-json-file'");
            return -1;
        }
    }
}
