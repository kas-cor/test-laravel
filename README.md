## Test Laravel

### Dependency

```bash
composer i && npm i
```

### Config DB

```bash
cp .env.example .env
```

Edit config file `.env`

```
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
...
QUEUE_CONNECTION=database
...
```

### Generate encryption key

```bash
php artisan key:generate
```

### Migrations

```bash
php artisan migrate
```

### Seeds

```bash 
php artisan db:seed DatabaseSeeder
php artisan db:seed FillOperationSeeder
```

### Assets

```bash
npm run dev
```

### Use

#### Authenticate

E-mail: (any from users table)

Password: password

#### Console commands

Run queue worker

```bash
php artisan queue:work 
```

Add user

```bash
php artisan user:add [name] [email] [password]
```

Add operation

```bash
php artisan user:operation [email] [sum]
```
