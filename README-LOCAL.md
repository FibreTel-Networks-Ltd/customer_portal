# Running the project locally

This project uses Docker to run the backend and frontend services, you will need to have Docker installed on your machine to run this project.
We also use MySQL, Redis, and Mailpit as services for the backend.

## Prerequisites

* Docker

## Getting started

Setup the environment file, you can get the secrets from 1Password

```shell
copy .env.example .env
```

Install the dependencies

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Start the docker containers, this will take a while the first time you run it

```shell
./vendor/bin/sail up -d
```

You can create an alias to sail in your `~/.zshrc` or `~/.bashrc` to avoid having to type `./vendor/bin/sail` everytime.

```shell 
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```


Run the migrations

```shell
sail artisan migrate
```

Install the frontend dependencies

```shell
sail npm install
```

Compile the front-end
```shell
sail npm run dev
```

The project will be running on http://localhost/

Generate the Sonar settings key

```shell
sail artisan sonar:settingskey
```

Head to the [settings page](http://localhost/settings) and enter the generate key then fill up the form with the following values

| Field        | Value                           |
|--------------|---------------------------------|
| Application URL    | https://fibretel.sonar.software |
| Mail Host | mailpit                           |
| Mail Port | 1025                            |
| Mail Username | admin                           |
| Mail Password | admin                           |
| Sender Email | any email you want              |
| Sender Name | any name you want               |


Roles:
https://fibretel.sonar.software/app#/settings/security/roles/update/4
