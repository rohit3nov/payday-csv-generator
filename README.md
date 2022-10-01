# Payday Csv Generator

## How to Setup
1. Clone this repo on your machine and `cd` into the application folder `payday-csv-generator`
2. Make sure you have docker installed otherwise you would require php8.1 and composer installed on your system
3. Once you have docker installed, run the below steps inside `payday-csv-generator`

    `$ docker-compose up -d`

    `$ docker exec -it csv-generator composer dump-autolod`

4. Run below command to get the csv generated inside `docs` folder. Make sure you replace the year field in below command with actual year or don't pass it

    `$ docker exec -it csv-generator php index get-salary-dates <year> >> 'docs/dates.csv'`
    
5. If you don't need docker setup, you can simply run `composer dump-autoload` for setup and `php index get-salary-dates <year> >> 'docs/dates.csv'` for generating the csv

## Run test cases

Enter container using `$ docker exec -it php-fpm /bin/bash` then

`$ composer run test`
