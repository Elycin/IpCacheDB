# IpCacheDB

IpCacheDB is a high performance solution for caching data from https://ipinfo.io/  
This system stores returned data, checks and compares to update old data, and utilizes the redis cache to provide a immediate response.

## Why was this created?
The source of where we get the data from is rate limited to 1,000 requests per day for free use.  
This system doesn't aim to circumvent this limit, but rather retain the data provided and store it for fast access.

## Usage
The data returned by this application is in JSON format.  
Although there is a web interface, it provides a basic idea of how the system should be used.

Example Request: `/8.8.8.8`

## Installation
This project was written in laravel.  
You may install the project by doing the following steps:  
```bash
$ git clone https://github.com/Elycin/IpCacheDB
$ cd IpCacheDB
$ composer install
$ cp .env.example .env
# At this point, please edit the .env and configure the database with MySQL. 
$ php artisan key:generate
$ php artisan migrate
```