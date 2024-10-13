# Project Title

Simple employee task management system.


## Perquisites
- PHP version +8.1
- Composer installed
- Mysql server
- Git 

## getting started steps

To deploy this project run

1- Clone the project for github 
```bash
git clone https://github.com/ahmedabdelaziz11/task-management.git
```
2. Move to the project folder 
        
```bash
cd task-management
```

3. Run Composer install in the project folder

```bash
composer install
```

4. Copy .env.example file in the project folder

```bash
cp .env.example .env
```
5. open mysql server
> create database with any name then edit the following in your .env file

```env
DB_DATABASE=database_name
DB_USERNAME=user_name
DB_PASSWORD=password
```

6. Run the following commands in same sequence

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

7. open open the following link

<http://localhost:8000>

## Manager Account 
email : ahmeddev101@gmail.com 
password : password

