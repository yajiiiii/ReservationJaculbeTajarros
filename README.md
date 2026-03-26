# Pahinga - Hotel Reservation System

A full-stack hotel reservation system built with PHP, MySQL (PDO), and Tailwind CSS.

**By: Ijay Jaculbe & Zedrick Tajarros**

---

## Tech Stack

- **Backend:** PHP 8+ with PDO (MySQL)
- **Database:** MySQL 8
- **Frontend:** HTML5, Tailwind CSS (CDN), Vanilla JavaScript
- **Font:** Poppins (Google Fonts)
- **Server:** Laragon (Apache + MySQL)

## Features

### Guest-Facing
- **Home Page** — Hero section with search, popular rooms, booking process timeline
- **Rooms Page** — Browse Regular, Deluxe, and Suite rooms with filtering
- **Reservation Page** — Book a room with date selection, customer info, and payment type
- **About Page** — Hotel story, core values, and leadership team
- **Form Validation** — Real-time validation with detailed error messages
- **Success UI** — Styled confirmation modal after successful booking

### Admin Panel (`?page=admin`)
- **Dashboard** — Stats overview (total rooms, available rooms, reservations, revenue)
- **Rooms Management** — Full CRUD (Create, Read, Update, Delete) for all rooms
- **Reservations Management** — View, create, update status, and delete reservations
- **Filters & Search** — Filter by room type, reservation status, or search by keyword

### Database
- **PDO Connection** — Singleton pattern with prepared statements (SQL injection safe)
- **Rooms Table** — 24 seeded rooms (8 Regular, 8 Deluxe, 8 Suite)
- **Reservations Table** — Stores all bookings with billing calculations

### Billing Logic
- **Room Pricing:**
  - Regular: Single (P100), Double (P200), Family (P500)
  - Deluxe: Single (P300), Double (P500), Family (P750)
  - Suite: Single (P500), Double (P800), Family (P1,000)
- **Discounts (Cash only):**
  - 3-5 nights: 10% discount
  - 6+ nights: 15% discount
- **Surcharges:**
  - Cheque: +5%
  - Credit Card: +10%

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/Tajarros-Zed/ReservationJaculbeTajarros.git
```

### 2. Place in Laragon Web Root
```
C:\laragon\www\ReservationJaculbeTajarros\
```

### 3. Import the Database
Option A — Import the full dump (includes existing reservation data):
```bash
mysql -u root < database/pahinga_db_dump.sql
```

Option B — Import clean schema with seeded rooms only:
```bash
mysql -u root < database/pahinga.sql
```

Or use HeidiSQL (Laragon > Database): open either SQL file and run it.

### 4. Access the Site
- **Home:** http://localhost/ReservationJaculbeTajarros/
- **Admin:** http://localhost/ReservationJaculbeTajarros/?page=admin

## Project Structure

```
ReservationJaculbeTajarros/
├── admin/
│   ├── api.php              # Admin CRUD API endpoints
│   └── admin.js             # Admin panel JavaScript
├── assets/
│   ├── banner/              # Leadership photos
│   ├── regular/             # Regular room images
│   ├── deluxe/              # Deluxe room images
│   ├── suite/               # Suite room images
│   └── popular/             # Featured room images
├── constant/
│   └── constant.php         # Room pricing & calculation logic
├── database/
│   ├── Database.php         # PDO singleton connection class
│   ├── pahinga.sql           # Clean schema + seed data
│   └── pahinga_db_dump.sql   # Full database dump with current data
├── pages/
│   ├── admin/Admin.php      # Admin panel (Dashboard, Rooms, Reservations)
│   ├── home/Home.php        # Home page
│   ├── about/About.php      # About page
│   ├── rooms/Rooms.php      # Rooms listing page
│   └── reservation/         # Reservation booking page
├── shared/                  # Reusable components (Navbar, Footer, Menu)
├── styles/app.css           # Global styles & animations
├── utils/
│   ├── interactive.js       # Reservation form logic & validation
│   ├── save_reservation.php # Save booking to database
│   └── mailer.php           # Email utility (optional)
└── index.php                # Main router
```

## Database Configuration

Default connection (Laragon):
- **Host:** localhost
- **Database:** pahinga_db
- **Username:** root
- **Password:** (empty)

To change, edit `database/Database.php`.
