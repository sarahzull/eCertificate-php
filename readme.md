# E-Certificate PHP Project

### Installation

1. **Clone the repository:**

   ```sh
   git clone https://github.com/sarahzull/e-certificate-php.git
   cd e-certificate-php
   ```

2. **Install Composer dependencies:**

   ```sh
   composer install
   ```

3. **Create a MySQL database:**

   ```sql
   CREATE DATABASE e_certificate;
   USE e_certificate;

   CREATE TABLE certificates (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       date_issued DATE NOT NULL,
       unique_number VARCHAR(255) UNIQUE NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

4. **Configure the database connection:**

   Copy the `db-example.php` file to `db.php` and add your database credentials:

   ```sh
   cp db-example.php db.php
   ```

   Edit the `db.php` file with your database credentials:

   ```php
   <?php
   $host = '127.0.0.1';
   $db = 'e_certificate';
   $user = 'root';
   $pass = 'yourpassword';
   $charset = 'utf8mb4';

   $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
   $options = [
       PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
       PDO::ATTR_EMULATE_PREPARES   => false,
   ];

   try {
       $pdo = new PDO($dsn, $user, $pass, $options);
   } catch (\PDOException $e) {
       throw new \PDOException($e->getMessage(), (int)$e->getCode());
   }
   ?>
   ```

### Usage

1. **Start a local PHP server:**

   ```sh
   php -S localhost:8000
   ```

2. **Create a certificate:**

   Navigate to `http://localhost:8000/create_certificate.php` in your browser to access the form for creating a certificate.

   - Fill in the recipient's name and the date issued.
   - Submit the form to generate the certificate and view it in the browser.
