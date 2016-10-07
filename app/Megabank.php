<?php


namespace app;


use Config;

class Megabank
{
    private $wsdl;

    function __construct()
    {
        $this->wsdl = Config::get('services.megabank')['ws_url'];
    }

    public function deposit($info, $key)
    {
        $time = gettimeofday();
        $transId = $time['sec'] . $time['usec'];
        $stan = substr($time['sec'], 4);

        $data = array();
        $data['merchantid'] 		= Config::get('services.megabank')['merchantid'];
        $data['stan'] 				= $stan;
        $data['termtxndatetime'] 	= date("YmdHis");
        $data['txnAmount'] 			= $info['txnAmount'];
        $data['fee'] 				= $info['fee'];
        $data['userName'] 			= $info['userName'];
        $data['IssuerID'] 			= Config::get('services.megabank')['IssuerID'];
        $data['tranID'] 			= $transId;
        $data['bankID'] 			= $info['bankID'];
        $mac_data = $data['merchantid'] . $data['stan'] . $data['termtxndatetime'] . $data['txnAmount'] . $data['fee'] . $data['userName'] . $info['IssuerID'] . $data['tranID'] . $data['bankID'] . $info['respUrl'];
        $data['mac'] 				= $this->mDESMAC_3des($mac_data, $key);
        $data['respUrl'] 			= $info['respUrl'];

        $client = new SoapClient($this->wsdl);
        try {
            $result = $client->__soapCall("Deposit", array($data));
            return $result;
        } catch(Exception $e) {
            return false;
        }
    }

    public function confirm($info, $key)
    {
        $time = gettimeofday();
        $transId = $time['sec'] . $time['usec'];
        $stan = substr($time['sec'], 4);

        $data = array();
        $data['merchantcode'] 	= $info['merchantcode'];
        $data['txnAmount'] 		= $info['txnAmount'];
        $data['confirmCode'] 	= $info['confirmCode'];
        $data['tranid'] 		= $info['tranid'];
        $mac_data = $data['merchantcode'] . $data['tranid'] . $data['txnAmount'] . $data['confirmCode'];
        $data['mackey'] 		= $this->mDESMAC_3des($mac_data, $key);

        $client = new SoapClient($this->wsdl);
        try {
            $result = $client->__soapCall("comfirm", array($data));
            return $result;
        } catch(Exception $e) {
            return false;
        }
    }

    public function mDESMAC_3des($input, $key)
    {
        $input = sha1($input);
        $len = strlen($input);

        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
        $blocksize = mcrypt_enc_get_block_size($td);
        $keysize = mcrypt_enc_get_key_size($td);
        $iv_size = mcrypt_enc_get_iv_size($td);
        //$iv = "hywebpg5";
        $input_len = strlen($input);
        $padsize = $blocksize-($input_len%$blocksize);
        @mcrypt_generic_init($td, $key, $iv);

        //	echo strlen($input) . "<BR>";
        //	echo strlen(mcrypt_generic($td, $input)) . "<BR>";
        $MacDes = bin2hex(mcrypt_generic($td, $this->hex2bin($input)));
        return strtoupper($MacDes);
    }

    private function hex2bin($str)
    {
        $bin = "";
        $i = 0;
        do {
            $bin .= chr(hexdec($str{$i}.$str{($i + 1)}));
            $i += 2;
        } while ($i < strlen($str));
        return $bin;
    }
}