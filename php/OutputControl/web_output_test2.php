<?php
// 设置此连接是否允许使用代理缓冲区。(yes允许使用缓冲区；no禁止使用缓冲区)
// 关闭缓冲区将适用 Comet 和 HTTP 流应用程序的无缓冲响应。
header("X-Accel-Buffering: no");

/*****************************************
// 除了设置 header 外，还可以通过修改 nginx 配置文件达到同样的目的
// 启用或禁用来自 FastCGI 服务器的响应缓冲。
// 禁用缓冲区后，响应一收到就立即同步传递的客户端。
// nginx 不会尝试从 FASTCGI 服务器读取整个响应。
// nginx 一次可以从服务器接收的最大数据大小由 fastcgi_buffer_size 指令设置。
// fastcgi_buffering off;
*****************************************/

if (!ini_get('display_errors')) ini_set('display_errors', 1);

error_reporting(E_ALL);

// 打开/关闭绝对刷送
// ob_implicit_flush() 将打开或关闭绝对（隐式）刷送。绝对（隐式）刷送将导致在每次输出调用后有一次刷送操作，以便不再需要对 flush() 的显式调用。
ob_implicit_flush(true);

for ($i = 0; $i <= 5; $i++) {
    echo $i . PHP_EOL;
    ob_flush();
    // 开启 ob_implicit_flush() 后，将不再需要显示的调用 flush() 函数。
    // flush();
    sleep(1);
}

echo 'The End.' . PHP_EOL;
