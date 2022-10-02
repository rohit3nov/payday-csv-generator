# Payday Csv Generator

A company is handling their sales payroll in the following way: - Sales staff gets a monthly fixed base salary and a monthly bonus. 
- The base salaries are paid on the last day of the month unless that day is a  Saturday or a Sunday (weekend). 
- On the 15th of every month bonuses are paid for the previous month, unless that day is a weekend. In that case, they are paid the first Wednesday after the 15th. 
- Create a CLI based php application to generate a csv containing salary dates and bonus dates for a given year.
- The output of the utility should be a CSV file, containing the payment dates for the remainder of this year. The CSV file should contain a column for the month name, a column that contains the salary payment date for that month, and a column that contains the bonus payment date. 


## How to Setup
- Clone this repo on your machine and `cd` into the application folder `payday-csv-generator`
- Make sure you have `docker` installed from [here](https://docs.docker.com/desktop/install/windows-install/), otherwise you would require `php` latest version and composer installed on your system
- Once you have docker installed, run the below steps inside `payday-csv-generator`

    `$ docker-compose up -d`

    `$ docker exec -it csv-generator composer install`

    `$ docker exec -it csv-generator composer dump-autolod`

# Generate CSV
- Run below command to get the csv generated inside `docs` folder. Make sure you replace the `[year]` field in below command with actual year or if you don't pass it, it will give result for remaining months of current year

    `$ docker exec -it csv-generator php index get-salary-dates [year] > 'docs/dates.csv'`
    
- If you don't need docker setup, you can simply run `composer dump-autoload` for setup and `php index get-salary-dates <year> > docs/dates.csv` for generating the csv

## Run test cases

- Enter container using `$ docker exec -it php-fpm /bin/bash` then

    `$ composer run test`
