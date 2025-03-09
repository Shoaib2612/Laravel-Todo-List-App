## Todo App 
Deployed Version : http://3.111.47.238/login

##  Overview

Todo App is a simple task management application built with Laravel, Tailwind CSS and Bootstrap. It allows users to add, update, and delete tasks efficiently.

##  Features

User authentication (login/logout)
Add, update, and delete tasks
Responsive UI using Bootstrap


##  Installation and Setup

#   Prerequisites

Make sure you have the following installed:

PHP (>=8.0)
Composer
Node.js & npm
MySQL or SQLite
Git

#   Clone the Repository

git clone https://github.com/Shoaib2612/Laravel-Todo-List-App.git
cd todo-app

#   Install Dependencies

composer install  
npm install
Set Up Environment Variables
Copy the .env.example file to .env:
cp .env.example .env
Generate an application key:
php artisan key:generate
Configure Database
Update your .env file with your database credentials. Then, run migrations:
php artisan migrate
Run the Application
Start the local development server:
php artisan serve
Now, visit http://127.0.0.1:8000 in your browser.
