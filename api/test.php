<?php
header('Content-Type: text/html; charset=UTF-8');
echo "<h1>Laravel Test</h1>";
echo "<pre>";

echo "1. PHP Version: " . phpversion() . "\n";
echo "2. Current Dir: " . __DIR__ . "\n";
echo "3. File exists check:\n";
echo "   - vendor/autoload.php: " . (file_exists(__DIR__.'/../vendor/autoload.php') ? 'YES' : 'NO') . "\n";
echo "   - bootstrap/app.php: " . (file_exists(__DIR__.'/../bootstrap/app.php') ? 'YES' : 'NO') . "\n";
echo "   - resources/views: " . (is_dir(__DIR__.'/../resources/views') ? 'YES' : 'NO') . "\n";

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
    echo "\n4. Autoload: SUCCESS\n";
    
    if (file_exists(__DIR__.'/../bootstrap/app.php')) {
        try {
            $app = require __DIR__.'/../bootstrap/app.php';
            echo "5. Laravel Bootstrap: SUCCESS\n";
            echo "6. App class: " . get_class($app) . "\n";
        } catch (Exception $e) {
            echo "5. Laravel Bootstrap: FAILED\n";
            echo "   Error: " . $e->getMessage() . "\n";
        }
    }
}

echo "\n7. Environment Variables:\n";
echo "   APP_KEY: " . (getenv('APP_KEY') ? 'SET' : 'NOT SET') . "\n";
echo "   APP_ENV: " . (getenv('APP_ENV') ?: 'NOT SET') . "\n";

echo "</pre>";