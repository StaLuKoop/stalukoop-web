# STALUKOOP-WEB

A modern web application built using the VILT stack: Laravel + Inertia.js + Vue.js + Tailwind CSS. This repository is part of the StaLuKoop organization and serves as the frontend/backend monolith for our cooperative platform.

## Tech Stack

- Laravel 12
- Inertia.js
- Vue 3
- Tailwind CSS
- Vite

## Installation

### Applications / Services to Install

<details>

<summary>Expand to view recommended tools</summary>

Search for `Powershell`, right-click and select Run as `Administrator`.
Paste the shell command by right-clicking and selecting `Paste`.

```bash
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows'))
```

Afterwards, make sure to install these:

- [Laravel Herd](https://herd.laravel.com/)
- [MySQL](https://dev.mysql.com/downloads/installer/)
- [phpmyadmin](https://www.phpmyadmin.net/downloads/)
- [Nodejs](https://nodejs.org/en)
- [HeidiSQL](https://www.heidisql.com/download.php)

#### Tweaks

```bash
cd path/of/phpmyadmin
composer update --no-dev
```

</details>

### Clone the repository

```bash
git clone https://github.com/StaLuKoop/stalukoop-web.git
cd stalukoop-web
```

### Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

#### Inside .env

`APP_NAME=Stalukoop`

`APP_URL=http://stalukoop-web.test`

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stalukoop_db
DB_USERNAME=root
DB_PASSWORD=

# Update your .env file with your local database credentials (MySQL).
```

#### Run database migrations

`php artisan migrate`

#### Start development

`composer run dev`

## Contributing

1. Fork the repository
1. Create your feature branch (git checkout -b feature/my-feature)
1. Commit your changes (git commit -m 'Add some feature')
1. Push to the branch (git push origin feature/my-feature)
1. Open a pull request

### Make changes

```bash
git add .
git commit -m "Update on [name] branch"
git push origin [name]
```

### Create a pull request

After pushing, go to: <https://github.com/StaLuKoop/stalukoop-web>

GitHub will automatically show a "Compare & pull request" banner. Click it and submit PR.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For questions, suggestions, or bugs, please reach out via GitHub Issues:
<https://github.com/StaLuKoop/stalukoop-web/issues>
