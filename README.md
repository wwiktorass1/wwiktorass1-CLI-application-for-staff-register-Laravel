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

1. **Clone the repository:**
   ```bash
   git clone https://github.com/wwiktorass1/wwiktorass1-CLI-application-for-staff-register-Laravel.git
   cd wwiktorass1-CLI-application-for-staff-register-Laravel

2. **Install dependencies:**
   ```bash
   composer install

3. **Clone the repository:**
* Copy the .env.example file and create a .env file:
   ```bash
   cp .env.example .env

* Update the .env file with your database credentials.

* 4. **Generate the application key:**
   ```bash
   php artisan key:generate

* 5. **Run migrations to set up the database:**
   ```bash
   php artisan migrate

# Usage
## Register a New Staff Member
### To register a new staff member interactively:

   ```bash
   php artisan staff:register

## Import Staff from a CSV File

### Ensure the CSV file has a valid structure:

```csv 
firstname,lastname,email,phonenumber1,phonenumber2,comment
Jonas,Jonaitis,jonas@example.com,+37061234567,+37061234568,Vadybininkas
Petras,Petraitis,petras@example.com,+37061234569,+37061234570,Programuotojas

### Run the command:
   ```bash
   php artisan staff:import {file}

 Replace {file} with the path to your CSV file.

## Find Staff
Search for a staff member by name or email:

   ```bash
   php artisan staff:find {query}

Replace {query} with the search term. Use % to display all staff records.

## Delete Staff

### Delete a staff member by email:

   ```bash
  php artisan staff:delete {email}

### Replace {email} with the staff member’s email.

## Testing

   ```bash
   php artisan test

or
   ```bash
   ./vendor/bin/phpunit




