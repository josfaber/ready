# Ready

Ready is a book collection and management application.
It is created as an mvp for the Soapbox development assignment.

## Assumptions

- Books are user-owned objects (a.o.t. a global list)
- Genres are global, editable by admins and usable by users
- For simplicity, admin status is `$user->id === 1`
- For simplicity, users and admins use the same dashboard
- Admins are also users with books

## Install

Preferably: prepare a runtime environment, e.g. [Laravel Herd](https://herd.laravel.com/)

#### Clone the repo
```
git clone git@github.com:josfaber/ready.git
cd ready
```

#### Create your environment

Copy the example environment and adapt to your situation.

```
cp .env.example .env
```

#### Prepare database

Create an empty local MySQL database called `ready` or change the database driver to sqlite in the `.env` file.

#### Setup the project
```
composer install
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
```

#### Visit the application
https://ready.test (or http://localhost:8080, depending on your setup)

## Users

The seeder will create one admin user and two unprivileged users for demonstration purpose.

#### User : password

```
dev+admin@soapbox.nl / dev+admin@soapbox.nl
dev+mads@soapbox.nl / dev+kaj@soapbox.nl
dev+mads@soapbox.nl / dev+mads@soapbox.nl
```

<br>
<hr>
Created at 14-05-2025 by Jos Faber for Soapbox
