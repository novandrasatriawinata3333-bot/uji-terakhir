<?php
echo "<h1>Environment Variables Check</h1>";
echo "<pre>";
echo "APP_KEY: " . (getenv('APP_KEY') ? 'SET ✓' : 'NOT SET ✗') . "\n";
echo "APP_ENV: " . (getenv('APP_ENV') ? getenv('APP_ENV') : 'NOT SET ✗') . "\n";
echo "APP_DEBUG: " . (getenv('APP_DEBUG') ? getenv('APP_DEBUG') : 'NOT SET ✗') . "\n";
echo "DB_HOST: " . (getenv('DB_HOST') ? 'SET ✓' : 'NOT SET ✗') . "\n";
echo "DB_DATABASE: " . (getenv('DB_DATABASE') ? getenv('DB_DATABASE') : 'NOT SET ✗') . "\n";
echo "VIEW_COMPILED_PATH: " . (getenv('VIEW_COMPILED_PATH') ? getenv('VIEW_COMPILED_PATH') : 'NOT SET ✗') . "\n";
echo "\n--- All Environment Variables ---\n";
foreach ($_ENV as $key => $value) {
    if (strpos($key, 'APP_') === 0 || strpos($key, 'DB_') === 0 || strpos($key, 'MYSQL_') === 0) {
        echo "$key = " . (strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value) . "\n";
    }
}
echo "</pre>";