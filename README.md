# Manipulate JSON Data in PHP 🐘

Code examples for the tutorial [How to Read, Decode, Encode, and Write JSON Files in PHP?](https://www.nidup.io/blog/manipulate-json-files-in-php)

The code is packaged as a simple Symfony application with cli commands.

This series also proposes other PHP data integration tutorials:
- [How to Read and Write CSV Files in PHP?](https://www.nidup.io/blog/manipulate-csv-files-in-php)
- [How to Read and Write Excel Files in PHP?](https://www.nidup.io/blog/manipulate-excel-files-in-php)
- [How to Use Google Sheets API in PHP?](https://www.nidup.io/blog/manipulate-google-sheets-in-php-with-api)

## Installation 📦

Download the source code:

```
git clone git@github.com:nidup/manipulate-json-data-in-php.git
cd manipulate-json-data-in-php
```

Then the installation comes into 2 flavors, directly on your host or using docker.

Once installed the commands are the same, some docker shortcuts are provided in `.docker/bin`.

### Install directly on your system (option A) 💻

Install the PHP dependencies:

```
composer install
```

### Install with docker & docker-compose (option B) 🐋

Build the docker image and install the PHP dependencies:

```
docker-compose up -d
.docker/bin/composer install
```

## Use the console commands 🚀

Use `bin/console` or `.docker/bin/console` to launch a command.

List the commands:
```
bin/console --env=prod
[...]
nidup
  nidup:json:generate-big-file  Generate 500k lines in a JSON file
  nidup:json:read-big-file      Read a big JSON file and measure time and memory
  nidup:json:read-file          Read a JSON file
  nidup:json:write-file         Write a json file

[...]
```

Launch a command:
```
bin/console nidup:json:read-file --env=prod
```

We use the prod environment here to have the most efficient execution.
