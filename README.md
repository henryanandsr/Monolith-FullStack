# Monolith Fullstack

## :writing_hand: Authors
| Nama                  | NIM      |
| --------------------- | -------- |
| Henry Anand Septian Radityo | 13521004 |

## :running_man: How to run the program
### Local
1. `php artisan serve` or `docker-compose up --build` -> `docker-compose exec php php artisan migrate`
### Deployments
1. Already ran at `https://merciful-nose-production.up.railway.app`

## :books: Design Pattern
1. Dependency Injection
Merupakan metode memisahkan dependencies (misalnya objek) ke dalam suatu kelas sehingga memungkinkan untuk de-coupling dan membuat kode lebih mudah dimaintain, hal ini diimplementasikan bersamaan dengan implementasi repository pattern.
2. Repository Pattern
Pola repository adalah sebuah pola desain yang digunakan untuk memisahkan algoritma logika dari manipulasi basis data. Dengan menggunakan pola ini, ketergantungan antara data dan logika bisnis dapat diurutkan sehingga memudahkan pemeliharaan data.
3. MVC Pattern
Pola Model-View-Controller (MVC) membantu mengorganisir kode dengan memisahkannya berdasarkan tugasnya masing-masing. Model digunakan untuk mengelola data dan logika bisnis, view untuk tampilan antarmuka, dan controller untuk mengatur interaksi antara keduanya.

## :wrench: Tech Stack
PHP, blade, laravel, HTML, CSS, Tailwind CSS, PostgreSQL.

## :purple_circle: Endpoint
/register
/login
/katalog-barang
/barang/:id 
/beli/:id
/orders
/riwayat-pembelian

## :white_check_mark:	Bonus
1. Deployment
