<?php

if (strtolower(php_sapi_name()) !== 'cli') {
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
for ($i = 0; $i < 5; $i++) {
    $pid = pcntl_fork();
    if ($pid == -1) {
        echo "\033[0;31;43m进程 fork 失败\033[0m\n";
        exit(0);
    } elseif ($pid) {
        $pid = getmypid();
        echo "\033[0;31m我是父进程 $pid \033[0m\n";
        $execute++;
        if ($execute >= MAXPROCESS) {
            pcntl_wait($status);
            $execute--;
        }
    } else {
        $mypid = getmypid(); // 子进程 PID
        $ppid = posix_getppid(); // 父进程 PID
        echo "\033[0;32m我是 {$ppid} 的子进程，我的PID是 $mypid \033[0m\n";
        sleep(rand(8, 17));
        $pid = pcntl_fork();
        if ($pid == -1) {
            echo "\033[0;35m子进程({$mypid})中：进程 fork 失败\033[0m\n";
            exit(0);
        } elseif ($pid) {
            $pid = getmypid();
            echo "\033[0;35m子进程({$mypid})中：我是父进程 $pid \033[0m\n";
            pcntl_wait($status);
        } else {
            $pid = getmypid();
            $ppid = posix_getppid();
            echo "\033[0;36m子进程({$mypid})中：我是 {$ppid} 的子进程，我的PID是 $pid \033[0m\n";
            exit(0);
        }
        exit(0);
    }
}