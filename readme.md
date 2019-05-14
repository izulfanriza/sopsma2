SISTEM INFORMASI PENCATATAN DAN PENGELOLAAN PEMBAYARAN SUMBANGAN OPERASIONAL PENDIDIKAN (SOP) BERBASIS WEB DI SMA NEGERI 2 TEGAL
--------------------------------------------------------------------------------------------------------------------------------
## Dev with:
Framework Laravel versi 5.4.36
PHP versi 7.0.24
XAMPP versi 3.2.2

How to Install :
1. Clone this repository with git command on your working directory (C:\xampp\htdocs on xampp or C:\laragon\www on laragon): git clone https://github.com/izulfanriza/sopsma2.git
2. Create your DATABASE
3 Edit the .env.example file. Change the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME and DB_PASSWORD parameter as your database configuration, and Save the file as .env
4. Import sopsma2.sql to your DATABASE
5. Install the dependencies with command-> composer install
6. Generate a random key with artisan command-> php artisan key:generate
7. Install Maatwebsite with artisan command-> composer require "maatwebsite/excel":"~2.1.0"

## Notes :
1. E-mail: cahyono@gmail.com
2. Password: cahyonosuperadmin123

## How to Active Email Notification :
1. Open curl-ca-bundle.crt file in sopsma2\xampp\apache\bin to your server in \apache\bin\
2. Open and Edit this file sopsma2\resources\views\transaksi => proses.blade.php
3. Setting based on this instruction =>
https://stackoverflow.com/questions/42558903/expected-response-code-250-but-got-code-535-with-message-535-5-7-8-username