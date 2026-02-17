<?php
// Simple PHP test - no Laravel
echo "<h1>PHP Test</h1>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Time: " . date('Y-m-d H:i:s') . "<br>";

// Test autoload
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo "✓ Vendor autoload exists<br>";
    require __DIR__ . '/../vendor/autoload.php';
    echo "✓ Autoload loaded<br>";
} else {
    echo "✗ Vendor autoload NOT FOUND<br>";
    exit;
}

// Test bootstrap
if (file_exists(__DIR__ . '/../bootstrap/app.php')) {
    echo "✓ Bootstrap exists<br>";
    try {
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        echo "✓ Laravel bootstrapped<br>";
        echo "App Class: " . get_class($app) . "<br>";
    } catch (Exception $e) {
        echo "✗ Bootstrap error: " . $e->getMessage() . "<br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
} else {
    echo "✗ Bootstrap NOT FOUND<br>";
}

phpinfo();