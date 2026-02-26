<?php

namespace App\Models;

use Core\Database;

class User
{
    private $db;
    // Güvenli DEĞİLDİR! Sadece örnek amaçlı sabit bir tuz.
    // Gerçek bir uygulamada rastgele, benzersiz ve veritabanında saklanan tuzlar kullanılmalıdır.
    private const SECRET_SALT = 'HidemYas_2020';

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Özel şifre hashleme fonksiyonu (Örnek amaçlı, üretim için güvenli DEĞİLDİR!).
     *
     * @param string $password Hashlenecek ham şifre.
     * @return string Hashlenmiş şifre.
     */
    private function customHashPassword(string $password): string
    {
        // Şifreye statik tuzu ekle ve SHA-256 ile hash'le
        // Bu, password_hash() kadar güvenli değildir çünkü salt sabittir.
        return hash('sha256', $password . self::SECRET_SALT);
    }

    /**
     * Özel şifre doğrulama fonksiyonu.
     *
     * @param string $password Kontrol edilecek ham şifre.
     * @param string $hashedPassword Veritabanından gelen hashlenmiş şifre.
     * @return bool Şifreler eşleşiyorsa true, aksi takdirde false.
     */
    private function customVerifyPassword(string $password, string $hashedPassword): bool
    {
        // Sağlanan şifreyi aynı yöntemle hash'le ve veritabanındaki hash ile karşılaştır
        return $this->customHashPassword($password) === $hashedPassword;
    }

    /**
     * Kullanıcı kimlik bilgilerini (username ve password) doğrular.
     * Artık customVerifyPassword() kullanılıyor (örnek amaçlı).
     *
     * @param string $username Kullanıcı adı.
     * @param string $password Ham şifre.
     * @return array|false Kullanıcı bulunursa kullanıcı verilerini, bulunamazsa false döndürür.
     */
    public function checkCredentials(string $username, string $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM restoranlar WHERE mail = :username OR phone = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        // DİKKAT: Şifreyi burada tekrar hashleme!
        if ($user && $this->customVerifyPassword($password, $user['password'])) {
            return $user; // Doğrulama başarılı
        }

        return false; // Kullanıcı yok veya şifre yanlış
    }


    /**
     * Yeni bir kullanıcı oluşturur.
     * Artık customHashPassword() kullanılıyor (örnek amaçlı).
     *
     * @param string $username Kullanıcı adı.
     * @param string $password Ham şifre.
     * @return int Yeni kullanıcının ID'si.
     */
//    public function createUser(string $username, string $password)
//    {
//        $hashedPassword = $this->customHashPassword($password); // Özel hash fonksiyonunu kullan
//        $stmt = $this->db->prepare("INSERT INTO restoranlar (username, password_hash) VALUES (:username, :password_hash)");
//        $stmt->bindParam(':username', $username);
//        $stmt->bindParam(':password_hash', $hashedPassword);
//        $stmt->execute();
//        return $this->db->lastInsertId();
//    }

    /**
     * Kullanıcının oturum açmış olup olmadığını kontrol eder.
     *
     * @return bool Kullanıcı oturum açmışsa true, değilse false.
     */
    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }
}