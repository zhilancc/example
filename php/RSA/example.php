<?php
include "./vendor/autoload.php";

use App\Rsa\RsaClass;

$private_key_filepath = "./storage/rsa_private_key.pem";
$public_key_filepath = "./storage/rsa_public_key.pem";
$rsa = new RsaClass($private_key_filepath, $public_key_filepath);

echo PHP_EOL . "========================= 私钥加密&公钥解密 =========================" . PHP_EOL;
$str = "Hello World.";
$encry_str = $rsa->privateEncrypt($str);
echo "字符串({$str})私钥加密后：{$encry_str}" . PHP_EOL;
echo "加密字符串({$encry_str})公钥解密后：{$rsa->publicDecrypt($encry_str)} ". PHP_EOL;

echo PHP_EOL . "========================= 公钥加密&私钥解密 =========================" . PHP_EOL;
$str = "世界，你好。";
$encry_str = $rsa->publicEncrypt($str);
echo "字符串({$str})公钥加密后：{$encry_str}" . PHP_EOL;
echo "加密字符串({$encry_str})私钥解密后：{$rsa->privateDecrypt($encry_str)}" . PHP_EOL;

echo PHP_EOL . "========================= md5WithRSAEncryption =========================" . PHP_EOL;
$str = 'Hello World.';
$signature = '';
$rs = openssl_get_privatekey("file://storage/rsa_private_key.pem", '');
if (openssl_sign($str, $signature, $rs, OPENSSL_ALGO_MD5)) {
    $signature = base64_encode($signature);
}
echo "字符串({$str})私钥加密后：{$signature}" . PHP_EOL;
$rs = openssl_get_publickey("file://storage/rsa_public_key.pem");
$res = openssl_verify($str, base64_decode($signature), $rs, OPENSSL_ALGO_MD5);
if ($res == 1) {
    echo "md5WithRSAEncryption 加密验证成功" . PHP_EOL;
} else if ($res == 0) {
    echo "md5WithRSAEncryption 加密验证失败" . PHP_EOL;
} else {
    echo "错误的校验" . PHP_EOL;
}
openssl_free_key($rs);

echo PHP_EOL . "========================= sha1WithRSAEncryption =========================" . PHP_EOL;
$str = 'Hello World.';
$signature = '';
$rs = openssl_get_privatekey("file://storage/rsa_private_key.pem", '');
if (openssl_sign($str, $signature, $rs, OPENSSL_ALGO_SHA1)) {
    $signature = base64_encode($signature);
}
echo "字符串({$str})私钥加密后：{$signature}" . PHP_EOL;
$rs = openssl_get_publickey("file://storage/rsa_public_key.pem");
$res = openssl_verify($str, base64_decode($signature), $rs, OPENSSL_ALGO_SHA1);
if ($res == 1) {
    echo "sha1WithRSAEncryption 加密验证成功" . PHP_EOL;
} else if ($res == 0) {
    echo "sha1WithRSAEncryption 加密验证失败" . PHP_EOL;
} else {
    echo "错误的校验" . PHP_EOL;
}
openssl_free_key($rs);

echo PHP_EOL . "========================= sha256WithRSAEncryption =========================" . PHP_EOL;
$str = 'Hello World.';
$signature = '';
$rs = openssl_get_privatekey("file://storage/rsa_private_key.pem", '');
if (openssl_sign($str, $signature, $rs, OPENSSL_ALGO_SHA256)) {
    $signature = base64_encode($signature);
}
echo "字符串({$str})私钥加密后：{$signature}" . PHP_EOL;
$rs = openssl_get_publickey("file://storage/rsa_public_key.pem");
$res = openssl_verify($str, base64_decode($signature), $rs, OPENSSL_ALGO_SHA256);
if ($res == 1) {
    echo "sha256WithRSAEncryption 加密验证成功" . PHP_EOL;
} else if ($res == 0) {
    echo "sha256WithRSAEncryption 加密验证失败" . PHP_EOL;
} else {
    echo "错误的校验" . PHP_EOL;
}
openssl_free_key($rs);

echo PHP_EOL . "========================= sha512WithRSAEncryption =========================" . PHP_EOL;
$str = 'Hello World.';
$signature = '';
$rs = openssl_get_privatekey("file://storage/rsa_private_key.pem", '');
if (openssl_sign($str, $signature, $rs, OPENSSL_ALGO_SHA512)) {
    $signature = base64_encode($signature);
}
echo "字符串({$str})私钥加密后：{$signature}" . PHP_EOL;
$rs = openssl_get_publickey("file://storage/rsa_public_key.pem");
$res = openssl_verify($str, base64_decode($signature), $rs, OPENSSL_ALGO_SHA512);
if ($res == 1) {
    echo "sha512WithRSAEncryption 加密验证成功" . PHP_EOL;
} else if ($res == 0) {
    echo "sha512WithRSAEncryption 加密验证失败" . PHP_EOL;
} else {
    echo "错误的校验" . PHP_EOL;
}
openssl_free_key($rs);
