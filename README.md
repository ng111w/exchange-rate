# Intorduction
	This project is design to fetch ExchangeRate API on schedule(once a day) and queue it as a job for later.

	- On saving to database, the system will check if certian Base currency with its respective timestamp already exists, if yes, it will ignore the transaction


# Set up

## once the code has been extracted, run the following code for a refresh
```bash
	php artisan composer dump-autoload
```

## ENV
Rename .env.example to .env and update your database configuration


## Run the code below to migrate all tables
```bash
	php artisan migrate
```

## Miscellaneous
- The following property should be kept as they are, within the .env file
EXCHANGE_RATE_URL, EXCHANGE_RATE_API, EXCHANGE_RATE_SYMBOLS

- 

# Once you good and ready 

## Schedule the task 
- This will queue your job and save the detail within the "jobs" table
```bash
	php artisan schedule:work
```

## Start a worker
- The process scans the queue stores (database) and run any job there 
- Run code below to start the worker with priority "exchangerates"
```bash
	php artisan queue:work --queue=exchangerates,default
``` 

## If everything goes well..
You will get a success within the log file if not, check the log as well and see the "failed_jobs" table