<?php

declare(strict_types=1);

namespace App\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadJsonFileCommand extends Command
{
    protected function configure()
    {
        $this->setName('nidup:json:read-file')
            ->setDescription('Read a JSON file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // decode a string to an associative array
        if (false) {
            $jsonString = '[{"id":"287947","title":"Shazam!","poster":"https:\/\/image.tmdb.org\/t\/p\/w500\/xnopI5Xtky18MPhK40cZAGAOVeV.jpg","overview":"A boy is given the ability to become an adult superhero in times of need with a single magic word.","release_date":"1553299200","genres":["Action","Comedy","Fantasy"]},{"id":"299537","title":"Captain Marvel","poster":"https:\/\/image.tmdb.org\/t\/p\/w500\/AtsgWhDnHTq68L0lLsUrCnM7TjG.jpg","overview":"The story follows Carol Danvers as she becomes one of the universe\u2019s most powerful heroes when Earth is caught in the middle of a galactic war between two alien races. Set in the 1990s, Captain Marvel is an all-new adventure from a previously unseen period in the history of the Marvel Cinematic Universe.","release_date":"1551830400","genres":["Action","Adventure","Science Fiction"]}]';
            $jsonArray = json_decode($jsonString, true);
            var_dump($jsonArray);
            exit();
        }

        // encode an array to a json string
        if (false) {
            $jsonArray = [
                [
                    "id" => "287947",
                    "title" => "Shazam!",
                    "poster" => "https://image.tmdb.org/t/p/w500/xnopI5Xtky18MPhK40cZAGAOVeV.jpg",
                    "overview" => "A boy is given the ability to become an adult superhero in times of need with a single magic word.",
                    "release_date" => "1553299200",
                    "genres"=> ["Action", "Comedy", "Fantasy"]
                ],
                [
                    "id" => "299537",
                    "title" => "Captain Marvel",
                    "poster" => "https://image.tmdb.org/t/p/w500/AtsgWhDnHTq68L0lLsUrCnM7TjG.jpg",
                    "overview" => "The story follows Carol Danvers as she becomes one of the universe’s most powerful heroes when Earth is caught in the middle of a galactic war between two alien races. Set in the 1990s, Captain Marvel is an all-new adventure from a previously unseen period in the history of the Marvel Cinematic Universe.",
                    "release_date" => "1551830400",
                    "genres"=> ["Action", "Adventure", "Science Fiction"]
                ]
            ];
            // compact format
            $compactJsonString = json_encode($jsonArray);
            echo $compactJsonString.PHP_EOL;
            // pretty human-readable format
            $prettyJsonString = json_encode($jsonArray, JSON_PRETTY_PRINT);
            echo $prettyJsonString;
        }


        if (true) {
            $path = 'data/movies-10.json';
            // read the file's content as a string
            $jsonString = file_get_contents($path);
            // convert the json string to an array
            $jsonData = json_decode($jsonString, true);
            var_dump($jsonData);
        }

        // convert JSON to CSV file
        if (false) {
            $path = 'data/movies-flat-10.json';
            // read the file's content as a string
            $jsonString = file_get_contents($path);
            // convert the json string to an array of associative array (one per object)
            $jsonObjects = json_decode($jsonString, true);

            // fetch the keys of the first json object
            $headers = array_keys(current($jsonObjects));

            // flatten the json objects to keep only the values as arrays
            $rows = [];
            foreach ($jsonObjects as $jsonObject) {
                $rows[] = array_values($jsonObject);
            }

            // insert the headers and the rows in the CSV file
            $path = 'data/new-file2.csv';
            $csv = Writer::createFromPath($path, 'w');
            $csv->insertOne($headers);
            $csv->insertAll($rows);
        }


        return 0;
    }
}
