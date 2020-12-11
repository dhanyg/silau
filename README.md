# SILAU (Sistem Manajemen Laundry)

## What is SILAU?

SILAU merupakan aplikasi manajemen laundry yang dibuat menggunakan codeigniter 4.  
  
## Fitur  
- Manajemen level (role), user, menu, submenu, dan hak akses menu.
- Manajemen transaksi masuk, pengambilan, pemasukan, dan pengeluaran.
- 3 level (role) default: administrator, user, owner. Setiap level memiliki hak akses ke menu yang berbeda-beda dan bisa disesuaikan melalui menu Tools > Access.
- Auto insert saldo pemasukan apabila terdapat transaksi pengambilan.
- Pencarian data sederhana (belum menggunakan datatables)
- Cetak invoice ke PDF
- Cetak laporan ke PDF

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
   
 Untuk proses deveopment, ubah environment menjadi development:  
 `CI_ENVIRONMENT = development`  
   
 Migrasi database  
 `php spark migrate`  
   
 Seed database  
 `php spark db:seed LaundrySeeder`  
   
 Jalankan server  
 `php spark serve`  
   
 Akses url melalui web browser  
   
- username: admin | op | owner  
- password: admin | 1234 | 1234  
