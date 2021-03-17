#!/usr/bin/php
<?php
// 在 PHP-CLI 模式下是没有超时时间的，也无法通过 set_time_limit 设置超时时间。
set_time_limit(10);

// 在 PHP-CLI 模式下总是关闭输出缓冲区。
while (1) {
    echo 'hello' . PHP_EOL;
    sleep(1);
}
