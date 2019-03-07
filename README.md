# Getting Started
### 1. Get the codebase
```sh
git clone https://github.com/ngjunxiang/IoT-T7.git
```

### 2. Install dependencies
```sh
cd IoT-T7
composer install
```

### 3. Environment Variables
Laravel make use of environment variables to communicate with the database, send emails etc.
```sh
cd IoT-T7
cp .env.example .env
```

### 4. Generate new application key
The application key is used to encrypt data, such as sessions. This step must be executed first before seeding the database as all passwords saved with Hash::make() will no longer be valid once you execute this command.
```sh
php artisan key:generate
```

### 5. Rebuild, Migrate & Seed
Clear current compiled files, update the classes it needs and then write them back out. This step also creates the required tables and seed them with basic sample data.
```sh
composer dump-autoload
php artisan clear-compiled
php artisan migrate:fresh --seed
```

# Linux Commands
Restart apache
```sh
sudo service httpd restart
```

Restart mysql
```sh
sudo service mysqld restart
```

# Branch Policy
We follow the Github Flow when developing the application, and name our branches as follow:
- ```master``` is the active development branch

Local development branch naming:

- ```feature/<your-branch-name>``` for substantial new feature or function
- ```enhance/<your-branch-name>``` for minor feature or function enhancement
- ```bugfix/<your-branch-name>``` for bug fixes

### How to branch?
- Create a new branch: ```git checkout -b <bugfix/your-branch-name>```
- Switch branch: ```git checkout master``` or ```git checkout <bugfix/your-branch-name>```
- Pushing to branch: 
-- ```git add . ```
-- ``` git commit -m "Your message"```
-- ``` git push ```
- Set upstream: ``` git branch --set-upstream-to origin/master ```
- Rebase: ``` git rebase master ```
