# TODO App REST API's

### Technical Stack
- PHP >= 8.1, Laravel 10, Mysql

## Project Setup
Clone the project source code from the [Repository](https://github.com/abdulmujeebcs/todo-app).
```bash
git clone https://github.com/abdulmujeebcs/todo-app
```

Create .env file by using this command

```bash
cp .env.example .env
```

```bash
docker-compose up -d
```


```bash
docker-compose run composer install
```

```bash
docker-compose run artisan key:generate
```

```bash
docker-compose run artisan optimize
```


```bash
docker-compose run artisan migrate
```

### Ubuntu users (need to automate this in docker)
```bash
sudo chmod 777 -R storage
```


## Run Feature Tests
```bash
sudo docker-compose run artisan test
```
