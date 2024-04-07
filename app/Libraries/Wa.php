<?php

namespace App\Libraries;

class Wa
{
    function kirim($no, $tanggal)
    {
        $userkey = '024aa52aa4c3';
        $passkey = 'c581a02ad7b1c39466fa5b7d';
        $telepon = $no;
        $message = "BAZNAS \n Tagihan pembayaran anda akan jatuh tempo pada tanggal *$tanggal*\n mohon untuk segera melakukan pembayaran dan konfirmasi pembayaran\n Abaikan pesan ini jika telah melakukan pembayaran";
        $url = 'https://console.zenziva.net/reguler/api/sendsms/';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $telepon,
            'message' => $message
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
        return $results;
    }
}
