<?php
namespace app\validator;
use GuzzleHttp\Client;

class ReCaptcha{
    public function validate($attribute, $value, $parameters, $validators){// Mendefinisikan metode validate yang menerima satu parameter $value
        $client = new Client();// Membuat instance baru dari GuzzleHttp\Client untuk melakukan permintaan HTTP
        // Mengambil kunci rahasia reCAPTCHA dari konfigurasi aplikasi
        $secret = config('services.recaptcha.secret');
        // Memeriksa apakah kunci rahasia kosong, jika ya, lemparkan pengecualian
        if (empty($secret)) {
            throw new \Exception('reCAPTCHA secret key is not set.');
        }
        // Melakukan permintaan POST ke API reCAPTCHA untuk memverifikasi respons
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params'=>[
                    'secret'=> config('services.recaptcha.secret'),// Mengirim kunci rahasia sebagai parameter
                    'response'=>$value,// Mengirim nilai respons reCAPTCHA yang diterima dari klien
                ],
        ],
    );
    // Mendekode respons JSON dari API reCAPTCHA
    $body = json_decode((string)$response->getBody());
    // Mengembalikan nilai boolean apakah verifikasi reCAPTCHA berhasil
    return $body->success;
    }
}
