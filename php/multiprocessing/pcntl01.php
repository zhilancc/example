<?php

if (strtolower(php_sapi_name()) !== 'cli') {
    echo "请在 CLI 模式下运行该脚本！" . PHP_EOL;
    exit(0);
}

if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

echo "当前进程ID：" . getmypid() . PHP_EOL;
echo "当前进程ID：" . posix_getpid(). PHP_EOL;

// fork 是创建了一个子进程，父进程和子进程都从 fork 的位置开始向下继续执行，不同的是父进程执行过程中，得到的 fork 返回值为子进程号，而子进程得到的是 0。
$pid = pcntl_fork(); // fork 子进程

if ($pid == -1) {
    echo "进程 fork 失败！" . PHP_EOL;
    exit(1);
} else if ($pid) {
    // 如果 fork 成功，返回子进程 ID (pid > 0)
    echo "fork 成功后父进程得到的 PID: " . $pid . PHP_EOL;
    echo "当前进程ID：" . posix_getpid(). PHP_EOL;
    // 父进程逻辑
    for ($i = 0; $i < 10; $i++) {
        echo "父进程输出：{$i}" . PHP_EOL; 
    }
} else {
    echo "fork 成功后子进程得到的 PID: " . $pid . PHP_EOL;
    echo "当前进程ID：" . posix_getpid(). PHP_EOL;
    // 子进程逻辑
    for ($i = 9; $i >= 0; $i--) {
        echo "子进程输出：{$i}" . PHP_EOL; 
    }
}
sleep(5);
echo 'The End...' . PHP_EOL;
exit(0);