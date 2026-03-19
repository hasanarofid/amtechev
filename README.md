# Amtech EV Management System

A premium, role-based EV charging management platform featuring glassmorphism UI, real-time statistics, and seamless customer interactions.

## Features

- **Dynamic Landing Page**: High-end "EV-Premium" aesthetic with real-time stats.
- **Role-Based Access**: Specialized portals for Admins, Staff, and Customers.
- **Customer Dashboard**: Personalized installation tracking and session history.
- **Maintenance Schedule**: Interactive schedule for EV technician visits.
- **Charger Management**: Automated tracking and status monitoring.

## Technology Stack

- **Framework**: Laravel 12
- **Styling**: Tailwind CSS & Custom Vanilla CSS (EV Premium Glassmorphism)
- **Database**: MySQL / SQLite
- **Frontend**: Blade Templating

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM

### Installation

1. Clone the repository:
   ```bash
   git clone git@github.com:hasanarofid/amtechev.git
   cd amtechev
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Database migration & seeding:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. Run the development server:
   ```bash
   php artisan serve
   npm run dev
   ```

## Developer Contacts

- **Email**: [hasanarofid@gmail.com](mailto:hasanarofid@gmail.com)
- **Website**: [hasanarofid.site](https://hasanarofid.site)

## License

The Amtech EV System is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
