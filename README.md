# PHP MVC Framework

A lightweight MVC framework built with PHP and PostgreSQL, featuring a clean architecture and modular design.

## Features
- MVC Architecture
- PostgreSQL Integration
- Environment Configuration
- Component-based Views
- Clean Routing System
- PDO Database Layer

## Project Structure
```php
project/
├── app/
│   ├── Controllers/
│   |   └── Controller.php/
│   |   └── IndexController.php/
│   └── Config/
│   |   └── Database.php/
│   └── Models/
│   |   └── Home.php/
│   └── Repositories/
│   |   └── Repository.php/
│   └── Routes/
│   |   └── Route.php/
│   |   └── Router.php/

├── public/
│   ├── assets/
│   |   └── css/
│   |   |    └── app.css
│   |   └── js/
│   |   |    └── app.js
│   └── index.php
├── resources/
│   ├── views/
│   |     ├── components/
│   |     |      ├── footer.php/
│   |     |      ├── navbar.php/
│   |     |      ├── header.php/
│   |     ├── pages/
│   |     |      ├── home.php/
│   |     ├── 404.php/
├── .env/
└── README.md

```


##  Installation

1. Clone the repository
```bash
git clone <repository-url>
cd project
```
2. Install dependencies
```bash
composer install
```
3. Configure environment
```bash
cp .env.example .env
```
4. Update .env with your database credentials
```env
DB_HOST=localhost
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_DATABASE=your_database
DB_PORT=5432
```

## Core Components

Database Config (Database.php)


```php
<?php
namespace App\Config;

use Dotenv\Dotenv;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct($host, $user, $password, $dbname, $port)
    {
        $dsn = 'pgsql:host=' . $host .';port='.$port. ';dbname=' . $dbname;
        $options = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->pdo = new \PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = self::createInstanceFromEnv();
        }
        return self::$instance;
    }

    private static function createInstanceFromEnv()
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];
        $port = $_ENV['DB_PORT']??'5432';

        return new self($host, $user, $password, $dbname,$port);
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}

```
Base Controller (Controller.php)


```php
<?php
namespace App\Controller;

class Controller {
    protected $viewPath;
    protected $model;

    public function __construct()
    {
        $this->viewPath = __DIR__."/../../resources/views";
        $modelName = str_replace('Controller', '',static::class);
        $modelName = strtolower($modelName);
    }

    protected function render($view, $data = [])
    {
        $file = __DIR__ . '/../../resources/views/' . str_replace('.', '/', $view) . '.php';
        if (file_exists($file)) {
            extract($data);
            include $file;
        }
    }
}

```
Index Controller (IndexController.php)


```php
<?php
namespace App\Controller;

use App\Controller\Controller;

class IndexController extends Controller {
    public function index()
    {
        return $this->render("pages.home");
    }

    public function about()
    {
        return $this->render("pages.about");
    }
}

```
### 🔧 Usage Examples
Creating a New Controller

```php
namespace App\Controller;

class UserController extends Controller {
    public function index() {
        return $this->render("pages.users.index", [
            'users' => $users
        ]);
    }
}

```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch ( git checkout -b feature/AmazingFeature)
3. Commit your changes ( git commit -m 'Add some AmazingFeature')
4. Push to the branch ( git push origin feature/AmazingFeature)
5. Open a Pull Request

## 🤝 ARtikles
- [Meduim](https://medium.com/@kardasch/mvc-model-view-controller-c324c5a150b5) -  MVC Fremwork
