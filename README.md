## Requirements

- PHP 8.1+
- Composer
- MySQL 

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/jekanito/punch-agency-test-task.git
   cd punch-agency-test-task
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install JavaScript dependencies:
   ```
   npm install
   ```

4. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```
   cp .env.example .env
   ```
   Make sure to set `TELEGRAM_USER_ID`, `TELEGRAM_BOT_TOKEN` and `GOOGLE_SHEET_SPREADSHEET_ID` in your `.env` file.

5. Generate an application key:
   ```
   php artisan key:generate
   ```

6. Run database migrations:
   ```
   php artisan migrate
   ```

7Start the development server:
   ```
   php artisan serve
   ```

## Environment Variables

Make sure to set the following environment variables in your `.env` file:

```
TELEGRAM_USER_ID=5762496344
TELEGRAM_BOT_TOKEN=7977665822:AAEBQkJ-EJFqSFhCavSZJksTe4fLUmp-F0I

GOOGLE_SHEET_SPREADSHEET_ID=1_kYGPsSneBWLXWEQ3dNgtTt9Pj9I21tqWiyUz-uL2uo
```

Google sheet - https://docs.google.com/spreadsheets/d/1_kYGPsSneBWLXWEQ3dNgtTt9Pj9I21tqWiyUz-uL2uo
Telegram bot - @PunchAgencyTestBot
