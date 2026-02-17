<?php
define('LARAVEL_START', microtime(true));
if (!file_exists('/tmp/isrgrootx1.pem')) { file_put_contents('/tmp/isrgrootx1.pem', file_get_contents(__DIR__.'/../storage/app/isrgrootx1.pem')); chmod('/tmp/isrgrootx1.pem', 0644); }
$dirs = ['/tmp/storage','/tmp/storage/framework','/tmp/storage/framework/cache','/tmp/storage/framework/cache/data','/tmp/storage/framework/sessions','/tmp/storage/framework/views','/tmp/storage/logs','/tmp/bootstrap','/tmp/bootstrap/cache'];
foreach ($dirs as $dir) { if (!is_dir($dir)) { mkdir($dir, 0755, true); } }
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->useStoragePath('/tmp/storage');
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle($request = Illuminate\Http\Request::capture());
$response->send();
$kernel->terminate($request, $response);