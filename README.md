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
2. Responsive Layout
3. Lighthouse
4. Search Feature

## :bulb: Lighthouse screenshot
<img width="960" alt="katalog" src="https://github.com/henryanandsr/SingleService-Labpro/assets/39207406/e902e5b3-0920-4191-98ec-3c90649ba3da">
<img width="960" alt="home" src = "https://github.com/henryanandsr/SingleService-Labpro/assets/39207406/bfc772f6-de3c-4c42-937f-ca06c6da576f">
<img width="960" alt="login" src = "https://github.com/henryanandsr/SingleService-Labpro/assets/39207406/32938456-1b32-4977-b262-3c106dd771a3">
<img width="960" alt="register" src = "https://github.com/henryanandsr/SingleService-Labpro/assets/39207406/ba5c7fb9-25e0-4ad8-8080-1b82beecccb5">
<img width="960" alt="detailbarang" src="https://github.com/henryanandsr/SingleService-Labpro/assets/39207406/73c45a41-a0f6-4b53-baae-d1644af1544e">
<img width="959" alt="beli" src="https://github.com/henryanandsr/SingleService-Labpro/assets/39207406/3af3ad48-7f03-423c-9bc0-91c7f09f55ea">
