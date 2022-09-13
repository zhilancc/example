<?php

if (strtoupper(php_sapi_name()) !== 'CLI') {
    echo "请在 CLI 模式下运行该脚本！" . PHP_EOL;
    exit(0);
}

if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

// 最大进程数
define('MAXPROCESS', 25);

$execute = 0; // 初始化
for ($i = 0; $i < 100; $i++) {
    $pid = pcntl_fork();
    if ($pid == -1) {
        echo "could not fork" . PHP_EOL;
        exit(1);
    } elseif ($pid) {
        echo "I'm the Parent $i" . PHP_EOL;
        $execute++;
        if ($execute >= MAXPROCESS) {
            pcntl_wait($status);
            $execute--;
        }
    } else {
        $pid = posix_getpid();
        echo "I am the child, $i pid = $pid" . PHP_EOL;
        sleep(rand(3, 10));
        echo "Bye Bye from $i" . PHP_EOL;
        exit(0);
    }
}