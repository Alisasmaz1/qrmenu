<?php

namespace App\Controllers;

use Core\Request;
use Core\Security;
use App\Models\RestoranUser;

class SiteController {

    private $RestoranUser;
    public function __construct()
    {
        $this->RestoranUser = new RestoranUser();
    }

    public function index(Request $request)
    {
        return view(['index'], ['name' => 'Restoran giriş Kayıt']);
    }

    public function register(Request $request)
    {
        return view(['register'], ['name' => 'Restoran Kayıt']);
    }

    /**
     * Giriş formu verilerini işler.
     * URL: /handleRegister (POST)
     * @param Request $request Gelen HTTP isteği (POST)
     */
    public function handleRegister(Request $request)
    {
        $restoranUser = $this->RestoranUser;
        // Sadece POST isteklerini kabul et
        if (!$request->isPost()) {
            return view('page404')->withStatus(405); // 405 Method Not Allowed
        }

        // CSRF token kontrolü
        if (!Security::checkCsrfToken($request->input('_token'))) {
            $_SESSION['form_errors'] = ['session' => 'Oturum süresi doldu veya geçersiz CSRF token.'];
            header("Location: /auth/login");
            exit();
        }



        $register_data = [
            'name'=>$request->input('restoranAdi'),
            'slogan'=>$request->input('restoranSlogani'),
            'adres'=>$request->input('restoranAdresi'),
            'sehir'=>$request->input('restoranSehir'),
            'ilce'=>$request->input('restoranSehir'),
            'mail'=>$request->input('RestoranMail'),
            'phone'=>$request->input('RestoranTelefon'),
            'url'=>$request->input('RestoranWebsite'),
            'password'=>$request->input('RestoranSifre'),
        ];

        if ($restoranUser->userExists($register_data['mail'],$register_data['phone'])){
            $_SESSION['form_errors'] = ['session' => 'Zaten Kayıtlı Mail Adresi veya Telefon '.$register_data['mail']." ve ".$register_data['phone']];
            header("Location: /auth/login");
            exit();
        }

        $gunler = [
            'pazartesi'=>[$request->input('restoranGunPztStart'),$request->input('restoranGunPztEnd')],
            'sali'=>[$request->input('restoranGunSalStart'),$request->input('restoranGunSalEnd')],
            'carsamba'=>[$request->input('restoranGunCarStart'),$request->input('restoranGunCarEnd')],
            'persembe'=>[$request->input('restoranGunPerStart'),$request->input('restoranGunPerEnd')],
            'cuma'=>[$request->input('restoranGunCumStart'),$request->input('restoranGunCumEnd')],
            'cumartesi'=>[$request->input('restoranGunCtesiStart'),$request->input('restoranGunCtesiEnd')],
            'pazar'=>[$request->input('restoranGunPazStart'),$request->input('restoranGunPazEnd')],
        ];

        if ($request->find('restoranHerGun')){
            $gunler['restoranHerGun']='on';
        }else{
            $gunler['restoranHerGun']='off';
        }

        $status = $restoranUser->createUser($register_data,$gunler);


        $restoran['id']=$status;

//        echo "<pre>";
//        print_r($register_data);
//        print_r($gunler);
//        echo "</pre>";

        return view(['registerOk'], ['restoran' => $restoran]);
    }



    public function waitRestoran(Request $request)
    {
        return view(['loginWait'], ['restoran' => "QR Restoran Yönetim"]);
    }



    public function api(Request $request)
    {
        return json(['name' => $request->query('name')]);
    }





    public function page404(Request $request)
    {
        return view('page404')
            ->withStatus(404);
    }
}