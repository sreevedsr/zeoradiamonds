# Zeora Diamonds - Certificate Management Platform

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About The Project

Zeora Diamonds is a web application built with Laravel 12 designed for the comprehensive management of diamond certificates. It provides distinct, role-based portals for administrators and merchants to manage inventory, customers, and suppliers. The system also exposes a secure API for a buyer-facing mobile application (built with Flutter).

The application is built with a modern tech stack, prioritizing a clean user interface and a robust, testable backend.

### Key Features

**Admin Panel:**
*   **Dashboard:** An overview of key application metrics.
*   **Merchant Management:** Full CRUD (Create, Read, Update, Delete) functionality for merchants.
*   **Supplier Management:** Full CRUD for product and material suppliers.
*   **Staff Management:** Onboard and manage internal staff members.
*   **Diamond Certificate (Card) Management:** Create, edit, and delete detailed diamond certificates, including image uploads.
*   **Inventory Assignment:** Assign diamond certificates from the central inventory to specific merchants.
*   **Rate Management:** A dedicated interface to set and update daily gold and diamond rates.

**Merchant Portal:**
*   **Dashboard:** A personalized view of the merchant's sales and customer metrics.
*   **Customer Management:** Full CRUD for the merchant's own customer base.
*   **Certificate Assignment:** Assign diamond certificates to customers, with the ability to set selling prices and discounts.
*   **Marketplace (In Progress):** Functionality for merchants to request new certificate stock from the admin's central inventory.

**Buyer API (for Mobile App):**
*   **Authentication:** Secure, token-based user registration and login endpoints using Laravel Sanctum.
*   **View Certificates:** A protected endpoint for authenticated buyers to view the details of diamond certificates that have been assigned to them.

### Tech Stack

*   **Backend:** PHP 8.2, Laravel 12
*   **Frontend:** Vite, Tailwind CSS, Alpine.js
*   **Database:** MySQL
*   **Testing:** PHPUnit

---

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   A MySQL database server

### Installation

1.  **Clone the repository:**
    ```sh
    git clone https://github.com/your-username/zeora-diamonds.git
    cd zeora-diamonds
    ```

2.  **Install PHP dependencies:**
    ```sh
    composer install
    ```

3.  **Set up your environment file:**
    ```sh
    cp .env.example .env
    ```

4.  **Generate an application key:**
    ```sh
    php artisan key:generate
    ```

5.  **Configure your `.env` file:**
    Create a new database in your MySQL server. Then, update the `DB_*` variables in your `.env` file to connect to it. For example:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=zeora_diamonds
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Run the database migrations and seeders:**
    ```sh
    php artisan migrate --seed
    ```

7.  **Install front-end dependencies:**
    ```sh
    npm install
    ```

8.  **Build the front-end assets:**
    ```sh
    npm run build
    ```

### Running the Application

This project includes a convenient script to run the development server, queue worker, and Vite server concurrently.

```sh
composer run dev
You can then access the application at http://127.0.0.1:8000 or the URL provided by the php artisan serve command.
Running Tests
To run the full suite of PHPUnit tests for the application, use the following command:
code
Sh
composer test
API Endpoints for Buyer App
The following API endpoints are available for the mobile (Flutter) application.
Method	Endpoint	Description	Authentication
POST	/api/register	Register a new buyer account.	Public
POST	/api/login	Log in a buyer and receive an API token.	Public
GET	/api/cards	Get a list of cards assigned to the buyer.	Sanctum Token
POST	/api/logout	Log out the buyer and invalidate the token.	Sanctum Token
License
The Zeora Diamonds application is open-sourced software licensed under the MIT license.
