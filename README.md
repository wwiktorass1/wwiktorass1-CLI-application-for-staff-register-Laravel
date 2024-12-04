# CLI Application for Staff Register in Laravel

This is a Laravel-based Command-Line Interface (CLI) application designed to manage staff information efficiently. It provides functionality to import, register, find, and delete staff records via custom artisan commands.

## Features

- **Register New Staff:** Add a new staff member interactively using `php artisan staff:register`.
- **Import Staff from CSV:** Batch import staff data from a CSV file using `php artisan staff:import {file}`.
- **Find Staff:** Search for staff records by name or email using `php artisan staff:find {query}`.
- **Delete Staff:** Remove a staff member from the database using `php artisan staff:delete {email}`.
- **View Staff List:** Use `php artisan staff:find "%"`, to display all staff records in a table format.

## Requirements

- **PHP**: 8.0 or higher
- **Laravel**: 10.x
- **Database**: MySQL or compatible
- **Composer**: Latest version
- **Git**: For version control
- **Node.js**: For optional frontend (if applicable)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/wwiktorass1/wwiktorass1-CLI-application-for-staff-register-Laravel.git
   cd wwiktorass1-CLI-application-for-staff-register-Laravel
