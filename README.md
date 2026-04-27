# Salon Management System

A comprehensive Laravel-based web application for managing customers, salon/nail services, appointments, and payments.

## Features

- **Authentication** - Laravel Breeze login/logout with session handling
- **Service Management** - Full CRUD for salon/nail services with pricing
- **Appointment Booking** - Create, view, edit, and cancel bookings
- **Payment Processing** - Record payments with multiple methods (cash, card, transfer, e-wallet)
- **Dashboard** - Real-time statistics and recent activity
- **Responsive UI** - Tailwind CSS with dark mode support

## Modules

### Services
- Create, read, update, delete salon services
- Track service name, price, duration, description

### Appointments
- Book appointments with customer details
- Select services and schedule date/time
- Track appointment status (confirmed, completed, cancelled)
- View related payments

### Payments
- Record payments for appointments
- Multiple payment methods: cash, credit_card, debit_card, bank_transfer, e_wallet
- Track payment status: pending, paid, failed, refunded
- Transaction ID tracking

## Installation

### Using Docker (Recommended)

```bash
# Build and run
docker build -t laravel-salon .
docker run -d -p 8000:10000 \
  -e DB_CONNECTION=mysql \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3306 \
  -e DB_DATABASE=salon \
  -e DB_USERNAME=root \
  -e DB_PASSWORD= \
  laravel-salon
```

### Manual Installation

```bash
# Install dependencies
composer install
npm install && npm run build

# Setup database
cp .env.example .env
php artisan key:generate
# Configure database in .env

# Run migrations and seed sample data
php artisan migrate
php artisan db:seed

# Start dev server
php artisan serve
```

## Sample Data

The seeders populate:
- 10 Salon services (manicures, pedicures, gel polish, extensions, etc.)
- 35 Appointments (various statuses)
- 20 Payments (various methods and statuses)

## Access

- URL: http://localhost:8000
- Email: test@example.com
- Password: password

## Tech Stack

- Laravel 12
- PHP 8.4
- MySQL
- Tailwind CSS
- Alpine.js
- Vite
- Docker

## Docker

See [Dockerfile](Dockerfile) for container configuration.
- Port: 10000
- Document root: `/var/www/html/public`
- PHP extensions: pdo, pdo_mysql, pdo_pgsql, zip, mbstring, xml

## License

MIT
