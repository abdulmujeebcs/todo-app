# TODO App

Task Todos REST API's 

## Technical Stack
- PHP >= 8.1
- Laravel 10

## Project Setup
Clone the project source code from the [Repository](https://github.com/abdulmujeebcs/todo-app).
```bash
git clone https://github.com/abdulmujeebcs/todo-app
```

```bash
composer install
```

Update your `.env` file Information before serving the application

```bash
cp .env.example .env
```

Key genration for application

```bash
docker-compose run artisan key:generate
```

```bash
docker-compose run artisan optimize
```


```bash
docker-compose run artisan migrate
```

## Run Feature Tests
```bash
sudo docker-compose run artisan test
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.