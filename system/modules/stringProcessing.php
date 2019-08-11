<?php
namespace Modules;

class stringProcessingModule
{
    public function encryptWithOutKey(string $data)
    {
        return hash("md5", hash("sha256", $data));
    }

    public function encrypt(string $data, string $key)
    {
        return openssl_encrypt($data, "aes-256-cbc", hash("sha256", $key), 0, substr(hash("sha256", "35DFD4A32ECE54400800FFC275F87ADC"), 0, 16));
    }

    public function decrypt(string $data, string $key)
    {
        return openssl_decrypt($data, "aes-256-cbc", hash("sha256", $key), 0, substr(hash("sha256", "35DFD4A32ECE54400800FFC275F87ADC"), 0, 16));
    }

    public function createToken(array $params, bool $temp = false)
    {
        $return_value = null;
        ($temp) ? array_push($params, date("d/m/Y")) : null ;
        foreach ($params as $param) {
            $return_value .= $param;
        }
        return $this->encryptWithOutKey($return_value);
    }
}
