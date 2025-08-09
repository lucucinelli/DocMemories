
<p align="center">
<img src="https://github.com/lucucinelli/DocMemories/blob/main/public/favicon.ico" alt="Build Status" width="100" height="100" align="middle">


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#digitalplot)

# ➤ DigitalPlot

[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#the-perfect-site-for-every-reader)

## ➤ The perfect site for every reader

**DigitalPlot** is a web application developed for a university project. It allows users to write and read articles published by other users in a simple and accessible way.

In our application, there are four main types of users:
- **BASIC**: This user can read up to eight articles, earn points for each article read, and purchase a subscription.
- **READER**: This user can read all articles on the website. Additionally, he can write reviews, follow specific writers, and search for specific articles on the website.
- **WRITER**: This user has the same features as the Reader, with an additional privilege: he can post, modify, and delete his own articles.
- **ADMIN**: The Admin is the all-mighty user. He can manage every article on the website, and every article must be approved by him. He can also view log files and delete comments.



[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#-installation-guide)

## ➤ 🚀 Installation Guide

Before starting, make sure you have the following installed:

- PHP (version 8.x or higher)
- A web server (e.g. Apache)
- A relational DBMS (e.g. MariaDB)
- Composer

After downloading the repository to your device, follow these steps:

### 1. Extract the folder
Extract all the folder files into the document root of your server (e.g.: xampp/htdocs if you are using xampp)

### 2. Install dependencies

Open your terminal in the document root folder and run:

```bash
composer install
```

### 3. Configure database

Edit the database settings in the following file:
```
/Progetto/Utility/config.php
```
Be sure to set your host, database name, username, and password properly.<br>

### 4. Enjoy our application

If you are using a local server be sure to:
- Comment the line 26 of the file '.htaccess';
- For linux/unix OS: grant Apache permission to read and write in the following directories: proxy, template_c, and Logs. Otherwise, the application will not function correctly.

```bash
sudo chmod -R 777 path-to/directory
```

After that, start your local server (e.g. with php artisan serve if using Laravel, or configure Apache/Nginx) and access the application via your browser by typing the URL hostname/dbInit in order to populate properly your db (at the end, you will be redirected to the home). <br>

N.B. 
- If you see an error about 'RuntimeReflectionService.php', go to the file 'vendor/doctrine/persistence/src/Persistence/Mapping/RuntimeReflectionService.php' and edit the line 36 as following:
'public function getParentClasses(string $class): array';
- The automatic redirect to HTTPS may not work in all browsers because the certificate is missing. However, if you click 'Proceed anyway', the redirect will still occur. Otherwise, to solve this problem comment the line 20-21-22 of the file 
'.htaccess'.



[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#-notes)

## ➤ 📝 Notes

This project is for academic purposes and not intended for production use.
Contributions and feedback are welcome.




[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#-author)

## ➤ 👨🏻‍💻 Author

Andrea – Engineering student <br>
Ludovica – Engineering student <br>
Giulio – Engineering student
