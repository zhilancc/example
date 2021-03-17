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

// 可以通过 php.ini 配置文件设置是否开启输出控制
// output_buffering bool/int
// 该选项设置为 On 时，将在所有的脚本中使用输出控制。如果要限制输出缓冲区的最大值，可将该选项设定为指定的最大字节数（例如 output_buffering=4096）。从PHP 该选项在 PHP-CLI 下总是为 Off。

if (!ini_get('display_errors')) ini_set('display_errors', 1);

error_reporting(E_ALL);

if (!ob_get_level()) ob_start();

/*****************************************
// 深入理解ob_flush和flush的区别
// 转载地址：https://www.laruence.com/2010/04/15/1414.html

// ob_flush/flush在手册中的描述，都是刷新输出缓冲区，并且还需要配套使用，所以会导致很多人迷惑...
// 其实，他们俩的操作对象不同，有些情况下，flush根本不做什么事情..
// ob_*系列函数，是操作PHP本身的输出缓冲区。
// 所以，ob_flush是刷新PHP自身的缓冲区。
// 而flush，严格来讲，这个只有在PHP做为apache的Module(handler或者filter)安装的时候，才有实际作用。它是刷新WebServer(可以认为特指apache)的缓冲区。
// 在apache module的sapi下，flush会通过调用sapi_module的flush成员函数指针，间接的调用apache的api: ap_rflush刷新apache的输出缓冲区，当然手册中也说了，有一些apache的其他模块，可能会改变这个动作的结果..

有些Apache的模块，比如mod_gzip，可能自己进行输出缓存，这将导致flush()函数产生的结果不会立即被发送到客户端浏览器。甚至浏览器也会在显示之前，缓存接收到的内容。例如 Netscape 浏览器会在接受到换行或 html 标记的开头之前缓存内容，并且在接受到 </table> 标记之前，不会显示出整个表格。一些版本的 Microsoft Internet Explorer 只有当接受到的256个字节以后才开始显示该页面，所以必须发送一些额外的空格来让这些浏览器显示页面内容。

// 所以，正确使用俩者的顺序是: 先ob_flush，然后flush，
// 当然，在其他sapi下，不调用flush也可以，只不过为了保证你代码的可移植性，建议配套使用。
****************************************/
for ($i = 0; $i <= 5; $i++) {
    echo $i . PHP_EOL;
    ob_flush();
    flush();
    sleep(1);
}

echo 'The End.' . PHP_EOL;
