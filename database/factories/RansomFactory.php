<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RansomWare;
use Faker\Generator as Faker;
use phpseclib\Crypt\RSA;
use Illuminate\Support\Str;



$factory->define(RansomWare::class, function (Faker $faker) {

	   $rsa = new RSA();
	    // creating keys 
	   $keys = $rsa->createKey(2048);
		// extracting the keys
		
		// $plaintext = 'I am prosper kalu';

		// $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);
		// $ciphertext = $rsa->encrypt($plaintext);

		// $rsa->loadKey($keys['privatekey']); // private key
		// echo $rsa->decrypt($ciphertext);

    return [
       
        'device_type' => 'Dell',
        'publicIp' => '127.0.1',
        'os' => 'Linux',  
        'enc_fernet_key' => Str::random(10),
        'isPaid' => 0,
        'publickey' => $keys['publickey'],
        'privatekey' => $keys['privatekey']
    ];
});
