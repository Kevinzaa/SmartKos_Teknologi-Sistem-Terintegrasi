# Tugas 2 II3160 Teknologi Sistem Terintegrasi : Mengembangkan layanan microservices (SMARTKOS)
Tugas ini bertujuan untuk mengembangkan layanan inti yang sudah dirancang pada tugas 1 dengan menggunakan Framework CodeIgniter4 dan XAMPP

SmartKos adalah aplikasi berbasis web yang dirancang untuk membantu pengguna dalam melaporkan dan mengelola permasalahan di lingkungan kost secara efisien. Aplikasi ini menyediakan fitur seperti pelaporan masalah, pelacakan status laporan, dan statistik laporan.

Oleh : 
Muhammad Kevinza Faiz (18222072)

Rekan : 
Taufiq Ramadhan Ahmad (18222060)

---

## Link Web dan Dokumentasi
Smartkos : https://cornflowerblue-wolverine-266402.hostingersite.com/

Dokumentasi : https://drive.google.com/file/d/1kr0rUNdUlmB1s4sN6s9vDqz9bupWheC_/view?usp=sharing

---

## Teknologi yang digunakan

- **Frontend**:
  - HTML, CSS, JavaScript

- **Backend**:
  - [CodeIgniter 4](https://codeigniter.com/)

- **Database**:
  - MySQL (hosted on AivenCloud)

- **Hosting**:
  - Deployed on Hostinger

---

## Installation and Setup

### Prerequisites

- PHP 7.4 or later
- XAMPP for Apache and MySQL

### Local Setup

1. Clone the repository:
    ```bash
    git clone https://github.com/Kevinzaa/SmartKos_Teknologi-Sistem-Terintegrasi.git
    cd SmartKos_Teknologi-Sistem-Terintegrasi
    ```


2. Configure the environment variables:
    - Make `.env` in the root folder.
    - Paste code below:
      ```env
      CI_ENVIRONMENT = development
      app.baseURL = 'http://localhost:8080/'

      database.default.hostname = sql310.iceiy.com
      database.default.database = icei_38055647_smartkos
      database.default.username = icei_38055647
      database.default.password = tyQsLnbMUAal
      database.default.DBDriver = MySQLi
      database.default.DBPrefix =
      ```

4. Start the development server:
    ```bash
    php spark serve
    ```

6. Access the application at `http://localhost:8080`.

---
