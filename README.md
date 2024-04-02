## About Trail Race Service app
### Made by: Antun J.
Basic app with classic user login and api access for admin
## Requirements
- Docker
- Postman
- Internet browser
## Installation guide
- Open terminal and navigate to project root
- Copy ``` .env.eyample ``` to ```.env```
- Run ``` docker-compose build ``` to build app
- Run ``` docker-compose up -d ``` to run app
- Run ``` docker-compose exec app compose install ``` 
- Run ``` npm install &&  npm run build ``` to install and compile npm files
- Run ``` docker-compose exec app php artisan migrate:fresh --seed ``` to setup database and run migration
- Open browser and navigate it to: http://localhost:8080/ log in as applicant with: user@trail-race.com and password: 123456

## API test guide
Go and check https://documenter.getpostman.com/view/2247202/2sA35Jyyv4