## Requirements
* PHP 7.4
* MySQL 5.7

## Running
```shell script
$ chmod +x start.sh && sh start.sh
```

## Stopping
```shell script
$ chmod +x stop.sh && sh stop.sh
```

## Download as CSV
While APP is running go to page `http://localhost:8080/tables/source/csv`.

Visit `http://localhost:8080/` to easily download CSV or find link examples to fetch JSON.

## Functional Testing
Contains functional test for CSV export.

```shell script
$ bin/phpunit
```
