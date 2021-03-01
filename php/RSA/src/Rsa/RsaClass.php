<?php
namespace App\Rsa;

use Exception;

class RsaClass
{
    private $private_key = '';

    private $public_key = '';

    public function __construct($private_key_filepath, $public_key_filepath)
    {
        try {
            $this->private_key = $this->_getFileContents($private_key_filepath);
            $this->public_key = $this->_getFileContents($public_key_filepath);
        } catch (Exception $e) {
            die("获取密钥失败：" . $e->getMessage() . PHP_EOL);
        }
    }

    private function _getFileContents($file)
    {
        if (!file_exists($file)) {
            throw new Exception("文件不存在或路径错误");
        }
        return file_get_contents($file);
    }

    /**
     * 私钥加密
     *
     * @param string $data 需要加密的字符串
     * @return string
     */
    public function privateEncrypt(string $data): string
    {
        return openssl_private_encrypt($data, $crypted, $this->private_key) ? base64_encode($crypted) : '';
    }

    /**
     * 公钥加密
     *
     * @param string $data 需要加密的字符串
     * @return string
     */
    public function publicEncrypt(string $data): string
    {
        return openssl_public_encrypt($data, $crypted, $this->public_key) ? base64_encode($crypted) : '';
    }

    /**
     * 私钥解密
     *
     * @param string $data 需要解密的字符串
     * @return string
     */
    public function privateDecrypt(string $data): string
    {
        return openssl_private_decrypt(base64_decode($data), $decrypted, $this->private_key) ? $decrypted : '';
    }

    /**
     * 公钥解密
     *
     * @param string $data 需要解密的字符串
     * @return string
     */
    public function publicDecrypt(string $data): string
    {
        return openssl_public_decrypt(base64_decode($data), $decrypted, $this->public_key) ? $decrypted : '';
    }
}
