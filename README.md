# Web-Based Expert System for Diabetes Detection

A PHP-based web application that helps users assess diabetes-related conditions using symptom selection and a **Bayesian-style inference** engine. The system stores expert knowledge (symptoms, diseases, symptom–disease weights) in a MySQL/MariaDB database and presents likely conditions with suggested management steps.

> **Disclaimer:** This tool is for educational and informational purposes only. It does **not** replace professional medical diagnosis or treatment. Always consult a qualified healthcare provider.

---

## Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [How to Use](#how-to-use)
- [User Roles](#user-roles)
- [Project Structure (overview)](#project-structure-overview)
- [Database](#database)
- [Security Notes](#security-notes)
- [Troubleshooting](#troubleshooting)

---

## Features

### Public website

- **Landing page** (`index.php`) with project information and a link to the login area.
- Short usage instructions (register, start consultation, view results).

### Account & access

- **Login** (`spadmin/index.php`) with role-based redirection.
- **Self-registration** (`spadmin/ayodaftar/`) for new **User** accounts (name, username, password, address).

### Patient (User) area

- **Dashboard** with an overview after login.
- **Diagnosis (symptom selection)** (`User/diagnosapilihan.php`): select one or more symptoms from the master list (checkboxes).
- **Bayesian calculation & result** (`User/detail.php`):  
  - Shows selected symptoms.  
  - Computes **disease probabilities** using stored weights (`relasi` + `penyakit` tables).  
  - Displays **conclusion**: disease code, name, percentage, and **recommended solution / management** text.  
  - **Save diagnosis** to history (`riwayat`).  
  - **Print** report (`cetak2.php`).
- **Diagnosis history** (`User/riwayat.php`): past consultations.
- **Logout**.

### Administrator area

- **Dashboard** with counts (e.g. symptoms, diseases).
- **Master data**  
  - **Symptoms** (`gejala`)  
  - **Diseases** (`penyakit`) including solution text  
  - **Rules / relations** (`relasi`) — symptom–disease probability weights used in inference  
- **Diagnosis history** (all users).
- **Admin accounts** and **patient (user) data** management.
- **Reports** (e.g. `cetak_laporan.php`).

### Inference method (main flow)

The primary consultation path uses **symptom–disease relations** and **disease priors** from the database (`relasi`, `penyakit`), with a **Bayesian-style** calculation in `User/detail.php` (labeled “Perhitungan bayes” in the UI). Example disease categories in the bundled dataset include **Gestational Diabetes Mellitus** and **Pregestational Diabetes** (see `pakar_diabetes.sql`).

---

## Technology Stack

| Layer        | Technology                          |
|-------------|--------------------------------------|
| Backend     | PHP (procedural)                     |
| Database    | MySQL / MariaDB                      |
| Frontend UI | Bootstrap, NiceAdmin-style templates |

---

## Prerequisites

- **Web server** with PHP support (e.g. **XAMPP**, **WAMP**, **Laragon**, or Linux `apache2` + `php` + `mysql`).
- **PHP** with **mysqli** extension enabled.
- **MySQL** or **MariaDB** server.

---

## Installation

1. **Copy the project** into your web root, for example:  
   - XAMPP: `C:\xampp\htdocs\Web-Based-System-for-Diabetes-Detection-main`  
   - Or your Apache `DocumentRoot`.

2. **Create the database**  
   - Open phpMyAdmin (or MySQL CLI) and create a database named `pakar_diabetes` (or import the file and the name will be created automatically).

3. **Import the schema and data**  
   - Import:  
     `pakar_diabetes.sql`  
   - If you use `spadmin/ayodaftar/tb_user.sql`, import it only if your project requires that extra table (optional; main app uses `admin` table).

4. **Start services**  
   - Start **Apache** and **MySQL** from your stack (e.g. XAMPP Control Panel).

5. **Open the app in a browser**  
   - Example: `http://localhost/Web-Based-System-for-Diabetes-Detection-main/`  
   - Login page: `http://localhost/Web-Based-System-for-Diabetes-Detection-main/spadmin/index.php`

---

## Configuration

Database settings are defined in:

- `spadmin/koneksi.php`
- `spadmin/conn.php`
- `spadmin/User/koneksi.php` (if present)
- `spadmin/ayodaftar/koneksi.php`

Default values:

```php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pakar_diabetes";
```

Change **host**, **username**, **password**, and **database name** to match your environment.

---

## How to Use

### For new patients (users)

1. Open the **login** page: `spadmin/index.php`.
2. Click **Create an account** / registration link and go to `spadmin/ayodaftar/index.php`.
3. Fill in the required fields (e.g. ID, name, username, password, address) and submit.
4. Log in with your **username** and **password**.
5. In the sidebar, open **Diagnosa** (`diagnosapilihan.php`).
6. Tick the symptoms that apply to you, then click **Submit Diagnosa**.
7. Review the **Bayesian calculation** table and the **final conclusion** (disease, percentage, solution).
8. Optionally click **Simpan diagnosa** to save the result to **riwayat** (history), or **Cetak** to print.
9. Use **riwayat diagnosa** to view past records.

### For administrators

1. Log in with an **Admin** account (see sample data below after import).
2. Use **Data master** to maintain **symptoms**, **diseases**, and **rules** (`relasi` weights).  
   Accurate rules improve inference quality.
3. Monitor **riwayat diagnosa**, **data pasien**, and **data admin** as needed.
4. Use report/print features where available.

---

## User Roles

| Role    | Typical access |
|--------|----------------|
| **Admin**  | Full master data, users, patients, diagnosis history, reports. |
| **User**   | Patient dashboard, diagnosis, own history, print. |
| **Dokter** | Login redirects to `Dokter/index.php` — ensure that folder exists and is deployed if you use this role. |

---

## Project Structure (overview)

```
Web-Based-System-for-Diabetes-Detection-main/
├── index.php                 # Public landing page
├── pakar_diabetes.sql        # Database dump (import this)
├── spadmin/
│   ├── index.php             # Login
│   ├── proseslogin.php       # Login handler
│   ├── koneksi.php, conn.php # DB connection
│   ├── ayodaftar/            # User registration
│   ├── admin/                # Admin panel
│   └── User/                 # Patient panel (diagnosis, history, print)
```

---

## Database

Main tables (from `pakar_diabetes.sql`):

- **`admin`** — User accounts (`level`: Admin, User, Dokter).
- **`gejala`** — Symptom catalog (`kd_gejala`, description).
- **`penyakit`** — Disease catalog, **solution** text, **bobot** (weight).
- **`relasi`** — Links symptoms to diseases with **nilai** (probability-like weights for inference).
- **`riwayat`** — Saved diagnosis results per user.
- **`diagnosa`** — Used by some diagnostic screens (legacy / alternate flows).

---

## Security Notes

- The sample SQL dump includes **plain-text passwords** (e.g. default admin). **Change all passwords** before any production use.
- Prefer **password hashing** (e.g. `password_hash` / `password_verify`) and **prepared statements** for all SQL; the current codebase is oriented toward learning/demo use.
- Restrict database user privileges and keep the server updated.

---

## Troubleshooting

- **Cannot connect to database** — Check MySQL is running, database name matches `pakar_diabetes`, and credentials in `koneksi.php` / `conn.php` are correct.
- **Blank page or PHP errors** — Enable error display in `php.ini` temporarily (`display_errors`) or check Apache/PHP error logs.
- **“Dokter” login fails or 404** — The `Dokter/` application path may be missing; add it or use Admin/User roles only.
- **Some diagnosis pages** (e.g. chained `diagnosa.php` → `diagnosa2.php`) may depend on files not included in this repo; the **recommended** flow is **Diagnosa** (`diagnosapilihan.php`) → **detail.php**.

---

## Deploy ke Vercel + Aiven MySQL

### 1. Siapkan database di Aiven
1. Buka https://console.aiven.io/
2. Buat project baru dan service MySQL.
3. Catat detail koneksi: host, port, username, password, dan nama database.
4. Aktifkan akses dari luar dengan menambahkan IP `0.0.0.0/0` pada allowlist.

### 2. Impor database
1. Buka Aiven Console atau tool MySQL client.
2. Import file `pakar_diabetes.sql`.

### 3. Set environment variables di Vercel
Di Vercel Project > Settings > Environment Variables, tambahkan:
- `DB_HOST`
- `DB_PORT`
- `DB_USER`
- `DB_PASS`
- `DB_NAME`

Contoh:
- `DB_HOST` = host MySQL Aiven Anda
- `DB_PORT` = port MySQL Aiven Anda
- `DB_USER` = username MySQL Anda
- `DB_PASS` = password MySQL Anda
- `DB_NAME` = nama database Anda

### 4. Deploy ke Vercel
1. Push project ke GitHub.
2. Buka https://vercel.com dan import repository.
3. Pilih folder proyek.
4. Deploy.

### 5. Catatan penting
- Karena aplikasi ini adalah PHP, Vercel bukan pilihan terbaik untuk semua fitur PHP. Jika deployment gagal, gunakan hosting yang mendukung PHP penuh seperti cPanel, Hostinger, InfinityFree, atau Railway dengan PHP.
- Jika Aiven menolak koneksi, periksa host, port, username, password, dan allowlist IP.

---

## License & credits

- UI templates may include third-party themes (e.g. BootstrapMade **Butterfly**, **NiceAdmin**). Respect their licenses when redistributing.
- This README describes the repository as bundled; adjust URLs and paths if you rename the project folder.

---

*Last updated to match the project layout and main diagnosis flow (`diagnosapilihan.php` → `detail.php`).*
