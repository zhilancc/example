<?php

if (strtoupper(php_sapi_name()) !== 'CLI') {
    echo "请在 CLI 模式下运行该脚本！" . PHP_EOL;
    exit(0);
}

if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_NOTICE);
}

ini_set('memory_limit', -1);

// 最大进程数
define('MAXPROCESS', 5);

$fh = @fopen('./demo.txt', 'rb');
if (!$fh) {
    echo "\033[0;31;43m文件打开失败\033[0m" . PHP_EOL;
    exit(1);
}
$execute = 0;
while (($buffer = fgets($fh, 2048)) !== false) {
    $pid = pcntl_fork();
    if ($pid == -1) {
        echo "进程 fork 失败" . PHP_EOL;
        exit(1);
    } elseif ($pid) {
        $pid = posix_getpid();
        printf("\033[0;31m执行父进程逻辑 %s \033[0m\n", $pid);
        $execute++;
        if ($execute >= MAXPROCESS) {
            pcntl_wait($status);
            $execute--;
        }
    } else {
        $pid = posix_getpid();
        printf("\033[0;32m执行子进程逻辑 %s \033[0m\n", $pid);
        echo strtoupper($buffer) . PHP_EOL;
        sleep(rand(3, 7));
        exit(0);
    }
    $temp = '';
}
if (!feof($fh)) {
    echo "Error: unexpected fgets() fail\n";
}
fclose($fh);
