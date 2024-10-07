<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Change from " " to ""
define('DB_NAME', 'project_ideas_db');

// Website configuration
define('SITE_NAME', 'Project Ideas Hub');
define('SITE_URL', 'http://localhost/cursor-tutor/'); // Replace with your actual domain

// Email configuration (for password reset, notifications, etc.)
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your_email@example.com');
define('SMTP_PASSWORD', 'your_email_password');
define('SMTP_FROM_EMAIL', 'noreply@yourdomain.com');
define('SMTP_FROM_NAME', 'Project Ideas Hub');

// Security configuration
define('SALT', 'your_unique_salt_string'); // Used for password hashing
define('SESSION_TIMEOUT', 1800); // Session timeout in seconds (30 minutes)

// File upload configuration
define('MAX_FILE_SIZE', 5000000); // Maximum file size in bytes (5MB)
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'pdf']);
define('UPLOAD_DIR', '/uploads/');

// Pagination configuration
define('ITEMS_PER_PAGE', 10);

// Debug mode (set to false in production)
define('DEBUG_MODE', true);

// Time zone
date_default_timezone_set('UTC');

// Error reporting (disable in production)
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Include database connection
require_once 'db_connect.php';

// Include functions
require_once 'functions.php';