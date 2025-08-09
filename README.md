


<p align="center">
<img src="https://github.com/lucucinelli/DocMemories/blob/main/public/favicon.ico" alt="Build Status" width="100" height="100">

[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#docmemories)
# ➤ DocMemories

[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#the-perfect-site-for-every-reader)

## ➤ A web app to help Doctors

**DocMemories** is a web application designed to help doctors manage clinical data and generate functional statistics. Built with the Laravel framework, it provides a secure and efficient way to manage patient and visit information.

[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#-features)

## ➤ Features

- **User Authentication**: Secure login and registration for users.
- 
- **Search Functionality**: Quickly find documents using a powerful search feature.

[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#-installation-guide)

## ➤ 🚀 Installation Guide

Before starting, make sure you have the following installed:

- PHP (version 8.x or higher)
- A web server (e.g. Apache)
- A relational DBMS (e.g. MariaDB)
- Composer
- NodeJs

After downloading the repository to your device, follow these steps:

### 1. Enter the folder
Navigate to the folder where you extracted the files (e.g.: xampp/htdocs/DocMemories if you are using xampp)

### 2. Configure settings

Add the `.env` file with all the necessary configuration.<br>
You can use the `.env.example` file as a reference to create your own. Be sure to set: 
- `DB_HOST`
- `DB_NAME`
- `DB_USER`
- `DB_PASSWORD`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_FROM_ADDRESS`

N.B. Make sure to close the `.env` file properly.

### 3. Install dependencies

Open your terminal in the document root folder and run:

```bash
composer install
npm install
```

The installation process may take a few minutes. Once it's done, you can proceed to the next steps.

```bash
php artisan key:generate
php artisan migrate --seed
npm run build
```
### 4. Get Started

To start the application, run the following command:

```bash
php artisan serve
```

This will start a local development server at `http://localhost:8000`.

### 5. Enjoy the application!

[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#-notes)

## ➤ 📝 Notes

This project is developed using the <a href="https://laravel.com/">Laravel framework</a> and is designed to be used as a learning tool. It is not intended for production use and should be used for educational purposes only.



[![-----------------------------------------------------](https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/colored.png)](#-authors)

## ➤ 👨🏻‍💻 Authors

<a href="https://github.com/AndrewCostant">Andrea</a> – Engineering student <br>
<a href="https://github.com/lucucinelli">Ludovica</a> – Engineering student <br>
