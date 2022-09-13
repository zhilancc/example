<?php

if (strtoupper(php_sapi_name()) !== 'CLI') {
    echo "请在 CLI 模式下运行该脚本！" . PHP_EOL;
    exit(0);
}

if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$index = 0;
$loop = 3;
while ($index < $loop) {
    echo "当前进程ID：" . getmypid() . PHP_EOL;
    echo "当前进程ID：" . posix_getpid() . PHP_EOL;

    $pid = pcntl_fork();
    if ($pid == -1) {
        echo "进程 fork 失败" . PHP_EOL;
        exit(1);
    } else if ($pid) {
        pcntl_wait($status);
        // 父进程逻辑
        $child_id = $pid; // 子进程 ID
        $pid = posix_getpid(); // 当前进程 ID
        $ppid = posix_getppid(); // 当前进程父级 ID
        echo "父进程：fork 的子进程 ({$child_id})；当前进程 ({$pid})；父进程 ({$ppid})；当前 index ({$index})。" . PHP_EOL;
    } else {
        // 子进程逻辑
        $pid = posix_getpid(); // 当前进程 ID
        $ppid = posix_getppid(); // 当前进程父级 ID
        echo "子进程 ({$pid})；父进程 ({$ppid})；当前 index ({$index})。" . PHP_EOL;
        exit(0);
    }
    $index++;
}
echo 'The End...' . PHP_EOL;
sleep(5);