# categorize country phone numbers.
## Built with
- Laravel 
- docker
- react
- kibana and elasticsearch
- nginx
- swagger



## Prerequisites
  1. docker
  2. docker-compose https://docs.docker.com/engine/install/ubuntu/
## Installation Steps
- clone the repo
- API
 ```sh
cd api
docker-compose up -d
docker-compose exec app composer install
```
- FrontEnd
 ```sh
cd front
docker-compose up -d
```
- Test cases 
```sh
cd api
docker-compose exec app php artisan test
```
## Browse URLs
| Service | URL |
| ------ | ------ |
| Frontend | http://localhost:8000/ |
| swagger | http://localhost:8080/api/documentation |
| kibana | http://localhost:5601 index customer*|
| Api | http://localhost:8080/api/customers |



