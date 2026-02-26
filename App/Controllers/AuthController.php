<?php

namespace App\Controllers;

use Core\Request;
use Core\Response;
use Core\Security;
use App\Models\User; // User modelini dahil ediyoruz

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User(); // User modelini başlatıyoruz
        // Oturumları başlatmak için session_start() çağrısı genellikle public/index.php'de yapılır.
        // Eğer yapılmadıysa burada veya uygulamanın en başında yapılması gerekir.
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Giriş formunu gösterir.
     * URL: /auth/login
     * @param Request $request Gelen HTTP isteği
     * @return Response HTML giriş formu
     */
    public function login(Request $request): Response
    {
        // Oturum açmış kullanıcılar admin paneline yönlendirilebilir
        if ($this->isLoggedIn()) {
            header("Location: /yonetim/index");
            exit();
        }

        $errors = $_SESSION['login_errors'] ?? []; // Önceki hataları al
        unset($_SESSION['login_errors']); // Hataları session'dan temizle

        return view(['auth.login'], [
            'name' => "Restoran Giriş",
            'errors' => $errors,
            '_token' => Security::getCsrfToken() // CSRF token'ı view'e gönder
        ]);
    }

    /**
     * Admin Giriş formunu gösterir.
     * URL: /auth/admin
     * @param Request $request Gelen HTTP isteği
     * @return Response HTML giriş formu
     */
    public function admin(Request $request): Response
    {
        // Oturum açmış kullanıcılar admin paneline yönlendirilebilir
        if ($this->isLoggedIn()) {
            header("Location: /admin/index");
            exit();
        }

        $errors = $_SESSION['login_errors'] ?? []; // Önceki hataları al
        unset($_SESSION['login_errors']); // Hataları session'dan temizle

        return view('auth.admin_login', [
            'errors' => $errors,
            '_token' => Security::getCsrfToken() // CSRF token'ı view'e gönder
        ]);
    }

    /**
     * Giriş formu verilerini işler.
     * URL: /auth/handleLogin (POST)
     * @param Request $request Gelen HTTP isteği (POST)
     * @return Response Yönlendirme veya hata mesajı ile tekrar form
     */
    public function handleLogin(Request $request): Response
    {
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

        if ($request->find('username') and $request->find('password')){
            $username = $request->input('username');
            $password = $request->input('password');


        }else{
                $_SESSION['form_errors'] = ['session' => 'Lütfen Geçerli Parametreleri gönderin'];
            header("Location: /auth/login");
            exit();
        }
        $login_type = $request->find('adminLogin') ? '/auth/admin':'/auth/login';



        $user = $this->userModel->checkCredentials($username, $password);


//        die();

        if ($user) {
            // Kimlik doğrulama başarılı
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // İsteğe bağlı olarak diğer kullanıcı bilgilerini de saklayabilirsiniz
            // $_SESSION['is_admin'] = true; // Eğer ayrı bir admin rolü sistemi varsa

            header("Location: /yonetim/index"); // Admin paneline yönlendir
            exit();
        } else {
            // Kimlik doğrulama başarısız
            $_SESSION['form_errors'] = ['credentials' => 'Yanlış kullanıcı adı veya şifre.'];
            header("Location: $login_type");
            exit();
        }
    }

    /**
     * Kullanıcının oturumunu sonlandırır.
     * URL: /auth/logout (POST veya GET, ancak POST daha güvenlidir)
     * @param Request $request Gelen HTTP isteği
     * @return Response Yönlendirme
     */
    public function logout(Request $request): Response
    {
        // CSRF token kontrolü (POST isteği varsayılırsa)
        if ($request->isPost() && !Security::checkCsrfToken($request->input('_token'))) {
            return view('page404')->withStatus(403);
        }

        // Oturum değişkenlerini temizle
        session_unset();
        session_destroy();

        // Giriş sayfasına veya ana sayfaya yönlendir
        header("Location: /auth/login");
        exit();
    }

    /**
     * Kullanıcının oturum açmış olup olmadığını kontrol eder.
     * @return bool
     */
    private function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }
}
