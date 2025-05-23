SkillBridge Laravel Application
This Laravel application supports role-based authentication using Jetstream. 
It includes two user roles: Admin and Student. Admin users are seeded by default, while students can register themselves.

Authentication via Laravel Jetstream (Livewire)

Role-based access for Admin and Student

Default Admin user seeded via migration

Student registration enabled

Email configuration using Gmail SMTP

Stripe integration setup

Queue system using database driver

Installation Instructions
1. Clone the Repository

git clone https://github.com/Srikanth-Palnati/skill-bridge
cd skillbridge
2. Install Dependencies


composer update
npm install && npm run dev

3. Set Up Environment
Create a .env file and update with the following values:



DB_DATABASE=skillbridge

MAIL_USERNAME=skillbridge@gmail.com
MAIL_PASSWORD=opia fafs rwed dfsf
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=skillbridge@gmail.com
MAIL_FROM_NAME=skillbridge
MAIL_SERVICE_PROVIDER=Google

QUEUE_CONNECTION=database

STRIPE_SECRET = "sk_test_***your_key***"
Ensure you’ve set up your database (skillbridge) and have correct DB credentials.

4. Run Migrations

php artisan migrate
This will also seed a default admin user.

Default Admin Login
Email: admin@user.com

Password: admin123

Admin is created automatically when migrations are run.

Student Features
Students can register themselves from the registration page.

After registering, they can log in and access student-specific functionality.

Additional Notes
To test email functionality, ensure "Allow less secure apps" is enabled in the Gmail settings (if using a real Gmail account).

Make sure QUEUE_CONNECTION=database is set, and run:

php artisan queue:work