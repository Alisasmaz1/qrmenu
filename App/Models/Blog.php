<?php

namespace App\Models;

use Core\Database;

class Blog
{
    private $db;
    // Güvenli DEĞİLDİR! Sadece örnek amaçlı sabit bir tuz.
    // Gerçek bir uygulamada rastgele, benzersiz ve veritabanında saklanan tuzlar kullanılmalıdır.


    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Özel şifre hashleme fonksiyonu (Örnek amaçlı, üretim için güvenli DEĞİLDİR!).
     *
     * @return array Blog Yazıları
     */
    public function getAllPosts(): array
    {
        return array(
          ["id"=>1,"title"=>"Başlık","thumbnail"=>"image.png","created_at"=>"Thu Aug 14 2025 19:33:40 GMT+0300 (GMT+03:00)"],
          ["id"=>2,"title"=>"Başlık","thumbnail"=>"image.png","created_at"=>"Thu Aug 14 2025 19:33:40 GMT+0300 (GMT+03:00)"],
          ["id"=>3,"title"=>"Başlık","thumbnail"=>"image.png","created_at"=>"Thu Aug 14 2025 19:33:40 GMT+0300 (GMT+03:00)"],
          ["id"=>4,"title"=>"Başlık","thumbnail"=>"image.png","created_at"=>"Thu Aug 14 2025 19:33:40 GMT+0300 (GMT+03:00)"],
          ["id"=>5,"title"=>"Başlık","thumbnail"=>"image.png","created_at"=>"Thu Aug 14 2025 19:33:40 GMT+0300 (GMT+03:00)"],
        );
    }

}