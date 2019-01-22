<?php
class CryptAES
{

    public function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
    public function pkcs5_unpad($text)
    {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text))
        {
            return false;
        }
        if( strspn($text, chr($pad), strlen($text) - $pad) != $pad)
        {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }


//加密
    public function encrypt($data,$key)
    {

        $iv     = "0102030405060708";
        $iv = pack("H16", $iv);
        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
        mcrypt_generic_init($td, $key, $iv);
        $str = base64_encode(mcrypt_generic($td,$this->pkcs5_pad($data,8)));
        return $str;
    }
//解密
    public function decrypt($data,$key)
    {
        if(!empty($data))
        {
            $iv     = "0102030405060708";
            $iv = pack("H16", $iv);
            $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
            mcrypt_generic_init($td, $key, $iv);
            $ttt  =$this->pkcs5_unpad(mdecrypt_generic($td, base64_decode($data)));
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            return $ttt;
        }
    }
}
?>