# Intorduction
This project is designed to fetch ExchangeRate API on schedule(once a day at 6:00) and queue it as a job for the worker to dispatch.
Once the worker runs and dispatch the job successfuly, if there is any update to teh database, an email notification is triggered to the system administator


## The scheduler
In directory "app/console/Kernel.php", "SaveExchangeRateAPIToDB" is scheduled and queued for 6am daily
The job information is saved within the "jobs" table, on the DB
In the case of any failed job, the information is saved within the "failed_jobs" table
- remeber ot update SCHEDULER_QUEUE_TIME within the .env file, by the default it is set to 06:00 

## SaveExchangeRateAPIToDB [JOB]
This will connect to API and attempt to save response data into the database
The process wil check if the combination of the USD and dataTime exists within the table, if not  that mean there is a new data, therefore this will be processed


# Set up

## ENV
Rename .env.example to .env and update the following:
- Database configuration
- Email configuration 
- SCHEDULER_QUEUE_TIME (see details below) 
- leave the following as they are, EXCHANGE_RATE_URL, EXCHANGE_RATE_API, EXCHANGE_RATE_SYMBOLS

## Run the code below to migrate all tables
```bash
	php artisan migrate
```


## Next is to Schedule the task 
- This will queue your job and save the detail within the "jobs" table
- before running the code below, set 'SCHEDULER_QUEUE_TIME' within the .env to 1 minute or 2 ahead  of your current time, in order for the scheduler to activate within your time. 
For example by the time you're running the code, if your time is 05:53, set SCHEDULER_QUEUE_TIME to 05:55  

- run the code below on your terminal
```bash
	php artisan schedule:work
```

## Start a worker
- The process scans the queue stores (database) and run any job there 
- On another terminal tab, run code below to start the worker with priority "exchangerates"
```bash
	php artisan queue:work --queue=exchangerates,default
``` 

## If everything goes well..
- The tables bases and rates should update with respective
- You should notification on the set email within your .env file
- You should get a success message within the log file.
- If there is an issue, check the log as well and see the "failed_jobs" table

## To search for exchange rates by dates
- visit "/search" and select availble dates and time from the drop down, click search and result should be displayed.

## Miscellaneous
- The following property should be kept as they are, within the .env file
EXCHANGE_RATE_URL, EXCHANGE_RATE_API, EXCHANGE_RATE_SYMBOLS

## Contact
If you have any issue with any portion of this code, please contact me on nolimit.gws@gmail.com