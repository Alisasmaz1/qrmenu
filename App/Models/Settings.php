<?php

namespace App\Models;

use Core\Database;

class Settings
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    /**
     * Veritabanından settings tablosundan ayar getirir
     *
     * @param string $setting_slug Kontrol edilecek ayar keyi.
     * @return array ayar bulunsa veya bulunmasa bir dizi döner
     */
    public function getSetting(string $setting_slug): array
    {
        $query = $this->db->prepare('SELECT * FROM settings WHERE setting_key = ?');
        $query->execute([$setting_slug]);
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data || !isset($data['setting_value'])) {
            return ['is_active'=>0,'msg'=>'no content'];
        }

        return $this->decodeJSON($data);
    }


    /**
     * Veritabanından settings tablosundaki componenti çağırır
     *
     * @param string $setting_slug Kontrol edilecek ayar keyi.
     * @param array $extra_data komponentin kullanacağı ek veriler
     * @return komponenti ekrana çağırır
     */
    public function loadComponent(string $setting_slug,array $extra_data=[])
    {
        $query = $this->db->prepare('SELECT * FROM settings WHERE setting_key = ?');
        $query->execute([$setting_slug]);
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data || !isset($data['companent'])) {
            return ['is_active'=>0,'msg'=>'no companent'];
        }
        $comp_name = $data['companent'];
        $components[$comp_name] =  $this->decodeJSON($data);
        $comp_path = dirname(__DIR__)."../Views/components/".$comp_name.".php";


        include_once $comp_path;
    }

    /**
     * Gelen datadaki setting_value json verisini true parametresi ile decode eder
     *
     * @param array $data Kontrol edilecek ayar keyi.
     * @return array json decode edilmiş içerik
     */
    public function decodeJSON(array $data):array
    {
        $target = $data['setting_value'];
        $decode_target = json_decode($target,true);
        $data['setting_value'] = $decode_target;
        return $data;
    }

}