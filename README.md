
## Installation

### Step 1
You can install the package via git:

```shell
git clone https://github.com/shivragshukla/laravel-vue-repository-design-pattern.git
```

#### Package install

Run the command : 

- The Laravel package will automatically register itself, so you can start using it immediately.

```shell
composer install
```

- The npm package will automatically register itself, so you can start using it immediately.

```shell
npm install
```

#### Key generate

Run the command : 

- The Laravel key generate immediately.

```shell
php artisan key:generate
```

### Step 2 - SetUp database

- Open .env file set DB_DATABASE, DB_USERNAME, DB_PASSWORD and add MIX_APP_URL="${APP_URL}"
- Run the command : 

```shell
composer dump-autoload
```

```shell
php artisan migrate:refresh --seed
```

## Usage

- Run the command on 1st shell: 

```shell
php artisan serve
```

- Run the command on 2nd shell: 

```shell
npm run watch
```