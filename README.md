# SILAU (Sistem Manajemen Laundry)

## What is SILAU?

SILAU merupakan aplikasi manajemen laundry yang dibuat menggunakan codeigniter 4.  
  
## Requirements

- Cek requirement [codeigniter 4](https://codeigniter.com/user_guide/intro/requirements.html)
- [Composer](https://getcomposer.org/download/)

## Installation

Clone repository:  
`git clone https://github.com/dhanyg/silau.git`  
  
Masuk folder silau:  
`cd silau`  
  
Kemudian lakukan composer install:  
`composer install`  
  
## Setup

Copy file `env` menjadi `.env`, kemudian ubah konfigurasi file `.env` pada bagian berikut:  
`app.baseURL = 'http://localhost:8080'`  
...  
`database.default.hostname = your_hostname`  
`database.default.database = your_database_name`  
`database.default.username = your_database_username`  
`database.default.password = your_database_password`  
`database.default.DBDriver = MySQLi`  
   
 Migrasi database  
 `php spark migrate`  
   
 Seed database  
 `php spark db:seed LaundrySeeder`  
   
 Jalankan server  
 `php spark serve`  
   
 Akses url melalui web browser  
